<!DOCTYPE html>
<html lang="en">
<head>
    <title>IFMP Member Verification</title>
    <!-- Bootstrap CSS and Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body style="background-color: #ecf0f5; font-size: inherit;">
<section class="main-container">
    <div class="row m-0">
        <!-- Logo Start -->
        <div class="col-md-12 p-3 text-center">
            <div class="logo">
                <img src="https://registration.icm.org.pk/public/signin22.png" class="img-fluid" alt="IFMP Logo">
            </div>
        </div>
        <!-- Title Start -->
        <div class="col-md-12 bg-primary text-light p-3 text-center d-flex justify-content-between align-items-center">
            <strong>IFMP MEMBERS VERIFICATION</strong>

            {{-- <nav>
                <a
                    href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Log in
                </a>
            </nav> --}}
        </div>


        <!-- Search Form -->
        <div class="col-md-12 p-5">
            <form id="cnicForm" method="POST" action="{{ route('certificate.search') }}">
                @csrf
                <div class="input-group bg-white">
                    <input type="text" id="cnic" name="cnic" class="form-control" placeholder="Search with CNIC Number" required>
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <small id="cnicError" class="text-danger d-none">CNIC format must be 00000-0000000-0</small>
            </form>
        </div>

        <!-- Table for Displaying Results -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>IFMP-ID</th>
                                <th>Name</th>
                                <th>Dues</th>
                                <th>Status</th>
                                <th class="text-center">Payment</th>
                                <th class="text-center">Certification</th>
                            </tr>
                        </thead>
                        <tbody id="certificateResults">
                            <!-- Results will be displayed here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('cnicForm').addEventListener('submit', function(event) {
        const cnicInput = document.getElementById('cnic');
        const cnicError = document.getElementById('cnicError');

        // CNIC validation regex (00000-0000000-0 format)
        const cnicPattern = /^\d{5}-\d{7}-\d{1}$/;

        if (!cnicPattern.test(cnicInput.value)) {
            cnicError.classList.remove('d-none');
            event.preventDefault(); // Prevent form submission
        } else {
            cnicError.classList.add('d-none');
        }
    });
</script>
<script>
    document.getElementById('cnicForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const cnicInput = document.getElementById('cnic').value;
        const cnicError = document.getElementById('cnicError');

        if (/^\d{5}-\d{7}-\d{1}$/.test(cnicInput)) {
            cnicError.classList.add('d-none');

            fetch("{{ route('certificate.search') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ cnic: cnicInput })
            })
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('certificateResults');
                tableBody.innerHTML = '';

                if (data.error) {
                    tableBody.innerHTML = `<tr><td colspan="6" class="text-center text-danger">${data.error}</td></tr>`;
                } else {
                    tableBody.innerHTML = `
                        <tr>
                            <td>${data.ifmp_id}</td>
                            <td>${data.name}</td>
                            <td>${data.totalAmount}</td>
                            <td>${data.status}</td>
                            <td class="text-center"><button class="btn btn-outline-primary btn-sm">Pay Online</button></td>
                            <td class="text-center"><button class="btn btn-outline-success btn-sm">View Certificates</button></td>
                        </tr>
                    `;
                }
            });
        } else {
            cnicError.classList.remove('d-none');
        }
    });
</script>

</body>
</html>
