<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Cetak Laporan Barang Masuk</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">

</head>
<body style="background-color: white;" onload="window.print()">

    <style>
        .line-title{
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table style="width: 100%">
                        <tr>
                            <td align="center">
                                <span style="line-height: 1.6; font-weight: bold";>
                                    SISTEM INFORMASI INVENTORY
                                    <br>PT. VICTORY PAN MULTITEX
                                </span>
                            </td>
                        </tr>
                    </table>

                    <hr class="line-title">
                    <p align="center">
                        LAPORAN DATA BARANG MASUK
                    </p>
                    <p align="center">
                        Periode Tanggal {{ date('d F Y', strtotime($tgl_mulai)) }} s/d {{ date('d F Y', strtotime($tgl_selesai)) }}
                    </p>

                    <hr/>

                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>No Barang Masuk</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Tanggal Masuk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>

                        @if ($sum_total == 0)
                        <tr>
                            <td colspan="8">
                                <center>
                                    <b> Data Tidak Ada Pada Periode Tanggal {{ date('d F Y', strtotime($tgl_mulai)) }} s/d {{ date('d F Y', strtotime($tgl_selesai)) }} </b>
                                </center>
                            </td>
                        </tr>

                        @else

                        @php
                        $no=1;
                        @endphp
                        @foreach ($brg_masuk as $row)

                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->no_brg_masuk }}</td>
                            <td>{{ $row->nama_brg }}</td>
                            <td>{{ $row->nama_kategori }}</td>
                            <td>{{ date('d F Y', strtotime($row->tgl_brg_masuk)) }}</td>
                            <td>Rp. {{ number_format($row->harga) }}</td>
                            <td>{{ $row->jml_brg_masuk }} Unit</td>
                            <td>Rp. {{ number_format($row->total) }}</td>
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="7">Total Harga</td>
                            <td>Rp. {{ number_format($sum_total) }}</td>
                        </tr>

                        @endif

                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
