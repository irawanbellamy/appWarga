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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input class="form-control" type="hidden" name="is_active" value="1">
                                <select class="form-control select2bs4" style="width: 100%;" name="name">
                                    <option value="">Nama</option>
                                    @foreach ($nama as $nama)
                                    <option value="{{ $nama->name }}">{{ $nama->name }} - {{ $nama->house_block }}/{{ $nama->house_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>Blok Rumah</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="house_block">
                                    <option value="">Blok Rumah</option>
                                    <option value="I1">I1</option>
                                    <option value="I2">I2</option>
                                    <option value="I3">I3</option>
                                    <option value="I4">I4</option>
                                    <option value="I5">I5</option>
                                    <option value="J1">J1</option>
                                    <option value="J2">J2</option>
                                    <option value="J3">J3</option>
                                    <option value="J4">J4</option>
                                    <option value="J5">J5</option>
                                    <option value="J6">J6</option>
                                    <option value="J7">J7</option>
                                    <option value="J8">J8</option>
                                    <option value="K1">K1</option>
                                    <option value="K2">K2</option>
                                    <option value="K3">K3</option>
                                    <option value="K4">K4</option>
                                    <option value="K5">K5</option>
                                    <option value="K6">K6</option>
                                    <option value="K7">K7</option>
                                    <option value="K8">K8</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="L3">L3</option>
                                    <option value="L4">L4</option>
                                    <option value="L5">L5</option>
                                    <option value="L6">L6</option>
                                    <option value="L7">L7</option>
                                    <option value="L8">L8</option>
                                    <option value="L9">L9</option>
                                    <option value="Ruko">Ruko</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telpon</label>
                                <input type="text" class="form-control" name="phone_number" placeholder="Nomor Telpon" value="{{ old('phone_number') }}">
                                <input type="hidden" class="form-control" name="role" value="WARGA">
                                <input type="hidden" class="form-control" name="is_active" value="1">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Nomor Rumah</label>
                                <input type="number" class="form-control" name="house_number" placeholder="Nomor Rumah" value="{{ old('house_number') }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" value="{{ old('password') }}">
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
<!-- /.content -->
@endsection
