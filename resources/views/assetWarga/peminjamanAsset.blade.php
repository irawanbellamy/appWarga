@extends('templates.main')
@section('title')
Peminjaman Asset
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Asset</h3>
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
                <form id="assetForm" action="{{route('peminjamanAsset.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="asset_id">Asset ID</label>
                        <input type="text" class="form-control" name="asset_id" id="asset_id">
                    </div>
                    <div class="form-group">
                        <label for="asset_name">Asset Name</label>
                        <input type="text" class="form-control" name="asset_name" id="asset_name">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" name="quantity" id="quantity">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addAsset()">Tambah</button>
                    <table id="assetTable" class="table table-bordered table-striped mt-4">
                        <thead>
                            <tr>
                                <th>Asset ID</th>
                                <th>Asset Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- isi form -->
                        </tbody>
                    </table>
                    <button type="submit" value="submit" class="btn btn-primary mt-2">Simpan</button>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="#" target="_blank">Warga Tenjo City Residence 3</a>
            </div>
        </div>
        <!-- /.card -->


        <script>
            function addAsset() {
                var assetId = document.getElementById('asset_id').value;
                var assetName = document.getElementById('asset_name').value;
                var quantity = document.getElementById('quantity').value;

                var table = document.getElementById('assetTable').getElementsByTagName('tbody')[0];
                var newRow = table.insertRow(table.rows.length);
                var cell1 = newRow.insertCell(0);
                var cell2 = newRow.insertCell(1);
                var cell3 = newRow.insertCell(2);

                cell1.innerText = assetId;
                cell2.innerText = assetName;
                cell3.innerText = quantity;


                document.getElementById('asset_id').value = '';
                document.getElementById('asset_name').value = '';
                document.getElementById('quantity').value = '';
            }
        </script>
        
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
