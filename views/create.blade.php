@extends('layout.main')
@section('title'){{'Tambah Mesin'}} @endsection
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2>Tambah Data Mesin</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="/data-mesin" id="myForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="kode_jenis" class="form-label">Nomor</label>
                            <input type="text" name="kode_jenis" class="form-control @error('kode_jenis') is-invalid @enderror" id="kode_jenis" placeholder="Masukkan nama jenis baru.." maxlength="10" readonly value="{{ old('kode_jenis', sprintf('001-%s', old('tahun_mesin'))) }}">
                            @error('kode_jenis')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="nama_mesin" class="form-label">Nama Mesin<span class="text-danger">*</span></label>
                                <input type="text" name="nama_mesin" class="form-control" id="nama_mesin" placeholder="Masukkan Nama Mesin" value="{{ old('nama_mesin') }}" required>
                                @error('nama_mesin')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="kapasitas" class="form-label">Kapasitas</label>
                                <input type="text" name="kapasitas" class="form-control" id="kapasitas" placeholder="Masukan Kapasitas Bulanan" value="{{ old('kapasitas') }}">
                                @error('kapasitas')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="nama_kategori" class="form-label">Kategori Mesin<span class="text-danger">*</label>
                                <select id="single-select-field" name="nama_kategori" class="form-control" required>
                                    <option value="">-- Select Kategori --</option>
                                    @foreach ($kategorimesin as $data)
                                    <option value="{{ $data->id }}" data-kode-kategori="{{ $data->kode_kategori }}">{{ $data->nama_kategori }}</option>
                                    </option>
                                    @endforeach
                                </select>
                                @error('nama_kategori')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="klas_mesin" class="form-label">Klasifikasi Mesin<span class="text-danger">*</label>
                                <select id="single-select-field2" name="klas_mesin" class="form-control" required>
                                    <option value="">-- Select Klasifikasi --</option>
                                </select>
                                @error('nama_klasifikasi')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="type_mesin" class="form-label">Type<span class="text-danger">*</span></label>
                                <input type="text" name="type_mesin" class="form-control" id="type_mesin" placeholder="Masukan Type mesin" value="{{ old('type_mesin') }}" required>
                                @error('type_mesin')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="merk_mesin" class="form-label">Merk<span class="text-danger">*</span></label>
                                <input type="text" name="merk_mesin" class="form-control" id="merk_mesin" placeholder="Masukan Merk Mesin" value="{{ old('merk_mesin') }}" required>
                                @error('merk_mesin')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="spek_mesin" class="form-label">Spesifikasi:<span class="text-danger">*</label>
                            <div class="col">
                                <label class="text-primary" for="spek_min">Min.</label>
                                <input type="text" name="spek_min" class="form-control" id="spek_min" placeholder="Masukan Minimal" value="{{ old('spek_min') }}" required>
                                @error('spek_min')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label class="text-primary" for="spek_max">Max.</label>
                                <input type="text" name="spek_max" class="form-control" id="spek_max" placeholder="Masukan maximal" value="{{ old('spek_max') }}">
                                @error('spek_max')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="pabrik" class="form-label">Pabrikan<span class="text-danger">*</label>
                                <input type="text" name="pabrik" class="form-control" id="pabrik" placeholder="Masukan Negara Pembuat" value="{{ old('pabrik') }}" required>
                                @error('pabrik')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="tahun_mesin" class="form-label">Tahun Mesin<span class="text-danger">*</label>
                                <input type="text" name="tahun_mesin" class="form-control" id="tahun_mesin" placeholder="Masukan Tahun" value="{{ old('tahun_mesin') }}" required>
                                @error('tahun_mesin')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="lok_ws" class="form-label">Lokasi,<span class="text-danger">*</span></label>
                                <select class="form-select" name="lok_ws" data-placeholder="Silahkan Pilih" id="single-select-field3" required>
                                    <option value="" selected disabled>-- Pilih Lokasi Terdaftar --</option>
                                    @foreach ($workshop as $kategori)
                                    <option value="{{ $kategori->nama_workshop }}">{{ $kategori->nama_workshop }}</option>
                                    @endforeach
                                </select>
                                @error('lok_ws')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="gambar_mesin" class="form-label">Gambar Mesin</label>
                                <input type="file" name="gambar_mesin" class="form-control" id="gambar_mesin" placeholder="Masukan Gambar mesin">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-success" href="/mesin-mesin">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#single-select-field').select2();
        $('#single-select-field2').select2();
        $('#single-select-field3').select2({
            matcher: function(params, data) {
                // Jika pencarian kosong, tampilkan semua opsi
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Ubah teks opsi dan kata kunci pencarian ke huruf kecil untuk pencarian yang tidak bersifat case-sensitive
                var text = data.text.toLowerCase();
                var term = params.term.toLowerCase();

                // Cek apakah dua huruf dari kata kunci muncul dalam teks opsi secara berurutan
                var termChars = term.split('');
                var termLength = termChars.length;
                var lastMatchedIndex = -1;

                for (var i = 0; i < termLength; i++) {
                    var char = termChars[i];
                    var indexInText = text.indexOf(char, lastMatchedIndex + 1);

                    if (indexInText === -1) {
                        return null; // Jika satu huruf tidak ditemukan, kembalikan null
                    }

                    lastMatchedIndex = indexInText;
                }

                // Jika semua huruf ditemukan secara berurutan, kembalikan data
                return data;
            }
        });


        $('#single-select-field').on('change', function() {
            var idCountry = this.value;
            var kodeKategori = $(this).find(':selected').attr('data-kode-kategori');

            $("#single-select-field2").html('');

            $.ajax({
                url: "{{url('api/getklasmesin')}}",
                type: "POST",
                data: {
                    kategorimesin_id: idCountry,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#single-select-field2').html('<option value="">-- Select Klasifikasi --</option>');
                    $.each(result.klasmesin, function(key, value) {
                        // Pastikan atribut data-kode-klasifikasi ada dan terisi dengan benar
                        var kodeKlasifikasi = value.kode_klasifikasi ? value.kode_klasifikasi : '';

                        $("#single-select-field2").append('<option value="' + value.id + '" data-kode-klasifikasi="' + kodeKlasifikasi + '">' + value.nama_klasifikasi + '</option>');
                    });

                    // Panggil fungsi getLatestID saat dropdown klasifikasi berubah
                    getLatestID();
                }
            });
        });

        // Panggil fungsi getLatestID saat dropdown klasifikasi berubah
        $('#single-select-field2').on('change', function() {
            getLatestID();
        });

        function getLatestID(selectedKategoriId, selectedKlasifikasiId) {
            $.ajax({
                url: "/get-latest-id/" + selectedKategoriId + "/" + selectedKlasifikasiId,
                method: "GET",
                success: function(response) {
                    var latestID = response.latestID;
                    updateKodeJenis(latestID);
                },
                error: function(xhr, status, error) {
                    console.error('Gagal mengambil ID terbaru: ' + error);
                }
            });
        }

        function updateKodeJenis(latestID) {
            var selectedKategori = $('#single-select-field');
            var selectedKlasifikasi = $('#single-select-field2');
            var tahunMesin = $('#tahun_mesin').val();

            var kodeKategori = selectedKategori.find(':selected').attr('data-kode-kategori');
            var kodeKlasifikasi = selectedKlasifikasi.find(':selected').attr('data-kode-klasifikasi');

            // Format kodeJenis sesuai kebutuhan Anda
            // var nomorUrut = ('000' + latestID).slice(-3);
            var kodeJenis = kodeKategori + ' - ' + kodeKlasifikasi + ' - ' + ' - ' + tahunMesin;
            $('#kode_jenis').val(kodeJenis);


            // Format kodeJenis sesuai kebutuhan Anda
            $.ajax({
                url: "/get-latest-mesin/" + selectedKategori.val() + "/" + selectedKlasifikasi.val() + "/" + tahunMesin,
                method: "GET",
                success: function(response) {

                    if (response.latest == '') {
                        // var nomorUrut = ('000' + latestID).slice(-3);
                        var kodeJenis = kodeKategori + ' - ' + kodeKlasifikasi + ' - ' + '001' + ' - ' + tahunMesin;
                        $('#kode_jenis').val(kodeJenis);
                    } else {
                        console.log('====================================');
                        console.log(response.latest);
                        console.log('====================================');

                        var inputString = response.latest;
                        var nextNomorUrut = incrementNomorUrut(inputString);

                        // Membuat string baru dengan nomor urut yang telah diincrement
                        var newString = inputString.replace(/(\d{3})/, nextNomorUrut);

                        var kodeJenis = kodeKategori + ' - ' + kodeKlasifikasi + ' - ' + nextNomorUrut + ' - ' + tahunMesin;
                        $('#kode_jenis').val(kodeJenis);

                        // console.log(kodeJenis)

                        // $('#kode_jenis').val(kodeJenis);

                    }
                },
                error: function(xhr, status, error) {
                    console.error('Gagal mengambil ID terbaru: ' + error);
                }
            });
        }

        function incrementNomorUrut(inputString) {
            // Memotong string untuk mendapatkan nomor urut
            var nomorUrutString = inputString.split('-')[2].trim();

            // Mengonversi string menjadi bilangan bulat
            var nomorUrutInt = parseInt(nomorUrutString, 10);

            // Menambahkan 1
            var nextNomorUrutInt = nomorUrutInt + 1;

            // Format nomor urut menjadi string dengan panjang 3 karakter
            var nextNomorUrutString = ('000' + nextNomorUrutInt).slice(-3);

            return nextNomorUrutString;
        }


        // Panggil fungsi saat input "tahun_mesin" berubah
        $('#tahun_mesin').on('input', function() {
            updateKodeJenis();
        });

        // Panggil fungsi saat dropdown kategori berubah
        $('#single-select-field').on('change', function() {
            getLatestID();
        });

        // Panggil fungsi saat halaman dimuat untuk menginisialisasi nilai "kode_jenis"
        window.addEventListener('load', function() {
            getLatestID();
        });
    });
</script>

@endsection