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

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center w-100">

            <div class="d-flex align-items-center gap-2">
                <i class="text-primary"></i>
                <h3 class="mb-0 text-dark">ARTIKEL</h3>
            </div>

            <a href="{{ Route('admin.artikel.berita.create') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-2">
                <i class="fas fa-plus"></i>
                Tambah Artikel
            </a>
        </div>

        <div class="container my-4 d-flex justify-content-end">
            <div class="search-container" onclick="activateSearch()">
                <input type="text" id="search-input" class="form-control search-input" placeholder="Cari...">
                <i class="fas fa-search search-icon"></i>
            </div>
        </div>

        @foreach ($artikels as $artikel)
        <div class="row bg-white shadow-sm rounded p-4 mb-3">
            <div class="col-md-3 col-12 mb-3 mb-md-0 d-flex justify-content-center align-items-center">
                <img src="{{ asset('storage/' . $artikel->media_utama) }}" alt="ini foto" class="img-fluid rounded" style="max-height: 150px; width: auto;">
            </div>
            <div class="col-md-9 col-12">
                <h5 class="fw-bold text-truncate" style="max-width: 100%;">{{ $artikel->judul }}</h5>
                <p class="text-muted text-truncate" style="max-width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {{ $artikel->konten }}
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="" class="bi bi-clipboard btn btn-info btn-sm"> Detail</a>
                    <a href="" class="bi bi-pencil btn btn-warning btn-sm"> Edit</a>
                    <a href="{{ Route('admin.artikel.berita.delete', $artikel->id_artikel) }}" onclick="return confirm('Yakin Ingin Hapus Data Ini?')" class="bi bi-trash btn btn-danger btn-sm"> Hapus</a>
                </div>
            </div>
        </div>
        @endforeach
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

    $(document).ready(function() {
        $('#search-input').on('keyup', function() {
            const table = $('#kategori').DataTable();
            table.search(this.value).draw();
        });
    });
</script>

@endsection