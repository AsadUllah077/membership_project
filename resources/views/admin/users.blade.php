@include('admin-layouts.header')
<div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Sidebar Start -->
    @include('admin-layouts.sidebar')
    <!-- Sidebar End -->


    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        @include('admin-layouts.navbar')
        <!-- Navbar End -->


        <!-- Sale & Revenue Start -->
        <div class="container-fluid pt-4 px-4">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row mt-2">
                <div class="col-sm-12">
                    <div class="card bg-light">
                        <div class="card-header">
                            <div class="row">
                                <!-- First column -->
                                <div class="col-md-6 d-flex align-items-center">
                                    <h5>USERS LIST</h5>
                                </div>
                                <!-- Second column -->
                                <div class="col-md-6 d-flex justify-content-end">
                                    <a href="{{ route('admin.create_user') }}">
                                        <button type="button" class="btn btn-primary btn-sm">Add New</button>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body table-border-style">
                            <div class="row mb-2">
                                <!-- Search bar -->
                                <div class="col-md-6 d-flex align-items-center">
                                    <form class="input-group input-group-sm" method="GET"
                                        action="{{ route('admin.users') }}">
                                        <input class="form-control" type="search" name="search" placeholder="Search"
                                            aria-label="Search" value="{{ request()->input('search') }}" />
                                        <button class="btn btn-outline-primary btn-sm" type="submit">Search</button>
                                    </form>
                                </div>
                                <!-- Export buttons aligned to the right -->
                                <div class="col-md-6 d-flex justify-content-end">
                                    <a href="{{ route('admin.users.export.csv') }}"
                                        class="btn btn-outline-danger btn-sm">CSV</a>
                                    <a href="{{ route('admin.users.export.excel') }}"
                                        class="btn btn-outline-primary btn-sm">Excel</a>
                                    <a href="{{ route('admin.users.export.pdf') }}"
                                        class="btn btn-outline-success btn-sm">PDF</a>
                                </div>

                            </div>




                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>STATUS</th>
                                            <th class="text-center">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr>
                                            <td>U-1</td>
                                            <td>Admin</td>
                                            <td>admin@gmail.com</td>
                                            <td>Admin</td>
                                            <td>Active</td>
                                            <td class="text-center">
                                                <a href="#" class="btn-primary btn-sm mrg" data-placement="top"
                                                    data-toggle="tooltip" data-original-title="View"><i
                                                        class="far fa-eye"></i></a>
                                                <a href="#" class="btn-warning btn-sm mrg" data-placement="top"
                                                    data-toggle="tooltip" data-original-title="Edit"><i
                                                        class="far fa-edit"></i></a>
                                                <a href="#"
                                                    onclick="return confirm('you are about to delete a record. This cannot be undone. are you sure?')"
                                                    class="btn-danger btn-sm mrg" data-placement="top"
                                                    data-toggle="tooltip" data-original-title="Delete"><i
                                                        class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr> --}}
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ $user->status }}</td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.delete_user',$user->id)}}" class="btn-danger btn-sm mrg"
                                                       data-placement="top" data-toggle="tooltip"
                                                       data-original-title="Delete"><i class="far fa-trash-alt"></i></a>
                                                    <a href="{{route('admin.edit_user',$user->id)}}" class="btn-warning btn-sm mrg"
                                                       data-placement="top" data-toggle="tooltip"
                                                       data-original-title="Edit"><i class="far fa-edit"></i></a>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--simple table for qualification end-->

                <!--Candidate Qualification form Start-->
            </div>
        </div>
        <!-- Footer End -->
    </div>
</div>
@include('admin-layouts.footer')
