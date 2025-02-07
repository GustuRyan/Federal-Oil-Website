<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Spending;

class MonthlySpendChart
{
    
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $data = Spending::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total')
            ->toArray();

        $months = Spending::selectRaw('MONTHNAME(created_at) as month')
            ->groupBy('month')
            ->orderByRaw('MONTH(created_at)')
            ->pluck('month')
            ->toArray();

        return $this->chart->barChart()
            ->setTitle('Jumlah Pengeluaran per Bulan')
            ->setSubtitle('Data dalam 1 tahun terakhir')
            ->addData('Total Transaksi', $data)
            ->setLabels($months)
            ->setHeight(300);
    }
}