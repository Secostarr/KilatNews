@extends('admin.layouts.app')
@section('title', 'Pengaturan')
@section('content')

<div class="container-fluid pt-2 px-1">
    <div class="row bg-light rounded align-items-center mx-0 p-4">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-2">
                <i class="text-primary fas fa-cog"></i>
                <h3 class="mb-0 text-dark">Pengaturan</h3>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Form untuk Nama Website -->
        <div class="col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Nama Website</h5>
                    <form action="#" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" id="app_name" name="app_name" placeholder="Masukkan nama website">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Form untuk Kontak Email -->
        <div class="col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Kontak Email</h5>
                    <form action="#" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="email" class="form-control" id="admin_email" name="admin_email" placeholder="Masukkan kontak email">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Form untuk Nomor Kontak -->
        <div class="col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Nomor Kontak</h5>
                    <form action="#" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Masukkan nomor kontak">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Form untuk Upload Logo -->
        <div class="col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Upload Logo</h5>
                    <form action="#" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input type="file" class="form-control" id="logo_upload" name="logo_upload">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Form untuk Lokasi -->
        <div class="col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Lokasi</h5>
                    <form action="#" method="post">
                        @csrf
                        <div class="input-group">
                            <textarea class="form-control" id="address" name="address" rows="2" placeholder="Masukkan lokasi"></textarea>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Form untuk Deskripsi -->
        <div class="col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Deskripsi</h5>
                    <form action="#" method="post">
                        @csrf
                        <div class="input-group">
                            <textarea class="form-control" id="description" name="description" rows="2" placeholder="Masukkan deskripsi singkat"></textarea>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
