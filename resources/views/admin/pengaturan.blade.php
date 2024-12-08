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

    <form action="#" method="post" class="mt-4">
        @csrf
        
        <!-- Input 1 -->
        <div class="mb-3">
            <label for="app_name" class="form-label">Nama Aplikasi</label>
            <input type="text" class="form-control" id="app_name" name="app_name" placeholder="Masukkan nama aplikasi">
        </div>

        <!-- Input 2 -->
        <div class="mb-3">
            <label for="admin_email" class="form-label">Email Admin</label>
            <input type="email" class="form-control" id="admin_email" name="admin_email" placeholder="Masukkan email admin">
        </div>

        <!-- Input 3 -->
        <div class="mb-3">
            <label for="site_mode" class="form-label">Mode Situs</label>
            <select class="form-select" id="site_mode" name="site_mode">
                <option value="live">Live</option>
                <option value="maintenance">Maintenance</option>
            </select>
        </div>

        <!-- Input 4 -->
        <div class="mb-3">
            <label for="contact_number" class="form-label">Nomor Kontak</label>
            <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Masukkan nomor kontak">
        </div>

        <!-- Input 5 -->
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea class="form-control" id="address" name="address" rows="2" placeholder="Masukkan alamat"></textarea>
        </div>

        <!-- Input 6 -->
        <div class="mb-3">
            <label for="timezone" class="form-label">Zona Waktu</label>
            <select class="form-select" id="timezone" name="timezone">
                <option value="UTC">UTC</option>
                <option value="Asia/Jakarta">Asia/Jakarta</option>
                <option value="Asia/Makassar">Asia/Makassar</option>
                <option value="Asia/Jayapura">Asia/Jayapura</option>
            </select>
        </div>

        <!-- Input 7 -->
        <div class="mb-3">
            <label for="logo_upload" class="form-label">Upload Logo</label>
            <input type="file" class="form-control" id="logo_upload" name="logo_upload">
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
        </div>
    </form>

@endsection
