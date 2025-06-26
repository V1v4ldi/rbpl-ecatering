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
    // ✅ Check library availability first
    if (typeof html2canvas === 'undefined') {
        alert('Library html2canvas tidak tersedia. Refresh halaman dan coba lagi.');
        return;
    }
    
    if (typeof window.jspdf === 'undefined') {
        alert('Library jsPDF tidak tersedia. Refresh halaman dan coba lagi.');
        return;
    }

    const { jsPDF } = window.jspdf;
    const content = document.getElementById('reportContent');
    
    if (!content) {
        alert('Elemen konten laporan tidak ditemukan!');
        return;
    }

    const exportButton = document.getElementById('exportBtn');
    const originalButtonHTML = exportButton.innerHTML;
    
    exportButton.innerHTML = `
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Mengekspor...`;
    exportButton.disabled = true;

    const selectorsToHide = [
        '#prevBtn', '#nextBtn', '#monthlyBtn', '#yearlyBtn', '#exportBtn', 
        '#paginationInfo', '.pageBtn', '#prevPage', '#nextPage', 
        '#loadingOverlay', '.hover\\:text-green-500'
    ];
    
    const hiddenElements = [];
    selectorsToHide.forEach(selector => {
        document.querySelectorAll(selector).forEach(function(el) {
            if (el && el.style.display !== 'none') {
                hiddenElements.push({ element: el, originalDisplay: el.style.display });
                el.style.display = 'none';
            }
        });
    });

    document.body.classList.add('pdf-export-mode');

    try {
        console.log('Starting PDF export...');
        
        // ✅ Wait longer for CSS to apply
        await new Promise(resolve => setTimeout(resolve, 1200));

        console.log('Creating canvas...');
        
        const canvas = await html2canvas(content, {
            scale: 1.5,
            useCORS: true,
            allowTaint: false,
            scrollY: -window.scrollY,
            scrollX: -window.scrollX,
            backgroundColor: '#ffffff',
            logging: false,
            width: content.scrollWidth,
            height: content.scrollHeight,
            onclone: function(clonedDoc) {
                // ✅ Force PDF mode and override colors
                clonedDoc.body.classList.add('pdf-export-mode');
                
                // ✅ Remove all CSS custom properties that might contain oklch
                const allElements = clonedDoc.querySelectorAll('*');
                allElements.forEach(el => {
                    // Remove transitions and animations
                    el.style.transition = 'none';
                    el.style.animation = 'none';
                    el.style.transform = 'none';
                    
                    // Force override color classes with RGB
                    const classList = Array.from(el.classList);
                    classList.forEach(className => {
                        if (className.includes('green-500')) {
                            if (className.includes('bg-')) el.style.backgroundColor = 'rgb(34, 197, 94)';
                            if (className.includes('text-')) el.style.color = 'rgb(34, 197, 94)';
                            if (className.includes('border-')) el.style.borderColor = 'rgb(34, 197, 94)';
                        }
                        if (className.includes('white')) {
                            if (className.includes('bg-')) el.style.backgroundColor = 'rgb(255, 255, 255)';
                            if (className.includes('text-')) el.style.color = 'rgb(255, 255, 255)';
                        }
                        if (className.includes('gray-')) {
                            if (className.includes('gray-50')) {
                                if (className.includes('bg-')) el.style.backgroundColor = 'rgb(249, 250, 251)';
                                if (className.includes('text-')) el.style.color = 'rgb(249, 250, 251)';
                            }
                            if (className.includes('gray-200')) {
                                if (className.includes('border-')) el.style.borderColor = 'rgb(229, 231, 235)';
                            }
                            if (className.includes('gray-500')) {
                                if (className.includes('text-')) el.style.color = 'rgb(107, 114, 128)';
                            }
                            if (className.includes('gray-600')) {
                                if (className.includes('text-')) el.style.color = 'rgb(75, 85, 99)';
                            }
                        }
                    });
                });
            }
        });

        console.log('Canvas created successfully, generating PDF...');

        const imgData = canvas.toDataURL('image/png', 0.95);
        const pdf = new jsPDF('p', 'mm', 'a4');
        
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = pdf.internal.pageSize.getHeight();
        const imgProps = pdf.getImageProperties(imgData);
        const imgWidth = imgProps.width;
        const imgHeight = imgProps.height;
        
        const margin = 10;
        const availableWidth = pdfWidth - (margin * 2);
        const availableHeight = pdfHeight - (margin * 2);
        
        const widthRatio = availableWidth / imgWidth;
        const heightRatio = availableHeight / imgHeight;
        const ratio = Math.min(widthRatio, heightRatio);
        
        const newWidth = imgWidth * ratio;
        const newHeight = imgHeight * ratio;
        const x = (pdfWidth - newWidth) / 2;
        const y = margin;

        pdf.addImage(imgData, 'PNG', x, y, newWidth, newHeight, '', 'FAST');
        
        const dateDisplayElement = document.getElementById('dateDisplay');
        const periodText = dateDisplayElement ? 
            dateDisplayElement.textContent.replace(/[^a-zA-Z0-9\s]/g, '').replace(/\s+/g, '_') : 
            'report';
        const timestamp = new Date().toISOString().slice(0, 10);
        const filename = `Laporan_ECatering_${periodText}_${timestamp}.pdf`;
        
        console.log('Saving PDF as:', filename);
        pdf.save(filename);
        
        alert('PDF berhasil diekspor!');

    } catch (err) {
        console.error("PDF Export Error:", err);
        
        let errorMessage = 'Gagal mengekspor PDF: ' + err.message;
        
        // ✅ Handle specific oklch error
        if (err.message.includes('oklch') || err.message.includes('color function')) {
            errorMessage = 'Error warna CSS terdeteksi. Mencoba refresh halaman...';
            alert(errorMessage);
            // Auto refresh as fallback
            setTimeout(() => window.location.reload(), 2000);
            return;
        }
        
        alert(errorMessage);
        
    } finally {
        hiddenElements.forEach(item => {
            if (item.element) {
                item.element.style.display = item.originalDisplay;
            }
        });
        
        document.body.classList.remove('pdf-export-mode');
        exportButton.innerHTML = originalButtonHTML;
        exportButton.disabled = false;
        
        console.log('PDF export process completed.');
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

    let allOrdersData = [];
    let currentPage = 1;
    const itemsPerPage = 5;

    function renderTablePage() {
        const $tb = $('#ordersTableBody').empty();
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const pageOrders = allOrdersData.slice(startIndex, endIndex);

        if (pageOrders.length > 0) {
            pageOrders.forEach(o => {
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
    }

    // --- FUNGSI BARU UNTUK UPDATE KONTROL PAGINASI ---
    function updatePaginationControls() {
        const totalPages = Math.ceil(allOrdersData.length / itemsPerPage);
        const paginationContainer = $('#paginationInfo').parent();

        if (totalPages <= 1) {
            paginationContainer.hide();
            return;
        }
        
        paginationContainer.show();
        $('#paginationInfo').text(`Halaman ${currentPage} dari ${totalPages}`);
        $('#prevPage').prop('disabled', currentPage === 1).toggleClass('opacity-50 cursor-not-allowed', currentPage === 1);
        $('#nextPage').prop('disabled', currentPage === totalPages).toggleClass('opacity-50 cursor-not-allowed', currentPage === totalPages);

        // Update tombol angka (opsional, tapi bagus)
        $('.pageBtn').each(function() {
            const pageNum = $(this).data('page');
            $(this).toggleClass('bg-green-500 text-white', pageNum === currentPage)
                   .toggleClass('border-gray-300', pageNum !== currentPage);
        });
    }

    function updatePeriodString() {
        period = (view === 'monthly')
            ? `${currentSelectedYear}-${String(currentSelectedMonth + 1).padStart(2, '0')}`
            : `${currentSelectedYear}`;
    }

    function loadReport() {
        updatePeriodString();
        $('#loadingOverlay').show();
        $.getJSON(`/owner/report-data/${view}/${period}`, function(data) {
            // ... (Update statistik, chart, dll. tetap sama) ...
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

            // --- LOGIKA BARU DI SINI ---
            allOrdersData = data.orders || []; // Simpan semua data
            currentPage = 1; // Reset ke halaman pertama setiap kali load data baru

            renderTablePage(); // Render halaman pertama
            updatePaginationControls(); // Update tombol paginasi

            // Hitung total untuk footer dari SEMUA data, bukan hanya per halaman
            let sumSub = 0, sumDisc = 0, sumTot = 0;
            allOrdersData.forEach(o => {
                sumSub += parseFloat(o.subtotal) || 0;
                sumDisc += parseFloat(o.discount) || 0;
                sumTot += parseFloat(o.total) || 0;
            });

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

    function initializeReportPage() {
        $('#loadingOverlay').show();
        // Panggil endpoint baru untuk mendapatkan periode terbaru
        $.getJSON('{{ route("owner.latestPeriod") }}')
            .done(function(data) {
                // Jika berhasil, atur state berdasarkan respons server
                const periodParts = data.latest_period.split('-');
                currentSelectedYear = parseInt(periodParts[0], 10);
                
                view = data.latest_type;
                if (view === 'monthly') {
                    currentSelectedMonth = parseInt(periodParts[1], 10) - 1; // -1 karena bulan 0-indexed
                }
                
                // Update tampilan tombol (monthly/yearly)
                if(view === 'yearly'){
                    $('#yearlyBtn').click();
                } else {
                    $('#monthlyBtn').click();
                }

            })
            .fail(function() {
                // Jika gagal, gunakan tanggal hari ini sebagai fallback (perilaku lama)
                console.error("Gagal mendapatkan periode laporan terbaru. Menggunakan tanggal saat ini.");
                currentSelectedYear = currentActualYear;
                currentSelectedMonth = currentActualMonth;
                view = 'monthly';
            })
            .always(function() {
                // Setelah mendapatkan periode yang benar, panggil loadReport
                loadReport();
            });
    }

    window.addEventListener('DOMContentLoaded', function() {
        $('#monthlyBtn').click(function() {
            if (view === 'monthly') return;
            view = 'monthly';
            $(this).addClass('bg-green-500 text-white').removeClass('bg-white border-gray-300 text-gray-700 hover:bg-gray-50').attr('aria-pressed', 'true');
            $('#yearlyBtn').removeClass('bg-green-500 text-white').addClass('bg-white border-gray-300 text-gray-700 hover:bg-gray-50').attr('aria-pressed', 'false');
            loadReport();
        });

        $('#yearlyBtn').click(function() {
            if (view === 'yearly') return;
            view = 'yearly';
            $(this).addClass('bg-green-500 text-white').removeClass('bg-white border-gray-300 text-gray-700 hover:bg-gray-50').attr('aria-pressed', 'true');
            $('#monthlyBtn').removeClass('bg-green-500 text-white').addClass('bg-white border-gray-300 text-gray-700 hover:bg-gray-50').attr('aria-pressed', 'false');
            loadReport();
        });

        // --- TAMBAHKAN EVENT LISTENER YANG HILANG DI SINI ---
        $('#prevBtn').click(function() {
            if (view === 'monthly') {
                currentSelectedMonth--;
                if (currentSelectedMonth < 0) {
                    currentSelectedMonth = 11; // Kembali ke Desember
                    currentSelectedYear--;
                }
            } else { // yearly
                currentSelectedYear--;
            }
            loadReport();
        });

        $('#nextBtn').click(function() {
            if ($(this).prop('disabled')) return; // Jangan lakukan apa-apa jika tombol dinonaktifkan
            if (view === 'monthly') {
                currentSelectedMonth++;
                if (currentSelectedMonth > 11) {
                    currentSelectedMonth = 0; // Kembali ke Januari
                    currentSelectedYear++;
                }
            } else { // yearly
                currentSelectedYear++;
            }
            loadReport();
        });

        $('#prevPage').click(function() {
            if (currentPage > 1) {
                currentPage--;
                renderTablePage();
                updatePaginationControls();
            }
        });

        $('#nextPage').click(function() {
            const totalPages = Math.ceil(allOrdersData.length / itemsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderTablePage();
                updatePaginationControls();
            }
        });

        $('.pageBtn').click(function() {
            const pageNum = $(this).data('page');
            const totalPages = Math.ceil(allOrdersData.length / itemsPerPage);
            if (pageNum >= 1 && pageNum <= totalPages) {
                currentPage = pageNum;
                renderTablePage();
                updatePaginationControls();
            }
        });

        $('#exportBtn').click(exportToPDF);
    });
    window.addEventListener('load', function(){initializeReportPage();});
</script>