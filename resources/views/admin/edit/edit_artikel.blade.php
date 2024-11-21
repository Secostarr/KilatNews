@extends('admin.layouts.app')
@section('title', 'Edit Artikel')

@section('content')

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form action="{{ Route('admin.artikel.berita.update', ['id_artikel' => $artikel->id_artikel]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="judul" class="form-label">Judul Artikel</label>
                            <input type="text" class="form-control" value="{{ old('judul', $artikel->judul) }}" id="judul" name="judul">
                            @error('judul')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="konten" class="form-label">Konten</label>
                            <textarea class="form-control" id="summernote" name="konten">{{ old('konten', $artikel->konten) }}</textarea>
                            @error('konten')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <script>
                            $('#summernote').summernote({
                                placeholder: 'Masukkan konten berita anda di sini',
                                tabsize: 2,
                                height: 300,
                                toolbar: [
                                    ['style', ['style']],
                                    ['font', ['bold', 'underline', 'clear']],
                                    ['color', ['color']],
                                    ['para', ['ul', 'ol', 'paragraph']],
                                    ['table', ['table']],
                                    ['insert', ['link', 'picture', 'video']],
                                    ['view', ['fullscreen', 'codeview', 'help']]
                                ]
                            });
                        </script>

                        <div class="form-group mb-3">
                            <label for="tanggal_publikasi" class="form-label">Tanggal Publikasi</label>
                            <input type="date" class="form-control"
                                id="tanggal_publikasi"
                                value="{{ old('tanggal_publikasi', $artikel->tanggal_publikasi ? \Illuminate\Support\Carbon::parse($artikel->tanggal_publikasi)->format('Y-m-d') : '') }}"
                                name="tanggal_publikasi">
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
                        <div class="mb-2">
                            <img src="{{ asset('storage/' .$artikel->media_utama) }}" alt="" height="180">
                        </div>

                        <div class="d-flex flex-column gap-2">
                            <h5>Status Publikasi</h5>

                            <div class="d-flex gap-3">
                                @foreach(['published', 'draft', 'archived'] as $status)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="{{ $status }}" name="status_publikasi" value="{{ $status }}" onclick="onlyOne(this)" {{ old('status_publikasi') === $status ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $status }}">{{ ucfirst($status) }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex flex-column mt-0">
                            <h5>Highlight Berita</h5>
                            <div class="d-flex gap-3">
                                <!-- Opsi "Iya" -->
                                <div class="form-group form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="highlightTrue" name="highlight" value="true" onclick="onlyOne(this)">
                                    <label class="form-check-label" for="highlightTrue">Iya</label>
                                    @error('highlight')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Opsi "Tidak" -->
                                <div class="form-group form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="highlightFalse" name="highlight" value="false" onclick="onlyOne(this)">
                                    <label class="form-check-label" for="highlightFalse">Tidak</label>
                                    @error('highlight')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="trending" class="form-label">Status Trending</label>
                            <select class="form-select" id="trending" name="trending">
                            <option value="" selected disabled>Pilih Trending</option>
                                <option value="true">Trending</option>
                                <option value="false">Tidak Trending</option>
                            </select>
                            @error('trending')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>  

                        <div class="form-group mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="id_kategori">
                                <option value="" selected disabled>Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tag" class="form-label">tag</label>
                            <select class="form-select" id="tag" name="id_tag">
                                <option value="" selected disabled>Pilih tag</option>
                                @foreach($tags as $tag)
                                <option value="{{ $tag->id_tag }}">{{ $tag->nama_tag }}</option>
                                @endforeach
                            </select>
                            @error('id_tag')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
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
                            <a href="{{ Route('admin.artikel.berita') }}" class="btn btn-danger">Kembali</a>
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
        const checkboxes = document.querySelectorAll(input[name="${checkbox.name}"]);
        checkboxes.forEach((cb) => {
            if (cb !== checkbox) cb.checked = false;
        });
    }
</script>

@endsection