@extends('admin.layouts.app')
@section('title', 'Kategori')
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
                <h3 class="mb-0 text-dark">Management Tags</h3>
            </div>

            <a href="{{ Route('admin.artikel.tag.create') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-2">
                <i class="fas fa-plus"></i>
                Tambah Tags
            </a>
        </div>

        <div class="container my-4 d-flex justify-content-end">
            <div class="search-container" onclick="activateSearch()">
                <input type="text" id="search-input" class="form-control search-input" placeholder="Cari...">
                <i class="fas fa-search search-icon"></i>
            </div>
        </div>

        <div class="container my-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Daftar Tags</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered table-striped" id="kategori">
                        <thead class="table-light">
                            <tr>
                                <th width="10">No</th>
                                <th>Nama Tag</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $tag->nama_tag }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('admin.artikel.tag.edit', $tag->id_tag) }}" class="btn btn-outline-warning btn-sm me-1 shadow-sm">
                                        <i class="fas fa-edit"></i>Edit</a>
                                        <form action="{{ route('admin.artikel.tag.delete', $tag->id_tag) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Yakin Ingin Hapus Data Ini?')" class="btn btn-outline-danger btn-sm shadow-sm">
                                                <i class="fas fa-trash">Hapus</i> 
                                            </button>
                                        </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

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
        $('#kategori').DataTable({
            dom: 'lrtip'
        });

        $('#search-input').on('keyup', function() {
            $('#kategori').DataTable().search(this.value).draw();
        });
    });

    $(document).ready(function() {
        if (!$.fn.DataTable.isDataTable('#kategori')) {
            $('#kategori').DataTable({
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ditemukan data yang cocok",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data",
                    "infoFiltered": "(difilter dari _MAX_ total data)"
                },
                "pagingType": "full_numbers",
                "columnDefs": [{
                    "orderable": false,
                    "targets": 4
                }]
            });
        }
    });
</script>

@endsection