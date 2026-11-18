@extends('layouts.app')
@section('title', $title)
@section('content')
<section class="section">
    <h1 class="section-title">{{ $title }}</h1>
    <p class="sub">{{ strtoupper($desc) }}</p>
    <div class="stats">
        @foreach($stats as $label => $value)
            <div class="stat"><b>{{ $value }}</b><span>{{ $label }}</span></div>
        @endforeach
    </div>
    <a class="btn ghost" href="{{ route('dashboard') }}">← KEMBALI KE DASHBOARD</a>
</section>
@endsection
