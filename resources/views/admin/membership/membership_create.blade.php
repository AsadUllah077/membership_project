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

        {{-- Add user form --}}
        <div class="container mt-4">
            <h3>Add New Membership</h3>
            <form action="{{ route('admin.store_membership') }}" method="POST">
                @csrf

                <div class="row">


                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="ifmp_id" class="form-label">Ifmp Id</label>
                        <input type="string" name="ifmp_id" id="ifmp_id" class="form-control" placeholder="IFMP-0000"
                            value="{{ old('ifmp_id') }}" required>
                        @error('ifmp_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3  col-xl-4 col-md-6 col-sm-12">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="cnic" class="form-label">CNIC</label>
                        <input type="text" name="cnic" id="cnic" class="form-control"
                            value="{{ old('cnic') }}" required>
                        @error('cnic')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="email" class="form-label">email</label>
                        <input type="text" name="email" id="email" class="form-control"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="text" name="mobile" id="mobile" class="form-control"
                            value="{{ old('mobile') }}" required>
                        @error('mobile')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="phone" class="form-label">phone</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="m_date" class="form-label">M Date</label>
                        <input type="date" name="m_date" id="m_date" class="form-control"
                            value="{{ old('m_date') }}" required>
                        @error('m_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="sba" class="form-label">SBA</label>
                        <select class="form-control form-select" name="sba">
                            <option value="" disabled="" selected="">Select Status</option>
                            <option value="psba">PSBA</option>
                            <option value="nonpsba">Non-PSBA</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="company_id" class="form-label"> Companies</label>
                        <select class="form-control form-select" name="company_id">
                            <option value="" selected="" disabled="">select company</option>
                            @foreach ($companies as $compny)
                                <option value="{{ $compny->id }}">{{ $compny->name }}</option>
                            @endforeach
                        </select>
                        @error('compny_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>





                </div>

                <button type="submit" class="btn btn-primary">Add Membership</button>
            </form>
        </div>

    </div>
</div>
@include('admin-layouts.footer')
