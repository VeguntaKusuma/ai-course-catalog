<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
            <div class="text-center mb-4">
                <h1 class="h3 mb-1">Admin Login</h1>
                <div class="text-muted">Sign in to manage courses</div>
            </div>

            <div class="card shadow-sm">
    <div class="card-body p-4">

        {{-- ✅ Show global error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
    type="text"
    id="email"
    name="email"
    class="form-control"
    value="{{ old('email') }}"
>

<div class="invalid-feedback" id="emailError"></div>
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
    type="password"
    id="password"
    name="password"
    class="form-control"
>

<div class="invalid-feedback" id="passwordError"></div>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="btn btn-primary w-100">
                Login
            </button>

        </form>
    </div>
</div>

            <!-- <div class="card shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                required
                                autofocus
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Login
                        </button>
                    </form>
                </div>
            </div> -->
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const email = document.getElementById('email');
    const password = document.getElementById('password');

    function validateEmail() {
        const regex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;

        if (!regex.test(email.value.trim())) {
            setError(email, 'Enter a valid email');
            return false;
        }

        setSuccess(email);
        return true;
    }

    function validatePassword() {
        if (password.value.trim().length < 6) {
            setError(password, 'Password must be at least 6 characters');
            return false;
        }

        setSuccess(password);
        return true;
    }

    function setError(input, message) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        document.getElementById(input.id + 'Error').textContent = message;
    }

    function setSuccess(input) {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        document.getElementById(input.id + 'Error').textContent = '';
    }

    email.addEventListener('input', validateEmail);
    password.addEventListener('input', validatePassword);

});
</script>

