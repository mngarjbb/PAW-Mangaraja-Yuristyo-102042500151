@extends('layouts.app')
@section('title', $materi->exists ? 'Edit Materi' : 'Tambah Materi')
@section('content')
<section class="section narrow">
    <h1 class="section-title">{{ $materi->exists ? 'EDIT MATERI' : 'TAMBAH MATERI' }}</h1>
    <form method="POST" class="form"
          action="{{ $materi->exists ? route('kelola-materi.update', $materi) : route('kelola-materi.store') }}">
        @csrf
        @if($materi->exists) @method('PUT') @endif
        <label>JUDUL
            <input name="title" value="{{ old('title', $materi->title) }}" required>
        </label>
        @error('title')<p class="error">{{ $message }}</p>@enderror
        <label>MATA KULIAH
            <input name="course" value="{{ old('course', $materi->course) }}" required>
        </label>
        @error('course')<p class="error">{{ $message }}</p>@enderror
        <label>DESKRIPSI
            <textarea name="description" rows="4">{{ old('description', $materi->description) }}</textarea>
        </label>
        @error('description')<p class="error">{{ $message }}</p>@enderror
        <button class="btn" type="submit">SIMPAN</button>
        <a class="btn ghost" href="{{ route('kelola-materi.index') }}" style="text-align:center">BATAL</a>
    </form>
</section>
@endsection
