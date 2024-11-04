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
            <h3>Add New Certificate</h3>
            <form action="{{ route('admin.store_certificate') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="ifmp_id" class="form-label">IFMP ID</label>
                    <input type="text" name="ifmp_id" id="ifmp_id" class="form-control" value="{{ old('ifmp_id') }}" required>
                    @error('ifmp_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cnic" class="form-label">CNIC</label>
                    <input type="text" name="cnic" id="cnic" class="form-control" value="{{ old('cnic') }}" required>
                    @error('cnic')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" name="category" id="category" class="form-control" value="{{ old('category') }}" required>
                    @error('category')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="certification" class="form-label">Certificate</label>
                    <input type="text" name="certification" id="certification" class="form-control" value="{{ old('certification') }}" required>
                    @error('certification')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="valid_till" class="form-label">Valid Till</label>
                    <input type="date" name="valid_till" id="valid_till" class="form-control" value="{{ old('valid_till') }}" required>
                    @error('valid_till')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Add Certificate </button>
            </form>
        </div>

    </div>
</div>
@include('admin-layouts.footer')
