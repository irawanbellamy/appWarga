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
                <form action="{{ route('mutasiKasKeluarPdf') }}" method="get" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4">
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
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
