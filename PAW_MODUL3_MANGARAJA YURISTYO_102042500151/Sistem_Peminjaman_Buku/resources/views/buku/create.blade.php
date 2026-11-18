
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold mb-1">Tambah Buku Baru</h3>
                <p class="text-muted small mb-0">
                    Isi formulir berikut untuk menambahkan buku ke sistem perpustakaan.
                </p>
            </div>
            <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('buku.store') }}" method="POST">
                    @csrf

                    {{-- Input Judul Buku --}}
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Buku</label>
                        <input
                            type="text"
                            name="judul"
                            id="judul"
                            class="form-control @error('judul') is-invalid @enderror"
                            value="{{ old('judul') }}"
                            maxlength="100"
                            required
                        >
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Penulis --}}
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input
                            type="text"
                            name="penulis"
                            id="penulis"
                            class="form-control @error('penulis') is-invalid @enderror"
                            value="{{ old('penulis') }}"
                            maxlength="100"
                            required
                        >
                        @error('penulis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Penerbit --}}
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input
                            type="text"
                            name="penerbit"
                            id="penerbit"
                            class="form-control @error('penerbit') is-invalid @enderror"
                            value="{{ old('penerbit') }}"
                            maxlength="100"
                            required
                        >
                        @error('penerbit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Tahun Terbit --}}
                    <div class="mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input
                            type="number"
                            name="tahun_terbit"
                            id="tahun_terbit"
                            class="form-control @error('tahun_terbit') is-invalid @enderror"
                            value="{{ old('tahun_terbit') }}"
                            min="1000"
                            max="9999"
                            required
                        >
                        @error('tahun_terbit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Stok --}}
                    <div class="mb-4">
                        <label for="stok" class="form-label">Stok Buku</label>
                        <input
                            type="number"
                            name="stok"
                            id="stok"
                            class="form-control @error('stok') is-invalid @enderror"
                            value="{{ old('stok', 0) }}"
                            min="0"
                            required
                        >
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('buku.index') }}" class="btn btn-light">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
