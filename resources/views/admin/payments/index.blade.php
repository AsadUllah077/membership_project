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

                <div class="row mt-2">
                    <div class="col-sm-12">
                        <div class="card bg-light">
                            <div class="card-header">
                                <div class="row">
                                    <!-- First column -->
                                    <div class="col-md-6 d-flex align-items-center">
                                        <h5>CONDIDATE PAYMENT DETAILS  </h5>
                                    </div>
                                    <!-- Second column -->
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <a href="{{route('admin.payment.create')}}">
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
                                            action="{{ route('admin.payment') }}">
                                            <input class="form-control" type="search" name="search" placeholder="Search"
                                                aria-label="Search" value="{{ request()->input('search') }}" />
                                            <button class="btn btn-outline-primary btn-sm" type="submit">Search</button>
                                        </form>
                                    </div>
                                    <!-- Export buttons aligned to the right -->
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <a href="{{ route('admin.payments.export.csv') }}"
                                            class="btn btn-outline-danger btn-sm">CSV</a>
                                        <a href="{{ route('admin.payments.export.excel') }}"
                                            class="btn btn-outline-primary btn-sm">Excel</a>
                                        <a href="{{ route('admin.payments.export.pdf') }}"
                                            class="btn btn-outline-success btn-sm">PDF</a>
                                    </div>

                                </div>



                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>IFMP-ID</th>
                                                <th>CNIC</th>
                                                <th>Bank Name</th>
                                                <th>Receipt Date</th>
                                                <th>Reference Number</th>
                                                <th>Amount</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($payments as $payment )
                                                <tr>
                                                    <td>{{ $payment->ifmp_id }}</td>
                                                    <td>{{ $payment->cnic }}</td>
                                                    <td>{{ $payment->bank_name }}</td>
                                                    <td>{{ $payment->reciept_date }}</td>
                                                    <td>{{ $payment->reciept_number }}</td>
                                                    <td>{{ $payment->amount }}</td>
                                                    <td class="text-center">
                                                        <a href="{{route('admin.edit_payment', $payment->id)}}"
                                                            class="btn btn-sm btn-info">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{route('admin.delete_payment', $payment->id)}}"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                </tr>
                                                @endforeach

                                        </tbody>
                                    </table>
                                    {{ $payments->links('pagination::bootstrap-5') }}
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
