<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class KelolaNilaiController extends Controller
{
    private function rules(Request $request): array
    {
        return $request->validate([
            'user_id' => ['required', Rule::exists('users', 'id')->where('role', 'mahasiswa')],
            'course' => ['required', 'string', 'max:100'],
            'score' => ['required', 'integer', 'between:0,100'],
        ]);
    }

    private function mahasiswa()
    {
        return User::where('role', 'mahasiswa')->orderBy('name')->get();
    }

    public function index(): View
    {
        return view('nilai.kelola', ['nilais' => Nilai::with('mahasiswa')->latest()->get()]);
    }

    public function create(): View
    {
        return view('nilai.form', ['nilai' => new Nilai, 'mahasiswa' => $this->mahasiswa()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Nilai::create($this->rules($request));

        return redirect()->route('kelola-nilai.index')->with('status', 'Nilai berhasil ditambahkan.');
    }

    public function edit(Nilai $nilai): View
    {
        return view('nilai.form', ['nilai' => $nilai, 'mahasiswa' => $this->mahasiswa()]);
    }

    public function update(Request $request, Nilai $nilai): RedirectResponse
    {
        $nilai->update($this->rules($request));

        return redirect()->route('kelola-nilai.index')->with('status', 'Nilai berhasil diperbarui.');
    }

    public function destroy(Nilai $nilai): RedirectResponse
    {
        $nilai->delete();

        return redirect()->route('kelola-nilai.index')->with('status', 'Nilai dihapus.');
    }
}
