@section('title', 'Login')

<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.head')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h4>Kompensasi <b>JTI</b> Polinema</h4>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}"
                                placeholder="Username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        @error('username')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <p class="mb-1">
                                <a href="forgot-password.html">I forgot my password</a>
                            </p>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>

                @if (session('error'))
                    <div class="alert alert-danger mt-3">
                        <small class="text-light my-2">{{ session('error') }}</small>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        <small class="text-light my-2">{{ session('success') }}</small>
                    </div>
                @endif

            </div>
        </div>
    </div>

    @include('layouts.partials.foot')
</body>

</html>