<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KelolaMateriController extends Controller
{
    private function rules(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'course' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);
    }

    public function index(): View
    {
        return view('materi.kelola', ['materis' => Materi::with('pengunggah')->latest()->get()]);
    }

    public function create(): View
    {
        return view('materi.form', ['materi' => new Materi]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->rules($request);
        $data['user_id'] = $request->user()->id;
        Materi::create($data);

        return redirect()->route('kelola-materi.index')->with('status', 'Materi berhasil ditambahkan.');
    }

    public function edit(Materi $materi): View
    {
        return view('materi.form', compact('materi'));
    }

    public function update(Request $request, Materi $materi): RedirectResponse
    {
        $materi->update($this->rules($request));

        return redirect()->route('kelola-materi.index')->with('status', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi): RedirectResponse
    {
        $materi->delete();

        return redirect()->route('kelola-materi.index')->with('status', 'Materi dihapus.');
    }
}
