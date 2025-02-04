<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Transaction;

class MonthlyChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        // Ambil data transaksi per bulan
        $data = Transaction::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total')
            ->toArray();

        $months = Transaction::selectRaw('MONTHNAME(created_at) as month')
            ->groupBy('month')
            ->orderByRaw('MONTH(created_at)')
            ->pluck('month')
            ->toArray();

        return $this->chart->barChart()
            ->setTitle('Jumlah Transaksi per Bulan')
            ->setSubtitle('Data dalam 1 tahun terakhir')
            ->addData('Total Transaksi', $data)
            ->setLabels($months)
            ->setHeight(300);
    }
}