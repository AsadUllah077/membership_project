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
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"></i>IMFP</h3>
                </a>
                {{-- <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{asset('dashbaord/img/user.jpg')}}" alt=""
                            style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div>
                </div> --}}
                <div class="navbar-nav w-100">
                    <a href="index.html" class="nav-item nav-link active"><i
                            class="fa fa-tachometer-alt me-2"></i>Dashbaord</a>
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-laptop me-2"></i>Elements</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="button.html" class="dropdown-item">Buttons</a>
                            <a href="typography.html" class="dropdown-item">Typography</a>
                            <a href="element.html" class="dropdown-item">Other Elements</a>
                        </div>
                    </div> --}}
                    <a href="mermbership.html" class="nav-item nav-link"><i class="fas fa-handshake"></i>Membership</a>
                    <a href="form.html" class="nav-item nav-link"><i class="fas fa-credit-card"></i>Fees</a>
                    <a href="table.html" class="nav-item nav-link"><i class="fas fa-briefcase"></i>Payments</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fas fa-certificate"></i>e-Certificates</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fas fa-school"></i>Companies</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fas fa-user-tie"></i>Users</a>

                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>

                <div class="navbar-nav align-items-center ms-auto">

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{ asset('dashbaord/img/user.jpg') }}"
                                alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
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
                                        <h5>COMPANIES LIST</h5>
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
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>T-Active</th>
                                                <th>T-InActive</th>
                                                <th>Total Dues</th>
                                                <th>Total Paid</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <tr>
                                               <td>COM-5452</td>
                                               <td>HBL Bank</td>
                                               <td>514</td>
                                               <td>215</td>
                                               <td>50215</td>
                                               <td>30000</td>
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
