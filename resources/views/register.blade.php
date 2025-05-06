<x-layout>
    <div class="min-h-screen w-full flex justify-center items-center bg-gray-100 relative">
        <!-- Background Food Image -->
        <div class="absolute inset-0 z-0 bg-cover bg-center filter brightness-90" style="background-image: url('/api/placeholder/1600/900')"></div>

        <!-- Registration Card -->
        <div class="w-full max-w-md bg-gray-50 rounded-xl shadow-lg p-8 z-10 mx-4 md:mx-0 relative">
            <!-- Back Button -->
            <a href="/">
                <div class="flex items-center text-gray-600 font-medium mb-5 cursor-pointer hover:text-yellow-500 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </div>
            </a>

            <!-- Auth Toggle Buttons -->
            <div class="flex rounded-lg bg-gray-200 mb-6 overflow-hidden">
                <button class="flex-1 py-3 text-base font-semibold transition-colors duration-300" id="login-tab">MASUK</button>
                <button class="flex-1 py-3 text-base font-semibold bg-yellow-500 text-white transition-colors duration-300" id="register-tab">DAFTAR</button>
            </div>

            <!-- Form Title -->
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">Buat Akun Baru</h2>
            <p class="text-center text-gray-500 text-sm mb-6">Daftar untuk memulai perjalanan kuliner Anda</p>

            <!-- Registration Form -->
            <form id="register-form">
                <!-- Full Name -->
                <div class="mb-5">
                    <label for="fullname" class="block text-sm text-gray-600 mb-2">Nama Lengkap</label>
                    <input 
                        type="text" 
                        id="fullname" 
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
                        id="email" 
                        placeholder="Email Anda" 
                        required
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300"
                    >
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label for="password" class="block text-sm text-gray-600 mb-2">Password</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            placeholder="••••••••" 
                            required
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300"
                        >
                        <button 
                            type="button" 
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-yellow-500 text-xs font-semibold"
                            id="password-toggle"
                        >
                            LIHAT
                        </button>
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="mb-5">
                    <label for="phone" class="block text-sm text-gray-600 mb-2">Nomor Telepon</label>
                    <input 
                        type="tel" 
                        id="phone" 
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
    </div>
    <script>
        // Password Toggle Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const passwordToggle = document.getElementById('password-toggle');
            const passwordInput = document.getElementById('password');
            
            passwordToggle.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordToggle.textContent = 'SEMBUNYIKAN';
                } else {
                    passwordInput.type = 'password';
                    passwordToggle.textContent = 'LIHAT';
                }
            });
            
            // Auth Toggle
            const loginTab = document.getElementById('login-tab');
            const registerTab = document.getElementById('register-tab');
            
            loginTab.addEventListener('click', function() {
                loginTab.classList.add('bg-yellow-500', 'text-white');
                registerTab.classList.remove('bg-yellow-500', 'text-white');
                // In a real app, you would switch forms or redirect here
                console.log('Switching to login');
            });
            
            registerTab.addEventListener('click', function() {
                registerTab.classList.add('bg-yellow-500', 'text-white');
                loginTab.classList.remove('bg-yellow-500', 'text-white');
            });
            
            // Form submission (for demo purposes)
            const registerForm = document.getElementById('register-form');
            registerForm.addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Pendaftaran berhasil! (Demo)');
                // In a real app, send data to the server here
            });
        });
    </script>
</x-layout>