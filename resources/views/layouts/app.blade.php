<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistem Perpustakaan')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Perpustakaan</a>

            @auth
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}"
                           href="{{ route('categories.index') }}">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}"
                           href="{{ route('books.index') }}">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('members.*') ? 'active' : '' }}"
                           href="{{ route('members.index') }}">Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('borrowings.*') ? 'active' : '' }}"
                           href="{{ route('borrowings.index') }}">Peminjaman</a>
                    </li>
                    @if (auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                               href="{{ route('users.index') }}">Pengguna</a>
                        </li>
                    @endif
                </ul>

                <div class="d-flex align-items-center">
                    <span class="navbar-text me-3">
                        {{ auth()->user()->name }} ({{ auth()->user()->role }})
                    </span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    <main class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Data belum valid:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>