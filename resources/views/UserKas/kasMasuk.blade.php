@extends('templates.main')
@section('title')
Kas Masuk
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
                <form action="{{ route('UserKasMasuk') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Bulan</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="bulan">
                                    <option value="">Bulan</option>
                                    <option value="Januari">Januari</option>
                                    <option value="Februari">Februari</option>
                                    <option value="Maret">Maret</option>
                                    <option value="April">April</option>
                                    <option value="Mei">Mei</option>
                                    <option value="Juni">Juni</option>
                                    <option value="Juli">Juli</option>
                                    <option value="Agustus">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="Oktober">Oktober</option>
                                    <option value="November">November</option>
                                    <option value="Desember">Desember</option>
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
                        <div class="col-4">
                            <div class="form-group">
                                <label>Dari Tanggal</label>
                                <input class="form-control" type="date" name="from" id="" placeholder="Dari Tanggal">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Sampai Tanggal</label>
                                <input class="form-control" type="date" name="to" id="" placeholder="Sampai Tanggal">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="hidden" name="action_type" id="action_type" value="Cari">
                                <input type="submit" class="btn btn-primary" onclick="setActionType('html')" value="Tampilkan Data">
                                <input type="submit" class="btn btn-warning" onclick="setActionType('pdf')" value="Download PDF">
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
                <a href="{{ route('UserRkKasMasuk') }}" target="_blank" class="btn btn-success">
                    <span class="fas fa-print"></span> Rekap Kas Masuk PDF (All)
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
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->transaction_id }}</td>
                            <td>{{ $item->subtransaction_id }}</td>
                            <td>{{ $item->name }} {{ $item->house_block }}/{{ $item->house_number }}</td>
                            <td>{{ $item->cash_in_category }}</td>
                            <td>{{ $item->cash_in_methode }}</td>
                            <td>Rp. {{ number_format($item->amount) }}</td>
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
                            <td>{{ date('d-m-Y', strtotime($item->cash_in_date)) }}</td>
                        </tr>
                        @endforeach
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</section>
<script>
    function setActionType(type) {
        document.getElementById('action_type').value = type;
        console.log(type)
    }
</script>
<!-- /.content -->
@endsection
