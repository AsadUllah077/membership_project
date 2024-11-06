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
            <h3>Update Membership</h3>
            <form action="{{ route('admin.update_membership',$membership->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $membership->name }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="ifmp_id" class="form-label">Ifmp Id</label>
                    <input type="number" name="ifmp_id" id="ifmp_id" class="form-control" value="{{ $membership->ifmp_id }}" required>
                    @error('ifmp_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cnic" class="form-label">CNIC</label>
                    <input type="number" name="cnic" id="cnic" class="form-control" value="{{ $membership->cnic }}" required>
                    @error('cnic')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="certificate_id" class="form-label">Certificates Dues</label>
                    <select class="form-control form-select" name="certificate_id">
                        <option value="" disabled>Select certificate</option>
                        @foreach ($certificates as $certificate)
                            <option value="{{ $certificate->id }}"
                                {{ $membership->certificate_id == $certificate->id ? 'selected' : '' }}>
                                {{ $certificate->certification }}
                            </option>
                        @endforeach
                    </select>
                    @error('certificate_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control form-select" name="status">
                        <option value="" disabled="" selected="">Select Status</option>
                        <option value="active" {{$membership->status == 'active' ? 'selected' : ''}}>Active</option>
                        <option value="inactive" {{$membership->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dues" class="form-label">Dues</label>
                    <input type="number" name="dues" id="dues" class="form-control" value="{{ $membership->dues }}" required>
                    @error('dues')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="balance" class="form-label">Balance</label>
                    <input type="number" name="balance" id="balance" class="form-control" value="{{ $membership->balance }}" required>
                    @error('balance')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="m_date" class="form-label">M Date</label>
                    <input type="date" name="m_date" id="m_date" class="form-control" value="{{ $membership->m_date }}" required>
                    @error('m_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="valid_till" class="form-label">Valid Till</label>
                    <input type="date" name="valid_till" id="valid_till" class="form-control" value="{{ $membership->valid_till }}" required>
                    @error('valid_till')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Membership</button>
            </form>
        </div>

    </div>
</div>
@include('admin-layouts.footer')
