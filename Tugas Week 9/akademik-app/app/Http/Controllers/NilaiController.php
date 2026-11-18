<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NilaiController extends Controller
{
    // Lihat nilai PRIBADI: query selalu dibatasi ke user yang login (bukan dari parameter URL)
    public function saya(Request $request): View
    {
        return view('nilai.saya', [
            'nilais' => Nilai::where('user_id', $request->user()->id)->latest()->get(),
        ]);
    }
}
