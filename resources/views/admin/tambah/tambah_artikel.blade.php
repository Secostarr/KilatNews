@extends('admin.layouts.app')
@section('title', 'Tambah Artikel')

@section('content')

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Tambah Artikel</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="judul_artikel" class="form-label">Judul Artikel</label>
                            <input type="text" class="form-control" id="judul_artikel" name="judul">
                            @error('judul')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="konten" class="form-label">Konten</label>
                            <textarea class="form-control" id="konten" name="konten"></textarea>
                            @error('konten')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_publikasi" class="form-label">Tanggal Publikasi</label>
                            <input type="datetime-local" class="form-control" id="tanggal_publikasi" name="tanggal_publikasi">
                            @error('tanggal_publikasi')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="media_utama" class="form-label">Media Utama</label>
                            <input type="file" class="form-control" id="media_utama" name="media_utama">
                            @error('media_utama')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="status_publikasi" class="form-label">Status Publikasi</label>
                            <select class="form-select" id="status_publikasi" name="status_publikasi">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                            @error('status_publikasi')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex flex-column gap-2">
                            <h5>Pilih Salah Satu</h5>

                            <div class="d-flex gap-3">
                                <div class="d-flex gap-3">
                                    <div class="form-group form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="highlight" name="highlight" value="1" onclick="onlyOne(this)">
                                        <label class="form-check-label" for="highlight">Published</label>
                                        @error('highlight')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="trending" name="trending" value="1" onclick="onlyOne(this)">
                                        <label class="form-check-label" for="trending">Draft</label>
                                        @error('trending')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="archived" name="archived" value="1" onclick="onlyOne(this)">
                                        <label class="form-check-label" for="archived">Archived</label>
                                        @error('archived')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" id="kategori" name="id_kategori">

                                </select>

                            </div>

                            <div class="form-group mb-3">
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi">
                                <div id="map" style="height: 400px;"></div>
                                @error('lokasi')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Summernote Integration -->
<link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#konten').summernote({
            height: 300,
            placeholder: 'Tuliskan konten artikel di sini...',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
    });

    // Inisialisasi Leaflet Map
    var map = L.map('map').setView([-6.200000, 106.816666], 10); // Jakarta sebagai default

    // Tambahkan tile dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    var marker;

    // Fungsi untuk mendapatkan nama lokasi dari koordinat
    function getLocationName(lat, lng) {
        $.getJSON(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`, function(data) {
            $('#lokasi').val(data.display_name); // Menampilkan nama lokasi pada input "lokasi"
        });
    }

    // Event listener saat peta diklik
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([lat, lng]).addTo(map);
        getLocationName(lat, lng); // Mengambil nama lokasi berdasarkan koordinat
    });

    function onlyOne(checkbox) {
        const checkboxes = document.querySelectorAll('.form-check-input');
        checkboxes.forEach((cb) => {
            if (cb !== checkbox) cb.checked = false;
        });
    }
</script>

@endsection