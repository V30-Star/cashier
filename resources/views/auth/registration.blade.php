<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }

        .form-signin {
            width: 100%;
            max-width: 380px;
            padding: 20px;
            margin: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .form-signin h1 {
            margin-bottom: 20px;
        }

        .btn {
            margin-top: 10px;
        }

        .text-body-secondary {
            color: #6c757d !important;
        }
    </style>
</head>

<body>

    <form class="form-signin" method="POST" action="{{ route('register.action') }}">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Please Registration</h1>

        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                name="username" placeholder="Username" value="{{ old('username') }}">
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" placeholder="Password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror"
                id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
            @error('confirmPassword')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Registration</button>
        <a class="btn btn-secondary w-100 py-2" href="{{ route('login') }}">Login</a>
        <p class="mt-5 mb-3 text-body-secondary">© 2024 | Hohoho</p>
    </form>

</body>

</html>
