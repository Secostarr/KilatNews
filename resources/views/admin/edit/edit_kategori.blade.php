@extends('admin.layouts.app')
@section('title', 'Edit - Kategori')
@section('content')

<div class="container my-4">
    <div class="row justify-content-center">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="col-xl-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Edit Kategori</h4>
                </div>
                <div class="p-3">
                    <form action="{{ route('admin.artikel.kategori.update', ['id_kategori' => $kategori->id_kategori]) }}" method="post" enctype="multipart/form-data">
                        @csrf <!-- Token CSRF untuk keamanan -->
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" name="nama_kategori">
                            @error('nama_kategori')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Kategori</label>
                            <textarea class="form-control" id="" name="konten">{{ old('deskirpsi', $kategori->deskripsi) }}</textarea>
                            @error('konten')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="urutan" class="form-label">Urutan Kategori</label>
                            <div class="col-2">
                                <input type="number" class="form-control" id="urutan" value="{{ old('urutan', $kategori->urutan) }}" name="urutan">
                            </div>
                            @error('urutan')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @endsection