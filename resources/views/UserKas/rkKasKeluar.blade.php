<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Kas Keluar</title>
</head>

<body>
    <style>
        #kas {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #kas td,
        #kas th {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 10pt;
        }

        #kas tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #kas tr:hover {
            background-color: #ddd;
        }

        #kas th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #f2f2f2;
        }

        .header {
            text-align: center;
        }

        .title {
            text-align: center;
            font-size: 8pt;
        }

        .signature {
            margin-top: 40px;
        }
    </style>
    <div class="header">
        <table>
            <th>
            <td>
                <img src="{{ public_path('lte/img/logo_paguyuban.png') }}" alt="logo" style="width: 80px; height:auto; margin-right:10px">
            </td>
            <td>
                <p><strong>PAGUYUBAN TENJO CITY RESIDENCE 3</strong> <br>
                    <span class="subtitle">
                        Perumahan Tenjo City Residence 3
                        Desa Singabangsa, Kecamatan Tenjo, Kabupaten Bogor, Jawa Barat 16370 <br>
                        Email : tcr3paguyuban@gmail.com HP : 081213137513
                    </span>
                </p>
            </td>
            </th>
        </table>
        <hr>
    </div>
    <div class="title">
        <h1>Rekap Kas Keluar</h1>
    </div>

    <table id="kas">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nomor Transaksi</th>
                <th>Kategori Kas</th>
                <th>Nominal Kas Keluar</th>
                <th>Tanggal Transaksi</th>
                <th>Catatan</th>
                <th>Diinput</th>
                <th>Tanggal Input</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->transaction_id }}</td>
                <td>{{ $item->cash_out_category }}</td>
                @if (is_null($item->amount))
                <td></td>
                @else
                <td>Rp. {{ number_format($item->amount) }}</td>
                @endif
                <td>{{ date('d-m-Y', strtotime($item->transaction_date)) }}</td>
                <td>{{ $item->cash_out_note }}</td>
                <td>{{ $item->user_input }}</td>
                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8" style="text-align: center;"><strong>Total Pengeluaran : Rp. {{ number_format($total) }}</strong></td>
            </tr>
        </tfoot>
    </table>
    </div>
    <div class="signature">
        <table style="width:100%">
            <tr>
                <th>Petugas</th>
                <th>Bendahara 1</th>
                <th>Bendahara 2</th>
                <th>Ketua</th>
            </tr>
            <tr>
                <th style="height: 50px;"></th>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <th>David P</th>
                <th>Winarno</th>
                <th>Andi Hakim</th>
            </tr>
        </table>
    </div>

</body>

</html>
