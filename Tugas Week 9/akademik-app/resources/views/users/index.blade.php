@extends('layouts.app')
@section('title', 'Manajemen Pengguna')
@section('content')
<section class="section">
    <div class="toolbar">
        <h1 class="section-title" style="margin:0">PENGGUNA</h1>
        <a class="btn" href="{{ route('admin.users.create') }}">+ TAMBAH</a>
    </div>
    <table>
        <thead><tr><th>NAMA</th><th>EMAIL</th><th>ROLE</th><th></th></tr></thead>
        <tbody>
        @foreach($users as $u)
            <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td><span class="badge">{{ strtoupper($u->role) }}</span></td>
                <td class="actions">
                    <a href="{{ route('admin.users.edit', $u) }}">EDIT</a>
                    @unless($u->is(auth()->user()))
                        <form method="POST" action="{{ route('admin.users.destroy', $u) }}" onsubmit="return confirm('Hapus pengguna ini?')">
                            @csrf @method('DELETE')
                            <button class="link-btn danger" type="submit">HAPUS</button>
                        </form>
                    @endunless
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</section>
@endsection
