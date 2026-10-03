<?php
// Studi Kasus 2 - Form input PHP (method POST) bergaya Windows 95
$submitted = ($_SERVER["REQUEST_METHOD"] === "POST");

function clean($key) {
    return isset($_POST[$key]) ? htmlspecialchars(trim($_POST[$key]), ENT_QUOTES, 'UTF-8') : '';
}

$nama   = clean('nama');
$email  = clean('email');
$jk     = clean('jenis_kelamin');
$alamat = clean('alamat');
$telp   = clean('telepon');
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Form Data Pengguna.exe</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400;600&display=swap" rel="stylesheet">
<style>
  * { box-sizing: border-box; }
  body {
    margin: 0;
    min-height: 100vh;
    background: #008080; /* teal desktop Win95 */
    font-family: "Pixelify Sans", "MS Sans Serif", "Courier New", monospace;
    font-size: 15px;
    -webkit-font-smoothing: none;
    font-smooth: never;
    text-rendering: optimizeSpeed;
    color: #000;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    padding: 24px 12px 60px;
  }
  .window {
    width: 100%;
    max-width: 460px;
    background: #c0c0c0;
    border: 2px solid;
    border-color: #fff #404040 #404040 #fff;
    box-shadow: 1px 1px 0 #000;
    padding: 3px;
  }
  .titlebar {
    background: #000080;
    color: #fff;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 3px 4px;
  }
  .titlebar .name { display: flex; align-items: center; gap: 6px; }
  .icon {
    width: 16px; height: 16px;
    background: linear-gradient(135deg, #ff0 0%, #f0f 50%, #0ff 100%);
    border: 1px solid #fff;
  }
  .ctrl { display: flex; gap: 2px; }
  .btn-ctrl {
    width: 20px; height: 18px;
    background: #c0c0c0; color: #000;
    border: 2px solid; border-color: #fff #404040 #404040 #fff;
    font-size: 11px; line-height: 12px; font-weight: bold;
    text-align: center; padding: 0;
  }
  .menubar { display: flex; gap: 14px; padding: 4px 6px; border-bottom: 1px solid #808080; }
  .menubar span u { text-decoration: underline; }
  .content { padding: 10px; }
  fieldset {
    border: 2px groove #fff;
    margin: 0 0 10px;
    padding: 10px;
  }
  legend { padding: 0 4px; }
  .row { display: flex; flex-direction: column; margin-bottom: 10px; }
  .row:last-child { margin-bottom: 0; }
  label { margin-bottom: 3px; }
  input[type=text], input[type=email], input[type=tel], textarea {
    width: 100%;
    background: #fff;
    border: 2px solid;
    border-color: #404040 #fff #fff #404040;
    outline: none;
    padding: 4px 5px;
    font-family: inherit;
    font-size: 14px;
  }
  textarea { resize: vertical; min-height: 70px; }
  .radios { display: flex; gap: 18px; }
  .radios label { display: flex; align-items: center; gap: 5px; margin: 0; }
  .buttons { display: flex; justify-content: flex-end; gap: 8px; }
  button.win-btn, .win-btn {
    min-width: 88px;
    padding: 5px 12px;
    background: #c0c0c0;
    font-family: inherit;
    font-size: 14px;
    color: #000;
    border: 2px solid;
    border-color: #fff #404040 #404040 #fff;
    box-shadow: 1px 1px 0 #000;
    cursor: pointer;
  }
  .win-btn:active { border-color: #404040 #fff #fff #404040; box-shadow: none; padding: 6px 11px 4px 13px; }
  .win-btn:focus-visible { outline: 1px dotted #000; outline-offset: -5px; }
  .statusbar {
    display: flex; gap: 3px; padding: 3px 0 0;
  }
  .statusbar div {
    flex: 1;
    border: 1px solid;
    border-color: #808080 #fff #fff #808080;
    padding: 2px 6px;
    font-size: 12px;
  }
  table.result { width: 100%; border-collapse: separate; border-spacing: 0; background: #fff;
    border: 2px solid; border-color: #404040 #fff #fff #404040; }
  table.result td { padding: 6px 8px; border-bottom: 1px solid #c0c0c0; vertical-align: top; word-break: break-word; }
  table.result tr:last-child td { border-bottom: none; }
  table.result td:first-child { width: 38%; font-weight: bold; background: #f0f0f0; }
  .msg { display: flex; gap: 10px; align-items: center; margin-bottom: 10px; }
  .msg .i {
    width: 32px; height: 32px; border-radius: 50%;
    background: #000080; color: #fff; font-weight: bold; font-size: 20px;
    display: flex; align-items: center; justify-content: center; font-family: Georgia, serif;
    flex: none;
  }
  .taskbar {
    position: fixed; left: 0; right: 0; bottom: 0;
    background: #c0c0c0; border-top: 2px solid #fff;
    padding: 3px 4px; display: flex; align-items: center; gap: 6px;
  }
  .start {
    font-weight: bold; padding: 3px 10px;
    border: 2px solid; border-color: #fff #404040 #404040 #fff;
    box-shadow: 1px 1px 0 #000;
  }
  .task-item {
    padding: 3px 10px; font-size: 12px;
    border: 2px solid; border-color: #404040 #fff #fff #404040;
    background: repeating-conic-gradient(#c0c0c0 0% 25%, #fff 0% 50%) 50% / 2px 2px;
  }
</style>
</head>
<body>

<!-- ===== WINDOW 1: FORM INPUT ===== -->
<div class="window">
  <div class="titlebar">
    <div class="name"><span class="icon"></span> FormPengguna.exe</div>
    <div class="ctrl">
      <span class="btn-ctrl">_</span><span class="btn-ctrl">□</span><span class="btn-ctrl">✕</span>
    </div>
  </div>
  <div class="menubar">
    <span><u>F</u>ile</span><span><u>E</u>dit</span><span><u>V</u>iew</span><span><u>O</u>ptions</span><span><u>H</u>elp</span>
  </div>

  <form class="content" method="POST" action="">
    <fieldset>
      <legend>Data Pengguna</legend>

      <div class="row">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required value="<?= $nama ?>">
      </div>

      <div class="row">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required value="<?= $email ?>">
      </div>

      <div class="row">
        <label>Jenis Kelamin:</label>
        <div class="radios">
          <label><input type="radio" name="jenis_kelamin" value="Laki-laki" required <?= $jk === 'Laki-laki' ? 'checked' : '' ?>> Laki-laki</label>
          <label><input type="radio" name="jenis_kelamin" value="Perempuan" <?= $jk === 'Perempuan' ? 'checked' : '' ?>> Perempuan</label>
        </div>
      </div>

      <div class="row">
        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required><?= $alamat ?></textarea>
      </div>

      <div class="row">
        <label for="telepon">Nomor Telepon:</label>
        <input type="tel" id="telepon" name="telepon" required pattern="[0-9+\-\s]{6,20}" value="<?= $telp ?>">
      </div>
    </fieldset>

    <div class="buttons">
      <button type="submit" class="win-btn">Submit</button>
      <button type="reset" class="win-btn">Reset</button>
    </div>
  </form>

  <div class="statusbar">
    <div>Siap</div>
    <div>Method: POST</div>
  </div>
</div>

<!-- ===== WINDOW 2: HASIL INPUT (tampil setelah form dikirim) ===== -->
<?php if ($submitted): ?>
<div class="window">
  <div class="titlebar">
    <div class="name"><span class="icon"></span> Hasil.exe</div>
    <div class="ctrl">
      <span class="btn-ctrl">_</span><span class="btn-ctrl">□</span><span class="btn-ctrl">✕</span>
    </div>
  </div>
  <div class="content">
    <div class="msg">
      <div class="i">i</div>
      <div>Data berhasil diterima dan diproses oleh PHP.</div>
    </div>
    <table class="result">
      <tr><td>Nama</td><td><?= $nama ?></td></tr>
      <tr><td>Email</td><td><?= $email ?></td></tr>
      <tr><td>Jenis Kelamin</td><td><?= $jk ?></td></tr>
      <tr><td>Alamat</td><td><?= nl2br($alamat) ?></td></tr>
      <tr><td>Nomor Telepon</td><td><?= $telp ?></td></tr>
    </table>
    <div class="buttons" style="margin-top:10px">
      <a href="index.php" class="win-btn" style="text-decoration:none;text-align:center">OK</a>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="taskbar">
  <div class="start">⊞ Start</div>
  <div class="task-item">FormPengguna.exe</div>
  <?php if ($submitted): ?><div class="task-item">Hasil.exe</div><?php endif; ?>
</div>

</body>
</html>
