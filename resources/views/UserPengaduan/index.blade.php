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
                <a href="{{ url('/user/pengaduan/create') }}" class="btn btn-primary">
                    <span class="fas fa-plus"></span> Buat Pengaduan
                </a>
                <a href="{{ url('/user/pengaduanPdf') }}" class="btn btn-success" target="_blank">
                    <span class="fas fa-print"></span> Rekap Pengaduan PDF
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('UserPengaduanDetail', [Crypt::encrypt($item->complaint_id)]) }}">
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
