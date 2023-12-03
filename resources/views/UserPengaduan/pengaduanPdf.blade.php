<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komplain Warga</title>
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
        <h1>Rekap Komplain Warga</h1>
    </div>

    <table id="kas">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nomor Pengaduan</th>
                <th>Jenis Pengaduan</th>
                <th>Deskripsi</th>
                <th>Lampiran</th>
                <th>Status</th>
                <th>Tgl Respon (Reject)</th>
                <th>Catatan Respon (Reject)</th>
                <th>Tgl Respon</th>
                <th>Catatan Respon</th>
                <th>Tanggal Tindakan</th>
                <th>Catatan Tindakan</th>
                <th>Lampiran Tindakan</th>
                <th>Tanggal Selesai</th>
                <th>Catatan</th>
                <th>Diinput Oleh</th>
                <th>Diupdate Oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>
                    {{ $item->complaint_id }}
                </td>
                <td>{{ $item->complaint_type }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    <a href="{{ asset('upload') }}/{{$item->attachment}}" target="_blank">
                        {{$item->attachment}}
                    </a>
                </td>
                <td>{{ $item->status }}</td>
                <td>
                    @if (is_null($item->reject_date))
                    <p></p>
                    @else
                    {{ date('d-m-Y', strtotime($item->reject_date)) }}
                    @endif
                </td>
                <td>{{ $item->reject_note }}</td>
                <td>
                    @if (is_null($item->followup_date))
                    <p></p>
                    @else
                    {{ date('d-m-Y', strtotime($item->followup_date)) }}
                    @endif
                </td>
                <td>{{ $item->followup_note }}</td>
                <td>
                    @if (is_null($item->execution_date))
                    <p></p>
                    @else
                    {{ date('d-m-Y', strtotime($item->execution_date)) }}
                    @endif
                </td>
                <td>{{ $item->execution_note }}</td>
                <td>
                    @if (is_null($item->execution_attachment))
                    <p></p>
                    @else
                    <a href="{{ asset('upload') }}/{{$item->execution_attachment}}" target="_blank">
                        {{$item->execution_attachment}}
                    </a>
                </td>
                @endif
                <td>
                    @if (is_null($item->finish_date))
                    <p></p>
                    @else
                    {{ date('d-m-Y', strtotime($item->finish_date)) }}
                    @endif
                </td>
                <td>{{ $item->finish_note }}</td>
                <td>{{ $item->user_input }}</td>
                <td>{{ $item->user_update }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</body>

</html>
