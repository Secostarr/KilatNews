@extends('admin.layouts.app')
@section('title', 'Dashboard')
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

    <div class="col-12 col-6 mt-4">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4"><i class="bi bi-graph-up me-2 btn btn-primary btn-sm"></i>Statistik KilatNews</h6>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true"><i class="bi bi-eye-fill me-2"></i>Views</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab"
                        aria-controls="pills-profile" aria-selected="false"><i class="bi bi-hand-thumbs-up-fill me-2"></i>Likes</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-contact" type="button" role="tab"
                        aria-controls="pills-contact" aria-selected="false"><i class="bi bi-chat-square-text-fill me-2"></i>Comments</button>
                </li>
            </ul>

            <div class="container my-4 d-flex justify-content-end">
                <div class="search-container" onclick="activateSearch()">
                    <input type="text" id="search-input" class="form-control search-input" placeholder="Cari...">
                    <i class="fas fa-search search-icon"></i>
                </div>
            </div>


            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="table-responsive">
                        <table class="table" id="views">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">ZIP</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>John</td>
                                    <td>Doe</td>
                                    <td>jhon@email.com</td>
                                    <td>USA</td>
                                    <td>123</td>
                                    <td>Member</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>John</td>
                                    <td>Doe</td>
                                    <td>jhon@email.com</td>
                                    <td>USA</td>
                                    <td>123</td>
                                    <td>Member</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="table-responsive">
                        <table class="table" id="likes">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">ZIP</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>John</td>
                                    <td>Doe</td>
                                    <td>jhon@email.com</td>
                                    <td>USA</td>
                                    <td>123</td>
                                    <td>Member</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="table-responsive">
                        <table class="table" id="comment">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">ZIP</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>John</td>
                                    <td>Doe</td>
                                    <td>jhon@email.com</td>
                                    <td>USA</td>
                                    <td>123</td>
                                    <td>Member</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function activateSearch() {
    const container = document.querySelector('.search-container');
    container.classList.toggle('active');

    // Set focus ke input field ketika search container aktif
    const input = document.querySelector('.search-input');
    if (container.classList.contains('active')) {
        input.focus();
    } else {
        input.blur();
    }
}

$(document).ready(function() {
    // Inisialisasi DataTable untuk masing-masing tabel
    var viewsTable = $('#views').DataTable({
        dom: 'lrtip'
    });

    var likesTable = $('#likes').DataTable({
        dom: 'lrtip'
    });

    var commentTable = $('#comment').DataTable({
        dom: 'lrtip'
    });

    // Event listener untuk pencarian di input
    $('#search-input').on('keyup', function() {
        // Menerapkan pencarian pada masing-masing tabel
        var searchTerm = this.value;
        viewsTable.search(searchTerm).draw();
        likesTable.search(searchTerm).draw();
        commentTable.search(searchTerm).draw();
    });
});

</script>


    @endsection