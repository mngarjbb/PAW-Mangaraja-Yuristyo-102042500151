# Tugas Praktikum W9 — Middleware & Pembatasan Hak Akses (Laravel 12)

Aplikasi akademik dengan 3 role (Admin, Dosen, Mahasiswa). Tampilan mengikuti gaya partyomo.com
(tema gelap, tipografi kapital, grid cover, aksen oranye).

## Cara pasang (overlay ke project Laravel baru)
```bash
composer create-project laravel/laravel akademik-app
cd akademik-app
# salin SEMUA isi zip ini ke folder akademik-app (timpa file yang sama: bootstrap/app.php, routes/web.php, app/Models/User.php, DatabaseSeeder.php, welcome.blade.php)
```
Atur `.env` (contoh MySQL; atau biarkan SQLite bawaan Laravel 12):
```
DB_CONNECTION=mysql
DB_DATABASE=akademik_app
DB_USERNAME=root
DB_PASSWORD=
```
```bash
php artisan migrate --seed
php artisan serve
php artisan route:list      # cek middleware tiap route
php artisan test            # jalankan pengujian otomatis
```

## Akun uji (password: `password`)
| Role | Email |
|---|---|
| Admin | admin@akademik.test |
| Dosen | dosen@akademik.test |
| Mahasiswa | mahasiswa@akademik.test |
| Mahasiswa 2 | mahasiswa2@akademik.test |

## Pemetaan ke slide 18
- Login/logout + kolom `role` pada `users` -> `AuthController`, migration `add_role_to_users_table`
- Middleware `CheckRole` + alias `role` -> `app/Http/Middleware/CheckRole.php`, `bootstrap/app.php`
- Route manajemen pengguna / materi / nilai dilindungi -> `routes/web.php`
- Uji >= 3 akun -> `tests/Feature/RoleAccessTest.php` + tabel di bawah

## Matriks akses
| Halaman | Admin | Dosen | Mahasiswa |
|---|---|---|---|
| /dashboard, /materi | ✓ | ✓ | ✓ |
| /admin, /admin/users | ✓ | 403 | 403 |
| /dosen | 403 | ✓ | 403 |
| /mahasiswa | 403 | 403 | ✓ |
| /kelola-materi, /kelola-nilai | ✓ | ✓ | 403 |
| /nilai-saya | ✓ | 403 | ✓ |
| Belum login (semua di atas) | redirect ke /login | | |

## Tabel dokumentasi pengujian (isi kolom "Hasil aktual" setelah dijalankan)
| Pengguna | URL | Diharapkan | Hasil aktual |
|---|---|---|---|
| Admin | /admin | Diizinkan | |
| Admin | /kelola-materi | Diizinkan | |
| Dosen | /dosen | Diizinkan | |
| Dosen | /admin | Ditolak (403) | |
| Mahasiswa | /mahasiswa | Diizinkan | |
| Mahasiswa | /kelola-materi | Ditolak (403) | |
| Belum login | /admin | Dialihkan ke login | |

## Catatan keamanan
- `role` tidak ada di `$fillable`; hanya diset oleh seeder/admin (`UserController`).
- Nilai pribadi selalu di-query dari `auth user`, bukan dari parameter URL.
- Tidak ada registrasi publik; akun dibuat oleh admin.
