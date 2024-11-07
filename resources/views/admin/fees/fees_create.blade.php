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
            <h3>Add New Fees</h3>
            <form action="{{ route('admin.store_fees') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="ifmp_id" class="form-label">Ifmp Id</label>
                    <input type="text" name="ifmp_id" id="ifmp_id" class="form-control"
                        value="{{ old('ifmp_id') }}" required>
                    @error('ifmp_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cnic" class="form-label">CNIC</label>
                    <input type="text" name="cnic" id="cnic" class="form-control" value="{{ old('cnic') }}"
                        required>
                    @error('cnic')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fees_year" class="form-label">Fees Year</label>
                    <input type="date" name="fees_year" id="fees_year" class="form-control"
                        value="{{ old('fees_year') }}" required>
                    @error('fees_year')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount') }}"
                        required>
                    @error('amount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control form-select" required>
                        <option value="">Select Status</option>
                        <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>paid</option>

                        <option value="unpaid" {{ old('status') == 'unpaid' ? 'selected' : '' }}>unpaid</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">Add Fees</button>
            </form>
        </div>

    </div>
</div>
@include('admin-layouts.footer')
