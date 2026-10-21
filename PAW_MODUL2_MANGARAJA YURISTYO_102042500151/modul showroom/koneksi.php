<?php
// Sesuaikan akun, sandi, dan nama database dengan komputer Anda.
// 127.0.0.1 memakai port TCP yang sama di Windows dan Mac.


// =====================================================================
// TODO 1 - Membuat koneksi ke database MySQL
// Ganti setiap ___1x___ (termasuk garis bawahnya) dengan nilai yang benar:
//   127.0.0.1 = alamat host     -> komputer sendiri: 127.0.0.1
//   root = username MySQL  -> bawaan XAMPP/Laragon: root
//    = password MySQL  -> bawaan XAMPP/Laragon: kosong, jadi tulis ''
//   paw_modul2_showroom = nama database   -> lihat baris CREATE DATABASE di database.sql
// =====================================================================
$conn = mysqli_connect('127.0.0.1', 'root', '', 'paw_modul2_showroom');


// =====================================================================
// TODO 2 - Mengatur charset koneksi
//   utf8mb4 = nama charset -> samakan dengan CHARACTER SET di database.sql
// =====================================================================
mysqli_set_charset($conn, 'utf8mb4');
