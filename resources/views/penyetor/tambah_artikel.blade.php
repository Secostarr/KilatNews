<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
</head>

<body>
    <div class="container my-5 card p-3">
    <div class="d-flex align-items-center mb-3">
            <a href="{{ Route('contributor.dashboard') }}" class="btn btn-outline-secondary me-3">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="m-0">Tambah Artikel Contributor</h2>
        </div>
        <hr class="my-4">
        <form action="{{ route('contributor.dashboard.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Artikel</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}">
                        @error('judul')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
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
                    <div class="mb-3">
                        <label for="tags" class="form-label">Tag</label>
                        <select class="form-select" id="tags" name="id_tag">
                            <option value="" selected disabled>Pilih Tag</option>
                            @foreach($tags as $tag)
                            <option value="{{ $tag->id_tag }}">{{ $tag->nama_tag }}</option>
                            @endforeach
                        </select>
                        @error('id_tag')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status_publikasi" class="form-label">Status Publikasi</label>
                        <input type="text" class="form-control" id="status_publikasi" name="status_publikasi" value="published" disabled>
                    </div>
                </div>
                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="media_utama" class="form-label">Media Utama</label>
                        <input type="file" class="form-control" id="media_utama" name="media_utama">
                        @error('media_utama')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_publikasi" class="form-label">Tanggal Publikasi</label>
                        <input type="date" class="form-control" id="tanggal_publikasi" name="tanggal_publikasi" value="{{ old('tanggal_publikasi') }}">
                        @error('tanggal_publikasi')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="highlight" class="form-label">Highlight Berita</label>
                        <select class="form-select" id="highlight" name="highlight">
                            <option value="true">Iya</option>
                            <option value="false">Tidak</option>
                        </select>
                        @error('highlight')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
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
                </div>
            </div>
            <!-- Konten -->
            <div class="mb-4">
                <label for="konten" class="form-label">Konten</label>
                <textarea class="form-control" id="summernote" name="konten">{{ old('konten') }}</textarea>
                @error('konten')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Lokasi -->
            <div class="mb-4">
                <label for="lokasi" class="form-label">Lokasi</label>
                <input type="text" class="form-control mb-2" id="lokasi" name="lokasi">
                <div id="map" style="height: 300px;"></div>
                @error('lokasi')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Tombol Simpan -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg w-50">Simpan Artikel</button>
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        $('#summernote').summernote({
            placeholder: 'Masukkan konten berita Anda di sini...',
            tabsize: 2,
            height: 300,
        });

        var map = L.map('map').setView([-6.200000, 106.816666], 10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        var marker;

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            if (marker) map.removeLayer(marker);
            marker = L.marker([lat, lng]).addTo(map);

            $.getJSON(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`, function(data) {
                $('#lokasi').val(data.display_name);
            });
        });
    </script>
</body>

</html>
