<script>
    // Timer functionality dengan waktu yang akurat dari server
    function startTimer(initialSeconds) {
        let timer = initialSeconds;
        const hoursElem = document.getElementById('hours');
        const minutesElem = document.getElementById('minutes');
        const secondsElem = document.getElementById('seconds');
        
        function updateTimer() {
            const hours = Math.floor(timer / 3600);
            const minutes = Math.floor((timer % 3600) / 60);
            const seconds = timer % 60;
            
            hoursElem.textContent = hours < 10 ? "0" + hours : hours;
            minutesElem.textContent = minutes < 10 ? "0" + minutes : minutes;
            secondsElem.textContent = seconds < 10 ? "0" + seconds : seconds;
            
            timer--;
        }

        updateTimer();
        const interval = setInterval(updateTimer, 1000);
        return interval;
    }
    
   document.addEventListener('DOMContentLoaded', function() {
    const remainingSeconds = {{ $remainingSeconds ?? 0 }};
    startTimer(remainingSeconds);
   })
    
    // Payment Method Selection
    const transferBank = document.getElementById('transfer-bank');
    const bayarDiTempat = document.getElementById('bayar-ditempat');
    const bankSelection = document.getElementById('bank-selection');
    
    if (transferBank && bayarDiTempat && bankSelection) {
        transferBank.addEventListener('click', function() {
            transferBank.classList.add('bg-amber-50', 'border-[#ff9a00]');
            transferBank.classList.remove('border-gray-200');
            bayarDiTempat.classList.remove('bg-amber-50', 'border-[#ff9a00]');
            bayarDiTempat.classList.add('border-gray-200');
            bankSelection.style.display = 'block';
        });
        
        bayarDiTempat.addEventListener('click', function() {
            bayarDiTempat.classList.add('bg-amber-50', 'border-[#ff9a00]');
            bayarDiTempat.classList.remove('border-gray-200');
            transferBank.classList.remove('bg-amber-50', 'border-[#ff9a00]');
            transferBank.classList.add('border-gray-200');
            bankSelection.style.display = 'none';
        });
    }
    
    // Bank Option Selection
    function selectBank(element, bankName) {
    // Remove active class from all options
    const bankOptions = document.querySelectorAll('[onclick^="selectBank"]');
    bankOptions.forEach(option => {
        option.classList.remove('bg-amber-50', 'border-[#ff9a00]');
        option.classList.add('border-gray-200');
    });
    
    // Add active class to clicked option
    element.classList.add('bg-amber-50', 'border-[#ff9a00]');
    element.classList.remove('border-gray-200');
    
    // Check the radio button
    const radioBtn = element.querySelector('input[type="radio"]');
    if (radioBtn) radioBtn.checked = true;
    
    // Update bank name in details
    const bankNameElem = document.getElementById('bank-name');
    if (bankNameElem) bankNameElem.textContent = bankName;
    
    // Define different account numbers for each bank
    const bankAccounts = {
        'BCA': '8790123456',
        'Mandiri': '1234567890',
        'BNI': '0987654321',
        'BRI': '1357924680'
    };
    
    // Update account number based on selected bank
    const accountNumberDisplay = document.getElementById('account-number-display');
    const accountNumber = bankAccounts[bankName];
    
    if (accountNumberDisplay && accountNumber) {
        // Update the account number display
        accountNumberDisplay.innerHTML = accountNumber + 
            ' <button class="cursor-pointer bg-gray-200 text-sm px-2 py-0.5 rounded ml-2 hover:bg-gray-300" onclick="copyToClipboard(\'' + accountNumber + '\')">Salin</button>';
    }
}
    
    // Copy to clipboard functionality
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Disalin ke clipboard: ' + text);
        }, function(err) {
            console.error('Gagal menyalin: ', err);
        });
    }
</script>