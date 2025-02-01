<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\View;

class InvoiceController extends Controller
{
    public function generatePDF()
    {
        $data = [
            'company' => 'PT Kledo Berhati Nyaman',
            'invoice_no' => 'INV-73333',
            'date' => '21/07/2020',
            'due_date' => '23/07/2020',
            'customer' => [
                'name' => 'Slamet Maryadi Usada',
                'address' => 'Ps. Peta No. 506, Mojokerto 49077, KalBar',
                'phone' => '627502388871',
                'email' => 'uchita.oktaviani@salahudin.desa.id'
            ]
        ];

        $pdf = PDF::loadView('invoice', $data);
        return $pdf->download('invoice.pdf');
    }
}