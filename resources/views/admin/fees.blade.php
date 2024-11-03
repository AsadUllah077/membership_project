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
                                            <h2>278</h2>
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
                                            <h3>278</h3>
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
                                            <h3>278</h3>
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
                    <div class="col-xl-3 col-sm-6 col-12">
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
                    </div>
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
                                <form id="validation-form123" action="#!">
                                    <div class="row">
                                        <div class="col-md-2 p-1">
                                            <select class="form-control form-select" id="validation-gender" required="required">
                                                <option value="" disabled="" selected="">Status</option>
                                                <option>Active</option>
                                                <option>InActive</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 p-1">
                                            <select class="form-control form-select" id="validation-gender" required="required">
                                                <option value="" disabled="" selected="">Company</option>
                                                <option>HBL</option>
                                                <option>NBP</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 p-1">
                                            <select class="form-control form-select" id="validation-gender" required="required">
                                                <option value="" disabled="" selected="">Certification
                                                </option>
                                                <option>FCM</option>
                                                <option>PMR</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 p-1">
                                            <input type="date" class="form-control" id="Extend"
                                                placeholder="Start" required="">
                                        </div>
                                        <div class="col-md-2 p-1">
                                            <input type="date" class="form-control" id="Extend"
                                                placeholder="End" required="">
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
                                        <a href="add.php">
                                            <button type="button" class="btn btn-primary btn-sm">Add New</button>
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body table-border-style">
                                <div class="row mb-2">
                                    <!-- Search bar -->
                                    <div class="col-md-6 d-flex align-items-center">
                                        <form class="input-group input-group-sm">
                                            <input class="form-control" type="search" placeholder="Search"
                                                aria-label="Search">
                                            <button class="btn btn-outline-primary btn-sm"
                                                type="submit">Search</button>
                                        </form>
                                    </div>
                                    <!-- Export buttons aligned to the right -->
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <button class="btn btn-outline-danger btn-sm">PDF</button>
                                        <button class="btn btn-outline-success btn-sm">CSV</button>
                                        <button class="btn btn-outline-primary btn-sm">Excel</button>
                                        <button class="btn btn-outline-info btn-sm">Copy</button>
                                        <button class="btn btn-outline-secondary btn-sm">Print</button>
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
                                         <tr>
                                            <td>05-Feb-2023</td>
                                            <td>IFMP-1545</td>
                                            <td>44205-5425845-7</td>
                                            <td>2023</td>
                                            <td>10000</td>
                                            <td class="text-center"><span class="badge bg-success">Paid</span></td>

                                            <td class="text-center">
                                                <a href="view.php" class="btn-primary btn-sm mrg" data-placement="top" data-toggle="tooltip" data-original-title="View"><i class="far fa-eye"></i></a>
                                                <a href="edit.php" class="btn-warning btn-sm mrg" data-placement="top" data-toggle="tooltip" data-original-title="Edit"><i class="far fa-edit"></i></a>
                                                <a href="#" onclick="return confirm('you are about to delete a record. This cannot be undone. are you sure?')" class="btn-danger btn-sm mrg" data-placement="top" data-toggle="tooltip" data-original-title="Delete"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                         </tr>

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
