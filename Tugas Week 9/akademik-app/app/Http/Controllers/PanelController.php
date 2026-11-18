<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PanelController extends Controller
{
    public function admin(): View
    {
        return view('panel', [
            'title' => 'PANEL ADMIN',
            'desc' => 'Kelola pengguna, mata kuliah, materi, dan nilai.',
            'stats' => [
                'PENGGUNA' => User::count(),
                'MATERI' => Materi::count(),
                'NILAI' => Nilai::count(),
            ],
        ]);
    }

    public function dosen(Request $request): View
    {
        return view('panel', [
            'title' => 'DASHBOARD DOSEN',
            'desc' => 'Kelola materi dan nilai mahasiswa.',
            'stats' => [
                'MATERI SAYA' => Materi::where('user_id', $request->user()->id)->count(),
                'MAHASISWA' => User::where('role', 'mahasiswa')->count(),
                'NILAI TERCATAT' => Nilai::count(),
            ],
        ]);
    }

    public function mahasiswa(Request $request): View
    {
        $nilai = Nilai::where('user_id', $request->user()->id);

        return view('panel', [
            'title' => 'DASHBOARD MAHASISWA',
            'desc' => 'Lihat materi dan nilai milik sendiri.',
            'stats' => [
                'MATERI TERSEDIA' => Materi::count(),
                'MATA KULIAH DINILAI' => (clone $nilai)->count(),
                'RATA-RATA' => round((float) (clone $nilai)->avg('score'), 1),
            ],
        ]);
    }
}
