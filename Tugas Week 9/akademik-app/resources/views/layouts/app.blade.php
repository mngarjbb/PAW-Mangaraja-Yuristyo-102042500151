<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') — AKADEMIK OFFICIAL SITE</title>
    <link rel="stylesheet" href="{{ asset('css/akademik.css') }}">
</head>
<body>
<header class="site-header">
    <a href="{{ route('home') }}" class="logo">AKADEMIK<span>™</span></a>
    <input type="checkbox" id="nav-toggle" class="nav-toggle">
    <label for="nav-toggle" class="burger">☰</label>
    <nav class="main-nav">
        @auth
            <a href="{{ route('dashboard') }}">DASHBOARD</a>
            <a href="{{ route('materi.index') }}">MATERI</a>
            @if(auth()->user()->hasRole('admin', 'mahasiswa'))
                <a href="{{ route('nilai.saya') }}">NILAI SAYA</a>
            @endif
            @if(auth()->user()->hasRole('admin', 'dosen'))
                <a href="{{ route('kelola-materi.index') }}">KELOLA MATERI</a>
                <a href="{{ route('kelola-nilai.index') }}">KELOLA NILAI</a>
            @endif
            @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('admin.users.index') }}">PENGGUNA</a>
            @endif
        @else
            <a href="{{ route('home') }}#role">ROLE</a>
        @endauth
    </nav>
    <div class="auth-box">
        @auth
            <span class="badge">{{ strtoupper(auth()->user()->role) }}</span>
            <form method="POST" action="{{ route('logout') }}">@csrf<button class="link-btn" type="submit">LOGOUT</button></form>
        @else
            <a href="{{ route('login') }}" class="pill">JOIN / LOGIN</a>
        @endauth
    </div>
</header>

@if(session('status'))
    <div class="flash">{{ session('status') }}</div>
@endif

<main>
    @yield('content')
</main>

<footer class="site-footer">
    © 2026 – ALL RIGHTS RESERVED, AKADEMIK
    <br><br>
    <a href="#">TERMS OF USE</a>|<a href="#">PRIVACY POLICY</a>
</footer>
</body>
</html>
