<script>
    // Helper Functions
    function formatCurrency(value) {
        if (isNaN(parseFloat(value))) return 'Rp 0';
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(value);
    }

    function updateChangeDisplay(elementId, change) {
        const $el = $('#' + elementId);
        if (change === null || typeof change === 'undefined' || isNaN(parseFloat(change))) {
            $el.html('<span>-</span>').removeClass('text-green-500 text-red-500').addClass('text-gray-500');
            return;
        }
        const changeValue = parseFloat(change);
        const arrow = changeValue > 0 ? '↗' : (changeValue < 0 ? '↘' : '→');
        $el.html(`<span>${arrow}</span> ${Math.abs(changeValue)}% dari periode lalu`)
           .removeClass('text-green-500 text-red-500 text-gray-500')
           .addClass(changeValue > 0 ? 'text-green-500' : (changeValue < 0 ? 'text-red-500' : 'text-gray-500'));
    }

    let revenueChartInstance; // Global/scoped chart instance

    function updateChart(chartDisplayTitle, chartLabelsArray, chartDataArray) {
        const canvas = document.getElementById('revenueChart');
        if (!canvas) {
            console.error("Canvas element #revenueChart not found!");
            return;
        }
        const ctx = canvas.getContext('2d');

        if (revenueChartInstance) {
            revenueChartInstance.destroy();
        }

        $('#chartTitle').text(chartDisplayTitle);

        revenueChartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabelsArray,
                datasets: [{
                    label: 'Pendapatan',
                    data: chartDataArray,
                    borderColor: '#22c55e', // Warna hijau dari owner.html
                    backgroundColor: 'rgba(34, 197, 94, 0.2)', // Warna area hijau muda
                    fill: true,
                    tension: 0.3,
                    pointRadius: 3,
                    pointBackgroundColor: '#22c55e',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: '#22c55e',
                    pointHoverBorderColor: '#fff',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) { return formatCurrency(value); },
                            font: { size: 10 }
                        },
                        grid: { display: true, color: 'rgba(200, 200, 200, 0.1)'}
                    },
                    x: {
                        ticks: { font: { size: 10 } },
                        grid: { display: false }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.7)',
                        titleFont: { size: 14 },
                        bodyFont: { size: 12 },
                        padding: 10,
                        callbacks: {
                            title: function(tooltipItems) {
                                // Untuk tampilan bulanan, label adalah tanggal. Untuk tahunan, label adalah bulan.
                                return view === 'monthly' ? `Tanggal ${tooltipItems[0].label}` : tooltipItems[0].label;
                            },
                            label: function(context) {
                                return `Pendapatan: ${formatCurrency(context.parsed.y)}`;
                            }
                        }
                    }
                }
            }
        });
    }

    async function exportToPDF() {
    const { jsPDF } = window.jspdf;
    const content = document.getElementById('reportContent');
    if (!content) {
        alert('Elemen konten laporan (#reportContent) tidak ditemukan!');
        return;
    }
    const exportButton = document.getElementById('exportBtn'); // Menggunakan Vanilla JS
    const originalButtonHTML = exportButton.innerHTML; // Menggunakan Vanilla JS
    exportButton.innerHTML = `
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Mengekspor...`;
    exportButton.disabled = true; // Menggunakan Vanilla JS

    const selectorsToHide = ['header > .flex.items-center.gap-4', '#prevBtn', '#nextBtn', '#monthlyBtn', '#yearlyBtn', '#exportBtn', '#paginationInfo', '.pageBtn', '#prevPage', '#nextPage', '#loadingOverlay'];
    const hiddenElements = [];
    selectorsToHide.forEach(selector => {
        document.querySelectorAll(selector).forEach(function(el) { // Menggunakan Vanilla JS
            if (el.style.display !== 'none') {
                hiddenElements.push({ element: el, originalDisplay: el.style.display });
                el.style.display = 'none';
            }
        });
    });

    // Tambahkan kelas ke body untuk mengaktifkan style PDF-friendly
    document.body.classList.add('pdf-export-mode');

    try {
        await new Promise(resolve => setTimeout(resolve, 100)); // Beri waktu browser menerapkan display:none

        const canvas = await html2canvas(content, {
            scale: 1.5,
            useCORS: true,
            scrollY: -window.scrollY,
            backgroundColor: '#ffffff', // Pastikan ini warna sederhana
            logging: true, // Aktifkan logging untuk detail lebih lanjut dari html2canvas
        });

        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF('p', 'mm', 'a4');
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = pdf.internal.pageSize.getHeight();
        const imgProps = pdf.getImageProperties(imgData);
        const imgWidth = imgProps.width;
        const imgHeight = imgProps.height;
        const ratio = Math.min((pdfWidth - 20) / imgWidth, (pdfHeight - 20) / imgHeight);
        const newWidth = imgWidth * ratio;
        const newHeight = imgHeight * ratio;
        const x = (pdfWidth - newWidth) / 2;
        const y = 10;

        pdf.addImage(imgData, 'PNG', x, y, newWidth, newHeight);
        const dateDisplayElement = document.getElementById('dateDisplay');
        const periodText = dateDisplayElement ? dateDisplayElement.textContent.replace(/[^a-zA-Z0-9]/g, '_') : 'report';
        pdf.save(`Laporan_ECatering_${periodText}.pdf`);

    } catch (err) {
        alert('Gagal mengekspor PDF: ' + err.message);
        console.error("PDF Export Error:", err);
    } finally {
        hiddenElements.forEach(item => item.element.style.display = item.originalDisplay);
        document.body.classList.remove('pdf-export-mode');
        exportButton.innerHTML = originalButtonHTML; // Menggunakan Vanilla JS
        exportButton.disabled = false; // Menggunakan Vanilla JS
    }
}

    // Variabel global untuk state
    let view = 'monthly';
    const today = new Date();
    const currentActualMonth = today.getMonth(); // 0-indexed
    const currentActualYear = today.getFullYear();
    let currentSelectedYear = currentActualYear;
    let currentSelectedMonth = currentActualMonth; // 0-indexed
    let period = ''; // Akan di-set oleh updatePeriodString

    function updatePeriodString() {
        period = (view === 'monthly')
            ? `${currentSelectedYear}-${String(currentSelectedMonth + 1).padStart(2, '0')}`
            : `${currentSelectedYear}`;
    }

    function loadReport() {
        updatePeriodString();
        $('#loadingOverlay').show();
        $.getJSON(`/owner/report-data/${view}/${period}`, function(data) {
            $('#totalRevenue').text(formatCurrency(data.totalRevenue));
            $('#totalOrders').text(data.totalOrders);
            $('#avgOrder').text(formatCurrency(data.avgOrder));
            $('#bestSeller').text(data.bestSeller || 'N/A');
            $('#bestSellerStats').text(data.bestSellerStats || 'Data tidak tersedia');

            updateChangeDisplay('revenueChange', data.revenueChange);
            updateChangeDisplay('ordersChange', data.orderChange);
            updateChangeDisplay('avgOrderChange', data.avgOrderChange);

            $('#periodInfo').text(`Periode: ${data.displayPeriodForTitle}`);
            $('#dateDisplay').text(data.displayPeriodForTitle);
            $('#tableTitle').text(`Data Pesanan (5 Teratas) - ${data.displayPeriodForTitle}`);

            const chartTitle = `Grafik Pendapatan ${data.reportTypeForTitle} (${data.displayPeriodForTitle})`;
            updateChart(chartTitle, data.labels, data.values);

            const $tb = $('#ordersTableBody').empty();
            let sumSub = 0, sumDisc = 0, sumTot = 0;
            if (data.orders && data.orders.length > 0) {
                data.orders.forEach(o => {
                    sumSub += parseFloat(o.subtotal) || 0;
                    sumDisc += parseFloat(o.discount) || 0;
                    sumTot += parseFloat(o.total) || 0;
                    $tb.append(
                        `<tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">${o.date}</td>
                            <td class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">${o.customer}</td>
                            <td class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">${o.menu}</td>
                            <td class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">${formatCurrency(o.subtotal)}</td>
                            <td class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">${formatCurrency(o.discount)}</td>
                            <td class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">${formatCurrency(o.total)}</td>
                            <td class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">${o.status}</td>
                        </tr>`
                    );
                });
            } else {
                $tb.append('<tr><td colspan="7" class="py-10 px-4 text-center text-gray-500">Tidak ada data pesanan untuk periode ini.</td></tr>');
            }

            $('#tableFoot').html(
                `<tr>
                    <td class="py-3 px-4">Total</td>
                    <td colspan="2"></td>
                    <td class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">${formatCurrency(sumSub)}</td>
                    <td class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">${formatCurrency(sumDisc)}</td>
                    <td class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">${formatCurrency(sumTot)}</td>
                    <td class="py-3 px-4"></td>
                </tr>`
            );
            $('#reportFooter').text(`Laporan ini dicetak pada ${new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit', hour12: false })} WIB`);

            // Disable/Enable tombol navigasi
            const $nextBtn = $('#nextBtn');
            const isFuturePeriod = (view === 'monthly' && (currentSelectedYear > currentActualYear || (currentSelectedYear === currentActualYear && currentSelectedMonth >= currentActualMonth))) ||
                                 (view === 'yearly' && currentSelectedYear >= currentActualYear);
            $nextBtn.prop('disabled', isFuturePeriod).toggleClass('opacity-50 cursor-not-allowed', isFuturePeriod).toggleClass('hover:text-green-500 hover:bg-gray-100', !isFuturePeriod);
            // Anda bisa menambahkan logika untuk #prevBtn jika ada batasan historis
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Error fetching report data:", textStatus, errorThrown);
            $('#ordersTableBody').html('<tr><td colspan="7" class="py-10 px-4 text-center text-red-500">Gagal memuat data laporan. Silakan coba lagi.</td></tr>');
            alert("Gagal memuat data laporan. Periksa konsol untuk detail.");
        })
        .always(function() {
            $('#loadingOverlay').hide();
        });
    }

    window.addEventListener('DOMContentLoaded', function() {
        $('#monthlyBtn').click(function() {
            if (view === 'monthly') return;
            view = 'monthly';
            currentSelectedYear = currentActualYear; // Reset ke tahun saat ini
            currentSelectedMonth = currentActualMonth; // Reset ke bulan saat ini
            $(this).addClass('bg-green-500 text-white').removeClass('bg-white border-gray-300 text-gray-700 hover:bg-gray-50').attr('aria-pressed', 'true');
            $('#yearlyBtn').removeClass('bg-green-500 text-white').addClass('bg-white border-gray-300 text-gray-700 hover:bg-gray-50').attr('aria-pressed', 'false');
            loadReport();
        });

        $('#yearlyBtn').click(function() {
            if (view === 'yearly') return;
            view = 'yearly';
            currentSelectedYear = currentActualYear; // Reset ke tahun saat ini
            $(this).addClass('bg-green-500 text-white').removeClass('bg-white border-gray-300 text-gray-700 hover:bg-gray-50').attr('aria-pressed', 'true');
            $('#monthlyBtn').removeClass('bg-green-500 text-white').addClass('bg-white border-gray-300 text-gray-700 hover:bg-gray-50').attr('aria-pressed', 'false');
            loadReport();
        });

        $('#prevBtn').click(function() {
            if (view === 'monthly') {
                currentSelectedMonth--;
                if (currentSelectedMonth < 0) {
                    currentSelectedMonth = 11;
                    currentSelectedYear--;
                }
            } else {
                currentSelectedYear--;
            }
            // Tambahkan batasan historis jika perlu, misal: if (currentSelectedYear < 2020) return;
            loadReport();
        });

        $('#nextBtn').click(function() {
            if ($(this).prop('disabled')) return; // Jangan lakukan apa-apa jika tombol disabled
            if (view === 'monthly') {
                currentSelectedMonth++;
                if (currentSelectedMonth > 11) {
                    currentSelectedMonth = 0;
                    currentSelectedYear++;
                }
            } else {
                currentSelectedYear++;
            }
            loadReport();
        });

        $('#exportBtn').click(exportToPDF);

    });
    window.addEventListener('load', function(){loadReport();});
</script>