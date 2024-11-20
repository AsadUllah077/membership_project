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
            <h3>Update Fees</h3>
            <form action="{{ route('admin.update_fees',$fees->id) }}" method="POST">
                @csrf

                <div class="row">
                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="member_select" class="form-label">Select Member</label>
                        <select name="member_id" id="member_select" class="form-control" required>
                            <option value="" disabled>Select a member</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}" {{ $fees->member_id == $member->id ? 'selected' : '' }}>
                                    {{ $member->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('member_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="membership" class="form-label">Fees Year Till</label>
                        <select name="fees" id="membership" class="form-control" required>
                            <option value="" disabled>Select membership status</option>
                            @foreach (range(2019, 2040) as $year)
                                <option value="membership-renewal-{{ $year }}" {{ $fees->fees == "membership-renewal-$year" ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('-', ' ', "membership-renewal-$year")) }}
                                </option>
                            @endforeach
                        </select>
                        @error('fees')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="fees_year" class="form-label">Fees Year</label>
                        <input type="date" name="fees_year" id="fees_year" class="form-control"
                               value="{{ old('fees_year', $fees->fees_year) }}" required>
                        @error('fees_year')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="fees_date" class="form-label">Fees Date</label>
                        <input type="date" name="fees_date" id="fees_date" class="form-control"
                               value="{{ old('fees_date', $fees->fees_date) }}" required>
                        @error('fees_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control"
                               value="{{ old('amount', $fees->amount) }}" required>
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



                <button type="submit" class="btn btn-primary">Update Fees</button>
            </form>
        </div>

    </div>
</div>
@include('admin-layouts.footer')
