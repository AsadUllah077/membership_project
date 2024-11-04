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

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="t_active" class="form-label">T-Active</label>
                    <input type="number" name="t_active" id="t_active" class="form-control" value="{{ old('t_active') }}" required>
                    @error('t_active')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="t_inactive" class="form-label">T-inActive</label>
                    <input type="number" name="t_inactive" id="t_inactive" class="form-control" value="{{ old('t_inactive') }}" required>
                    @error('t_inactive')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="total_dues" class="form-label">Total Dues</label>
                    <input type="number" name="total_dues" id="total_dues" class="form-control" value="{{ old('total_dues') }}" required>
                    @error('total_dues')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="total_paid" class="form-label">Total Paid</label>
                    <input type="number" name="total_paid" id="total_paid" class="form-control" value="{{ old('total_paid') }}" required>
                    @error('total_paid')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Add Company</button>
            </form>
        </div>

    </div>
</div>
@include('admin-layouts.footer')
