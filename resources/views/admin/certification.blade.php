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
                                        <h5>CERTIFICATION LIST</h5>
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
                                           <th>DATE</th>
                                           <th>IFMP-ID</th>
                                           <th>CNIC</th>
                                           <th>CATEGORY</th>
                                           <th>CERTIFICATION</th>
                                           <th>VAILD TILL</th>
                                           <th class="text-center">Action</th>
                                         </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                            <td>05-02-2024</td>
                                            <td>IFMP-5425</td>
                                            <td>42502-2542584-6</td>
                                            <td>GF</td>
                                            <td>FCM</td>
                                            <td>01-06-2024</td>
                                            <td class="text-center">
                                              <a href="#" class="btn-primary btn-sm mrg" data-placement="top" data-toggle="tooltip" data-original-title="View"><i class="far fa-eye"></i></a>
                                              <a href="#" class="btn-warning btn-sm mrg" data-placement="top" data-toggle="tooltip" data-original-title="Edit"><i class="far fa-edit"></i></a>
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
