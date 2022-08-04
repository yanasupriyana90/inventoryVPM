@extends("layouts.layout")

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Laporan Data Barang</h4>
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
                        <a href="#">Laporan Data</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Barang</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Laporan Data Barang</h4>
                                <a href="/lap_barang/cetak_barang" class="btn btn-primary btn-round ml-auto" target="_blank">
                                    <i class="fa fa-print"></i>
                                    Cetak Data
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Kategori</th>
                                            @if(Auth::user()->level == 1 || Auth::user()->level == 2)
                                            <th>Harga</th>
                                            @endif
                                            <th>Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp

                                        @foreach ($barang as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->nama_brg }}</td>
                                            <td>{{ $row->nama_kategori }}</td>
                                            @if(Auth::user()->level == 1 || Auth::user()->level == 2)
                                            <td>Rp. {{ number_format($row->harga) }}</td>
                                            @endif
                                            <td>{{ $row->stok }} Unit</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
