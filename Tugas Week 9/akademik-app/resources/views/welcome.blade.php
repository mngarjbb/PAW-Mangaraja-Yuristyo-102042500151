@extends('layouts.app')
@section('title', 'Beranda')
@section('content')
<section class="hero">
    <h1>AKADEMIK</h1>
    <p>PORTAL MATERI &amp; NILAI — AKSES SESUAI ROLE</p>
    @auth
        <a class="cta" href="{{ route('dashboard') }}">BUKA DASHBOARD →</a>
    @else
        <a class="cta" href="{{ route('login') }}">MASUK SEKARANG →</a>
    @endauth
</section>

<section class="section" id="role">
    <h2 class="section-title">ROLE</h2>
    <div class="grid">
        <div class="tile"><div class="cover" style="--h:20">AD</div><em>Admin</em><small>Pengguna · Materi · Nilai</small></div>
        <div class="tile"><div class="cover" style="--h:200">DS</div><em>Dosen</em><small>Kelola materi &amp; nilai</small></div>
        <div class="tile"><div class="cover" style="--h:280">MH</div><em>Mahasiswa</em><small>Lihat materi &amp; nilai sendiri</small></div>
    </div>
</section>
@endsection
