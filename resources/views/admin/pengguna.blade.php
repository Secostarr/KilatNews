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
        z-index: 1;
        /* Pastikan ikon berada di atas elemen lain */
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

    /* Styling untuk pesan tidak ada data */
    #no-result-message {
        background-color: #d1ecf1;
        border-color: #bee5eb;
        color: #0c5460;
        border-radius: 5px;
        padding: 15px;
        font-size: 16px;
        margin-top: 20px;
    }

    #no-result-message strong {
        font-size: 18px;
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
        </div>

        <!-- Search Box -->
        <div class="container my-4 d-flex justify-content-end">
            <div class="search-container" onclick="activateSearch()">
                <input type="text" id="search-input" class="form-control search-input" placeholder="Cari..." onkeyup="searchUsers()">
                <i class="fas fa-search search-icon"></i>
            </div>
        </div>

        <!-- User List -->
        @foreach ($users as $user)
        @if ($user->role !== 'admin') {{-- Kondisi untuk tidak menampilkan admin --}}
        <div class="comment mb-4 p-3 shadow-sm rounded"
            data-nama="{{ strtolower($user->nama) }}"
            data-role="{{ strtolower($user->role) }}"
            data-email="{{ strtolower($user->email) }}" style="display: flex;">
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
                    <form id="delete-form-{{ $user->id_user }}" action="{{ route('admin.pengguna.user.delete', $user->id_user) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $user->id_user }})">
                            <i class="fas fa-trash me-2"></i>Hapus Pengguna
                        </button>
                    </form>
                    <script>
                        function confirmDelete(id) {
                            Swal.fire({
                                title: "Yakin ingin menghapus?",
                                text: "Data yang dihapus tidak dapat dikembalikan!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Ya, hapus!",
                                cancelButtonText: "Batal"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Submit form jika konfirmasi diterima
                                    document.getElementById('delete-form-' + id).submit();
                                }
                            });
                        }
                    </script>
                </div>
            </div>
        </div>
        @endif
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

    /**
     * Search users based on the input value
     */
    function searchUsers() {
        const input = document.querySelector('#search-input');
        const filter = input.value.toLowerCase();
        const users = document.querySelectorAll('.comment');
        const noResultMessage = document.querySelector('#no-result-message');
        let visibleCount = 0;

        users.forEach(user => {
            const userName = user.getAttribute('data-nama')?.toLowerCase() || ''; // Pastikan data-nama ada
            const userEmail = user.getAttribute('data-email')?.toLowerCase() || ''; // Pastikan data-email ada
            const userRole = user.getAttribute('data-role')?.toLowerCase() || ''; // Pastikan data-role ada

            // Gabungkan atribut untuk pencarian
            const combinedData = `${userName} ${userEmail} ${userRole}`;

            // Lakukan pencarian case-insensitive
            if (combinedData.indexOf(filter.toLowerCase()) > -1) {
                user.style.display = 'flex'; // Tampilkan user
            } else {
                user.style.display = 'none'; // Sembunyikan user
            }
        });


        // Jika tidak ada user yang cocok, tampilkan pesan
        if (visibleCount === 0) {
            if (!noResultMessage) {
                const message = document.createElement('div');
                message.id = 'no-result-message';
                message.className = 'alert alert-info mt-3 text-center';
                message.innerHTML = `
                <strong>Oops!</strong> Kami tidak dapat menemukan hasil yang sesuai. 
                <br> Coba kata kunci lain atau pastikan ejaan benar.
                <br> <em>Menunggu pencarian yang lebih tepat...</em>
            `;
                document.querySelector('.container-fluid').appendChild(message); // Tempatkan pesan di bagian bawah daftar
            }
        } else {
            if (noResultMessage) {
                noResultMessage.remove(); // Sembunyikan pesan jika ada hasil
            }
        }
    }
</script>

@endsection