@extends('admin.layouts.app')
@section('title', 'Pengguna')
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
</style>

<div class="container-fluid pt-2 px-1">
    <div class="row bg-light rounded align-items-center mx-0 p-4">
        <div class="d-flex justify-content-between align-items-center w-100">

            <div class="d-flex align-items-center gap-2">
                <i class="text-primary"></i>
                <h3 class="mb-0 text-dark">PENGGUNA</h3>
            </div>

            <a href="" class="btn btn-sm btn-primary d-flex align-items-center gap-2">
                <i class="fas fa-plus"></i>
                Tambah Pengguna
            </a>
        </div>

        <div class="container my-4 d-flex justify-content-end">
            <div class="search-container" onclick="activateSearch()">
                <input type="text" class="form-control search-input" placeholder="Cari...">
                <i class="fas fa-search search-icon"></i>
            </div>
        </div>

        <div class="comment d-flex mb-4 p-3 shadow-sm rounded">
            <div class="comment-avatar me-3">
                <img src="avatar-placeholder.png" alt="User Avatar" class="rounded-circle">
            </div>
            <div class="comment-content flex-grow-1">
                <div class="comment-header d-flex justify-content-between align-items-center mb-2">
                    <span class="comment-author fw-bold">Nama Pengguna</span>
                    <span class="comment-time text-muted">Role</span>
                </div>
                <p class="comment-text mb-2">Email Pengguna</p>
                <div class="comment-actions">
                    <button class="btn btn-success btn-sm me-2"><i class="fas fa-check"></i> Balas</button>
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                </div>
            </div>
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