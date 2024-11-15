@extends('admin.layouts.app')
@section('title', 'Tambah - Kategori')
@section('content')

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Tambah Artikel</h4>
                </div>

                <div class="p-3">
                    <form action="" method="post">
                        <div class="form-group mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori">
                            @error('nama_kategori')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="deskripsi" class="form-label">deskripsi Kategori</label>
                            <textarea class="form-control" id="konten" name="konten"></textarea>
                            @error('deskripsi')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="urutan" class="form-label">Urutan Kategori</label>
                            <div class="col-2">
                                <input type="number" class="form-control" id="urutan" name="urutan">
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
</div>

@endsection