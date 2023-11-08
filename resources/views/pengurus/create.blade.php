@extends('templates.main')
@section('title')
Tambah Pengurus
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Pengurus</h3>
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
                <form action="{{ route('pengurus.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Pengurus</label>
                                <input class="form-control" type="hidden" name="is_active" value="1">
                                <select class="form-control select2bs4" style="width: 100%;" name="name">
                                    <option value="">Nama Pengurus</option>
                                    @foreach ($nama as $nama)
                                    <option value="{{ $nama->name }}">{{ $nama->name }} - {{ $nama->house_block }}/{{ $nama->house_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Posisi</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="job_title">
                                    <option value="">Posisi</option>
                                    <option value="Ketua">Ketua</option>
                                    <option value="Wakil">Wakil</option>
                                    <option value="Bendahara">Bendahara</option>
                                    <option value="Sekretaris">Sekretaris</option>
                                    <option value="Informasi">Informasi</option>
                                    <option value="Keamanan">Keamanan</option>
                                    <option value="Manajemen Asset">Manajemen Asset</option>
                                    <option value="Perlengkapan">Perlengkapan</option>
                                    <option value="Pendanaan">Pendanaan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Organisasi</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="department">
                                    <option value="">Organisasi</option>
                                    <option value="Paguyuban TC3">Paguyuban TC3</option>
                                    <option value="DKM Mushola AL Ikhlas">DKM Mushola AL Ikhlas</option>
                                    <option value="Okumene">Okumene</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row pl-1">
                        <div class="col-4">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Simpan">
                            </div>
                        </div>
                    </div>
            </div>
            <!-- /. row -->
            </form>

            <!-- /.card-body -->
            <div class="card-footer">
                <a href="#" target="_blank">Warga Tenjo City Residence 3</a>
            </div>
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
