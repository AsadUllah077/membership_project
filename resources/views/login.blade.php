<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Now</title>
    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="style.css" />
    <style>
      body {
        background-color: #fcaeae;
      }
      .login-container {
        width: 100%;
        max-width: 400px; /* Sets a max width for larger screens */
        padding: 20px;
      }
      .bg {
        background-color: #ffeadd;
      }
      .btn-color {
        background-color: #ff6666;
        border: none;
      }
    </style>
  </head>
  <body>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
      <form class="form-group login-container" action="{{route('admin.login')}}" method="POST">
        @csrf
        <div class="mb-3 bg p-4 rounded">
          <h2 class="text-center">Login</h2>
          <label for="email" class="form-label mt-4 fw-semibold">Email address</label>
          <input
            type="email"
            name="email"
            class="form-control"
            id="email"
            placeholder="name@example.com"
          />
          <label for="password" class="form-label mt-3 fw-semibold">Password</label>
          <input
            type="password"
            name="password"
            class="form-control"
            id="password"
          />
          <input
            type="submit"
            class="form-control btn-color mt-3"
            value="Login"
          />
        </div>
      </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
