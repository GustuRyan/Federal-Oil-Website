<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        .container {
            width: 100%;
        }

        .header {
            overflow: hidden;
            /* Clear float */
        }

        .header-left {
            float: left;
            width: 50%;
        }

        .header-right {
            float: right;
            width: 50%;
        }

        .line {
            width: 100%;
            height: 2px;
            background: black;
            margin: 10px 0;
        }
    </style>

</head>

<body>
    <table style="width: 100%;">
        <thead>
            <tr>
                <th align="left" style="width: 100%;">
                    <table>
                        <thead>
                            <tr>
                                <th align="left" style="width: 100%;">
                                    <h1>{{ $company }}</h1>
                                </th>
                                <th align="right" style="width: 100%;">
                                    <h1>INVOICE</h1>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <div class="line"></div>
                    <table>
                        <thead>
                            <tr>
                                <th align="left" style="width: 100%;">
                                    <p>
                                        No. Telepon <br>
                                        08222222222
                                    </p>
                                    <p class="bold">No. Invoice: <br>
                                        {{ $invoice_no }}</p>
                                </th>
                                <th align="right" style="width: fit-content;">
                                    <div>
                                        <p>Tanggal: <br>{{ $date }}</p>
                                        <p>Jatuh Tempo: <br>{{ $due_date }}</p>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </th>
                <th align="left" style="width: 100%; padding-left: 36px; padding-right: 100px;">
                    <h3>Tagihan Kepada:</h3>
                    <p>
                    <h2>{{ $customer['name'] }}</h2>{{ $customer['address'] }}<br>Telp:
                    {{ $customer['phone'] }}<br>Email:
                    {{ $customer['email'] }}</p>
                </th>
            </tr>
        </thead>
    </table>

    <table style="width: 100%; border-collapse: collapse;">
        <thead style="width: 100%;">
            <tr style="width: 100%;">
                <th style="border-top: 2px solid black; border-bottom: 2px solid black; padding: 4px;">Produk</th>
                <th style="border-top: 2px solid black; border-bottom: 2px solid black; padding: 4px;">Deskripsi</th>
                <th style="border-top: 2px solid black; border-bottom: 2px solid black; padding: 4px;">Kuantitas</th>
                <th style="border-top: 2px solid black; border-bottom: 2px solid black; padding: 4px;">Harga</th>
                <th style="border-top: 2px solid black; border-bottom: 2px solid black; padding: 4px;">Diskon</th>
                <th style="border-top: 2px solid black; border-bottom: 2px solid black; padding: 4px;">Jumlah</th>
            </tr>
        </thead>
        <tbody style="width: 100%;">
            @foreach ($products as $product)
                <tr style="width: 100%;">
                    <td style="border-bottom: 2px solid black; padding: 4px;">{{ $product['name'] }}</td>
                    <td style="border-bottom: 2px solid black; padding: 4px;">{{ $product['description'] }}</td>
                    <td style="border-bottom: 2px solid black; padding: 4px;" class="text-right">
                        {{ $product['quantity'] }}</td>
                    <td style="border-bottom: 2px solid black; padding: 4px;" class="text-right">Rp
                        {{ number_format($product['price'], 0, ',', '.') }}</td>
                    <td style="border-bottom: 2px solid black; padding: 4px;" class="text-right">
                        {{ $product['discount'] }}%</td>
                    <td style="border-bottom: 2px solid black; padding: 4px;" class="text-right">Rp
                        {{ number_format($product['total'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <table style="width: 100%; margin-top: 12px; border-collapse: collapse;">
        <thead style="width: 100%;">
            <tr style="width: 100%;">
                <th style="border-top: 2px solid black; border-bottom: 2px solid black; padding: 4px;">Servis</th>
                <th style="border-top: 2px solid black; border-bottom: 2px solid black; padding: 4px;">Deskripsi</th>
                <th style="border-top: 2px solid black; border-bottom: 2px solid black; padding: 4px;">Waktu Servis</th>
                <th style="border-top: 2px solid black; border-bottom: 2px solid black; padding: 4px;">Harga</th>
                <th style="border-top: 2px solid black; border-bottom: 2px solid black; padding: 4px;">Diskon</th>
                <th style="border-top: 2px solid black; border-bottom: 2px solid black; padding: 4px;">Jumlah</th>
            </tr>
        </thead>
        <tbody style="width: 100%;">
            @foreach ($services as $service)
                <tr style="width: 100%;">
                    <td style="border-bottom: 2px solid black; padding: 4px;">{{ $service['name'] }}</td>
                    <td style="border-bottom: 2px solid black; padding: 4px;">{{ $service['description'] }}</td>
                    <td style="border-bottom: 2px solid black; padding: 4px;" class="text-right">
                        {{ $service['quantity'] }}</td>
                    <td style="border-bottom: 2px solid black; padding: 4px;" class="text-right">Rp
                        {{ number_format($service['price'], 0, ',', '.') }}</td>
                    <td style="border-bottom: 2px solid black; padding: 4px;" class="text-right">
                        {{ $service['discount'] }}%</td>
                    <td style="border-bottom: 2px solid black; padding: 4px;" class="text-right">Rp
                        {{ number_format($service['total'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-top: 12px;">
        <thead style="width: 100%;">
            <tr style="width: 100%;">
                <th align="center" style="width: 50%; border: 2px solid black; padding: 8px;">
                    <h4>Terbilang:</h4>
                    <p>LIMA RATUS SEMBILAN PULUH TUJUH RIBU RUPIAH</p>
                </th>
                <th align="right" style="width: 100%;">
                    <table>
                        <tr align="right">
                            <th>Total</th>
                            <th class="text-right">Rp {{ number_format($total, 0, ',', '.') }}</th>
                        </tr>
                    </table>
                </th>
            </tr>
        </thead>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-top: 36px;">
        <thead style="width: 100%;">
            <tr style="width: 100%;">
                <th align="left" style="width: 30%;">
                    <p>Penerima</p>
                    <br><br><br><br>
                    <p>(.......................................)</p>
                </th>
                <th align="right" style="width: 100%;">
                    <p>Dengan Hormat,</p>
                    <br><br><br><br>
                    <p>Finance Dept</p>
                </th>
            </tr>
        </thead>
    </table>
    <div align="center" style="width: 40%; border: 2px solid black; padding: 8px;">
        <p>Pesan: Silakan transfer ke rekening: <br> <strong>{{ $bank }}</strong></p>
    </div>
</body>

</html>
