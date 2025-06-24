<x-layout>
    <div class="max-w-7xl mx-auto p-6" x-data="{tab: 'cart'}">
        <h1 class="text-2xl mb-6 text-gray-800" x-text="
            tab === 'cart' ? 'Keranjang Belanja' :
            tab === 'bd' ? 'Belum Dibayar' :
            tab === 'dp' ? 'Pesanan Saya' :
            tab === 'dn' ? 'Selesai' : ''
            "></h1>
        
        <div class="flex border-b border-slate-200 mb-6 gap-8 lg:gap-0">
            <div @click="tab = 'cart'"
            :class="tab == 'cart' ? 'border-b-2 border-blue-500' : 'border-transparent'"
            class="px-4 py-3 cursor-pointer flex items-center gap-2 text-gray-600 ">
                <i class='bx bx-cart' ></i> <span class="hidden lg:block">Keranjang Belanja</span>
            </div>
            <div @click="tab = 'bd'"
            :class="tab == 'bd' ? 'border-b-2 border-blue-500' : 'border-transparent'"
            class="px-4 py-3 cursor-pointer flex items-center gap-2 text-gray-600 ">
                <i class='bx bxs-credit-card'></i> <span class="hidden lg:block">Belum Bayar</span>
            </div>
            <div @click="tab = 'dp'"
            :class="tab == 'dp' ? 'border-b-2 border-blue-500' : 'border-transparent'"
            class="px-4 py-3 cursor-pointer flex items-center gap-2 text-gray-600 ">
                <i class='bx bxs-package'></i> <span class="hidden lg:block">Diproses</span>
            </div>
            <div @click="tab = 'dn'"
            :class="tab == 'dn' ? 'border-b-2 border-blue-500' : 'border-transparent'"
            class="px-4 py-3 cursor-pointer flex items-center gap-2 text-gray-600 ">
                <i class='bx bx-check-double text-xl'></i> <span class="hidden lg:block">Selesai</span>
            </div>
        </div>

        <div x-show="tab === 'cart'" x-cloak class="bg-gray-100 p-3 rounded-[6px]">
            <div id="containercart">
                
            </div>
            <div class="mt-6 float-right">
                <a href="{{ route("order") }}" class="py-2 px-4 rounded-[6px] text-gray-200 bg-green-500 text-sm cursor-pointer ml-2 hover:bg-green-600 hover:text-gray-1<span>00 hover:-translate-y-2 duration-300">
                    <i class='bx bx-cart' ></i> Checkout
                </a>
            </div>
        </div>

        {{-- Belum Dibayar --}}
        
        <div x-show="tab ==='bd'" x-cloak class="bg-gray-100 p-3 rounded-[6px]">
            <div id="ordercontainer">

            </div>
        </div>
        
        {{-- Diproses --}}

        <div x-show="tab ==='dp'" x-cloak class="bg-gray-100 p-3 rounded-[6px]">
            <div id="dpContainer">
                
            </div>
        </div>
        
        {{-- Selesai --}}

        <div x-show="tab === 'dn'" x-cloak class="bg-gray-100 p-3 rounded-[6px]">
            <div id="dnContainer">

            </div>
        </div>
    </div>
    @section('script')
    @include('script.render-cart')
    @include('script.render-order')
    @include('script.diproses-render')
    @include('script.render-selesai')
    @include('script.cart-item-get')
    @include('script.cart-order-get-script')
    @include('script.remove-cart-item')
    @stop
</x-layout>