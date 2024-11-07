@extends('admin.layouts.app')
@section('title', 'Notifikasi')
@section('content')

<style>
    /* Custom styling for notification cards */
    .notification-card {
        background-color: #f9f9f9;
        border: 1px solid #e0e0e0;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
        transition: background-color 0.3s;
    }

    .notification-card:hover {
        background-color: #f1f1f1;
    }

    .notification-actions button {
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        transition: background-color 0.3s ease;
    }
</style>

<div class="container-fluid pt-2 px-1">
    <div class="row bg-light rounded align-items-center mx-0 p-4">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-2">
                <i class="text-primary"></i> 
                <h3 class="mb-0 text-dark">Halaman Notifikasi</h3>
            </div>

            <a href="{{ Route('admin.pengguna.notifikasi') }}" class="btn btn-sm btn-danger d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left-circle-fill"></i> 
                Kembali
            </a>

        </div>

        <div class="container my-4">
            <!-- Example of a notification card -->
            <div class="notification-card">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0 text-dark">Permohonan Kontributor Baru</h5>
                    <span class="text-muted">2 jam yang lalu</span>
                </div>
                <p class="mb-2">User <strong>Nama Pengguna</strong> telah mendaftar sebagai kontributor artikel. Apakah Anda ingin menyetujui pendaftaran ini?</p>
                <div class="notification-actions d-flex justify-content-end gap-2">
                    <button class="btn btn-success btn-sm"><i class="fas fa-check"></i> Setujui</button>
                    <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Tolak</button>
                </div>
            </div>

            <!-- Tambahkan blok notification-card untuk setiap notifikasi baru -->
        </div>
    </div>
</div>

@endsection
