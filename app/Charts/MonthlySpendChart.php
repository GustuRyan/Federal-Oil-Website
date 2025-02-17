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
        // Ambil data pengeluaran per bulan
        $data = Spending::selectRaw('MONTH(created_at) as month, MONTHNAME(created_at) as month_name, COUNT(*) as total')
            ->groupBy('month', 'month_name') // Tambahkan 'month_name' ke GROUP BY
            ->orderBy('month')
            ->get();

        // Pisahkan data ke dalam array
        $totals = $data->pluck('total')->toArray();
        $months = $data->pluck('month_name')->toArray();

        return $this->chart->barChart()
            ->setTitle('Jumlah Pengeluaran per Bulan')
            ->setSubtitle('Data dalam 1 tahun terakhir')
            ->addData('Total Transaksi', $totals) // Gunakan $totals, bukan $data
            ->setLabels($months)
            ->setHeight(300);
    }
}