<x-layout>
    <div id="reportContent" class="max-w-7xl mx-auto p-4">
        <!-- Report Header -->
        <div class="text-right mb-5 text-gray-600 font-medium">
            <div>Laporan Keuangan</div>
            <div id="periodInfo">Periode: Sedang Dimuat... <i class='bx bx-loader-alt animate-spin text-2xl text-gray-500'></i></div>
        </div>

        <!-- Date Selector -->
        <div class="bg-white rounded-lg shadow p-4 mb-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <button id="prevBtn" class="text-gray-600 hover:text-green-500 transition-colors" title="Previous Period">◀</button>
                <span id="dateDisplay" class="font-medium text-gray-800 min-w-[100px] text-center">Sedang Dimuat... <i class='bx bx-loader-alt animate-spin text-2xl text-gray-500'></i></span>
                <button id="nextBtn" class="text-gray-600 hover:text-green-500 transition-colors" title="Next Period">▶</button>
            </div>
            <div class="flex gap-3">
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-green-500 text-white rounded font-medium transition-colors" id="monthlyBtn" aria-pressed="true">Bulanan</button>
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded transition-colors" id="yearlyBtn" aria-pressed="false">Tahunan</button>
                </div>
                <button class="px-4 py-2 bg-green-500 text-white rounded font-medium hover:bg-green-600 transition-colors" id="exportBtn" title="Export report as PDF">Export PDF</button>
            </div>
        </div>

        <!-- Statistics Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
            <!-- Total Revenue -->
            <div class="bg-white p-5 rounded-lg shadow">
                <div class="text-gray-500 text-sm mb-1">Total Pendapatan</div>
                <div id="totalRevenue" class="text-3xl font-bold mb-1">Sedang Dimuat.. <i class='bx bx-loader-alt animate-spin text-2xl text-gray-500'></i></div>
                <div id="revenueChange" class="text-green-500 text-sm flex items-center gap-1">
                    <span>↗</span>
                    
                </div>
            </div>
            <!-- Total Orders -->
            <div class="bg-white p-5 rounded-lg shadow">
                <div class="text-gray-500 text-sm mb-1">Total Pesanan</div>
                <div id="totalOrders" class="text-3xl font-bold mb-1">Sedang Dimuat.. <i class='bx bx-loader-alt animate-spin text-2xl text-gray-500'></i></div>
                <div id="ordersChange" class="text-green-500 text-sm flex items-center gap-1">
                    <span>↗</span>
                    
                </div>
            </div>
            <!-- Average Order -->
            <div class="bg-white p-5 rounded-lg shadow">
                <div class="text-gray-500 text-sm mb-1">Rata-rata per Pesanan</div>
                <div id="avgOrder" class="text-3xl font-bold mb-1">Sedang Dimuat.. <i class='bx bx-loader-alt animate-spin text-2xl text-gray-500'></i></div>
                <div id="avgOrderChange" class="text-green-500 text-sm flex items-center gap-1">
                    <span>↗</span>
                    
                </div>
            </div>
            <!-- Best Seller -->
            <div class="bg-white p-5 rounded-lg shadow">
                <div class="text-gray-500 text-sm mb-1">Menu Terlaris</div>
                <div id="bestSeller" class="text-3xl font-bold mb-1">Sedang Dimuat.. <i class='bx bx-loader-alt animate-spin text-2xl text-gray-500'></i></div>
                <div id="bestSellerStats" class="text-green-500 text-sm">
                    
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="bg-white p-5 rounded-lg shadow mb-6">
            <div id="chartTitle" class="text-lg font-semibold mb-5">Grafik Pendapatan Harian Sedang Dimuat... <i class='bx bx-loader-alt animate-spin text-2xl text-gray-500'></i></div>
            <div class="h-[300px]">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-5 border-b border-gray-200">
                <div id="tableTitle" class="text-lg font-semibold">Data Pesanan Sedang Dimuat... <i class='bx bx-loader-alt animate-spin text-2xl text-gray-500'></i></div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">Tanggal</th>
                            <th class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">Pelanggan</th>
                            <th class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">Menu</th>
                            <th class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">Subtotal</th>
                            <th class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">Diskon</th>
                            <th class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">Total</th>
                            <th class="py-3 px-4 text-left font-semibold text-gray-600 tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody id="ordersTableBody" class="tracking-wider">
                        <!-- Table data will be dynamically updated -->
                    </tbody>
                    <tfoot id="tableFoot">

                    </tfoot>
                </table>
            </div>
            <div class="p-5 flex justify-between items-center">
                <div id="paginationInfo">Halaman 1 dari 4</div>
                <div class="flex gap-2">
                    <button id="prevPage" class="px-3 py-2 border border-gray-300 rounded" title="Previous page">←</button>
                    <button class="pageBtn px-3 py-2 bg-green-500 text-white border border-green-500 rounded" data-page="1">1</button>
                    <button class="pageBtn px-3 py-2 border border-gray-300 rounded" data-page="2">2</button>
                    <button class="pageBtn px-3 py-2 border border-gray-300 rounded" data-page="3">3</button>
                    <button class="pageBtn px-3 py-2 border border-gray-300 rounded" data-page="4">4</button>
                    <button id="nextPage" class="px-3 py-2 border border-gray-300 rounded" title="Next page">→</button>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="text-xs text-gray-500 mt-6" id="reportFooter">
            Laporan ini dicetak pada 27 April 2025, 12:00 WIB
        </div>
    </div>
    @section('scriptAO')
    @include('script.owner.owner')
    @stop
</x-layout>