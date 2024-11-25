@extends('admin.layouts.app')
@section('title', 'Notifikasi')
@section('content')

<style>
    /* Card styling */
    .notification-card {
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .notification-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    /* Profile picture */
    .profile-picture {
        width: 100px;
        height: 100px;
        object-fit: cover;
        margin-right: 1.5rem;
        border-radius: 5px;
        /* Kotak dengan sudut sedikit melengkung */
    }

    /* Title */
    .notification-title {
        font-weight: bold;
        font-size: 1.2rem;
    }

    /* Button styles */
    .notification-actions button {
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: background-color 0.3s ease, transform 0.2s;
    }

    .notification-actions button:hover {
        transform: scale(1.05);
    }
</style>

<div class="container-fluid pt-2 px-1">
    <div class="row bg-light rounded align-items-center mx-0 p-4">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-2">
                <h3 class="mb-0 text-dark">Halaman Notifikasi Pendaftaran</h3>
            </div>
            <a href="{{ Route('admin.pengguna.notifikasi') }}" class="btn btn-sm btn-danger d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left-circle-fill"></i>
                Kembali
            </a>
        </div>

        <div class="container my-4">
            <!-- Loop through notifications -->
            @foreach($pendaftaran as $item)
            <div class="col-12 mb-3">
                <div class="notification-card d-flex align-items-center">
                    <!-- Profile Picture -->
                    <div>
                        @if ($item->user->foto)
                        <img src="{{ asset('storage/' . $item->user->foto) }}" alt="Foto Profil" class="profile-picture">
                        @else
                        <img src="https://via.placeholder.com/100?text=Foto" alt="Default Foto Profil" class="profile-picture">
                        @endif
                    </div>
                    <!-- Notification Content -->
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="notification-title text-dark">Permohonan Kontributor Baru</span>
                            <span class="text-muted">{{ $item->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="mb-1">User <strong>{{ $item->user->nama }}</strong> telah mendaftar sebagai kontributor artikel.</p>
                        <p class="mb-1">Keterangan: <strong>{{ $item->keterangan }}</strong></p>
                        <p class="mb-1">Nomor Telepon: <strong>{{ $item->no_telfon }}</strong></p>
                        <!-- Action Buttons -->
                        <div class="notification-actions d-flex justify-content-end gap-2 mt-3">
                            <!-- Approve Button -->
                            <form action="{{ route('admin.notifikasi.approve', $item->user->id_user) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm d-flex align-items-center gap-1">
                                    <i class="fas fa-check"></i> Setujui
                                </button>
                            </form>
                            <!-- Reject Button -->
                            <form action="" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-times"></i> Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection