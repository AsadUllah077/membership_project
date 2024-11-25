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
            <h3>Add New Payment</h3>
            <form action="{{ route('admin.store_payment') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-cl-4 col-md-6 col-sm-12 ">
                        <label for="member_select" class="form-label">Select Member</label>
                        <select name="membership_id" id="member_select" class="form-control" required>
                            <option value="" disabled selected>Select a member</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>
                        @error('membership_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-cl-4 col-md-6 col-sm-12">
                        <label for="reciept_number" class="form-label">Reciept Number</label>
                        <input type="number" name="reciept_number" id="reciept_number" class="form-control"
                            value="{{ old('reciept_number') }}" required>
                        @error('reciept_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-cl-4 col-md-6 col-sm-12">
                        <label for="reciept_date" class="form-label">Reciept Date</label>
                        <input type="date" name="reciept_date" id="reciept_date" class="form-control"
                            value="{{ old('reciept_date') }}" required>
                        @error('reciept_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="mb-3 col-cl-4 col-md-6 col-sm-12">
                        <label for="cnic" class="form-label">CNIC</label>
                        <input type="text" name="cnic" id="cnic" class="form-control"
                            value="{{ old('cnic') }}" required>
                        @error('cnic')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="mb-3 col-cl-4 col-md-6 col-sm-12">
                        <label for="bank_name" class="form-label">Banke Name</label>
                        <input type="text" name="bank_name" id="bank_name" class="form-control"
                            value="{{ old('bank_name') }}" required>
                        @error('bank_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-cl-4 col-md-6 col-sm-12">
                        <label for="amount" class="form-label">Paid Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control"
                            value="{{ old('amount') }}" required>
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add payment</button>
            </form>
        </div>

    </div>
</div>
@include('admin-layouts.footer')
