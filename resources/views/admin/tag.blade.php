@extends('admin.layouts.app')
@section('title', 'Tag')
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
        <div class="d-flex justify-content-between align-items-center w-100">

            <div class="d-flex align-items-center gap-2">
                <i class="text-primary"></i>
                <h3 class="mb-0 text-dark">TAG</h3>
            </div>

            <a href="{{ Route('admin.artikel.tag.create') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-2">
                <i class="fas fa-plus"></i>
                Tambah Tag
            </a>
        </div>

        <div class="container my-4 d-flex justify-content-end">
            <div class="search-container" onclick="activateSearch()">
                <input type="text" id="search-input" class="form-control search-input" placeholder="Cari...">
                <i class="fas fa-search search-icon"></i>
            </div>
        </div>

        <span class="border border-3 p-3">
        <table class="table table-striped" id="tag">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tag</th>
                    <th>Deskripsi</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>kulo</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>sampean</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        </span>
    </div>
</div>

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
    $('#tag').DataTable({
        dom:'lrtip' 
    });

    $('#search-input').on('keyup', function(){
        $('#tag').DataTable().search(this.value).draw();
        });
    });
</script>

@endsection