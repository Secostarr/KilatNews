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
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-2">
                <i class="text-primary"></i>
                <h3 class="mb-0 text-dark">PENGGUNA</h3>
            </div>

            <a href="{{ Route('admin.pengguna.user.create') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-2">
                <i class="fas fa-plus"></i>
                Tambah Pengguna
            </a>
        </div>

        <!-- Search Box -->
        <div class="container my-4 d-flex justify-content-end">
            <div class="search-container" onclick="activateSearch()">
                <input type="text" id="search-input" class="form-control search-input" placeholder="Cari...">
                <i class="fas fa-search search-icon"></i>
            </div>
        </div>

        <!-- User List -->
        @foreach ($users as $user)
        <div class="comment d-flex mb-4 p-3 shadow-sm rounded"
            data-nama="{{ strtolower($user->nama) }}"
            data-email="{{ strtolower($user->email) }}">
            <div class="comment-avatar me-3">
                <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('images/profil.jpeg') }}"
                    alt="User Avatar"
                    class="rounded-circle"
                    style="width: 50px; height: 50px; object-fit: cover;">
            </div>
            <div class="comment-content flex-grow-1">
                <div class="comment-header d-flex justify-content-between align-items-center mb-2">
                    <span class="comment-author fw-bold">{{ $user->nama }}</span>
                    <span class="comment-time text-muted">{{ $user->role }}</span>
                </div>
                <p class="comment-text mb-2">{{ $user->email }}</p>
                <div class="comment-actions">
                    <form action="{{ route('admin.pengguna.user.delete', $user->id_user) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                            <i class="fas fa-trash me-2"></i>Hapus Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    /**
     * Activate the search bar by toggling the class
     */
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

    document.getElementById('search-input').addEventListener('input', function() {
        const filter = this.value.toLowerCase(); // Ubah input ke huruf kecil
        const comments = document.querySelectorAll('.comment'); // Semua komentar

        comments.forEach(comment => {
            // Ambil nama dan email dari atribut data
            const nama = comment.getAttribute('data-nama');
            const email = comment.getAttribute('data-email');

            // Periksa apakah nama atau email mengandung teks yang dicari
            if (nama.includes(filter) || email.includes(filter)) {
                comment.style.display = ''; // Tampilkan komentar
            } else {
                comment.style.display = 'none'; // Sembunyikan komentar
            }
        });
    });
</script>

@endsection