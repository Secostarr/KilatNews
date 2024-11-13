@extends('admin.layouts.app')
@section('title', 'Tambah Artikel')

@section('content')

<div class="row g-4">
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <h6 class="mb-4">Tambah Artikel</h6>
            <form action="{{ route('admin.artikel.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="judul_artikel" class="form-label">Judul Artikel</label>
                    <input type="text" class="form-control" id="judul_artikel" name="judul_artikel">
                    <div class="text-danger">
                        @error('judul_artikel')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="konten" class="form-label">Konten</label>
                    <input type="text" class="form-control" id="konten" name="konten">
                    <div class="text-danger">
                        @error('konten')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tanggal_publikasi" class="form-label">Tanggal Publikasi</label>
                    <input type="date_time" class="form-control" id="tanggal_publikasi" name="tanggal_publikasi">
                    <div class="text-danger">
                        @error('tanggal_publikasi')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="media_utama" class="form-label">Media Utama</label>
                    <input type="text" class="form-control" id="media_utama" name="media_utama">
                    <div class="text-danger">
                        @error('media_utama')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="status_publikasi" class="form-label">Status Publikasi</label>
                    <input type="text" class="form-control" id="status_publikasi" name="status_publikasi">
                    <div class="text-danger">
                        @error('status_publikasi')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="highlight" class="form-label">Hightlight</label>
                    <input type="file" class="form-control" id="highlight" name="highlight">
                    <div class="text-danger">
                        @error('highlight')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="file" class="form-control" id="lokasi" name="lokasi">
                    <div class="text-danger">
                        @error('lokasi')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="viewer_count" class="form-label">Viewer Count</label>
                    <input type="file" class="form-control" id="viewer_count" name="viewer_count">
                    <div class="text-danger">
                        @error('viewer_count')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="trending" class="form-label">Trending</label>
                    <input type="text" class="form-control" id="trending" name="trending">
                    <div class="text-danger">
                        @error('trending')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="" id=""></select>
                    <div class="text-danger">
                        @error('kategori')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>               
</div>

@endsection