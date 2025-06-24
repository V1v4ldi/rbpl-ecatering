<?php

namespace App\Observers;

use App\Models\daily_report;
use App\Models\order;
use App\Models\report;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderObserver
{
    /**
     * Handle the order "created" event.
     */
    public function created(order $order): void
    {
        //
    }

    /**
     * Handle the order "updated" event.
     */
    public function updated(order $order): void
    {
        if (
            $order->isDirty('status_pesanan') &&
            $order->status_pesanan === 'Selesai' &&
            $order->getOriginal('status_pesanan') !== 'Selesai'
        ) {
            $this->addOrderToReport($order);
        }
    }

    private function addOrderToReport(order $order){

        $deliveryDate = $order->tanggal_kirim;
        $date = Carbon::parse($deliveryDate);
        $baseDReportId = $date->format('Y-m-d');
        $configs = [
            'monthly' => $date->format('Y-m'),
            'yearly' => $date->format('Y'),
        ];

        foreach($configs as $type => $reportId){            
            $main=$this->createMainReport($reportId, $type);

            $dReportId = $baseDReportId. '_'. $type;
            daily_report::firstOrCreate(
            ['report_d_id' => $dReportId, 'report_id' => $reportId],
            [
                'order_id' => $order->order_id,
                'tanggal' => $baseDReportId,
            ]);
            
            $this->recalculate($main);
        }
    }

    private function createMainReport($reportId, $type){
    
        $report = report::where('report_id', $reportId)->first();
    
        if (!$report) {
            $report = report::create([
                'report_id' => $reportId,
                'owner_id' => 'OWNER-0001',
                'type' => $type,
                'period' => $reportId,
                'total_revenue' => 0,
                'total_order' => 0,
                'average_order' => 0,
                'best_seller' => null
            ]);
        }
        return $report;
    }

    private function recalculate(report $report){
        $dailyReport = $report->daily_report()->with('order.orderDetails.product')->get();

        if($dailyReport->isEmpty()) {
            Log::info('No daily reports found', ['report_id' => $report->report_id]);
            return;
        }

        $totalRevenue = 0;
        $totalCatering = 0;
        $productTerjual = [];

        foreach ($dailyReport as $daily){
            $order = $daily->order;

            $orderPrice = $order->orderDetails->sum('harga_now');
            $orderRevenue = $orderPrice * $order->jumlah;

            $totalRevenue += $orderRevenue;
            $totalCatering += $order->jumlah;

            foreach($order->orderDetails as $detail){
                if(!$detail->product){
                    continue;
                }
                $productName = $detail->product->nama;
                $soldQ = $order->jumlah;

                $productTerjual[$productName] = ($productTerjual[$productName] ?? 0) + $soldQ; 
            }
        }
        arsort($productTerjual);
        $bestSeller = array_key_first($productTerjual) ?? null;

        $totalOrder = $dailyReport->count();
        $avgOrder = $totalOrder > 0 ? intval($totalRevenue / $totalOrder) : 0;
        
        $report->update([
            'total_revenue' => $totalRevenue,
            'total_order' => $totalCatering,
            'average_order' => $avgOrder,
            'best_seller' => $bestSeller,
        ]);
    }
    
    private function rollbackReport(order $order){
        
        $affected = report::whereHas('daily_report', function($query) use ($order){
            $query->where('order_id', $order->order_id);
        })->get();
        
        Log::info('Found affected reports', [
            'order_id' => $order->order_id,
            'affected_reports' => $affected->pluck('report_id')->toArray()
        ]);
        
        daily_report::where('order_id', $order->order_id)->delete();

        foreach($affected as $reportaffected){
            $this->recalculate($reportaffected);
        }
    }

    /**
     * Handle the order "deleted" event.
     */
    public function deleted(order $order): void
    {
        //
    }

    /**
     * Handle the order "restored" event.
     */
    public function restored(order $order): void
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     */
    public function forceDeleted(order $order): void
    {
        //
    }
}
