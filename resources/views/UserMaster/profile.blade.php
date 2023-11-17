@extends('templates.main')
@section('title')
Update Profile
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Update Password</h3>
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
                <form action="{{ url('user/profile/update', $data[0]->user_id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Warga</label>
                                <input type="text" class="form-control" value="{{ $data[0]->name }}" readonly>
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" class="form-control" name="password" placeholder="Masukan Password Baru" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row ml-1">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Update">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <a href="{{ url('/dashboardUser') }}" class="btn btn-danger">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /. row -->
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="https://wargatcr3.com" target="_blank">Warga Tenjo City Residence 3</a>
            </div>
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
