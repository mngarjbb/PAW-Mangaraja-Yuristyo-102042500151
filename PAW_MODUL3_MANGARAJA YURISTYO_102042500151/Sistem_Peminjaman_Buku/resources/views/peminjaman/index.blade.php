
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Daftar Peminjaman</h2>
        <p class="text-muted mb-0">
            Kelola transaksi peminjaman dan pengembalian buku.
        </p>
    </div>
    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Peminjaman
    </a>
</div>

{{-- Pesan sukses atau error --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-3" style="width: 50px;">No</th>
                        <th>Nama Anggota</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th class="text-center">Status</th>
                        <th class="text-end pe-3" style="width: 220px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($peminjaman as $index => $item)
                        <tr>
                            {{-- Nomor --}}
                            <td class="ps-3">
                                {{ $peminjaman->firstItem() + $index }}
                            </td>

                            {{-- Nama Anggota --}}
                            <td>
                                {{ $item->anggota->nama ?? 'Anggota tidak tersedia' }}
                            </td>

                            {{-- Judul Buku --}}
                            <td>
                                {{ $item->buku->judul ?? 'Buku tidak tersedia' }}
                            </td>

                            {{-- Tanggal Pinjam --}}
                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}
                            </td>

                            {{-- Tanggal Kembali --}}
                            <td>
                                @if ($item->tanggal_kembali)
                                    {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') }}
                                @else
                                    <span class="text-muted">Belum kembali</span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td class="text-center">
                                @if ($item->status === 'Dipinjam')
                                    <span class="badge bg-warning text-dark">
                                        Dipinjam
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        Dikembalikan
                                    </span>
                                @endif
                            </td>

                            {{-- Tombol Aksi --}}
                            <td class="text-end pe-3">
                                <div class="d-flex justify-content-end gap-1">
                                    @if ($item->status === 'Dipinjam')
                                        <form
                                            action="{{ route('peminjaman.kembali', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin mengembalikan buku ini?')"
                                        >
                                            @csrf
                                            @method('PUT')

                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="bi bi-check-circle me-1"></i>
                                                Kembalikan
                                            </button>
                                        </form>
                                    @endif

                                    <form
                                        action="{{ route('peminjaman.destroy', $item->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash me-1"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-journal-x fs-2 text-muted"></i>
                                <p class="text-muted mt-2 mb-0">
                                    Belum ada data peminjaman buku.
                                </p>
                                <a
                                    href="{{ route('peminjaman.create') }}"
                                    class="btn btn-sm btn-primary mt-3"
                                >
                                    Tambah Peminjaman
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($peminjaman->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $peminjaman->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
