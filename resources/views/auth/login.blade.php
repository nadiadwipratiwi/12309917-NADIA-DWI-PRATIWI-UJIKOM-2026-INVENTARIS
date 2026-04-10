<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f4f7f6;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .login-header {
            background: #2ecc71;
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 15px 15px 0 0;
        }
        .btn-green {
            background: #2ecc71;
            color: white;
            border: none;
            padding: 12px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-green:hover {
            background: #27ae60;
            color: white;
        }
        .form-control:focus {
            border-color: #2ecc71;
            box-shadow: 0 0 0 0.25rem rgba(46, 204, 113, 0.25);
        }
        .text-green {
            color: #2ecc71;
        }
    </style>
</head>
<body>

    <div class="card login-card">
        <div class="login-header">
            <h3 class="mb-0 fw-bold">LOGIN</h3>
        </div>
        <div class="card-body p-4">
            
            @if(session('error'))
                <div class="alert alert-danger py-2 small">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                        <input type="email" name="email" class="form-control border-start-0 bg-light" placeholder="email@contoh.com" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold small text-muted">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                        <input type="password" name="password" class="form-control border-start-0 bg-light" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-green shadow-sm rounded-pill">
                        LOGIN <i class="fas fa-sign-in-alt ms-2"></i>
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <p class="small text-muted mb-0">Lupa password? Hubungi Admin.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>