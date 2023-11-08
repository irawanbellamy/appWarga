@extends('templates.main')
@section('title')
Asset
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('peminjamanAsset') }}" class="btn btn-primary">
                    <span class="fas fa-cogs"></span> Pinjam Asset
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
                            <th>Nomor Transaksi</th>
                            <th>Nomor Asset</th>
                            <th>Nama Asset</th>
                            <th>Jumlah</th>
                            <th>Dari Tanggal</th>
                            <th>Sampai Tanggal</th>
                            <th>Lama Pemakaian</th>
                            <th>Keterangan</th>
                            <th>Pengguna</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Cek Pengembalian</th>
                            <th>Status</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->transaction_id }}</td>
                            <td>{{ $item->asset_id }}</td>
                            <td>{{ $item->asset_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->date_from }}</td>
                            <td>{{ $item->date_to }}</td>
                            <td>{{ $item->duration }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->user }}</td>
                            <td>{{ $item->return_date }}</td>
                            <td>{{ $item->return_check }}</td>
                            <td>{{ $item->status }}</td>
                            <td class="text-center">
                                <a href="{{ route('asset.edit',[Crypt::encrypt($item->asset_id)]) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"> Edit</i></a>
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
