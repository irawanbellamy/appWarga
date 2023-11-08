@extends('templates.main')
@section('title')
Edit Asset
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Edit Data Asset</h3>
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
                <form action="{{ route('asset.update', $data[0]->asset_id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Asset</label>
                                <input type="text" class="form-control" name="asset_name" placeholder="Nama Asset" value="{{ $data[0]->asset_name }}">
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" name="quantity" placeholder="Jumlah" value="{{ $data[0]->quantity }}">
                            </div>
                            <div class="form-group">
                                <label>Lampiran</label>
                                @if (is_null($data[0]->attachment))
                                <p class="text-danger">*Image belum diupload</p>
                                @else
                                <img src="{{ asset('upload') }}/{{$data[0]->attachment}}" alt="img" width="65px" class="m-2">
                                @endif
                                <input type="file" class="form-control" name="attachment" placeholder="Lampiran" value="{{ asset('upload') }}/$data[0]->attachment }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="description" placeholder="Deskripsi" class="form-control" cols="30" rows="3" value="{{ $data[0]->description }}">{{ $data[0]->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Aktif</label>
                                <select class="form-control select2bs4 " style="width: 100%;" name="status">
                                    <option value="{{ $data[0]->status }}">{{ $data[0]->status }}</option>
                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Dipesan">Dipesan</option>
                                    <option value="Digunakan">Digunakane</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Aktif</label>
                                <select class="form-control select2bs4 " style="width: 100%;" name="is_active">
                                    <?php
                                    $is_active = $data[0]->is_active;
                                    $is_active === 0 ? $is_active = "TIDAK AKTIF" : $is_active = "AKTIF";
                                    ?>
                                    <option value="{{ $data[0]->is_active }}">{{ $is_active }}</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row ml-1">
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
