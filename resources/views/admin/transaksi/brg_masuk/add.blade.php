@extends('layouts.layout')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Tambah Barang Masuk</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Tambah</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Barang Masuk</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Tambah Barang Masuk</div>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="/brg_masuk/store">
                            @csrf
                            <div class="card-body">

                                <input type="hidden" value="{{ auth()->user()->id }}" name="id_user" required>


                                <div class="form-group">
                                    <label>No Barang Masuk</label>
                                    <input type="text" class="form-control" value="{{ 'NBM-'.date('dmy').'-'.$kd }}" name="no_brg_masuk" readonly required>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Masuk</label>
                                    <input type="date" class="form-control" name="tgl_brg_masuk" required>
                                </div>

                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <Select class="form-control" name="id_brg" id="id_brg" required>
                                        <option value="" hidden="">== Pilih Barang ==</option>

                                        @foreach ($barang as $d)
                                        <option value="{{ $d->id }}">{{ $d->nama_brg }}</option>
                                        @endforeach
                                    </Select>
                                </div>

                                <div id="detail_barang"></div>

                                <div class="form-group">
                                    <label>Jumlah Barang</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" name="jml_brg_masuk" id= "jml_brg_masuk" placeholder="Jumlah Barang .." required>

                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Unit</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Total</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                        </div>
                                        <input type="text" class="form-control" name="total" id="total" placeholder="Total .." readonly required>
                                    </div>
                                </div>

                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                                <a href="/brg_masuk" class="btn btn-danger"><i class="fa fa-undo"></i> Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/core/jquery.3.2.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#jml_brg_masuk").keyup(function() {
            var jml_brg_masuk = $("#jml_brg_masuk").val();
            var harga = $("#harga").val();

            var total = parseInt(harga) * parseInt(jml_brg_masuk);
            $("#total").val(total);
        });
    });
</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script type="text/javascript">
    $('#id_brg').change(function(){
        var id_brg = $('#id_brg').val();
        $.ajax({
            type: "GET",
            url: "/brg_masuk/ajax",
            data: "id_brg="+id_brg,
            cache:false,
            success: function(data){
                $('#detail_barang').html(data);
            }
        });
    });
</script>

@endsection
