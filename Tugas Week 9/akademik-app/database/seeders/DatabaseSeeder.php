<?php

namespace Database\Seeders;

use App\Models\Materi;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private function akun(string $name, string $email, string $role): User
    {
        $user = new User(['name' => $name, 'email' => $email, 'password' => 'password']);
        $user->role = $role; // role diset eksplisit oleh sistem, bukan mass-assignment
        $user->save();

        return $user;
    }

    public function run(): void
    {
        $this->akun('Admin Akademik', 'admin@akademik.test', 'admin');
        $dosen = $this->akun('Dosen Pengampu', 'dosen@akademik.test', 'dosen');
        $mhs1 = $this->akun('Mahasiswa Satu', 'mahasiswa@akademik.test', 'mahasiswa');
        $mhs2 = $this->akun('Mahasiswa Dua', 'mahasiswa2@akademik.test', 'mahasiswa');

        $materi = [
            ['Pengantar Middleware', 'Pemrograman Web', 'Konsep dan alur kerja middleware pada Laravel.'],
            ['Authentication vs Authorization', 'Pemrograman Web', 'Perbedaan autentikasi dan otorisasi.'],
            ['Role-Based Access Control', 'Pemrograman Web', 'Pembatasan akses berdasarkan role pengguna.'],
            ['Normalisasi Database', 'Sistem Basis Data', 'Bentuk normal 1NF sampai 3NF.'],
            ['Model OSI & TCP/IP', 'Jaringan Komputer', 'Lapisan dan fungsi protokol jaringan.'],
            ['Uji Hipotesis', 'Statistika', 'Prosedur uji hipotesis dan interpretasi p-value.'],
        ];
        foreach ($materi as [$title, $course, $desc]) {
            Materi::create(['title' => $title, 'course' => $course, 'description' => $desc, 'user_id' => $dosen->id]);
        }

        Nilai::create(['user_id' => $mhs1->id, 'course' => 'Pemrograman Web', 'score' => 88]);
        Nilai::create(['user_id' => $mhs1->id, 'course' => 'Sistem Basis Data', 'score' => 76]);
        Nilai::create(['user_id' => $mhs2->id, 'course' => 'Pemrograman Web', 'score' => 64]);
    }
}
