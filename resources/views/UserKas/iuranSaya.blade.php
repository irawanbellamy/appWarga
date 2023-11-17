@extends('templates.main')
@section('title')
Iuran Saya
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3>Iuran Saya</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <!-- /.col -->
                    @foreach ($data as $item)
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="info-box bg-gradient-success">
                            <div class="info-box-content">
                                <span class="info-box-text">No Transaksi : {{ $item->transaction_id }}</span>
                                <span class="info-box-text">No Sub Transaksi : {{ $item->subtransaction_id }}</span>
                                <span class="info-box-number">Jumlah Rp. {{ number_format($item->amount)  }}</span>
                                <span class="info-box-number">Bulan/Tahun : {{ $item->cash_in_month }}-{{ $item->cash_in_year }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    @endforeach
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
