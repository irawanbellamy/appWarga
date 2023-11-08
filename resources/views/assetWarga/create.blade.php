@extends('templates.main')
@section('title')
Tambah Asset
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Asset</h3>
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
                <form action="{{ route('asset.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Asset</label>
                                <input type="text" class="form-control" name="asset_name" placeholder="Nawa Asset" value="{{ old('asset_name') }}">
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" name="quantity" placeholder="Jumlah" value="{{ old('quantity') }}">
                            </div>
                            <div class="form-group">
                                <label>Lampiran</label>
                                <input type="file" class="form-control" name="attachment" placeholder="Lampiran" value="{{ old('attachment') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="description" placeholder="Deskripsi" class="form-control" cols="30" rows="8" value="{{ old('description') }}">{{ old('description') }}</textarea>
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
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
