@extends('layouts.app')
@section('title', '403')
@section('content')
<section class="err403">
    <h1>403</h1>
    <p>{{ strtoupper($exception->getMessage() ?: 'Anda tidak memiliki hak akses!') }}</p>
    @auth
        <a class="btn" href="{{ route('dashboard') }}">KEMBALI KE DASHBOARD</a>
    @else
        <a class="btn" href="{{ route('login') }}">LOGIN</a>
    @endauth
</section>
@endsection
