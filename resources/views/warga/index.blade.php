@extends('templates.main')
@section('title')
Warga
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('warga.create') }}" class="btn btn-primary">
                    <span class="fas fa-user-plus"></span> Tambah User
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Warga</th>
                            <th>Block/No Rumah</th>
                            <th>Status</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->house_block }}/{{ $item->house_number }}</td>
                            <td>{{ $item->status }}</td>
                            <td class="text-center">
                                <a href="{{ route('warga.edit',[Crypt::encrypt($item->id)]) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"> Edit</i></a>
                            </td>
                        </tr>
                        @endforeach
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
