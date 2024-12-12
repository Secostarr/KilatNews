@extends('layouts.app')
@section('title', 'Contact')
@section('konten')

<!-- ================ Contact Section Start ================= -->
<section class="contact-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title text-uppercase">Contact Us</h2>
            <p class="section-subtitle">We'd love to hear from you! Reach out to us through any of the channels below.</p>
        </div>
        <div class="row justify-content-center">
            <!-- Contact Info Cards -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <div class="contact-icon mb-3">
                            <i class="ti-home text-primary display-4"></i>
                        </div>
                        <h5 class="card-title">Our Office</h5>
                        <p>{{ $pengaturan->lokasi }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <div class="contact-icon mb-3">
                            <i class="ti-tablet text-primary display-4"></i>
                        </div>
                        <h5 class="card-title">Call Us</h5>
                        <p>{{ $pengaturan->kontak_nomor }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <div class="contact-icon mb-3">
                            <i class="ti-email text-primary display-4"></i>
                        </div>
                        <h5 class="card-title">Email Us</h5>
                        <p>{{ $pengaturan->kontak_email }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional: Map Section -->
        <div class="mt-5">
            <h4 class="text-center mb-4">Find Us Here</h4>
            <div id="map" style="height: 400px; border-radius: 10px; overflow: hidden;"></div>
            <input type="hidden" id="lokasi" class="form-control mt-3" placeholder="Nama lokasi akan muncul di sini" value="{{ $pengaturan->lokasi }}" readonly>
        </div>
    </div>
</section>
<!-- ================ Contact Section End ================= -->
<script>
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

    // Ambil data lokasi dari server melalui API
    $.ajax({
        url: '/api/lokasi', // Endpoint API backend
        method: 'GET',
        success: function(response) {
            if (response && response.lokasi) {
                // Nama lokasi yang diterima dari server
                var lokasi = response.lokasi;

                // Menampilkan nama lokasi di input
                $('#lokasi').val(lokasi);

                // Update peta untuk menunjukkan lokasi
                updateMapWithLocationName(lokasi);
            } else {
                alert("Lokasi tidak ditemukan di database!");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error: ", error);
            console.error("Status: ", status);
            console.error("Response: ", xhr.responseText);
            alert("Gagal mengambil data lokasi dari server!");
        }
    });

    // Fungsi untuk memperbarui peta dengan nama lokasi
    function updateMapWithLocationName(locationName) {
        // Gunakan Nominatim untuk mendapatkan koordinat berdasarkan nama lokasi
        $.getJSON(`https://nominatim.openstreetmap.org/search?format=json&q=${locationName}`, function(data) {
            if (data.length > 0) {
                var lat = parseFloat(data[0].lat);
                var lon = parseFloat(data[0].lon);

                // Pindahkan peta ke lokasi baru
                map.setView([lat, lon], 15); // Update peta dengan koordinat baru

                // Tambahkan atau perbarui marker di lokasi baru
                if (marker) {
                    marker.setLatLng([lat, lon]); // Perbarui marker jika sudah ada
                } else {
                    marker = L.marker([lat, lon]).addTo(map); // Tambahkan marker baru jika belum ada
                }
            } else {
                alert("Lokasi tidak ditemukan di peta!");
            }
        });
    }
</script>
@endsection