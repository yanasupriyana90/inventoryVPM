@extends('layouts.layout')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Tambah Barang Keluar</h4>
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
                        <a href="#">Barang Keluar</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Tambah Barang Keluar</div>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="/brg_keluar/store">
                            @csrf
                            <div class="card-body">

                                <input type="hidden" value="{{ auth()->user()->id }}" name="id_user" required>


                                <div class="form-group">
                                    <label>No Barang Keluar</label>
                                    <input type="text" class="form-control" value="{{ 'NBK-'.date('dmy').'-'.$kd }}" name="no_brg_keluar" readonly required>
                                </div>

                                <div class="form-group">
                                    <label>tanggal Keluar</label>
                                    <input type="date" class="form-control" name="tgl_brg_keluar" required>
                                </div>

                                <div class="form-group">
                                    <label>Barang</label>
                                    <div class="input-group mb-3" id="input-barang">
                                        <input type="hidden" name="id_brg" id="id_barang">
                                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" readonly required>
                                        <button class="input-group-text btn" type="button" onclick="scan()"><i class="fa fa-qrcode mr-2"></i> Scan Qr Code</button>
                                    </div>
                                    <div class="col-lg-4" id="scan-barang" style="display: none;">
                                        <video id="preview" class="player rounded-3 w-100 rounded"></video>
                                    </div>
                                </div>

                                <div class="form-group" id="harga_brg" style="display: none;">
                                    <label>Harga</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                        </div>
                                        <input type="text" class="form-control" id="harga" readonly required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Jumlah Barang</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" name="jml_brg_keluar" id="jml_brg_keluar" placeholder="Jumlah Barang .." required>

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
                                <a href="/brg_keluar" class="btn btn-danger"><i class="fa fa-undo"></i> Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="{{ asset('assets/js/instanscan/instascan.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#jml_brg_keluar").keyup(function() {
            var jml_brg_keluar = $("#jml_brg_keluar").val();
            var harga = $("#harga").val();

            var total = parseInt(harga) * parseInt(jml_brg_keluar);
            $("#total").val(total);
        });
    });

    function scan() {
        const args = {
            video: document.getElementById('preview')
        };

        window.URL.createObjectURL = (stream) => {
            args.video.srcObject = stream;
            return stream;
        };
        let scanner = new Instascan.Scanner(args);
        scanner.addListener('scan', function(content) {
            let pisah = content.split('-');
            $.ajax({
                type: "GET",
                url: "{{url('brg_keluar/ajax')}}",
                data: {
                    'id_brg': pisah[0]
                },
                dataType: "JSON",
                success: function(data) {
                    if (data) {
                        console.log(data);
                        document.getElementById('nama_barang').value = data.nama_brg;
                        document.getElementById('id_barang').value = data.id;
                        document.getElementById('harga').value = data.harga;
                        // Intl.NumberFormat().format(data.harga)
                        document.getElementById('harga_brg').style.display = 'block';

                        scanner.stop();
                        document.querySelector('#input-barang').style.display = 'flex';
                        document.querySelector('#scan-barang').style.display = 'none';

                        document.getElementById('jml_brg_keluar').focus();
                    } else {
                        swal({
                            title: 'Warning',
                            text: 'Barang tidak ditemukan',
                            type: 'warning',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                }
            })
        });

        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
                document.querySelector('#input-barang').style.display = 'none';
                document.querySelector('#scan-barang').style.display = 'block';
            } else {
                console.log('No cameras found.');
            }
        }).catch(function(e) {
            console.log(e);
        });

    }

    // $.ajaxSetup({
    //     headers: {
    //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    // $('#id_brg').change(function() {
    //     var id_brg = $('#id_brg').val();
    //     $.ajax({
    //         type: "GET",
    //         url: "/brg_keluar/ajax",
    //         data: "id_brg=" + id_brg,
    //         cache: false,
    //         success: function(data) {
    //             $('#detail_barang').html(data);
    //         }
    //     });
    // });
</script>
@endsection