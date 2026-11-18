@extends('layouts.app')
@section('title', $nilai->exists ? 'Edit Nilai' : 'Tambah Nilai')
@section('content')
<section class="section narrow">
    <h1 class="section-title">{{ $nilai->exists ? 'EDIT NILAI' : 'TAMBAH NILAI' }}</h1>
    <form method="POST" class="form"
          action="{{ $nilai->exists ? route('kelola-nilai.update', $nilai) : route('kelola-nilai.store') }}">
        @csrf
        @if($nilai->exists) @method('PUT') @endif
        <label>MAHASISWA
            <select name="user_id" required>
                <option value="">— pilih —</option>
                @foreach($mahasiswa as $m)
                    <option value="{{ $m->id }}" @selected(old('user_id', $nilai->user_id) == $m->id)>{{ $m->name }}</option>
                @endforeach
            </select>
        </label>
        @error('user_id')<p class="error">{{ $message }}</p>@enderror
        <label>MATA KULIAH
            <input name="course" value="{{ old('course', $nilai->course) }}" required>
        </label>
        @error('course')<p class="error">{{ $message }}</p>@enderror
        <label>NILAI (0–100)
            <input type="number" name="score" min="0" max="100" value="{{ old('score', $nilai->score) }}" required>
        </label>
        @error('score')<p class="error">{{ $message }}</p>@enderror
        <button class="btn" type="submit">SIMPAN</button>
        <a class="btn ghost" href="{{ route('kelola-nilai.index') }}" style="text-align:center">BATAL</a>
    </form>
</section>
@endsection
