<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finance App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #198754 0%, #0d6efd 100%);
        }
        .hero-card {
            background: white;
            border-radius: 16px;
            padding: 3rem;
            max-width: 480px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="hero-card">
        <h1 class="mb-2">Personal Finance App</h1>
        <p class="text-muted mb-4">Track your income, expenses, and stay on top of your budget.</p>

        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg w-100">Go to Dashboard</a>
        @else
            <div class="d-flex gap-2">
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg flex-fill">Log in</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg flex-fill">Register</a>
            </div>
        @endauth
    </div>
</body>
</html>