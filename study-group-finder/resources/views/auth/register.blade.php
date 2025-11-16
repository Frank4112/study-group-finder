<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="/css/auth.css">
</head>
<body>

<div class="auth-container">
    <h2>Register</h2>

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

    <form method="POST" action="{{ route('register.perform') }}">
        @csrf

        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Major</label>
        <input type="text" name="major" value="{{ old('major') }}" required>

        <label>Year of Study</label>
        <input type="text" name="year_of_study" value="{{ old('year_of_study') }}" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Create Account</button>
    </form>

    <div class="link">
        Already have an account? <a href="{{ route('login.show') }}">Login</a>
    </div>
</div>

</body>
</html>