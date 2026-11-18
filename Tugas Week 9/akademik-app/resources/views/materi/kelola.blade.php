@extends('layouts.app')
@section('title', 'Kelola Materi')
@section('content')
<section class="section">
    <div class="toolbar">
        <h1 class="section-title" style="margin:0">KELOLA MATERI</h1>
        <a class="btn" href="{{ route('kelola-materi.create') }}">+ TAMBAH</a>
    </div>
    <table>
        <thead><tr><th>JUDUL</th><th>MATA KULIAH</th><th>PENGUNGGAH</th><th></th></tr></thead>
        <tbody>
        @forelse($materis as $m)
            <tr>
                <td>{{ $m->title }}</td>
                <td>{{ $m->course }}</td>
                <td>{{ $m->pengunggah?->name }}</td>
                <td class="actions">
                    <a href="{{ route('kelola-materi.edit', $m) }}">EDIT</a>
                    <form method="POST" action="{{ route('kelola-materi.destroy', $m) }}" onsubmit="return confirm('Hapus materi ini?')">
                        @csrf @method('DELETE')
                        <button class="link-btn danger" type="submit">HAPUS</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="empty">BELUM ADA MATERI.</td></tr>
        @endforelse
        </tbody>
    </table>
</section>
@endsection
