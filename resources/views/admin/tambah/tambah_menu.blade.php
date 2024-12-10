@extends('admin.layouts.app')
@section('title', 'Tambah - Menu')
@section('content')

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-center">
                    <h4 class="text-light">Menu Management</h4>
                </div>

                <div class="p-3">
                    <!-- Tombol Awal -->
                    <div id="initial-buttons" class="text-center my-4">
                        <button class="btn btn-success" onclick="showForm('tambah-menu')">Tambah Menu Utama</button>
                        <div class="p-2 mt-3">
                            <button class="btn btn-success mx-2" onclick="showForm('tambah-submenu')">Tambah SubMenu</button>
                        </div>
                        <div class="mt-3">
                            <a href="{{ Route('admin.artikel.menu') }}" class="btn btn-danger mx-2">Kembali</a>
                        </div>
                    </div>

                    <!-- Form Tambah Data Menu -->
                    <div id="tambah-menu" class="d-none">
                        <h3>Tambah Menu</h3>
                        <form action="{{ route('admin.artikel.menu.store') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Tambah nama menu</label>
                                <input type="text" class="form-control" id="name" name="name">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="url" class="form-label">Tambah URL Menu</label>
                                <input type="text" class="form-control" id="url" name="url">
                                <small class="text-muted">Jika menu ini sebagai submenu, kolom ini dapat dikosongkan.</small>
                                @error('url')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="order" class="form-label">Urutan</label>
                                <input type="text" class="form-control" id="order" name="order">
                                @error('order')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-danger" onclick="goBack()">Kembali</button>
                            </div>
                        </form>
                    </div>

                    <!--  Form Tambah SubMenu -->
                    <div id="tambah-submenu" class="d-none">
                        <h3>Tambah SubMenu</h3>
                        <form action="{{ route('admin.artikel.submenu.store') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Nama Submenu</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama submenu">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="url" class="form-label">URL Submenu</label>
                                <input type="text" class="form-control" id="url" name="url" placeholder="Masukkan URL submenu">
                                @error('url')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="id_parent" class="form-label">Menu Utama</label>
                                <select class="form-select" id="id_parent" name="id_parent" required>
                                    <option value="" disabled selected>Pilih Menu Utama</option>
                                    <!-- Loop hanya menampilkan menu utama -->
                                    @foreach($menus as $menu)
                                    @if(empty($menu->url)) <!-- Kondisi untuk memastikan URL kosong -->
                                    <option value="{{ $menu->id_menu }}">{{ $menu->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('id_parent')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mt-3">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-danger" onclick="goBack()">Kembali</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function showForm(formId) {
        // Sembunyikan semua form
        document.getElementById('tambah-menu').classList.add('d-none');
        document.getElementById('tambah-submenu').classList.add('d-none');
        document.getElementById('initial-buttons').classList.add('d-none');

        // Tampilkan form yang dipilih
        document.getElementById(formId).classList.remove('d-none');
    }

    function goBack() {
        // Sembunyikan semua form
        document.getElementById('tambah-menu').classList.add('d-none');
        document.getElementById('tambah-submenu').classList.add('d-none');

        // Tampilkan tombol awal
        document.getElementById('initial-buttons').classList.remove('d-none');
    }
</script>

@endsection