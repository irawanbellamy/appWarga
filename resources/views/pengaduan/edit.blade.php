@extends('templates.main')
@section('title')
Respon Pengaduan
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Respon Pengaduan</h3>
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
                <form action="{{ route('pengaduan.update', $data[0]->complaint_id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Pengaduan</label>
                                <input type="text" class="form-control" name="complaint_id" value="{{ $data[0]->complaint_id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Jenis Pengaduan</label>
                                <input type="text" class="form-control" name="complaint_type" value="{{ $data[0]->complaint_type }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Diposting Oleh</label>
                                <input type="text" class="form-control" name="user_input" value="{{ $data[0]->user_input }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control select2bs4 " style="width: 100%;" name="status" id="optionSelect" onchange="changeOptionSelect()">
                                    <option value="{{ $data[0]->status }}">{{ $data[0]->status }}</option>
                                    <option value="Reject">Reject</option>
                                    <option value="Diteruskan">Diteruskan</option>
                                    <option value="Diproses">Diproses</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-6 rowDiteruskan" hidden>
                            <div class="form-group">
                                <label>Tanggal Tindak Lanjut (Internal / Developer)</label>
                                <input type="text" class="form-control" name="followup_date" value="{{ date(now()) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Catatan Tindak Lanjut</label>
                                <textarea name="followup_note" placeholder="Catatan Tindak Lanjut" class="form-control" cols="30" rows="3" value=""></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 rowReject" hidden>
                            <div class="form-group">
                                <label>Tanggal Tindak Lanjut (Reject)</label>
                                <input type="text" class="form-control" name="reject_date" value="{{ date(now()) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Catatan Tindak Lanjut</label>
                                <textarea name="reject_note" placeholder="Catatan Reject" class="form-control" cols="30" rows="3" value=""></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 rowDiproses" hidden>
                            <div class="form-group">
                                <label>Tanggal Tindakan (Proses)</label>
                                <input type="text" class="form-control" name="execution_date" value="{{ date(now()) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Catatan Tindakan</label>
                                <textarea name="execution_note" placeholder="Catatan Tindak Lanjut" class="form-control" cols="30" rows="3" value=""></textarea>
                            </div>
                            <div class="form-group">
                                <label>Lampiran</label>
                                <input type="file" class="form-control" name="execution_attachment" placeholder="Lampiran" value="">
                            </div>
                        </div>
                        <div class="col-md-6 rowSelesai" hidden>
                            <div class="form-group">
                                <label>Tanggal Selesai</label>
                                <input type="text" class="form-control" name="finish_date" value="{{ date(now()) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="finish_note" placeholder="Catatan Tindak Lanjut" class="form-control" cols="30" rows="3" value=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row pl-1">
                        <div class="col-1">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Update">
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <a href="{{ route('pengaduan') }}" class="btn btn-danger">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row ml-1">
                        <div class="col-4">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Simpan">
                            </div>
                        </div>
                    </div> -->
            </div>
            <!-- /. row -->
            </form>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="#" target="_blank">Warga Tenjo City Residence 3</a>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
<script>
    function changeOptionSelect() {
        var optionSelect = $('#optionSelect').val();
        if (optionSelect == "Diteruskan") {
            $('.rowDiteruskan').removeAttr('hidden');
            $('.rowReject').attr('hidden', 'hidden');
            $('.rowDiproses').attr('hidden', 'hidden');
            $('.rowSelesai').attr('hidden', 'hidden');
        } else if (optionSelect == "Reject") {
            $('.rowReject').removeAttr('hidden', 'hidden');
            $('.rowDiteruskan').attr('hidden', 'hidden');
            $('.rowDiproses').attr('hidden', 'hidden');
            $('.rowSelesai').attr('hidden', 'hidden');

        } else if (optionSelect == "Diproses") {
            $('.rowDiproses').removeAttr('hidden', 'hidden');
            $('.rowReject').attr('hidden', 'hidden');
            $('.rowDiteruskan').attr('hidden', 'hidden');
            $('.rowSelesai').attr('hidden', 'hidden');
        } else if (optionSelect == "Selesai") {
            $('.rowSelesai').removeAttr('hidden', 'hidden');
            $('.rowReject').attr('hidden', 'hidden');
            $('.rowDiproses').attr('hidden', 'hidden');
            $('.rowDiteruskan').attr('hidden', 'hidden');
        } else {
            $('.rowReject').attr('hidden', 'hidden');
            $('.rowDiteruskan').attr('hidden', 'hidden');
            $('.rowDiproses').attr('hidden', 'hidden');
        }
    }
</script>
