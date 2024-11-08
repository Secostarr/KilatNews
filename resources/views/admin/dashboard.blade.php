@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')

<style>
    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    .shadow-sm {
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    <div class="row bg-light rounded mx-0 shadow-sm">
        <div class="col-12 d-flex justify-content-center align-items-center p-4">
            <p class="fw-bold fs-5 mb-0 text-center">Hi {{ $user->nama }}, Selamat Datang Di Dashboard KilatNews</p>
        </div>
    </div>

    <!-- Card for Views, Likes, and Comments -->
    <div class="row mt-4">
        <!-- Total Views -->
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card text-white text-center p-4 shadow border-0 bg-info card-hover">
                <h5><i class="fas fa-eye me-2"></i>Total Views</h5>
                <h2 class="mt-2">0</h2>
            </div>
        </div>

        <!-- Total Likes -->
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card text-white text-center p-4 shadow border-0 bg-success card-hover">
                <h5><i class="fas fa-thumbs-up me-2"></i>Total Likes</h5>
                <h2 class="mt-2">0</h2>
            </div>
        </div>

        <!-- Total Comments -->
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card text-white text-center p-4 shadow border-0 bg-warning card-hover">
                <h5><i class="fas fa-comments me-2"></i>Total Comments</h5>
                <h2 class="mt-2">0</h2>
            </div>
        </div>
    </div>
</div>
<!-- Blank End -->

@endsection