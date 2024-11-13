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
            <h3>Update Certificate</h3>
            <form action="{{ route('admin.update_certificate', $certificate->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12 ">
                        <label for="member_select" class="form-label">Select Member</label>
                        <select name="member_id" id="member_select" class="form-control" required>
                            <option value="" disabled>Select a member</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}"
                                    {{ $certificate->member_id == $member->id ? 'selected' : '' }}>
                                    {{ $member->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('member_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" name="category" id="category" class="form-control"
                            value="{{ $certificate->category }}" required>
                        @error('category')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="certification" class="form-label">Certificate</label>
                        <input type="text" name="certification" id="certification" class="form-control"
                            value="{{ $certificate->certification }}" required>
                        @error('certification')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-4 col-md-6 col-sm-12">
                        <label for="valid_till" class="form-label">Valid Till</label>
                        <input type="date" name="valid_till" id="valid_till" class="form-control"
                            value="{{ $certificate->valid_till }}" required>
                        @error('valid_till')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">update Certificate </button>
            </form>
        </div>

    </div>
</div>
@include('admin-layouts.footer')
