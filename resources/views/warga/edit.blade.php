@extends('templates.main')
@section('title')
Edit Warga
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Edit Data Warga</h3>
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
                <form action="{{ route('warga.update', $data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Warga</label>
                                <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>Blok Rumah</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="house_block">
                                    <option value="{{ $data->house_block }}">{{ $data->house_block }}</option>
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
                                    <option value="L5">Ruko</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telpon</label>
                                <input type="text" class="form-control" name="phone_number" value="{{ $data->phone_number }}" class="form-control">
                                <input type="hidden" class="form-control" name="role" value="WARGA">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $data->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Nomor Rumah</label>
                                <input type="number" class="form-control" name="house_number" value="{{ $data->house_number }}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" value="{{ $data->password }}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Status Huni</label>
                                <select class="form-control select2bs4 " style="width: 100%;" name="status">
                                    <option value="{{ $data->status }}">{{ $data->status }}</option>
                                    <option value="">Status Huni</option>
                                    <option value="Menetap">Menetap</option>
                                    <option value="Belum Menetap">Belum Menetap</option>
                                    <option value="Sewa">Sewa</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Aktif</label>
                                <select class="form-control select2bs4 " style="width: 100%;" name="is_active">
                                <?php
                                $is_active = $data->is_active;
                                $is_active === 0 ? $is_active = "TIDAK AKTIF" : $is_active = "AKTIF";
                                ?>
                                    <option value="{{ $data->is_active }}">{{ $is_active }}</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="row ml-1">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Update">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <a href="{{ route('warga.index') }}" class="btn btn-danger">Kembali</a>
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
