@extends('templates.main')
@section('title')
Tambah Warga
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Warga</h3>
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
                <form action="{{ route('warga.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Warga</label>
                                <input class="form-control" type="hidden" name="is_active" value="1">
                                <select class="form-control select2bs4" id="penghuni" style="width: 100%;" name="user_id">
                                    <option value="">Warga</option>
                                    @foreach ($penghuni as $item)
                                    <option value="{{ $item->id_warga }}">{{ $item->name }} - {{ $item->house_block }}/{{ $item->house_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Telpon</label>
                                <input type="text" class="form-control" name="phone_number" placeholder="Nomor Telpon" value="{{ old('phone_number') }}">
                                <input type="hidden" class="form-control" name="role" value="WARGA">
                                <input type="hidden" class="form-control" name="is_active" value="1">
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" id="name" class="form-control" name="name" placeholder="Nama" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Blok Rumah</label>
                                <input type="text" id="house_block" class="form-control" name="house_block" placeholder="Nomor Rumah" value="{{ old('house_block') }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Nomor Rumah</label>
                                <input type="text" id="house_number" class="form-control" name="house_number" placeholder="Nomor Rumah" value="{{ old('house_number') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" value="{{ old('password') }}" autocomplete="on">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Status Huni</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="status">
                                    <option value="">Status Huni</option>
                                    <option value="Menetap">Menetap</option>
                                    <option value="Belum Menetap">Belum Menetap</option>
                                    <option value="Sewa">Sewa</option>
                                </select>
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
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="#" target="_blank">Warga Tenjo City Residence 3</a>
            </div>
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</section>

@endsection
