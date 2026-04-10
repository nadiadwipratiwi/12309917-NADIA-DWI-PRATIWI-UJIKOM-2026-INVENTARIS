<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

    <style>
        :root {
            --primary-green: #2ecc71;
            --dark-green: #27ae60;
            --sidebar-bg: #1e272e;
        }

        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: var(--sidebar-bg);
            color: white;
            transition: 0.3s;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 20px;
            background: var(--dark-green);
            text-align: center;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .sidebar-divider {
            border-top: 2px solid rgba(255, 255, 255, 0.15);
            margin: 1rem 1rem;
        }

        .nav-link {
            color: #d1d8e0;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
            transition: 0.2s;
            border-left: 5px solid transparent;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.05);
            color: white;
            border-left: 5px solid var(--primary-green);
        }

        /* Main Content */
        .main-wrapper {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 15px 25px;
        }

        .profile-img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-green);
        }

        /* Card Custom */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .footer {
            background: white;
            padding: 15px;
            text-align: center;
            border-top: 1px solid #eee;
            margin-top: auto;
        }

        .text-green {
            color: var(--dark-green);
        }

        .bg-green {
            background-color: var(--primary-green);
            color: white;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -260px;
            }

            .main-wrapper {
                margin-left: 0;
            }

            .sidebar.active {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    @include('layouts.sidebar')

    <div class="main-wrapper">
        @include('layouts.navbar')

        <div class="p-4">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        <footer class="footer">
            <div class="text-muted small">
                &copy; 2026 <strong>Inventaris App</strong>. All rights reserved.
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
</body>

</html>
