@extends('templates.main')
@section('title')
Pengurus
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('pengurus.create') }}" class="btn btn-primary">
                    <span class="fas fa-user-plus"></span> Tambah Pengurus
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
                            <th>Nama Pengurus</th>
                            <th>Posisi</th>
                            <th>Organisasi</th>
                            <th>Status</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->job_title }}</td>
                            <td>{{ $item->department }}</td>
                            <?php
                            $is_active = $item->is_active;
                            $is_active === 0 ? $is_active = "TIDAK AKTIF" : $is_active = "AKTIF";
                            ?>
                            <td>{{ $is_active }}</td>
                            <td class="text-center">
                                <a href="{{ route('pengurus.edit',[Crypt::encrypt($item->id)]) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"> Edit</i></a>
                                <!-- <form action="{{ route('warga.destroy', [Crypt::encrypt($item->id)]) }}" method="post" onsubmit="return confirm('Yakin ingin menghapus?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
                                </form> -->
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
