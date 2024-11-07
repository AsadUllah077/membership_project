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
                                        <h5>COMPANIES LIST</h5>
                                    </div>
                                    <!-- Second column -->
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <a href="{{route('admin.companies.create')}}">
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

                                                <th>Name</th>
                                                <th>T-Active</th>
                                                <th>T-InActive</th>
                                                <th>Total Dues</th>
                                                <th>Total Paid</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           {{-- <tr>
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
                                           </tr> --}}

                                           @foreach ($companies as $company)
                                           <tr>
                                             <td>{{$company->name}}</td>
                                             <td>{{$company->t_active}}</td>
                                             <td>{{$company->t_inactive}}</td>
                                             <td>{{$company->total_dues}}</td>
                                             <td>{{$company->total_paid}}</td>
                                             <td class="text-center">
                                                <a href="{{route('admin.delete_company',$company->id)}}" class="btn-danger btn-sm mrg"
                                                   data-placement="top" data-toggle="tooltip"
                                                   data-original-title="Delete"><i class="far fa-trash-alt"></i></a>
                                                <a href="{{route('admin.edit_company',$company->id)}}" class="btn-warning btn-sm mrg"
                                                   data-placement="top" data-toggle="tooltip"
                                                   data-original-title="Edit"><i class="far fa-edit"></i></a>
                                            </td>
                                           </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $companies->links('pagination::bootstrap-5') }}
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
