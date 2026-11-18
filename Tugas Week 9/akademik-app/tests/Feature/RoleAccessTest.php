<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Pengujian pembatasan akses berdasarkan role (sesuai tabel skenario slide 15).
 * Jalankan: php artisan test
 */
class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    private function loginSebagai(string $role): static
    {
        return $this->actingAs(User::factory()->create(['role' => $role]));
    }

    public function test_admin_boleh_ke_admin(): void
    {
        $this->loginSebagai('admin')->get('/admin')->assertOk();
    }

    public function test_admin_boleh_ke_kelola_materi(): void
    {
        $this->loginSebagai('admin')->get('/kelola-materi')->assertOk();
    }

    public function test_dosen_boleh_ke_dosen(): void
    {
        $this->loginSebagai('dosen')->get('/dosen')->assertOk();
    }

    public function test_dosen_ditolak_ke_admin(): void
    {
        $this->loginSebagai('dosen')->get('/admin')->assertForbidden();
    }

    public function test_mahasiswa_boleh_ke_mahasiswa(): void
    {
        $this->loginSebagai('mahasiswa')->get('/mahasiswa')->assertOk();
    }

    public function test_mahasiswa_ditolak_ke_kelola_materi(): void
    {
        $this->loginSebagai('mahasiswa')->get('/kelola-materi')->assertForbidden();
    }

    public function test_belum_login_dialihkan_ke_login(): void
    {
        $this->get('/admin')->assertRedirect(route('login'));
    }

    public function test_hanya_admin_boleh_manajemen_pengguna(): void
    {
        $this->loginSebagai('dosen')->get('/admin/users')->assertForbidden();
        $this->loginSebagai('mahasiswa')->get('/admin/users')->assertForbidden();
        $this->loginSebagai('admin')->get('/admin/users')->assertOk();
    }

    public function test_mahasiswa_boleh_lihat_materi_dan_nilai_sendiri(): void
    {
        $this->loginSebagai('mahasiswa')->get('/materi')->assertOk();
        $this->loginSebagai('mahasiswa')->get('/nilai-saya')->assertOk();
    }

    public function test_dosen_ditolak_lihat_nilai_pribadi(): void
    {
        $this->loginSebagai('dosen')->get('/nilai-saya')->assertForbidden();
    }

    public function test_role_tidak_bisa_diisi_dari_input_pengguna(): void
    {
        $user = new User(['name' => 'X', 'email' => 'x@x.test', 'password' => 'password', 'role' => 'admin']);
        $user->save();

        $this->assertSame('mahasiswa', $user->fresh()->role); // role di-abaikan -> default
    }
}
