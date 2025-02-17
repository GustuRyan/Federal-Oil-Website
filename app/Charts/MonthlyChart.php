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
        $data = Transaction::selectRaw('MONTH(created_at) as month, MONTHNAME(created_at) as month_name, COUNT(*) as total')
            ->groupBy('month', 'month_name') // Tambahkan 'month_name' agar sesuai dengan SELECT
            ->orderBy('month')
            ->get();

        // Pisahkan data ke dalam array
        $totals = $data->pluck('total')->toArray();
        $months = $data->pluck('month_name')->toArray();

        return $this->chart->barChart()
            ->setTitle('Jumlah Transaksi per Bulan')
            ->setSubtitle('Data dalam 1 tahun terakhir')
            ->addData('Total Transaksi', $totals) // Ubah dari $data ke $totals
            ->setLabels($months)
            ->setHeight(300);

    }
}