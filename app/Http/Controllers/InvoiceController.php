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
                'email' => 'uchita.oktaviani@salahudin.desa.id',
            ],
            'products' => [
                [
                    'name' => 'Moslem Brown Blue Dress',
                    'description' => 'Ukuran M',
                    'quantity' => 3,
                    'price' => 199000,
                    'discount' => 0,
                    'tax' => 10,
                    'total' => 597000,
                ]
            ],
            'subtotal' => 542727.27,
            'tax' => 54722.73,
            'total' => 597000,
            'bank' => 'XXXXXXXX BCA a/n PT. ABC',
        ];

        $pdf = PDF::loadView('invoice', $data);
        return $pdf->download('invoice.pdf');
    }
}