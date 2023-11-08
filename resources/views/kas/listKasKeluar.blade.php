@extends('templates.main')
@section('title')
Kas Keluar
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <!-- <h3 class="card-title"><strong>Kas Masuk</strong> </h3> -->
                <a href="{{ route('kasKeluar') }}" class="btn btn-primary">
                    <span class="fas fa-plus"></span> Input Kas Keluar
                </a>
                <a href="{{ route('printKasKeluar') }}" target="_blank" class="btn btn-success">
                    <span class="fas fa-print"></span> Print Kas Keluar
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
                            <th>Kategori Kas</th>
                            <th>Nominal Kas Keluar</th>
                            <th>Tanggal Transaksi</th>
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
                            <td>{{ $item->cash_out_category }}</td>
                            <td>Rp. {{ $item->amount }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->transaction_date)) }}</td>
                            <td>
                                @if (is_null($item->cash_out_attachment))
                                <p></p>
                                @else
                                <a href="{{ asset('upload') }}/{{$item->cash_out_attachment}}" target="_blank">
                                    <img src="{{ asset('upload') }}/{{$item->cash_out_attachment}}" width="75px">
                                </a>
                                @endif
                            </td>
                            <td>{{ $item->cash_out_note }}</td>
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
