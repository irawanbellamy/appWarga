@extends('templates.main')
@section('title')
Input Kas Keluar
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"><strong>Input Kas Keluar</strong> </h3>
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
                <form action="{{ route('storeKasKeluar') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kategori Pengeluaran</label>
                                <input type="hidden" name="transaction_id">
                                <input type="hidden" name="user_input" value="{{ auth()->user()->name }}">
                                <select class="form-control select2bs4" style="width: 100%;" name="cash_out_category">
                                    <option value="">Kategori Pengeluaran</option>
                                    <option value="Operasional">Operasional</option>
                                    <option value="Kegiatan Warga">Kegiatan Warga</option>
                                    <option value="Sosial">Sosial</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nominal</label>
                                <input type="number" class="form-control" name="amount" placeholder="Rp. -" value="{{ old('amount') }}">
                            </div>
                            <div class=" form-group">
                                <label>Tanggal Pengeluaran</label>
                                <input type="date" class="form-control" name="transaction_date" placeholder="Tanggal Pengeluaran">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lampiran</label>
                                <input type="file" class="form-control" name="cash_out_attachment" placeholder="Lampiran" value="{{ old('cash_out_attachment') }}">
                            </div>
                            <div class="form-group">
                                <label>Catatan Pengeluaran</label>
                                <textarea name="cash_out_note" placeholder="Catatan Pengeluaran" class="form-control" cols="30" rows="4" value="{{ old('cash_out_note') }}">{{ old('cash_out_note') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row pl-1">
                        <div class="col-4">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Simpan">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /. row -->
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="#" target="_blank">Warga Tenjo City Residence 3</a>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
</section>
<script>
    $(function() {
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
    });
</script>
<!-- /.content -->
@endsection
