@extends('layouts.app')
@section('title', 'Kelola Nilai')
@section('content')
<section class="section">
    <div class="toolbar">
        <h1 class="section-title" style="margin:0">KELOLA NILAI</h1>
        <a class="btn" href="{{ route('kelola-nilai.create') }}">+ TAMBAH</a>
    </div>
    <table>
        <thead><tr><th>MAHASISWA</th><th>MATA KULIAH</th><th>NILAI</th><th>GRADE</th><th></th></tr></thead>
        <tbody>
        @forelse($nilais as $n)
            <tr>
                <td>{{ $n->mahasiswa?->name }}</td>
                <td>{{ $n->course }}</td>
                <td>{{ $n->score }}</td>
                <td>{{ $n->grade }}</td>
                <td class="actions">
                    <a href="{{ route('kelola-nilai.edit', $n) }}">EDIT</a>
                    <form method="POST" action="{{ route('kelola-nilai.destroy', $n) }}" onsubmit="return confirm('Hapus nilai ini?')">
                        @csrf @method('DELETE')
                        <button class="link-btn danger" type="submit">HAPUS</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="empty">BELUM ADA NILAI.</td></tr>
        @endforelse
        </tbody>
    </table>
</section>
@endsection
