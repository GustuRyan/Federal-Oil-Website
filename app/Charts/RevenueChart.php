<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Transaction;

class RevenueChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        // Ambil total pendapatan per bulan
        $revenues = Transaction::selectRaw('MONTH(created_at) as month, SUM(total_cost) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];
        $totals = [];
        $colors = ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff', '#ff9f40', '#ff6384', '#36a2eb', '#cc65fe', '#ffce56', '#4bc0c0', '#9966ff']; // 12 warna

        foreach ($revenues as $revenue) {
            $months[] = date('F', mktime(0, 0, 0, $revenue->month, 1));

            // Format angka ke bentuk Rupiah
            $totals[] = number_format($revenue->total, 0, ',', '.', );
        }

        return $this->chart->barChart()
            ->setTitle('Total Pendapatan per Bulan')
            ->setSubtitle('Dalam 1 tahun terakhir')
            ->addData('Total Pendapatan (Rp) dikali 1000', $totals)
            ->setLabels($months)
            ->setColors($colors)
            ->setHeight(300);
    }
}
