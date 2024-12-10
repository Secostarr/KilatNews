@extends('admin.layouts.app')
@section('title', 'Menu')
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

    .search-icon {
        cursor: pointer;
        font-size: 20px;
        color: #333;
        transition: transform 0.4s;
    }

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
                <h3 class="mb-0 text-dark">Management Menu</h3>
            </div>

            <a href="{{ Route('admin.artikel.menu.create') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-2">
                <i class="fas fa-plus"></i> Tambah Menu
            </a>
        </div>

        <div class="container my-4 d-flex justify-content-between align-items-center">
            <div>
                <button id="show-main-menu" class="btn btn-outline-primary">Menu Utama</button>
                <button id="show-submenu" class="btn btn-outline-secondary">Submenu</button>
            </div>
            <div class="search-container" onclick="activateSearch()">
                <input type="text" id="search-input" class="form-control search-input" placeholder="Cari...">
                <i class="fas fa-search search-icon"></i>
            </div>
        </div>

        <div class="container my-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Daftar Menu</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered table-striped" id="kategori">
                        <thead class="table-light">
                            <tr>
                                <th width="10">No</th>
                                <th>Nama Menu</th>
                                <th>URL Menu</th>
                                <th>id_parent Menu</th>
                                <th>Order Menu</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody id="menu-table-body">
                            @foreach ($menus as $menu)
                            <tr data-type="{{ $menu->id_parent ? 'submenu' : 'main-menu' }}">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->url }}</td>
                                <td>{{ $menu->id_parent ?? '-' }}</td>
                                <td>{{ $menu->order }}</td>
                                <td class="d-flex">
                                    <a href="" class="btn btn-outline-warning btn-sm me-1 shadow-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form id="delete-form-{{ $menu->id }}" action="" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $menu->id }})" class="btn btn-outline-danger btn-sm shadow-sm">
                                            <i class="fas fa-trash"></i> Hapus
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

        // Show/Hide menus based on button click
        $('#show-main-menu').click(function() {
            $('tr[data-type="submenu"]').hide();
            $('tr[data-type="main-menu"]').show();
        });

        $('#show-submenu').click(function() {
            $('tr[data-type="main-menu"]').hide();
            $('tr[data-type="submenu"]').show();
        });
    });

    function confirmDelete(id) {
        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

@endsection