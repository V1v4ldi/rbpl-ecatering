<x-layout>
    @php
            $changeprofile = null;
            $changepass = null;
            $usertype = null;

            if(Auth::guard('customer')->check()) { 
                $usertype = Auth::guard('customer')->user();
                $changeprofile = 'cust.cred';
                $changepass = 'cust.pass';
                
            }
            elseif(Auth::guard('owner')->check()) {
                $usertype = Auth::guard('owner')->user();
                $changeprofile = 'owner.cred';
                $changepass = 'owner.pass';
            }
            elseif (Auth::guard('admin')->check()) {
                $usertype = Auth::guard('admin')->user();
                $changeprofile = 'admin.cred';
                $changepass = 'admin.pass';
        }
    @endphp

    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="max-w-7xl mx-auto px-4 py-8" x-data="{ tab:@if(session('error') || $errors->any()) 'US' @else 'IP' @endif }" x-cloak>
        <h1 class="text-2xl font-semibold mb-8">Profil Saya</h1>

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Sidebar Navigation -->
            <div class="lg:w-full md:w-64 bg-white rounded-lg shadow-sm">

              {{-- Info Pribadi --}}

                <button @click="tab = 'IP'" 
                type="button" :class="tab == 'IP' ? 'border-[#ff9a00]' : 'border-transparent'"
                class="border-l-4 bg-primary-light py-4 px-5 flex items-center cursor-pointer tab-item active">
                    <div :class="tab == 'IP' ? 'bg-[#ff9a00]' : 'bg-gray-400'"
                    class="w-5 h-5 rounded-full mr-3"></div>
                    <span>Informasi Pribadi</span>
                </button>

                {{-- Riwayat Pesanan --}}
                @auth
                    @if(auth()->user()->role === 'customer')
                <button @click="tab = 'RP'" 
                type="button" :class="tab == 'RP' ? 'border-[#ff9a00]' : 'border-transparent'"
                class="border-l-4 hover:bg-gray-50 py-4 px-5 flex items-center cursor-pointer tab-item">
                <div :class="tab == 'RP' ? 'bg-[#ff9a00]' : 'bg-gray-400'"
                class="w-5 h-5 rounded-full mr-3"></div>
                <span>Riwayat Pesanan</span>
            </button>
                @else
                @endif
            @endauth

                {{-- Ubah sandi --}}

                <button @click="tab = 'US'"
                type="button" :class="tab == 'US' ? 'border-[#ff9a00]' : 'border-transparent'"
                class="border-l-4 hover:bg-gray-50 py-4 px-5 flex items-center cursor-pointer tab-item">
                    <div :class="tab == 'US' ? 'bg-[#ff9a00]' : 'bg-gray-400'"
                    class="w-5 h-5 rounded-full mr-3"></div>
                    <span>Ubah Sandi</span>
                </button>



            </div>

            <!-- Tab Content -->
            <div class="flex-1 bg-white rounded-lg shadow-sm p-6">
                <!-- Informasi Pribadi Tab -->
                <div x-show="tab === 'IP'">
                    <h2 class="text-xl font-semibold mb-5 pb-4 border-b border-gray-200">Informasi Pribadi</h2>
                    <form method="POST" action="{{ route($changeprofile) }}">
                        @csrf
                        <div class="mb-5">
                            <label for="nama" class="block mb-2 font-medium">Nama Lengkap</label>
                            <input type="text" id="nama" class="w-full px-4 py-3 border border-gray-300 rounded-md text-base" name="name" value="{{ $usertype->name }}">
                        </div>
                        <div class="mb-5">
                            <label for="email" class="block mb-2 font-medium">Email</label>
                            <input type="email" id="email" class="w-full px-4 py-3 border border-gray-300 rounded-md text-base" name="email" value="{{ $usertype->email }}">
                        </div>
                        <div class="mb-5">
                            <label for="phone" class="block mb-2 font-medium">Nomor Telepon</label>
                            <input type="tel" id="phone" class="w-full px-4 py-3 border border-gray-300 rounded-md text-base" name="no_hp" value="{{ $usertype->no_hp }}">
                        </div>
                        <div class="text-right mt-6 float-right">
                            <button type="submit" class="bg-[#ff9a00] hover:bg-white/90 hover:text-black hover:border-[#ff9a00] border-1 border-transparent text-white font-medium py-3 px-5 rounded-md transition cursor-pointer duration-300">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                @auth
                    @if(auth()->user()->role === 'customer')
                <!-- Riwayat Pesanan Tab -->
                <div x-show="tab === 'RP'">
                    <h2 class="text-xl font-semibold mb-5 pb-4 border-b border-gray-200">Riwayat Pesanan</h2>
                    
                    @if($orders && $orders->count() > 0)
            @foreach($orders as $order)
            <!-- Order Loop -->
            <div class="border border-gray-200 rounded-lg p-4 mb-5 bg-gray-50">
                <div class="flex justify-between items-center pb-3 mb-3 border-b border-gray-200">
                    <div class="font-semibold text-base">{{ $order->order_id }}</div>
                    <div class="bg-green-100 text-green-800 px-4 py-1 rounded-full text-sm font-medium">
                        {{ $order->status_pesanan }}
                    </div>
                </div>
                
                <div class="text-gray-600 mb-3">
                    {{ $order->tanggal_format }} • {{ $order->waktu_format }}
                </div>
                
                {{-- Loop order details --}}
                @foreach($order->orderDetails as $detail)
                <div class="flex justify-between mb-1.5">
                    <span>{{ $detail->product->nama }}</span>
                    <span>Rp {{ number_format($detail->harga_now * $order->jumlah, 0, ',', '.') }}</span>
                </div>
                @endforeach
                
                <div class="flex justify-between pt-3 mt-3 border-t border-gray-200 font-semibold">
                    <span>Total:</span>
                    <span>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                </div>
                
                <div class="text-right mt-3">
                    <a href="{{ route('order') }}" class="border border-[#ff9a00] text-[#ff9a00] hover:bg-[#ff9a00] hover:text-white px-4 py-2 rounded-md text-sm transition">
                        Pesan Lagi
                    </a>
                </div>
            </div>
            @endforeach
        @else
            {{-- Jika tidak ada order --}}
            <div class="text-center py-8">
                <div class="mb-4">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pesanan</h3>
                <p class="text-gray-600 mb-4">Anda belum memiliki riwayat pesanan yang selesai.</p>
                <a href="/menu" class="bg-[#ff9a00] hover:bg-[#ff6a00] text-white px-6 py-2 rounded-md transition">
                    Mulai Pesan
                </a>
            </div>
                @endif
        </div>
            @endif
        @endauth

                <!-- Ubah Sandi Tab -->
                <div x-show="tab === 'US'">
                    <h2 class="text-xl font-semibold mb-5 pb-4 border-b border-gray-200">Keamanan Akun</h2>
                    {{-- Display Error Message --}}
                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Display Validation Errors --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium">
                                        <ul class="list-disc list-inside space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route($changepass) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="current-password" class="block mb-2 font-medium">Password Saat Ini</label>
                            <input type="password" id="current-password" placeholder="••••••••" class="w-full px-4 py-3 border border-gray-300 rounded-md text-base" name="old-pass">
                        </div>
                        <div class="mb-5">
                            <label for="new-password" class="block mb-2 font-medium">Password Baru</label>
                            <input type="password" id="new-password" placeholder="•••••••••" class="w-full px-4 py-3 border border-gray-300 rounded-md text-base" name="new-pass">
                            <div class="text-gray-500 text-sm mt-1.5">
                                Password harus terdiri dari minimal 8 karakter dan mengandung angka, huruf besar dan kecil
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="confirm-password" class="block mb-2 font-medium">Konfirmasi Password Baru</label>
                            <input type="password" id="confirm-password" placeholder="•••••••••" class="w-full px-4 py-3 border border-gray-300 rounded-md text-base" name="new-pass_confirmation">
                        </div>
                        <div class="flex justify-between mt-6 float-right">
                            <button type="submit" class="bg-[#ff9a00] hover:bg-white/90 hover:text-black hover:border-[#ff9a00] border-1 border-transparent text-white font-medium py-3 px-5 rounded-md transition cursor-pointer duration-300">
                                Ubah Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>