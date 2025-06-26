<?php

namespace App\Console\Commands;

use App\Models\order;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
        $deletedCount = order::whereIn('status_pesanan', ['Belum Dibayar', 'Dibatalkan'])->where('created_at', '<', Carbon::now()->subHours(24))
        ->delete();

        if ($deletedCount > 0) {
            $this->info("Berhasil menghapus {$deletedCount} pesanan yang terbengkalai.");
            // Catat ke file log Laravel
            Log::info("Cron job: Berhasil menghapus {$deletedCount} pesanan yang terbengkalai.");
        } else {
            $this->info("Tidak ada pesanan terbengkalai yang perlu dihapus.");
            Log::info("Cron job: Tidak ada pesanan terbengkalai yang perlu dihapus.");
        }

        return 0;
    }
}
