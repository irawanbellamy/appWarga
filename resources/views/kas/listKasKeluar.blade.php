@extends('templates.main')
@section('title')
Kas Keluar
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"><strong>Filter Data</strong> </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('listKasKeluar') }}" method="get" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="category">
                                    <option value="">Kategori Kas</option>
                                    <option value="Operasional">Operasional</option>
                                    <option value="Kegiatan Warga">Kegiatan Warga</option>
                                    <option value="Sosial">Sosial</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label>Dari Tanggal</label>
                                <input class="form-control" type="date" name="from" id="" placeholder="Dari Tanggal">
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label>Sampai Tanggal</label>
                                <input class="form-control" type="date" name="to" id="" placeholder="Sampai Tanggal">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Cari">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /. row -->
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="#" target="_blank">Warga Tenjo City Residence 3</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <!-- <h3 class="card-title"><strong>Kas Masuk</strong> </h3> -->
                <a href="{{ route('kasKeluar') }}" class="btn btn-primary">
                    <span class="fas fa-plus"></span> Input Kas Keluar
                </a>
                <a href="{{ route('rkKasKeluar') }}" target="_blank" class="btn btn-success">
                    <span class="fas fa-print"></span> Print Rekap Kas Keluar
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
                            <td>Rp. {{ number_format($item->amount) }}</td>
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
