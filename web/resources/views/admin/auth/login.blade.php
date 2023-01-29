
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Labora Login</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('template') }}/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('template') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('template') }}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Labora</b></a>
    </div>
    <div class="card-body">
      @error('email')
        <div class="alert alert-danger" role="alert">
          <strong>{{ $message }}</strong>
        </div>
      @enderror
      <form action="{{ route('do_login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" id="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Log In</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="{{ asset('template') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('template') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('template') }}/dist/js/adminlte.min.js"></script>
</body>
</html>
