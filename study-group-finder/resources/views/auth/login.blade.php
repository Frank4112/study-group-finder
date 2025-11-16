
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="/css/auth.css">
</head>
<body>

<div class="auth-container">
    <h2>Login</h2>

    @if (session('success'))
        <div style="color:green; margin-bottom:10px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color:red; margin-bottom:10px;">
            <strong>There were some problems:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.perform') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" required value="{{ old('email') }}">

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <div class="link">
        Don’t have an account? <a href="{{ route('register.show') }}">Register</a>
    </div>
</div>

</body>
</html>