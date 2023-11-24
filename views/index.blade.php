@extends('layout.main')
@section('title', 'Daftar Mesin')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Mesin</h1>
    <p class="mb-4">Berikut merupakan data Mesin di Maintenance</p>

    @if(Session::has('berhasil'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Success,</strong>
        {{ Session::get('berhasil') }}
    </div>
    @endif
    <div class="row justify-content-start">
        <div class="col-6">
            <a href="/data-mesin/create" class="btn btn-primary btn-icon-split btn-sm mb-3" id="addRowButton">Tambah Data Mesin</a>

            <!--
            <a href="/data-mesin/printpdf" class="btn btn-success btn-icon-split btn-sm mb-3">Print Data Mesin</a>
            -->
            <button type="button" class="btn btn-success btn-icon-split btn-sm mb-3" data-toggle="modal" data-target="#importModal">iMPORT2</button>
            <a href="/file-import-export" class="btn btn-success btn-icon-split btn-sm mb-3">Import</a>
            <!--
            <a href="{{ route('file-export') }}" class="btn btn-success btn-icon-split btn-sm mb-3">Export</a>
            -->
            <a href="{{ route('file-export') }}" class="btn btn-success btn-icon-split btn-sm mb-3">EXPORT</a>

        </div>
    </div>
    <div class="row px-3 py-3">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>Ubah</th>
                            <th>No.</th>
                            <th>No.Registrasi</th>
                            <th>Katgeori Mesin</th>
                            <th>Klasifikasi Mesin</th>
                            <th>Nama Mesin</th>
                            <th>Type</th>
                            <th>Merk</th>
                            <th>Spesifikasi</th>
                            <th>Pabrikan</th>
                            <th>Kapasitas</th>
                            <th>Tahun Mesin</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datamesin as $mesin)
                        <tr>
                            <td>

                                <a class="btn btn-info" href="/data-mesin/{{ $mesin->id }}"><i class="bi bi-eye"></i></a>
                                <a class="btn btn-primary" href="/data-mesin/{{ $mesin->id }}/edit"><i class="bi bi-pencil-square"></i></a>
                                <div style="display: flex; align-items: center;">
                                    <form action="/data-mesin/{{ $mesin->id }}" method="POST" style="margin-right: 10px;">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini? ')" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                    <a class="btn btn-info" href="/qrcode/{{ $mesin->kode_jenis }}" style="display: inline-block; padding: 5px; background-color: #ECEE81; margin-left: -6px; ">
                                        <img src="{{ asset('assets/icon/qrcode-solid.svg') }}" alt="Lihat" style="width: 34px; height: 27px;">
                                    </a>
                                </div>
                            </td>

                            <!--
                    <td>{{ $mesin->kode_kategori }}-{{ $mesin->kode_klasifikasi }}-{{ str_pad($mesin->kodeJenis, 3, '0', STR_PAD_LEFT) }}-{{ $mesin->tahun_mesin }}</td>
-->
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mesin->kode_jenis }}</td>
                            <td>{{ $mesin->kategori->nama_kategori }}</td>
                            <td>{{ $mesin->klasifikasi->nama_klasifikasi }}</td>
                            <td class="text-capitalize">{{ $mesin->nama_mesin }}</td>
                            <td>{{ $mesin->type_mesin }}</td>
                            <td>{{ $mesin->merk_mesin }}</td>
                            <td>Min. {{ $mesin->spek_min }} - Max. {{ $mesin->spek_max }}</td>
                            <td>{{ $mesin->pabrik }}</td>
                            <td><span style="text-align:center;">{{ $mesin->kapasitas }} (Ton)</span></td>
                            <td>{{ $mesin->tahun_mesin }}</td>
                            <td>{{ $mesin->lok_ws }}</td>

                            <!--
                    <td>
                        <a class="btn btn-info" href="/data-mesin/{{ $mesin->id }}"><i class="bi bi-eye"></i></a>
                        <a class="btn btn-primary" href="/data-mesin/{{ $mesin->type_mesin }}/edit"><i class="bi bi-pencil-square"></i></a>
                        <div style="display: flex; align-items: center;">
                            <form action="/data-mesin/{{ $mesin->id }}" method="POST" style="margin-right: 10px;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini? ')" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                            <a class="btn btn-info" href="/qrcode/{{ $mesin->type_mesin }}" style="display: inline-block; padding: 5px; background-color: #ECEE81; margin-left: -6px; ">
                                <img src="{{ asset('assets/icon/qrcode-solid.svg') }}" alt="Lihat" style="width: 34px; height: 27px;">
                            </a>
                        </div>
                    </td>
                    -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="importFile">Choose file</label>
                            <input type="file" name="file" class="form-control-file" id="importFile">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "order": [
                    [1, 'asc']
                ], // Mengurutkan kolom No.Registrasi secara default
                "searching": true // Mengaktifkan pencarian
            });
        });
    </script>


    <style>
        /* Custom styles for all modals */
        .modal {
            background: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background-color: #007bff;
            color: #ffffff;
            border-bottom: 1px solid #dee2e6;
        }

        .modal-title {
            font-weight: bold;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            border-top: 1px solid #dee2e6;
            padding: 15px;
        }

        .close {
            font-size: 1.5rem;
            font-weight: bold;
            line-height: 1;
            color: #00000;
            opacity: 0.75;
        }

        /* Styling for the buttons in the footer */
        .modal-footer .btn {
            margin-right: 10px;
        }




        /* Style for the table */
        .table.table-bordered thead th {
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }

        .table.table-bordered tbody td {
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }

        /* Adjust column widths */
        .table.table-bordered th:nth-child(1),
        .table.table-bordered td:nth-child(1) {
            width: 10%;
        }

        .table.table-bordered th:nth-child(2),
        .table.table-bordered td:nth-child(2) {
            width: 10%;
        }

        .table.table-bordered th:nth-child(3),
        .table.table-bordered td:nth-child(3) {
            width: 15%;
        }

        .table.table-bordered th:nth-child(4),
        .table.table-bordered td:nth-child(4) {
            width: 8%;
        }

        .table.table-bordered th:nth-child(5),
        .table.table-bordered td:nth-child(5) {
            width: 10%;
        }

        .table.table-bordered th:nth-child(6),
        .table.table-bordered td:nth-child(6) {
            width: 12%;
        }

        .table.table-bordered th:nth-child(7),
        .table.table-bordered td:nth-child(7) {
            width: 10%;
        }

        .table.table-bordered th:nth-child(8),
        .table.table-bordered td:nth-child(8) {
            width: 5%;
        }

        .table.table-bordered th:nth-child(9),
        .table.table-bordered td:nth-child(9) {
            width: 5%;
        }

        .table.table-bordered th:nth-child(10),
        .table.table-bordered td:nth-child(10) {
            width: 10%;
        }
    </style>
    @include('sweetalert::alert')
    @endsection