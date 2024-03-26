<?php

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;


$user = Auth::user();
$totalContacts = Contact::where('user_id', $user->id)->count();
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">



    <!-- Styles -->
    <style>
        body {
            background-color: #eee;
            padding: 0;
        }

        .navbar {
            height: 70px;
        }

        .project-list-table {
            border-collapse: separate;
            border-spacing: 0 12px
        }

        .project-list-table tr {
            background-color: #fff
        }

        .table-nowrap td,
        .table-nowrap th {
            white-space: nowrap;
        }

        .table-borderless>:not(caption)>*>* {
            border-bottom-width: 0;
        }

        .table>:not(caption)>*>* {
            padding: 0.75rem 0.75rem;
            background-color: var(--bs-table-bg);
            border-bottom-width: 1px;
            box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        }

        .avatar-sm {
            height: 2rem;
            width: 2rem;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .me-2 {
            margin-right: 0.5rem !important;
        }

        img,
        svg {
            vertical-align: middle;
        }

        a {
            color: #3b76e1;
            text-decoration: none;
        }

        .badge-soft-danger {
            color: #f56e6e !important;
            background-color: rgba(245, 110, 110, .1);
        }

        .badge-soft-success {
            color: #63ad6f !important;
            background-color: rgba(99, 173, 111, .1);
        }

        .badge-soft-primary {
            color: #3b76e1 !important;
            background-color: rgba(59, 118, 225, .1);
        }

        .badge-soft-info {
            color: #57c9eb !important;
            background-color: rgba(87, 201, 235, .1);
        }

        .avatar-title {
            align-items: center;
            background-color: #3b76e1;
            color: #fff;
            display: flex;
            font-weight: 500;
            height: 100%;
            justify-content: center;
            width: 100%;
        }

        .bg-soft-primary {
            background-color: rgba(59, 118, 225, .25) !important;
        }

        .fa {
            font-size: 40px;
        }

        .pagination li span,
        .pagination li a {
            font-size: 14px;
            /* Atur ukuran font sesuai kebutuhan Anda */
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/registrations/registration-3/assets/css/registration-3.css">
    <script src="https://kit.fontawesome.com/7fbc6c871e.js" crossorigin="anonymous"></script>
</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-lg bg-body-tertiary  mb-3">
        <div class="container">
            <div class="collapse navbar-collapse d-flex align-items-center justify-content-between" id="navbarSupportedContent">
                <a href="{{ route('updateView')}}"><i class="fa fa-regular fa-circle-user"></i></a>
                <form class="w-50" action="{{ route('get.contact') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search by name...">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
                <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1> Welcome, {{ Auth::user()->name }}</h1>
                <div class="mb-3">
                    <h5 class="card-title">Contact List <span class="text-muted fw-normal ms-2">({{ $totalContacts}})</span></h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                    <div>
                        <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="add-btn btn btn-primary"><i class="bx bx-plus me-1"></i> Add New</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <div class="table-responsive">
                        <table class="table project-list-table table-nowrap align-middle table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">First name</th>
                                    <th scope="col">Last name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Addresses</th>
                                    <th scope="col" style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                <tr>
                                    <td><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="avatar-sm rounded-circle me-2" /><a href="#" class="text-body">{{ $contact->first_name }}</a></td>
                                    <td>{{ $contact->last_name }}</td>
                                    <td><span class="badge badge-soft-info mb-0">{{ $contact->email }}</span></td>
                                    <td>{{ $contact->phone }}</td>
                                    <td><a href="{{ route('addresses.index', $contact->id) }}" class="btn btn-primary" role="button">
                                            View Addresses
                                        </a>

                                    </td>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="{{ route('edit.contact', $contact->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="px-2 text-primary">
                                                    <i class="bx bx-pencil font-size-18"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <form action="{{ route('delete.contact', $contact->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <i class="bx bx-trash-alt font-size-18"></i>
                                                    </button>
                                                </form>
                                            </li>
                                            <li class="list-inline-item dropdown">
                                                <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="{{ route('edit.contact', $contact->id) }}">Edit</a>
                                                    <form action="{{ route('delete.contact', $contact->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">Delete</button>
                                                    </form>
                                                </div>
                                            </li>
                                        </ul>

                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination row g-0 align-items-center pb-4">
            <div class="pagination justify-content-center">
                {{ $contacts->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
    @if(request()->is('home'))
    @yield('addContact')
    @endif
    @yield('updateContact')
    @yield('updateUser')



</body>

</html>