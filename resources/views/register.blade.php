<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="min-h-screen w-full flex justify-center items-center bg-gray-100 relative">
        <!-- Background Food Image -->
        <div class="absolute inset-0 z-0 bg-cover bg-center filter brightness-90"></div>

         <!-- Registration Card -->
       <div class="w-full max-w-md bg-gray-50 rounded-xl shadow-lg p-8 z-10 mx-4 md:mx-0 relative lg:mb-0 mb-14">
            <!-- Back Button -->
            <a href="/">
                <div class="flex items-center text-gray-600 font-medium mb-5 cursor-pointer hover:text-yellow-500 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </div>
            </a>
            {{-- aman --}}

            <div x-data="{daftar: {{ $daftar }}}" x-cloak>
              
            <!-- Auth Toggle Buttons -->
            <div class="flex rounded-lg bg-gray-200 mb-6 overflow-hidden">
                <button 
                @click="daftar = false"
                x-bind:class="!daftar ? 'bg-yellow-500 text-white' : ''"
                class="flex-1 py-3 cursor-pointer text-base font-semibold transition-colors duration-300 ease-in-out hover:bg-yellow-400 hover:text-white">MASUK</button>
                
                <button  
                @click="daftar = true"
                x-bind:class="daftar ? 'bg-yellow-500 text-white' : ''" 
                class="flex-1 py-3 cursor-pointer text-base font-semibold  transition-colors duration-300 ease-in-out hover:bg-yellow-400 hover:text-white">DAFTAR</button>
            </div>
            {{-- Revisi --}}

              <div x-show="daftar">
                <!-- Form Title -->
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">Buat Akun Baru</h2>
              <p class="text-center text-gray-500 text-sm mb-6">Daftar untuk memulai perjalanan kuliner Anda</p>
              
              <!-- Registration Form -->
              <form id="register-form" method="POST" action="{{ route('register.store') }}" >
                @csrf
                <!-- Full Name -->
                <div class="mb-5">
                  <label for="fullname" class="block text-sm text-gray-600 mb-2">Nama Lengkap</label>
                  <input 
                        type="text" 
                        name="fullname" 
                        placeholder="Masukkan nama lengkap Anda" 
                        required
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300"
                    >
                </div>

                <!-- Email -->
                <div class="mb-5">
                    <label for="email" class="block text-sm text-gray-600 mb-2">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email Anda" 
                        required
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300"
                    >
                  </div>
                  
                  <!-- Password -->
                  <div x-data="{icon: false}">
                  <div class="mb-5">
                    <label for="password" class="block text-sm text-gray-600 mb-2">Password</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="••••••••" 
                            required
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300"
                        >
                          <button @click = "icon = !icon"
                          type="button" 
                          class="absolute right-4 top-1/2 transform -translate-y-1/2 text-yellow-500 text-2xl font-semibold cursor-pointer"
                          >
                          <i x-bind:class="icon ? 'bx bx-show-alt' : 'bx bx-hide'"
                           class=''></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Phone Number -->
                  <div class="mb-5">
                    <label for="phone" class="block text-sm text-gray-600 mb-2">Nomor Telepon</label>
                    <input 
                    type="tel" 
                    name="phone_number" 
                    placeholder="Masukkan nomor telepon" 
                    required
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300"
                    >
                  </div>
                  
                  <!-- Submit Button -->
                  <button 
                  type="submit" 
                  class="w-full py-3 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-600 transition-colors duration-300 mt-3"
                  >
                  DAFTAR SEKARANG
                </button>
              </form>
            </div>
            <div x-show="!daftar">
              <form action="{{ route('loggingin') }}" method="POST">
                @csrf
            <h1 class="text-2xl text-gray-800 text-center mb-2">Selamat Datang!</h1>
            <p class="text-center text-gray-600 mb-6">Masuk untuk memesan catering lezat Anda</p>
            
            <div class="mb-4">
                <label for="login-email" class="block mb-2 text-gray-600">Email</label>
                <div class="relative">
                    <input name="e-mail" type="email" id="login-email" placeholder="Email Anda" required
                           class="w-full p-4 border border-gray-300 rounded-lg text-base transition-all focus:border-yellow-500 focus:ring focus:ring-yellow-500/20">
                </div>
            </div>
            
            <div class="mb-4">
                <label for="login-password" class="block mb-2 text-gray-600">Password</label>
                <div class="relative">
                  <div x-data="{logicon: false}">
                    <input name="pw" type="password" id="login-password" placeholder="••••••••" required
                    class="w-full p-4 border border-gray-300 rounded-lg transition-all focus:border-yellow-500 focus:ring focus:ring-yellow-500/20">
                    <button @click = "logicon = !logicon" type="button"
                    class="absolute right-4 top-4 text-yellow-500 font-bold cursor-pointer hover:text-catering-red transition-colors text-2xl">
                      <i x-bind:class="logicon ? 'bx bx-show-alt' : 'bx bx-hide'"
                      class=''></i></button>
                    </div>
                  </div>
                </div>
            
            <button type="submit" class="w-full py-4 bg-yellow-500 text-white border-none rounded-lg text-base font-bold cursor-pointer mt-3 mb-4 transition-all duration-300 hover:bg-catering-red hover:shadow-lg transform hover:-translate-y-1">
                MASUK
            </button>
          </form>
        </div>
          </div>
        </div>
    </div>
</x-layout>