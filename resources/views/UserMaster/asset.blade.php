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
                <h3>Master Data Asset</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Asset</th>
                            <th>Nama Asset</th>
                            <th>Jumlah</th>
                            <th>Deskripsi</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->asset_id }}</td>
                            <td>{{ $item->asset_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                @if (is_null($item->attachment))
                                <p></p>
                                @else
                                <img src="{{ asset('upload') }}/{{$item->attachment}}" width="50px">
                                @endif
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
