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
            max-width: 330px;
            padding: 15px;
            margin: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-signin h1 {
            margin-bottom: 15px;
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

    <form class="form-signin" method="POST" action="{{ route('login.action') }}">
        @csrf

        @if (session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                value="{{ old('username') }}">
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
        <a class="btn btn-primary w-100 py-2" href="{{ route('register') }}">Registration</a>
        <p class="mt-5 mb-3 text-body-secondary">© 2024 | Hohoho</p>

    </form>

</body>

</html>
