@extends('templates.main')
@section('title')
Edit Pengurus
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Edit Data Pengurus</h3>
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
                <form action="{{ route('pengurus.update', $data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nama Pengurus</label>
                                <input class="form-control" type="hidden" name="is_active" value="1">
                                <select class="form-control select2bs4" style="width: 100%;" name="name">
                                    <option value="{{ $data->name }}">{{ $data->name }}</option>
                                    @foreach ($nama as $nama)
                                    <option value="{{ $data->name }}">{{ $nama->name }} - {{ $nama->house_block }}/{{ $nama->house_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Posisi</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="job_title">
                                    <option value="{{ $data->job_title }}">{{ $data->job_title }}</option>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Organisasi</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="department">
                                    <option value="{{ $data->department }}">{{ $data->department }}</option>
                                    <option value="Paguyuban TC3">Paguyuban TC3</option>
                                    <option value="DKM Mushola AL Ikhlas">DKM Mushola AL Ikhlas</option>
                                    <option value="Okumene">Okumene</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Aktif</label>
                                <select class="form-control select2bs4 " style="width: 100%;" name="is_active">
                                    <?php
                                    $is_active = $data->is_active;
                                    $is_active === 0 ? $is_active = "TIDAK AKTIF" : $is_active = "AKTIF";
                                    ?>
                                    <option "{{ $data->is_active }}">{{ $is_active }}</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row pl-1">
                        <div class="col-1">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Update">
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <a href="{{ route('pengurus.index') }}" class="btn btn-danger">Kembali</a>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- /. row -->
            </form>
        </div>
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
