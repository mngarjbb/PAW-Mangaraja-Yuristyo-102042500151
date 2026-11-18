@extends('layouts.app')
@section('title', 'Materi')
@section('content')
<section class="section">
    <h1 class="section-title">MATERI</h1>
    @forelse($materis as $m)
        @if($loop->first)<div class="grid">@endif
        <div class="tile" title="{{ $m->description }}">
            <div class="cover" style="--h:{{ ($m->id * 47) % 360 }}">{{ strtoupper(mb_substr($m->course, 0, 2)) }}</div>
            <em>{{ $m->title }}</em><small>{{ $m->course }}</small>
        </div>
        @if($loop->last)</div>@endif
    @empty
        <p class="empty">BELUM ADA MATERI.</p>
    @endforelse
</section>
@endsection
