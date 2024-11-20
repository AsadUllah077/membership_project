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
                <div class="row">
                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12  ">
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
                        <label for="category" class="form-label">Category</label>
                        <select name="category" id="category" class="form-control" required>
                            <option value="" disabled selected>Select a category</option>
                            <option value="GF" {{ old('category') == 'GF' ? 'selected' : '' }}>GF</option>
                            <option value="Exame" {{ old('category') == 'Exame' ? 'selected' : '' }}>Exame</option>
                            <option value="Insurance" {{ old('category') == 'Insurance' ? 'selected' : '' }}>Insurance</option>
                            <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('category')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="certification" class="form-label">Certificate</label>
                        <input type="text" name="certification" id="certification" class="form-control"
                            value="{{ old('certification') }}" required>
                        @error('certification')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="valid_till" class="form-label">Issue Date</label>
                        <input type="date" name="valid_till" id="valid_till" class="form-control"
                            value="{{ old('valid_till') }}" required>
                        @error('valid_till')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add Certificate </button>
            </form>
        </div>

    </div>
</div>
@include('admin-layouts.footer')
