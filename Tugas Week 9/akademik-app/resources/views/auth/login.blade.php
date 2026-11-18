@extends('layouts.app')
@section('title', 'Login')
@section('content')
<section class="section narrow">
    <h1 class="section-title">JOIN / LOGIN</h1>
    <form method="POST" action="{{ route('login.attempt') }}" class="form">
        @csrf
        <label>EMAIL ADDRESS
            <input type="email" name="email" value="{{ old('email') }}" required autofocus>
        </label>
        @error('email')<p class="error">{{ $message }}</p>@enderror
        <label>PASSWORD
            <input type="password" name="password" required>
        </label>
        <label style="flex-direction:row;align-items:center;gap:.6rem">
            <input type="checkbox" name="remember" value="1" style="width:auto"> INGAT SAYA
        </label>
        <button class="btn" type="submit">MASUK</button>
    </form>
</section>
@endsection
