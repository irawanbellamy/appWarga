<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mutasi Kas</title>
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
        <h1>Mutasi Kas</h1>
    </div>

    <table id="kas">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nomor Transaksi</th>
                <th>Tanggal Masuk</th>
                <th>Kas Masuk/Keluar</th>
                <th>Kategori Kas Masuk</th>
                <th>Donatur</th>
                <th>Nominal Kas Masuk</th>
                <th>Kategori Kas Keluar</th>
                <th>Tanggal Keluar</th>
                <th>Nominal Kas Keluar</th>
                <th>Sisa Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->transaction_id }}</td>
                @if (is_null($item->tanggal_masuk))
                <td></td>
                @else
                <td>{{ date('d-m-Y', strtotime($item->tanggal_masuk)) }}</td>
                @endif
                <td>{{ $item->cash_type }}</td>
                <td>{{ $item->cash_in_category }}</td>
                <td>{{ $item->donatur }}</td>
                @if (is_null($item->cash_in_amount))
                <td></td>
                @else
                <td>Rp. {{ $item->cash_in_amount }}</td>
                @endif
                <td>{{ $item->cash_out_category }}</td>
                @if (is_null($item->tanggal_keluar))
                <td></td>
                @else
                <td>{{ date('d-m-Y', strtotime($item->tanggal_keluar)) }}</td>
                @endif
                @if (is_null($item->cash_out_amount))
                <td></td>
                @else
                <td>Rp. {{ $item->cash_out_amount }}</td>
                @endif
                <td style="width: 80px;">Rp. {{ $item->last_saldo }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="10" style="text-align: center;"><strong>Total Saldo</strong></td>
                <td style="width: auto;"><strong>Rp. {{ $item->last_saldo }}</strong></td>
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
                <th>Jimmy Coy</th>
                <th>David P</th>
                <th>Winarno</th>
                <th>Andi Hakim</th>
            </tr>
        </table>
    </div>

</body>

</html>
