@extends('templates.main')
@section('title')
Kas Masuk
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <!-- <h3 class="card-title"><strong>Kas Masuk</strong> </h3> -->
                <a href="{{ route('kasMasuk') }}" class="btn btn-primary">
                    <span class="fas fa-plus"></span> Input Kas Masuk
                </a>
                <a href="{{ route('printKasMasuk') }}" target="_blank" class="btn btn-success">
                    <span class="fas fa-print"></span> Print Kas Masuk
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nomor Transaksi</th>
                            <th>Nomor Sub Transaksi</th>
                            <th>Nama Donatur</th>
                            <th>Kategori Kas</th>
                            <th>Metode</th>
                            <th>Nominal Kas Masuk</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Lampiran</th>
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
                            <td>{{ $item->subtransaction_id }}</td>
                            <td>{{ $item->donatur }}</td>
                            <td>{{ $item->cash_in_category }}</td>
                            <td>{{ $item->cash_in_methode }}</td>
                            <td>Rp. {{ $item->amount }}</td>
                            <td>{{ $item->cash_in_month }}</td>
                            <td>{{ $item->cash_in_year }}</td>
                            <td>
                                @if (is_null($item->cash_in_attachment))
                                <p></p>
                                @else
                                <a href="{{ asset('upload') }}/{{$item->cash_in_attachment}}" target="_blank">
                                    <img src="{{ asset('upload') }}/{{$item->cash_in_attachment}}" width="75px">
                                </a>
                                @endif
                            </td>
                            <td>{{ $item->cash_in_note }}</td>
                            <td>{{ $item->user_input }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                        </tr>
                        @endforeach
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
