@extends('admin.layouts.app')
@section('title', 'Artikel')
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
                <h3 class="mb-0 text-dark">Artikel</h3>
            </div>

            <a href="{{ Route('admin.artikel.create') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-2">
                <i class="fas fa-plus"></i> 
                Tambah Artikel
            </a>
        </div>

        <div class="container my-4 d-flex justify-content-end">
            <div class="search-container" onclick="activateSearch()">
                <input type="text" class="form-control search-input" placeholder="Cari...">
                <i class="fas fa-search search-icon"></i>
            </div>
        </div>

        <div class="row bg-white shadow-sm rounded p-4 mb-3">
            <div class="col-md-3 col-12 mb-3 mb-md-0 d-flex justify-content-center align-items-center">
                <img src="" alt="ini foto" class="img-fluid rounded" style="max-height: 150px; width: auto;">
            </div>
            <div class="col-md-9 col-12">
                <h5 class="fw-bold">Judul Artikel</h5>
                <p class="text-muted">
                    Ringkasan singkat tentang artikel yang menarik ini, yang dapat menarik minat pembaca untuk membaca lebih lanjut.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="" class="bi bi-clipboard btn btn-info btn-sm"> Detail</a>
                    <a href="" class="bi bi-pencil btn btn-warning btn-sm"> Edit</a>
                    <a href="" class="bi bi-trash btn btn-danger btn-sm"> Hapus</a>
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