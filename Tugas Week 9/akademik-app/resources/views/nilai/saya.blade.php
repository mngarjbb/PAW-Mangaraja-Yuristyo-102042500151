@extends('layouts.app')
@section('title', 'Nilai Saya')
@section('content')
<section class="section">
    <h1 class="section-title">NILAI SAYA</h1>
    <table>
        <thead><tr><th>MATA KULIAH</th><th>NILAI</th><th>GRADE</th></tr></thead>
        <tbody>
        @forelse($nilais as $n)
            <tr><td>{{ $n->course }}</td><td>{{ $n->score }}</td><td>{{ $n->grade }}</td></tr>
        @empty
            <tr><td colspan="3" class="empty">BELUM ADA NILAI.</td></tr>
        @endforelse
        </tbody>
    </table>
</section>
@endsection
