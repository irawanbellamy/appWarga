@extends('templates.main')
@section('title')
Mutasi Kas
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
                <form action="{{ route('kas') }}" method="get" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Tipe Kas</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="tipe">
                                    <option value="">Kas Masuk / Kas Keluar</option>
                                    <option value="MASUK">MASUK</option>
                                    <option value="KELUAR">KELUAR</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="category">
                                    <option value="">Kategori Kas</option>
                                    <option value="Iuran Paguyuban">Iuran Paguyuban</option>
                                    <option value="Donasi">Donasi</option>
                                    <option value="Sewa Asset">Sewa Asset</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Donatur</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="donatur">
                                    <option value="">Nama Donatur</option>
                                    @foreach ($nama as $nama)
                                    <option value="{{ $nama->id_warga }}">{{ $nama->name }} - {{ $nama->house_block }}/{{ $nama->house_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
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


        <!-- list data -->
        <div class="card">
            <div class="card-header">
                <!-- <a href="{{ route('printMutasiKas') }}" class="btn btn-primary" target="_blank"> -->
                <a href="{{ route('rekeningKoran') }}" class="btn btn-primary" target="_blank">
                    <span class="fas fa-print"></span> Print Rekening Koran
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
                            <th>Nomor Referensi</th>
                            <th>Nomor Transaksi</th>
                            <th>Tanggal Masuk</th>
                            <th>Kas Masuk/Keluar</th>
                            <th>Kategori Kas Masuk</th>
                            <th>Donatur</th>
                            <th>Nominal Kas Masuk</th>
                            <th>Kategori Kas Keluar</th>
                            <th>Tanggal Keluar</th>
                            <th>Nominal Kas Keluar</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->reference_id }}</td>
                            <td>{{ $item->transaction_id }}</td>
                            @if (is_null($item->tanggal_masuk))
                            <td></td>
                            @else
                            <td>{{ date('d-m-Y', strtotime($item->tanggal_masuk)) }}</td>
                            @endif
                            <td>{{ $item->cash_type }}</td>
                            <td>{{ $item->cash_in_category }}</td>
                            @if (is_null($item->name))
                            <td></td>
                            @else
                            <td>{{ $item->name }} {{ $item->house_block }}/{{ $item->house_number }}</td>
                            @endif
                            @if (is_null($item->cash_in_amount))
                            <td></td>
                            @else
                            <td>Rp. {{ number_format($item->cash_in_amount) }}</td>
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
                            <td>Rp. {{ number_format($item->cash_out_amount) }}</td>
                            @endif
                            <td style="width: 80px;">Rp. {{ number_format($item->last_saldo) }}</td>
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
