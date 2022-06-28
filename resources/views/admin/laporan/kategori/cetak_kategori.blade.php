<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Cetak Laporan Kategori</title>

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
                        LAPORAN DATA KATEGORI
                    </p>

                    <hr/>

                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                        </tr>

                        @php
                        $no=1;
                        @endphp

                        @foreach ($kategori as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->nama_kategori }}</td>

                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
