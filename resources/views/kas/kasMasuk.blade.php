@extends('templates.main')
@section('title')
Input Kas Masuk
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"><strong>Input Kas Masuk</strong> </h3>
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
                <form action="{{ route('storeKasMasuk') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Donatur</label>
                                <input class="form-control" type="hidden" name="is_active" value="1">
                                <select class="form-control select2bs4" style="width: 100%;" name="donatur">
                                    <option value="">Nama Donatur</option>
                                    @foreach ($nama as $nama)
                                    <option value="{{ $nama->name }}">{{ $nama->name }} - {{ $nama->house_block }}/{{ $nama->house_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kategori Kas</label>
                                <input type="hidden" name="transaction_id">
                                <input type="hidden" name="subtransaction_id">
                                <input type="hidden" name="user_input" value="{{ auth()->user()->name }}">
                                <select class="form-control select2bs4" style="width: 100%;" name="cash_in_category" id="optionSelect" onchange="changeOptionSelect()">
                                    <option value="">Kategori Kas</option>
                                    <option value="Iuran Paguyuban">Iuran Paguyuban</option>
                                    <option value="Donasi">Donasi</option>
                                    <option value="Sewa Asset">Sewa Asset</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Medode Pembayaran</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="cash_in_methode">
                                    <option value="">Medode Pembayaran</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                            </div>
                            <!-- <div class="form-group Donasi" hidden>
                                <label>Nominal Donasi/Sewa Asset</label>
                                <input type="number" class="form-control" name="amount" placeholder="Rp. -">
                            </div> -->
                            <div class="form-group">
                                <label>Nominal</label>
                                <input type="number" class="form-control" name="amount"   placeholder="Rp. -">
                            </div>
                            <div class="form-group Iuran" hidden>
                                <label>Total</label>
                                <input type="number" class="form-control" id="result" placeholder="Rp. -"  readonly>
                            </div>
                            <div class="form-group Iuran" hidden>
                                <label>Tahun</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="cash_in_year">
                                    <option value="">Tahun</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-2 Iuran" hidden>
                                <label>Bulan</label><br>
                                <div class="icheck-primary d-inline mr-2">
                                    <input type="checkbox" name="cash_in_month[]" value="Januari" id="checkboxPrimary1" onchange="updateValue()">
                                    <label for="checkboxPrimary1">
                                        Januari
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline mr-2">
                                    <input type="checkbox" name="cash_in_month[]" value="Februari" id="checkboxPrimary2" onchange="updateValue()">
                                    <label for="checkboxPrimary2">
                                        Februari
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline mr-2">
                                    <input type="checkbox" name="cash_in_month[]" value="Maret" id="checkboxPrimary3" onchange="updateValue()">
                                    <label for="checkboxPrimary3">
                                        Maret
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline mr-2">
                                    <input type="checkbox" name="cash_in_month[]" value="April" id="checkboxPrimary4" onchange="updateValue()">
                                    <label for="checkboxPrimary4">
                                        April
                                    </label>
                                </div>
                            </div>
                            <div class="form-group mt-2 Iuran" hidden>
                                <div class="icheck-primary d-inline mr-2">
                                    <input type="checkbox" name="cash_in_month[]" value="Mei" id="checkboxPrimary5" onchange="updateValue()">
                                    <label for="checkboxPrimary5">
                                        Mei
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline mr-2">
                                    <input type="checkbox" name="cash_in_month[]" value="Juni" id="checkboxPrimary6" onchange="updateValue()">
                                    <label for="checkboxPrimary6">
                                        Juni
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline mr-2">
                                    <input type="checkbox" name="cash_in_month[]" value="Juli" id="checkboxPrimary7" onchange="updateValue()">
                                    <label for="checkboxPrimary7">
                                        Juli
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline mr-2">
                                    <input type="checkbox" name="cash_in_month[]" value="Agustus" id="checkboxPrimary8" onchange="updateValue()">
                                    <label for="checkboxPrimary8">
                                        Agustus
                                    </label>
                                </div>
                            </div>
                            <div class="form-group mt-2 Iuran" hidden>
                                <div class="icheck-primary d-inline mr-2">
                                    <input type="checkbox" name="cash_in_month[]" value="September" id="checkboxPrimary9" onchange="updateValue()">
                                    <label for="checkboxPrimary9">
                                        September
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline mr-2">
                                    <input type="checkbox" name="cash_in_month[]" value="Oktober" id="checkboxPrimary10" onchange="updateValue()">
                                    <label for="checkboxPrimary10">
                                        Oktober
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline mr-2">
                                    <input type="checkbox" name="cash_in_month[]" value="November" id="checkboxPrimary11" onchange="updateValue()">
                                    <label for="checkboxPrimary11">
                                        November
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline mr-2">
                                    <input type="checkbox" name="cash_in_month[]" value="Desember" id="checkboxPrimary12" onchange="updateValue()">
                                    <label for="checkboxPrimary12">
                                        Desember
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Lampiran</label>
                                <input type="file" class="form-control" name="cash_in_attachment" placeholder="Lampiran" value="{{ old('cash_in_attachment') }}">
                            </div>
                            <div class="form-group">
                                <label>Catatan Kas Masuk</label>
                                <textarea name="cash_in_note" placeholder="Catatan Kas Masuk" class="form-control" cols="30" rows="2" value="{{ old('cash_in_note') }}">{{ old('cash_in_note') }}</textarea>
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
    function changeOptionSelect() {
        var optionSelect = $('#optionSelect').val();
        if (optionSelect == "Iuran Paguyuban") {
            $('.Iuran').removeAttr('hidden');
        } else if (optionSelect == "Donasi" || optionSelect == "Sewa Asset") {
            $('.Donasi').removeAttr('hidden');
            $('.Iuran').attr('hidden', 'hidden');
        } else {
            $('.Iuran').attr('hidden', 'hidden');
        }
    }
</script>
<script>
    function updateValue() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var total = 0;

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                total += 10000;
            }
        });

        var inputValue = document.getElementById("result");
        inputValue.value = total;
    }
</script>
<!-- <script>
    function sum() {
        var nominal = document.getElementById('amount').value;
        var total = document.getElementById('result').value = nominal;
    }
</script> -->
<!-- /.content -->
@endsection
