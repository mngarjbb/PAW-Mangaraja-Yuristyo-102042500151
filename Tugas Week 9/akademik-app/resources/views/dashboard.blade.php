@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
@php
    $u = $user;
    $menu = [
        ['Dashboard', 'Semua role', route('dashboard'), true, 'DB', 20],
        ['Lihat Materi', 'Semua role', route('materi.index'), true, 'LM', 200],
        ['Panel Admin', 'Admin', route('panel.admin'), $u->hasRole('admin'), 'AD', 340],
        ['Panel Dosen', 'Dosen', route('panel.dosen'), $u->hasRole('dosen'), 'DS', 160],
        ['Panel Mahasiswa', 'Mahasiswa', route('panel.mahasiswa'), $u->hasRole('mahasiswa'), 'MH', 280],
        ['Manajemen Pengguna', 'Admin', route('admin.users.index'), $u->hasRole('admin'), 'MP', 40],
        ['Kelola Materi', 'Admin · Dosen', route('kelola-materi.index'), $u->hasRole('admin', 'dosen'), 'KM', 100],
        ['Kelola Nilai', 'Admin · Dosen', route('kelola-nilai.index'), $u->hasRole('admin', 'dosen'), 'KN', 250],
        ['Nilai Saya', 'Admin · Mahasiswa', route('nilai.saya'), $u->hasRole('admin', 'mahasiswa'), 'NS', 320],
    ];
@endphp
<section class="section">
    <h1 class="section-title">DASHBOARD</h1>
    <p class="sub">HALO, {{ strtoupper($u->name) }} — ROLE: {{ strtoupper($u->role) }}</p>
    <div class="grid">
        @foreach($menu as [$label, $who, $url, $allowed, $code, $hue])
            @if($allowed)
                <a class="tile" href="{{ $url }}">
                    <div class="cover" style="--h:{{ $hue }}">{{ $code }}</div>
                    <em>{{ $label }}</em><small>{{ $who }}</small>
                </a>
            @endif
        @endforeach
    </div>
</section>
@endsection
