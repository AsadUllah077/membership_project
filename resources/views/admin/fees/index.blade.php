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
                                        <h2>{{ $all_fees }}</h2>
                                        <span>Total Fees</span>
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
                                        <h3>{{ $paid_fees }}</h3>
                                        <span>Total Paid</span>
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
                                        <h3>{{ $unpaid_fees }}</h3>
                                        <span>Total Unpaid</span>
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
                                            <span>This Year Paid</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                {{-- <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-shopping-cart"></i>
                            <div class="ms-3">
                                <p class="mb-2">Member</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-users"></i>
                            <div class="ms-3">
                                <p class="mb-2">Non Member</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-ticket-alt"></i>
                            <div class="ms-3">
                                <p class="mb-2">Ticket Resolved</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-dollar-sign"></i>
                            <div class="ms-3">
                                <p class="mb-2">Revenue Today</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div> --}}
            </div>
            <div class="row g-4 mt-2">


                <!--===Filter===-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body bg-light">
                            <form id="validation-form123" action="{{ route('admin.fees') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-2 p-1">
                                        <select class="form-control form-select" name="status">
                                            <option value="" disabled selected>Status</option>
                                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>
                                                Paid</option>
                                            <option value="unpaid"
                                                {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 p-1">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="{{ route('admin.fees') }}" class="btn btn-secondary">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--===End Filter===-->

            </div>
            <div class="row mt-2">
                <div class="col-sm-12">
                    <div class="card bg-light">
                        <div class="card-header">
                            <div class="row">
                                <!-- First column -->
                                <div class="col-md-6 d-flex align-items-center">
                                    <h5>CONDIDATE STATUS</h5>
                                </div>
                                <!-- Second column -->
                                <div class="col-md-6 d-flex justify-content-end">
                                    <a href="{{ route('admin.fees.create') }}">
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
                                        action="{{ route('admin.fees') }}">
                                        <input class="form-control" type="search" name="search" placeholder="Search"
                                            aria-label="Search" value="{{ request()->input('search') }}" />
                                        <button class="btn btn-outline-primary btn-sm" type="submit">Search</button>
                                    </form>
                                </div>
                                <!-- Export buttons aligned to the right -->
                                <div class="col-md-6 d-flex justify-content-end">
                                    <a href="{{ route('admin.fees.export.csv') }}"
                                        class="btn btn-outline-danger btn-sm">CSV</a>
                                    <a href="{{ route('admin.fees.export.excel') }}"
                                        class="btn btn-outline-primary btn-sm">Excel</a>
                                    <a href="{{ route('admin.fees.export.pdf') }}"
                                        class="btn btn-outline-success btn-sm">PDF</a>
                                </div>

                            </div>



                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>IFMP-ID</th>
                                            <th>CNIC</th>
                                            <th>Fees Year</th>
                                            <th>Amount</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fees as $fee)
                                            <tr>
                                                <td>{{ $fee->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $fee->member->ifmp_id }}</td>
                                                <td>{{ $fee->member->cnic }}</td>
                                                <td>{{ $fee->fees_year }}</td>
                                                <td>{{ $fee->amount }}</td>
                                                <td>{{ $fee->status }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.edit_fees', $fee->id) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('admin.delete_fees', $fee->id) }}"
                                                        onclick="return confirm('Are you sure you want to delete this item?')"
                                                        class="text-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $fees->links('pagination::bootstrap-5') }}
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
