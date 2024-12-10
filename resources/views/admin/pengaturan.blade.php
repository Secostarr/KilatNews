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
    <br>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row mt-4">
        <!-- Form untuk Nama Website -->
        <div class="col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Nama Website</h5>
                    <form action="{{ Route('admin.pengaturan.save') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" id="nama_situs" name="nama_situs" value="{{ $pengaturan->nama_situs ?? 'Data belum dimasukkan' }}">
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
                    <form action="{{ Route('admin.pengaturan.save') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="email" class="form-control" id="kontak_email" name="kontak_email" value="{{ $pengaturan->kontak_email ?? 'Data belum dimasukkan' }}">
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
                    <form action="{{ Route('admin.pengaturan.save') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" id="kontak_nomor" name="kontak_nomor" value="{{ $pengaturan->kontak_nomor ?? 'Data belum dimasukkan' }}">
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
                    <form action="{{ Route('admin.pengaturan.save') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input type="file" class="form-control" id="logo" name="logo">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                    <div class="mb-2">
                        <img src="{{ $pengaturan && $pengaturan->logo ? asset('storage/' . $pengaturan->logo) : asset('default-logo.png') }}" alt="Logo" height="80">
                    </div>
                </div>
            </div>
        </div>

        <!-- Form untuk Lokasi -->
        <div class="col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Lokasi</h5>
                    <form action="{{ Route('admin.pengaturan.save') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <textarea class="form-control" id="lokasi" name="lokasi" rows="2">{{ $pengaturan->lokasi ?? 'Data belum dimasukkan' }}</textarea>
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
                    <form action="{{ Route('admin.pengaturan.save') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <textarea class="form-control" id="deskripsi_singkat" name="deskripsi_singkat" rows="2">{{ $pengaturan->deskripsi_singkat ?? 'Data belum dimasukkan' }}</textarea>
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