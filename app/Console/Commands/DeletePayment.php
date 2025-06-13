<?php

namespace App\Console\Commands;

use App\Models\order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeletePayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus Kalo Ada Payment Lebih Dari 24 Jam Pembuatannya';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        order::where('status_pesanan', 'Belum Dibayar')->where('created_at', '<', Carbon::now()->subHours(24))
        ->delete();

        return 0;
    }
}
