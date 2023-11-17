@extends('templates.main')
@section('title')
Dashboard
@endsection
@section('content_header')
<h4 class="m-0">Selamat Datang {{ ucfirst(auth()->user()->name) }}</h4>

@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <!-- Small boxes (Stat box) -->
        <div class="row mr-2">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        @if (is_null($warga))
                        <h3>0</h3>
                        @else
                        <h3>{{$warga}}</h3>
                        @endif
                        <p>Warga (Terdata)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="{{ url('/user/penghuni') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        @if (is_null($pengaduan))
                        <h3>0</h3>
                        @else
                        <h3>{{$pengaduan}}<sup style="font-size: 20px"></sup></h3>
                        @endif
                        <p>Pengaduan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-email"></i>
                    </div>
                    <a href="{{ url('/user/pengaduan') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        @if (is_null($asset))
                        <h3>0</h3>
                        @else
                        <h3>{{$asset}}</h3>
                        @endif
                        <p>Item Asset</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-wrench"></i>
                    </div>
                    <a href="{{ url('/user/asset') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

        </div>

        <!-- /.row -->
        <div class="row mr-2">
            <div class="col-md-12">
                <!-- /.card -->
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Ballance Kas</h3>
                        <div class="card-tools">
                            <a href="#" class="btn btn-sm btn-tool">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-info text-xl">
                                <i class="ion-ios-plus-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    Kas Masuk
                                </span>
                                <span class="text-muted">Rp. {{ number_format($kas_masuk) }}</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-danger text-xl">
                                <i class="ion-ios-minus-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    Kas Keluar
                                </span>
                                <span class="text-muted">Rp. {{ number_format($kas_keluar) }}</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-success text-xl">
                                <i class="ion-ios-folder-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    Total Kas
                                </span>
                                @if (is_null($saldo))
                                <span class="text-muted">Rp. 0</span>
                                @else
                                <span class="text-muted">Rp. {{ number_format($saldo->last_saldo) }}</span>
                                @endif
                            </p>
                        </div>
                        <!-- /.d-flex -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
