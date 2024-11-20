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

        {{-- Edit user form --}}
        <div class="container mt-4">
            <h3>Edit Membership</h3>
            <form action="{{ route('admin.update_membership', $membership->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- This tells Laravel that the form is using the PUT method -->

                <div class="row">

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="ifmp_id" class="form-label">Ifmp Id</label>
                        <input type="string" name="ifmp_id" id="ifmp_id" class="form-control" placeholder="IFMP-0000"
                            value="{{ old('ifmp_id', $membership->ifmp_id) }}" required>
                        @error('ifmp_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3  col-xl-4 col-md-6 col-sm-12">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $membership->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="cnic" class="form-label">CNIC</label>
                        <input type="text" name="cnic" id="cnic" class="form-control"
                            value="{{ old('cnic', $membership->cnic) }}" required>
                        @error('cnic')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control"
                            value="{{ old('email', $membership->email) }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="text" name="mobile" id="mobile" class="form-control"
                            value="{{ old('mobile', $membership->mobile) }}" required>
                        @error('mobile')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            value="{{ old('phone', $membership->phone) }}" required>
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="m_date" class="form-label">Membership Date</label>
                        <input type="date" name="m_date" id="m_date" class="form-control"
                            value="{{ old('m_date', $membership->m_date) }}" required>
                        @error('m_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="sba" class="form-label">SBA</label>
                        <select class="form-control form-select" name="sba">
                            <option value="psba" {{ old('sba', $membership->sba) == 'psba' ? 'selected' : '' }}>PSBA</option>
                            <option value="nonpsba" {{ old('sba', $membership->sba) == 'nonpsba' ? 'selected' : '' }}>Non-PSBA</option>
                        </select>
                        @error('sba')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="company_id" class="form-label">Company</label>
                        <select class="form-control form-select" name="company_id">
                            <option value="" selected="" disabled="">Select Company</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id', $membership->company_id) == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('company_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Update Membership</button>
            </form>
        </div>

    </div>
</div>
@include('admin-layouts.footer')
