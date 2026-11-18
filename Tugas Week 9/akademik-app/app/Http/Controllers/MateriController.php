<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\View\View;

class MateriController extends Controller
{
    // Lihat materi: boleh untuk semua role yang sudah login
    public function index(): View
    {
        return view('materi.index', ['materis' => Materi::latest()->get()]);
    }
}
