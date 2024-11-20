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
                <div class="row">
                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="member_select" class="form-label">Select Member</label>
                        <select name="member_id" id="member_select" class="form-control" required>
                            <option value="" disabled selected>Select a member</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>
                        @error('member_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="membership" class="form-label">Fees Year Till</label>
                        <select name="fees" id="membership" class="form-control" required>
                            <option value="" disabled selected>Select membership status</option>
                            <option value="membership-renewal-2019">Membership Renewal 2019</option>
                            <option value="membership-renewal-2020">Membership Renewal 2020</option>
                            <option value="membership-renewal-2021">Membership Renewal 2021</option>
                            <option value="membership-renewal-2022">Membership Renewal 2022</option>
                            <option value="membership-renewal-2023">Membership Renewal 2023</option>
                            <option value="membership-renewal-2024">Membership Renewal 2024</option>
                            <option value="membership-renewal-2025">Membership Renewal 2025</option>
                            <option value="membership-renewal-2026">Membership Renewal 2026</option>
                            <option value="membership-renewal-2027">Membership Renewal 2027</option>
                            <option value="membership-renewal-2028">Membership Renewal 2028</option>
                            <option value="membership-renewal-2029">Membership Renewal 2029</option>
                            <option value="membership-renewal-2030">Membership Renewal 2030</option>
                            <option value="membership-renewal-2031">Membership Renewal 2031</option>
                            <option value="membership-renewal-2032">Membership Renewal 2032</option>
                            <option value="membership-renewal-2033">Membership Renewal 2033</option>
                            <option value="membership-renewal-2034">Membership Renewal 2034</option>
                            <option value="membership-renewal-2035">Membership Renewal 2035</option>
                            <option value="membership-renewal-2036">Membership Renewal 2036</option>
                            <option value="membership-renewal-2037">Membership Renewal 2037</option>
                            <option value="membership-renewal-2038">Membership Renewal 2038</option>
                            <option value="membership-renewal-2039">Membership Renewal 2039</option>
                            <option value="membership-renewal-2040">Membership Renewal 2040</option>

                        </select>
                        @error('fees')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="fees_year" class="form-label">Fees Year</label>
                        <input type="date" name="fees_year" id="fees_year" class="form-control"
                            value="{{ old('fees_year') }}" required>
                        @error('fees_year')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="fees_date" class="form-label">Fees Date</label>
                        <input type="date" name="fees_date" id="fees_date" class="form-control" required>
                        @error('fees_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control"
                            value="{{ old('amount') }}" required>
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Add Fees</button>
            </form>
        </div>

    </div>
</div>
@include('admin-layouts.footer')
