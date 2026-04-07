@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header')
    <h3 class="text-center font-weight-bold">Welcome Back 👋</h3>
    <p class="text-center text-muted">Silakan login ke Laundry App</p>
@stop

@section('auth_body')

<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

/* GLOBAL */
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(-45deg, #4f46e5, #9333ea, #22c55e, #06b6d4);
    background-size: 400% 400%;
    animation: gradientMove 12s ease infinite;
}

/* ANIMASI BACKGROUND */
@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* CARD LOGIN */
.login-box .card {
    border-radius: 20px;
    backdrop-filter: blur(10px);
    background: rgba(255,255,255,0.9);
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    transition: 0.3s;
}

.login-box .card:hover {
    transform: translateY(-5px);
}

/* INPUT */
.form-control {
    border-radius: 10px;
}

.input-group-text {
    border-radius: 0 10px 10px 0;
}

/* BUTTON */
.btn-primary {
    border-radius: 10px;
    background: linear-gradient(90deg, #4f46e5, #9333ea);
    border: none;
    transition: 0.3s;
}

.btn-primary:hover {
    transform: scale(1.05);
    background: linear-gradient(90deg, #6366f1, #a855f7);
}

/* CHECKBOX */
.icheck-primary label {
    font-size: 14px;
}

/* LINK */
a {
    color: #6366f1;
}

a:hover {
    color: #4f46e5;
    text-decoration: underline;
}

</style>

<form action="{{ route('login') }}" method="POST">
    @csrf

    {{-- Email --}}
    <div class="input-group mb-3">
        <input type="email" name="email"
            class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') }}"
            placeholder="Email">

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>

        @error('email')
        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    {{-- Password --}}
    <div class="input-group mb-3">
        <input type="password" name="password"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="Password">

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>

        @error('password')
        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="row">
        <div class="col-7">
            <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-block mt-3">
        🚀 Login Sekarang
    </button>

</form>
@stop

@section('auth_footer')

@if (Route::has('password.request'))
<p class="text-center mt-2">
    <a href="{{ route('password.request') }}">Lupa password?</a>
</p>
@endif

@if (Route::has('register'))
<p class="text-center">
    Belum punya akun?
    <a href="{{ route('register') }}"><b>Daftar</b></a>
</p>
@endif

@stop