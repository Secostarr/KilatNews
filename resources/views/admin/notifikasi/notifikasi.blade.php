@extends('admin.layouts.app')
@section('title', 'Notifikasi')
@section('content')

<style>
    /* Styling the search container */
    .search-container {
        display: flex;
        align-items: center;
        position: relative;
        width: 40px;
        transition: width 0.4s;
    }

    /* Search input field */
    .search-input {
        opacity: 0;
        width: 0;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        border: 1px solid #ced4da;
        outline: none;
        transition: width 0.4s, opacity 0.4s;
        position: absolute;
        left: 0;
    }

    /* Search icon */
    .search-icon {
        cursor: pointer;
        font-size: 20px;
        color: #333;
        transition: transform 0.4s;
    }

    /* Active state of input field */
    .search-container.active {
        width: 200px;
    }

    .search-container.active .search-input {
        width: 100%;
        opacity: 1;
    }

    .search-container.active .search-icon {
        transform: translateX(-32px);
    }

    /* Custom button styles */
    .btn-custom {
        font-size: 1rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border-radius: 0.5rem;
        transition: background-color 0.3s ease, transform 0.3s ease;
        padding: 0.75rem 1.25rem;
    }

    .btn-custom-success {
        background-color: #28a745;
        color: #fff;
    }

    .btn-custom-primary {
        background-color: #007bff;
        color: #fff;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        opacity: 0.9;
    }

    .btn-custom i {
        font-size: 1.2rem;
    }
</style>

<div class="container-fluid pt-2 px-1">
    <div class="row bg-light rounded align-items-center mx-0 p-4">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-2">
                <i class="text-primary"></i>
                <h3 class="mb-0 text-dark">NOTIFIKASI</h3>
            </div>

            <div class="container my-4 d-flex justify-content-end">
                <div class="search-container" onclick="activateSearch()">
                    <input type="text" class="form-control search-input" placeholder="Cari...">
                    <i class="fas fa-search search-icon"></i>
                </div>
            </div>
        </div>

        <div class="d-flex gap-5 mt-3">
            <a href="{{ Route('admin.pengguna.notifikasi.pendaftar') }}" class="btn btn-custom btn-custom-success">
                <i class="fas fa-user-check"></i> Notif Konfirmasi Pendaftar
            </a>
        </div>
    </div>
</div>

<script>
    function activateSearch() {
        const container = document.querySelector('.search-container');
        container.classList.toggle('active');

        // Set focus to the input field when activated
        const input = document.querySelector('.search-input');
        if (container.classList.contains('active')) {
            input.focus();
        } else {
            input.blur();
        }
    }
</script>

@endsection
