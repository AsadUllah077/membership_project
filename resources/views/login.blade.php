<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Now</title>
    <!-- Bootstrap link css -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="style.css" />
    <style>
        body {
  background-color: #fcaeae;
  height: 100%;
}
form {
  width: 28%;
  margin: auto;
  padding-top: 150px;
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
    <div class="container">
      <form class="form-group" action="{{route('admin.login')}}" method="POST">
        @csrf
        <div class="mb-3 bg p-5 rounded">
          <h2 class="text-center">Login</h2>
          <label
            for="exampleFormControlInput1"
            class="form-label mt-4 fw-semibold"
            >Email address</label
          >
          <input
            type="email" name="email"
            class="form-control"
            id="exampleFormControlInput1"
            placeholder="name@example.com"
          />
          <label
            for="exampleFormControlInput1"
            class="form-label mt-3 fw-semibold"
            >Password</label
          >
          <input
            type="password"
             name="password"
            class="form-control"
            id="exampleFormControlInput1"
          />

          <input
            type="submit"
            class="form-control btn-color mt-3"
            id="exampleFormControlInput1"
          />
        </div>
      </form>
    </div>

    <!-- Bootstrap link js -->
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
