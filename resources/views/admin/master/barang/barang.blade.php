@extends("layouts.layout")

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Barang</h4>
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
                        <a href="#">Data</a>
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
                                <h4 class="card-title">Data Barang</h4>
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalTambahBarang">
                                    <i class="fa fa-plus"></i>
                                    Tambah Data
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
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
                                            <td>Rp. {{ number_format($row->harga) }}</td>
                                            <td>{{ $row->stok }} Unit</td>
                                            <td class="text-center">
                                                <button class="btn btn-info btn-xs" data-item="{{$row}}" data-qrCode="{{ htmlspecialchars($row->qrCode) }}" onclick="generateQrCode(this)"><i class="fa fa-qrcode"></i> Cetak QrCode</button>
                                                <a href="#modalEditBarang{{ $row->id }}" data-toggle="modal" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="#modalHapusBarang{{ $row->id }}" data-toggle="modal" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
                                            </td>
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


<div class="modal fade" id="modalTambahBarang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" enctype="multipart/form-data" action="/barang/store">
                @csrf

                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama_brg" placeholder="Nama Barang .." required>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" name="id_kategori" required>
                            <option value="" hidden="">== Pilih Kategori ==</option>

                            @foreach ($kategori as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                            </div>
                            <input type="number" class="form-control" name="harga" placeholder="Harga .." required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="minStok" placeholder="Minimal Stok .." required>

                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Unit</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="stok" placeholder="Stok .." required>

                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Unit</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>

            </form>
        </div>
    </div>
</div>

@foreach ($barang as $d)
<div class="modal fade" id="modalEditBarang{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" enctype="multipart/form-data" action="/barang/{{ $d->id }}/update">
                @csrf

                <div class="modal-body">

                    <input type="hidden" value="{{ $d->id }}" name="id" required>

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" value="{{ $d->nama_brg }}" class="form-control" name="nama_brg" placeholder="Nama Barang .." required>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" name="id_kategori" required>
                            <option value="{{ $d->id_kategori }}">{{ $d->nama_kategori }}</option>

                            @foreach ($kategori as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                            </div>
                            <input type="number" value="{{ $d->harga }}" class="form-control" name="harga" placeholder="Harga .." required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="">Minimal Stok</label>
                            <div class="input-group mb-3">
                                <input type="number" value="{{ $d->minStok }}" class="form-control" name="minStok" placeholder="Minimal Stok .." required>

                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Unit</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Stok</label>
                            <div class="input-group mb-3">
                                <input type="number" value="{{ $d->stok }}" class="form-control" name="stok" placeholder="Stok .." required>

                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Unit</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endforeach

@foreach ($barang as $g)
<div class="modal fade" id="modalHapusBarang{{ $g->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Hapus Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="GET" enctype="multipart/form-data" action="/barang/{{ $g->id }}/destroy">
                @csrf

                <div class="modal-body">

                    <input type="hidden" value="{{ $g->id }}" name="id" required>

                    <div class="form-group">
                        <h4>Apakah Anda Ingin Menghapus Data Ini ?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endforeach
<div class="modal fade" id="modalQrCode" tabindex="-1" role="dialog" aria-labelledby="modalQrCodeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalQrCodeTitle">QR-CODE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div id="viewQrCode" class="mb-2">

                </div>
                <button type="button" class="btn btn-secondary" id="downloadPNG"><i class="fa fa-download"></i> Download to PNG</button>
            </div>
        </div>
    </div>
</div>
<script>
    function generateQrCode(obj) {
        const item = $(obj).data('item');
        const qrCode = $(obj).data('qrcode');

        document.querySelector('#downloadPNG').dataset.namabarang = item.nama_brg;

        document.getElementById('viewQrCode').innerHTML = htmlDecode(qrCode);
        $('#modalQrCode').modal('show')
    }

    function htmlDecode(input) {
        const doc = new DOMParser().parseFromString(input, 'text/html');
        return doc.documentElement.textContent;
    };

    document.querySelector('#downloadPNG').addEventListener('click', downloadSVGAsPNG);

    function downloadSVGAsPNG(e) {
        let namabarang = $(e.target).data('namabarang');

        const canvas = document.createElement("canvas");
        const svg = document.querySelector('#viewQrCode svg');
        const base64doc = btoa(unescape(encodeURIComponent(svg.outerHTML)));
        const w = parseInt(svg.getAttribute('width'));
        const h = parseInt(svg.getAttribute('height'));
        const img_to_download = document.createElement('img');
        img_to_download.src = 'data:image/svg+xml;base64,' + base64doc;
        img_to_download.onload = function() {
            canvas.setAttribute('width', w);
            canvas.setAttribute('height', h);
            const context = canvas.getContext("2d");
            //context.clearRect(0, 0, w, h);
            context.drawImage(img_to_download, 0, 0, w, h);
            const dataURL = canvas.toDataURL('image/png');
            if (window.navigator.msSaveBlob) {
                window.navigator.msSaveBlob(canvas.msToBlob(), `qrCode-${namabarang}.png`);
                e.preventDefault();
            } else {
                const a = document.createElement('a');
                const my_evt = new MouseEvent('click');
                a.download = `qrCode-${namabarang}.png`;
                a.href = dataURL;
                a.dispatchEvent(my_evt);
            }
            //canvas.parentNode.removeChild(canvas);
        }
    }
</script>
@endsection