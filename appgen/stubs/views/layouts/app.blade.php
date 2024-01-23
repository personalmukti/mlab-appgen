<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Page | Mlab Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand mb-0 h1">MLAB Generator</span>
        </div>
    </nav>

    {{-- Content --}}
    <main class="flex-shrink-0">
        <div class="container py-3">
            <div class="row">
                {{-- Sidebar --}}
                <aside class="col-md-3">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="{{ url('/') }}" class="text-decoration-none text-dark">DASHBOARD</a>
                        </li>
                        <li class="list-group-item">
                            <a href="crud-manager" class="text-decoration-none text-dark">CRUD</a>
                        </li>
                        <li class="list-group-item">
                            <a href="user-manager" class="text-decoration-none text-dark">USER & PERMISSION</a>
                        </li>
                    </ul>
                </aside>

                {{-- Main Content --}}
                <div class="col-md-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            Copyright &copy; 2024. Developed by : MLab App Generator.
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
