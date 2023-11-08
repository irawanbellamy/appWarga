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
                <form action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Bulan</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="bulan">
                                    <option value="">Bulan</option>
                                    <option value="">Januari</option>
                                    <option value="">Februari</option>
                                    <option value="">Maret</option>
                                    <option value="">April</option>
                                    <option value="">Mei</option>
                                    <option value="">Juni</option>
                                    <option value="">Juli</option>
                                    <option value="">Agustus</option>
                                    <option value="">September</option>
                                    <option value="">Oktober</option>
                                    <option value="">November</option>
                                    <option value="">Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Tahun</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="tahun">
                                    <option value="">Tahun</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Dari Tanggal</label>
                                <input type="date" name="from" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Sampai Tanggal</label>
                                <input type="date" name="to" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Simpan">
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
                <a href="{{ route('printMutasiKas') }}" class="btn btn-primary" target="_blank">
                    <span class="fas fa-print"></span> Print Mutasi
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
                            <th>Sisa Saldo</th>
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
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
