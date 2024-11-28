@extends('admin.layouts.app')
@section('title', 'Tambah - Tag')
@section('content')

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Tambah Tag</h4>
                </div>

                <div class="p-3">
                    <form action="{{ route('admin.artikel.tag.store') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nama_tag" class="form-label">Tambah Urutan Tag</label>
                            <div class="col-4">
                                <input type="text" class="form-control" id="nama_tag" name="nama_tag">
                            </div>
                            @error('nama_tag')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('admin.artikel.tag') }}" class="btn btn-danger">Kembali</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection