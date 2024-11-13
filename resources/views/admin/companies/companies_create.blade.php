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
            <h3>Add New Companies</h3>
            <form action="{{ route('admin.store_company') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="string" name="email" id="email" class="form-control"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="number" name="phone" id="phone" class="form-control"
                            value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="sba" class="form-label">SBA</label>
                        <input type="string" name="sba" id="sba" class="form-control"
                            value="{{ old('sba') }}" required>
                        @error('sba')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Add Company</button>
            </form>
        </div>

    </div>
</div>
@include('admin-layouts.footer')
