<?php
/* =====================================================
   CIA STORE - Katalog Produk
   HTML + CSS + PHP Native
   ===================================================== */

// 1. DATA PRODUK (disimpan dalam array PHP)
$produk = [
    ["nama" => "Laptop Ultrabook 14\"",     "kategori" => "Laptop",     "harga" => 8500000, "stok" => 5,  "gambar" => "https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=600&h=600&fit=crop&q=80"],
    ["nama" => "Smartphone Nova X",          "kategori" => "Smartphone", "harga" => 3200000, "stok" => 12, "gambar" => "https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=600&h=600&fit=crop&q=80"],
    ["nama" => "Headphone Wireless ANC",     "kategori" => "Audio",      "harga" => 1250000, "stok" => 0,  "gambar" => "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&h=600&fit=crop&q=80"],
    ["nama" => "Mechanical Keyboard 75%",    "kategori" => "Aksesoris",  "harga" => 750000,  "stok" => 20, "gambar" => "https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=600&h=600&fit=crop&q=80"],
    ["nama" => "Mouse Gaming Ringan",        "kategori" => "Aksesoris",  "harga" => 350000,  "stok" => 0,  "gambar" => "https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=600&h=600&fit=crop&q=80"],
    ["nama" => "Smartwatch Pulse 2",         "kategori" => "Wearable",   "harga" => 1800000, "stok" => 7,  "gambar" => "https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&h=600&fit=crop&q=80"],
    ["nama" => "Power Bank 20.000 mAh",      "kategori" => "Aksesoris",  "harga" => 280000,  "stok" => 35, "gambar" => "https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?w=600&h=600&fit=crop&q=80"],
    ["nama" => "Speaker Bluetooth Mini",     "kategori" => "Audio",      "harga" => 499000,  "stok" => 14, "gambar" => "https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=600&h=600&fit=crop&q=80"],
];

// 2. FUNGSI
function rupiah($angka) {
    return "Rp" . number_format($angka, 0, ",", ".");
}

// Challenge: diskon 10% untuk harga >= Rp1.000.000
define("BATAS_DISKON", 1000000);
define("PERSEN_DISKON", 10);

function hitungDiskon($harga) {
    return $harga * PERSEN_DISKON / 100;
}

// Foto produk: isi "gambar" dengan nama file lokal (mis. "img/laptop.jpg")
// atau URL foto langsung. Tanpa titik = kata kunci (LoremFlickr).
function fotoProduk($gambar, $id) {
    if (strpos($gambar, ".") !== false) {
        return $gambar; // file lokal / URL langsung
    }
    return "https://loremflickr.com/600/600/" . urlencode($gambar) . "?lock=" . $id;
}

$totalProduk = count($produk);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cia Store - Katalog Produk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --hitam: #000;
            --teks: #fff;
            --redup: #8a8a8a;
            --garis: #222;
            --merah: #d6001c;
            --font-logo: "Archivo", "Helvetica Neue", Helvetica, Arial, sans-serif;
            --font-isi: "Archivo", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            background: var(--hitam);
            color: var(--teks);
            font-family: var(--font-isi);
            font-size: 14px;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }
        a { color: inherit; text-decoration: none; }
        :focus-visible { outline: 1px solid var(--teks); outline-offset: 3px; }

        /* Announcement */
        .info-bar {
            background: var(--teks);
            color: var(--hitam);
            text-align: center;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: .04em;
            padding: 9px 16px;
        }

        /* Navbar: menu kiri, logo tengah */
        header {
            position: sticky; top: 0; z-index: 10;
            background: var(--hitam);
        }
        .nav {
            padding: 18px 24px;
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
        }
        .logo {
            grid-column: 2; grid-row: 1;
            font-family: var(--font-logo);
            font-size: 22px; font-weight: 800;
            letter-spacing: .32em;
            text-transform: uppercase;
            margin-right: -.32em;
        }
        .nav ul {
            grid-column: 1; grid-row: 1;
            list-style: none; display: flex; gap: 24px;
            font-size: 13px; font-weight: 500;
        }
        .nav ul a { color: var(--redup); transition: color .2s; }
        .nav ul a:hover { color: var(--teks); }

        /* Hero */
        .hero {
            padding: 120px 24px 96px;
            text-align: center;
        }
        .hero h1 {
            font-family: var(--font-logo);
            font-weight: 800;
            font-size: clamp(44px, 11vw, 150px);
            line-height: .95;
            letter-spacing: .12em;
            margin-right: -.12em;
            text-transform: uppercase;
        }
        .hero p {
            max-width: 44ch; margin: 24px auto 36px;
            color: var(--redup); font-size: 15px;
        }

        /* Tombol */
        .btn {
            display: inline-block;
            font-family: var(--font-isi);
            font-size: 12px; font-weight: 600;
            letter-spacing: .06em;
            padding: 13px 30px;
            border: 1px solid var(--teks);
            background: var(--teks); color: var(--hitam);
            cursor: pointer;
            transition: background .2s, color .2s;
        }
        .btn:hover { background: transparent; color: var(--teks); }
        .btn:disabled, .btn.nonaktif {
            background: transparent; color: #555;
            border-color: var(--garis); cursor: not-allowed;
        }
        .btn.penuh { width: 100%; text-align: center; }

        /* Informasi jumlah produk */
        .ringkasan {
            padding: 24px 24px 16px;
            display: flex; justify-content: space-between; align-items: baseline;
            gap: 16px; flex-wrap: wrap;
            border-top: 1px solid var(--garis);
        }
        .ringkasan h2 { font-size: 14px; font-weight: 600; letter-spacing: .04em; }
        .ringkasan span { color: var(--redup); font-size: 13px; }

        /* Katalog: CSS Grid, rapat, tanpa kotak */
        .katalog {
            padding: 0 12px 96px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px 12px;
        }
        .card {
            background: transparent;
            border: 0;
            display: flex; flex-direction: column;
        }
        .gambar {
            position: relative;
            aspect-ratio: 4 / 5;
            background: #0f0f0f;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }
        .gambar b {
            font-family: var(--font-logo);
            font-size: 96px; font-weight: 800; line-height: 1;
            color: #222;
        }
        .gambar img {
            position: absolute; inset: 0;
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform .6s ease;
        }
        .card:hover .gambar img { transform: scale(1.03); }
        .gambar img.abu { filter: grayscale(1) brightness(.5); }
        .label {
            z-index: 1;
            position: absolute; top: 10px; left: 10px;
            font-size: 11px; font-weight: 600;
            letter-spacing: .04em;
            padding: 3px 8px;
        }
        .label.diskon { background: var(--merah); color: #fff; }
        .label.habis  { background: var(--teks); color: var(--hitam); }
        .isi {
            padding: 14px 4px 0;
            display: flex; flex-direction: column; align-items: center;
            text-align: center; gap: 2px; flex: 1;
        }
        .kategori { color: var(--redup); font-size: 12px; }
        .nama { font-size: 14px; font-weight: 500; line-height: 1.35; }
        .harga { margin-top: 4px; display: flex; align-items: baseline; justify-content: center; gap: 8px; flex-wrap: wrap; }
        .harga-akhir { font-size: 14px; font-weight: 600; }
        .harga-coret { color: var(--redup); text-decoration: line-through; font-size: 13px; }
        .status { font-size: 12px; margin-top: 2px; }
        .status.tersedia { color: var(--redup); }
        .status.habis { color: var(--teks); font-weight: 600; }
        .aksi { padding: 14px 0 0; }

        /* Footer */
        footer { border-top: 1px solid var(--garis); }
        .footer-isi {
            padding: 40px 24px;
            display: flex; flex-direction: column; align-items: center; text-align: center;
            gap: 10px;
            color: var(--redup); font-size: 12px;
        }
        .footer-isi .logo {
            grid-column: auto;
            color: var(--teks); font-size: 18px;
        }

        /* Responsive */
        @media (max-width: 1024px) { .katalog { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 768px) {
            .katalog { grid-template-columns: repeat(2, 1fr); gap: 32px 10px; }
            .nav { padding: 14px 16px; }
            .nav ul { gap: 14px; }
            .logo { font-size: 18px; }
            .hero { padding: 80px 20px 64px; }
            .gambar b { font-size: 72px; }
        }
        @media (max-width: 480px) {
            .nav ul li:nth-child(n+2) { display: none; }
        }
    </style>
</head>
<body>

    <div class="info-bar">Diskon 10% untuk semua produk mulai Rp1.000.000</div>

    <!-- NAVBAR -->
    <header>
        <nav class="nav">
            <a href="#" class="logo">Cia Store</a>
            <ul>
                <li><a href="#katalog">Katalog</a></li>
                <li><a href="#katalog">Promo</a></li>
                <li><a href="#kontak">Kontak</a></li>
            </ul>
        </nav>
    </header>

    <!-- HERO -->
    <section class="hero">
        <h1>Cia Store</h1>
        <p>Perangkat dan aksesoris teknologi pilihan untuk kerja, main, dan sehari-hari.</p>
        <a href="#katalog" class="btn">Lihat Katalog</a>
    </section>

    <!-- INFORMASI JUMLAH PRODUK -->
    <section class="ringkasan" id="katalog">
        <h2>Semua Produk</h2>
        <span>Menampilkan <?= $totalProduk; ?> produk</span>
    </section>

    <!-- KATALOG PRODUK -->
    <main class="katalog">
        <?php foreach ($produk as $i => $item): ?>
            <?php
                // Percabangan: status berdasarkan stok
                if ($item["stok"] > 0) {
                    $status      = "Tersedia";
                    $kelasStatus = "tersedia";
                } else {
                    $status      = "Stok Habis";
                    $kelasStatus = "habis";
                }

                // Challenge: diskon 10% bila harga >= Rp1.000.000
                $dapatDiskon = $item["harga"] >= BATAS_DISKON;
                if ($dapatDiskon) {
                    $hargaAkhir = $item["harga"] - hitungDiskon($item["harga"]);
                } else {
                    $hargaAkhir = $item["harga"];
                }
            ?>
            <article class="card">
                <div class="gambar">
                    <b><?= strtoupper(substr($item["nama"], 0, 1)); ?></b>
                    <img src="<?= fotoProduk($item["gambar"], $i + 1); ?>"
                         alt="<?= htmlspecialchars($item["nama"]); ?>"
                         loading="lazy"
                         class="<?= $item["stok"] == 0 ? "abu" : ""; ?>"
                         onerror="this.style.display='none'">
                    <?php if ($item["stok"] == 0): ?>
                        <span class="label habis">Stok Habis</span>
                    <?php elseif ($dapatDiskon): ?>
                        <span class="label diskon">-<?= PERSEN_DISKON; ?>%</span>
                    <?php endif; ?>
                </div>

                <div class="isi">
                    <span class="kategori"><?= $item["kategori"]; ?></span>
                    <h3 class="nama"><?= $item["nama"]; ?></h3>

                    <div class="harga">
                        <span class="harga-akhir"><?= rupiah($hargaAkhir); ?></span>
                        <?php if ($dapatDiskon): ?>
                            <span class="harga-coret"><?= rupiah($item["harga"]); ?></span>
                        <?php endif; ?>
                    </div>

                    <span class="status <?= $kelasStatus; ?>">
                        <?= $status; ?><?= $item["stok"] > 0 ? " (stok: " . $item["stok"] . ")" : ""; ?>
                    </span>
                </div>

                <div class="aksi">
                    <?php if ($item["stok"] > 0): ?>
                        <button type="button" class="btn penuh">Beli Sekarang</button>
                    <?php else: ?>
                        <button type="button" class="btn penuh" disabled>Stok Habis</button>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
    </main>

    <!-- FOOTER -->
    <footer id="kontak">
        <div class="footer-isi">
            <span class="logo">Cia Store</span>
            <span>Jakarta, Indonesia &nbsp;|&nbsp; cia@ciastore.test</span>
            <span>&copy; <?= date("Y"); ?> Cia Store. Semua hak dilindungi.</span>
        </div>
    </footer>

</body>
</html>