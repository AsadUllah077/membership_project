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
            <div class="row g-4">
                {{-- <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-shopping-cart"></i>
                            <div class="ms-3">
                                <p class="mb-2">New Registration</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div> --}}
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card bg-primary">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-center text-white">
                                        <h2>{{ $users }}</h2>
                                        <span>Total Members</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-users"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Registration</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div> --}}
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card bg-success">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-center text-white">
                                        <h3>{{ $active_users }}</h3>
                                        <span>Active Members</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-ticket-alt"></i>
                            <div class="ms-3">
                                <p class="mb-2">Examination</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div> --}}
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card bg-warning">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-center text-white">
                                        <h3>{{ $users - $active_users }}</h3>
                                        <span>InActive Members</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-dollar-sign"></i>
                            <div class="ms-3">
                                <p class="mb-2">Grand Fathering</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div> --}}
                {{-- <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card bg-info">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-center text-white">
                                            <h3>278</h3>
                                            <span>New Members</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

            </div>
            <div class="row g-4 mt-2">



            </div>
            <div class="row mt-2">
                <div class="col-sm-12">
                    <div class="card bg-light">
                        <div class="card-header">
                            <div class="row">
                                <!-- First column -->
                                <div class="col-md-6 d-flex align-items-center">
                                    <h5>MEMBERSHIP LIST</h5>
                                </div>
                                <!-- Second column -->
                                <div class="col-md-6 d-flex justify-content-end">
                                    <a href="{{ route('admin.membership.create') }}">
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
                                        action="{{ route('admin.membership') }}">
                                        <input class="form-control" type="search" name="search" placeholder="Search"
                                            aria-label="Search" value="{{ request()->input('search') }}" />
                                        <button class="btn btn-outline-primary btn-sm" type="submit">Search</button>
                                    </form>
                                </div>
                                <!-- Export buttons aligned to the right -->
                                <div class="col-md-6 d-flex justify-content-end">
                                    <a href="{{ route('admin.membership.export.csv') }}"
                                        class="btn btn-outline-danger btn-sm">CSV</a>
                                    <a href="{{ route('admin.membership.export.excel') }}"
                                        class="btn btn-outline-primary btn-sm">Excel</a>
                                    <a href="{{ route('admin.membership.export.pdf') }}"
                                        class="btn btn-outline-success btn-sm">PDF</a>
                                </div>

                            </div>


                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>IFMP-ID</th>
                                            <th>Name</th>
                                            <th>CNIC</th>
                                            <th>Certification</th>
                                            <th>Status</th>
                                            <th>Dues</th>
                                            <th>Balance</th>
                                            <th>M-Date</th>
                                            <th>Vail Till</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($membership as $member)
                                            <tr>
                                                <td>{{ $member->ifmp_id }}</td>
                                                <td>{{ $member->name }}</td>
                                                <td>{{ $member->cnic }}</td>
                                                <td>{{ $member->certificate ? $member->certificate->certification : 'N/A' }}
                                                </td>
                                                <td>{{ $member->status }}</td>
                                                <td>{{ $member->dues }}</td>
                                                <td>{{ $member->balance }}</td>
                                                <td>{{ $member->m_date }}</td>
                                                <td>{{ $member->valid_till }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.edit_membership', $member->id) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('admin.delete_membership', $member->id) }}"
                                                        onclick="return confirm('Are you sure you want to delete this item?')"
                                                        class="text-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $membership->links('pagination::bootstrap-5') }}

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
