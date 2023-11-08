@extends('templates.main')
@section('title')
Pengaduan
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('pengaduan.create') }}" class="btn btn-danger">
                    <span class="fas fa-exclamation-triangle"></span> Buat Pengaduan
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
                            <th>Nomor Pengaduan</th>
                            <th>Jenis Pengaduan</th>
                            <th>Deskripsi</th>
                            <th>Lampiran</th>
                            <th>Status</th>
                            <th>Tgl Respon (Reject)</th>
                            <th>Catatan Respon (Reject)</th>
                            <th>Tgl Respon</th>
                            <th>Catatan Respon</th>
                            <th>Tanggal Tindakan</th>
                            <th>Catatan Tindakan</th>
                            <th>Lampiran Tindakan</th>
                            <th>Tanggal Selesai</th>
                            <th>Catatan</th>
                            <th>Diinput Oleh</th>
                            <th>Diupdate Oleh</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('pengaduan.detail', [Crypt::encrypt($item->complaint_id)]) }}">
                                    {{ $item->complaint_id }}
                                </a>
                            </td>
                            <td>{{ $item->complaint_type }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <a href="{{ asset('upload') }}/{{$item->attachment}}" target="_blank">
                                    <img src="{{ asset('upload') }}/{{$item->attachment}}" width="75px">
                                </a>
                            </td>
                            <td>{{ $item->status }}</td>
                            <td>
                                @if (is_null($item->reject_date))
                                <p></p>
                                @else
                                {{ date('d-m-Y', strtotime($item->reject_date)) }}
                                @endif
                            </td>
                            <td>{{ $item->reject_note }}</td>
                            <td>
                                @if (is_null($item->followup_date))
                                <p></p>
                                @else
                                {{ date('d-m-Y', strtotime($item->followup_date)) }}
                                @endif
                            </td>
                            <td>{{ $item->followup_note }}</td>
                            <td>
                                @if (is_null($item->execution_date))
                                <p></p>
                                @else
                                {{ date('d-m-Y', strtotime($item->execution_date)) }}
                                @endif
                            </td>
                            <td>{{ $item->execution_note }}</td>
                            <td>
                                @if (is_null($item->execution_attachment))
                                <p></p>
                                @else
                                <a href="{{ asset('upload') }}/{{$item->execution_attachment}}" target="_blank">
                                    <img src="{{ asset('upload') }}/{{$item->execution_attachment}}" width="75px">
                                </a>
                            </td>
                            @endif
                            <td>
                                @if (is_null($item->finish_date))
                                <p></p>
                                @else
                                {{ date('d-m-Y', strtotime($item->finish_date)) }}
                                @endif
                            </td>
                            <td>{{ $item->finish_note }}</td>
                            <td>{{ $item->user_input }}</td>
                            <td>{{ $item->user_update }}</td>
                            <td class="text-center">
                                <a href="{{ route('pengaduan.edit',[Crypt::encrypt($item->complaint_id)]) }}" class="btn btn-success btn-sm">Update</a>
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
