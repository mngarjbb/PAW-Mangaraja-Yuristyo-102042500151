@extends('layouts.app')
@section('title', $user->exists ? 'Edit Pengguna' : 'Tambah Pengguna')
@section('content')
<section class="section narrow">
    <h1 class="section-title">{{ $user->exists ? 'EDIT PENGGUNA' : 'TAMBAH PENGGUNA' }}</h1>
    <form method="POST" class="form"
          action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}">
        @csrf
        @if($user->exists) @method('PUT') @endif
        <label>NAMA
            <input name="name" value="{{ old('name', $user->name) }}" required>
        </label>
        @error('name')<p class="error">{{ $message }}</p>@enderror
        <label>EMAIL
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </label>
        @error('email')<p class="error">{{ $message }}</p>@enderror
        <label>PASSWORD {{ $user->exists ? '(KOSONGKAN JIKA TIDAK DIGANTI)' : '' }}
            <input type="password" name="password" {{ $user->exists ? '' : 'required' }}>
        </label>
        @error('password')<p class="error">{{ $message }}</p>@enderror
        <label>ROLE
            <select name="role" required>
                @foreach(\App\Models\User::ROLES as $r)
                    <option value="{{ $r }}" @selected(old('role', $user->role ?? 'mahasiswa') === $r)>{{ strtoupper($r) }}</option>
                @endforeach
            </select>
        </label>
        @error('role')<p class="error">{{ $message }}</p>@enderror
        <button class="btn" type="submit">SIMPAN</button>
        <a class="btn ghost" href="{{ route('admin.users.index') }}" style="text-align:center">BATAL</a>
    </form>
</section>
@endsection
