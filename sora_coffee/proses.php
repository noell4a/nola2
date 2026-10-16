<?php
/* =====================================================
   SORA COFFEE - proses.php (SATU-SATUNYA file PHP)
   Tugas: counter, cari menu (GET), pesan (POST), promo (POST)
   Tampilan: index.html + style.css
   ===================================================== */
date_default_timezone_set('Asia/Jakarta');

/* ---------- DATA MENU ---------- */
$menu = [
    ['id' => 'espresso', 'nama' => 'Sora Espresso',    'harga' => 18000, 'warna' => '#6b4228', 'desc' => 'Double shot pekat, manis seperti karamel.'],
    ['id' => 'latte',    'nama' => 'Kumo Latte',       'harga' => 28000, 'warna' => '#d2a679', 'desc' => 'Espresso + susu lembut, seringan awan.'],
    ['id' => 'aren',     'nama' => 'Aren Sora',        'harga' => 26000, 'warna' => '#c07a3a', 'desc' => 'Es kopi susu gula aren, favorit semua orang.'],
    ['id' => 'matcha',   'nama' => 'Matcha Cloud',     'harga' => 30000, 'warna' => '#8fc15f', 'desc' => 'Matcha creamy, sedikit pahit, banyak happy.'],
    ['id' => 'taro',     'nama' => 'Taro Dream',       'harga' => 27000, 'warna' => '#b79be6', 'desc' => 'Taro ungu manis, wajib difoto dulu.'],
    ['id' => 'berry',    'nama' => 'Strawberry Latte', 'harga' => 29000, 'warna' => '#ff8fb1', 'desc' => 'Susu stroberi + espresso, pink dan segar.'],
];

/* Pilihan gula & es yang boleh (dicek lagi di server) */
$pilihanGula = ['No Sugar', 'Less Sugar', 'Normal Sugar'];
$pilihanEs   = ['Panas', 'No Ice', 'Less Ice', 'Normal Ice', 'Extra Ice'];

function cariMenu($menu, $id)
{
    foreach ($menu as $m) {
        if ($m['id'] === $id) {
            return $m;
        }
    }
    return null;
}

function rupiah($n)
{
    return 'Rp ' . number_format($n, 0, ',', '.');
}

/* ---------- PAGE VIEW COUNTER (counter.txt) ---------- */
function hitungPageView()
{
    $file = __DIR__ . '/counter.txt';
    if (!file_exists($file)) {
        file_put_contents($file, '0');
    }
    $fp = fopen($file, 'c+');
    if ($fp === false) {
        return 0;
    }
    flock($fp, LOCK_EX);
    $total = (int) trim(stream_get_contents($fp)) + 1;   // tambah 1 tiap halaman dibuka
    ftruncate($fp, 0);
    rewind($fp);
    fwrite($fp, (string) $total);
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);
    return $total;
}

/* ---------- KERANGKA HALAMAN HASIL ---------- */
function kepala($judul)
{
    ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($judul) ?> | Sora Coffee</title>
    <link rel="icon" href="images/logo.svg" type="image/svg+xml">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
    <symbol id="cup" viewBox="0 0 100 100">
        <ellipse cx="48" cy="89" rx="34" ry="6" fill="#86b6d8" stroke="#2b211b" stroke-width="3"/>
        <path d="M72 48h5a9 9 0 0 1 0 18h-7" fill="none" stroke="#2b211b" stroke-width="3" stroke-linecap="round"/>
        <path d="M21 42h52v17a26 26 0 0 1-26 26 26 26 0 0 1-26-26z" fill="#faf6ef" stroke="#2b211b" stroke-width="3"/>
        <ellipse cx="47" cy="42" rx="26" ry="6" fill="currentColor" stroke="#2b211b" stroke-width="3"/>
        <path d="M38 32c-5 0-7-6-3-9 1-5 8-6 11-2 3-4 10-3 11 2 5 1 5 9 0 9z" fill="#fff" stroke="#2b211b" stroke-width="2.5" stroke-linejoin="round"/>
        <circle cx="38" cy="62" r="2.8" fill="#2b211b"/><circle cx="56" cy="62" r="2.8" fill="#2b211b"/>
        <ellipse cx="31" cy="68" rx="4" ry="2.6" fill="#f4b8a4"/><ellipse cx="63" cy="68" rx="4" ry="2.6" fill="#f4b8a4"/>
        <path d="M43 67q4 5 8 0" fill="none" stroke="#2b211b" stroke-width="2.6" stroke-linecap="round"/>
    </symbol>
    <symbol id="awan" viewBox="0 0 120 60">
        <path d="M24 56a20 20 0 0 1 3-40 26 26 0 0 1 49-5 22 22 0 0 1 22 21 17 17 0 0 1-3 24z"/>
    </symbol>
</svg>

<header class="site-header">
    <div class="header-inner">
        <a href="index.html" class="brand"><img src="images/logo.svg" alt="Logo Sora Coffee" width="36" height="36"><span>sora<em>.</em></span></a>
        <nav aria-label="Navigasi utama">
            <ul class="nav">
                <li><a href="index.html#home">Home</a></li>
                <li><a href="index.html#menu">Menu</a></li>
                <li><a href="index.html#pesan">Pesan</a></li>
                <li><a href="index.html#blog">Blog</a></li>
                <li><a href="index.html#kontak">Kontak</a></li>
            </ul>
        </nav>
        <a href="index.html#pesan" class="btn btn-primary btn-small">Pesan Sekarang</a>
    </div>
</header>

<main>
<section class="section">
    <div class="wrap narrow">
    <?php
}

function kaki()
{
    ?>
    </div>
</section>
</main>
<footer class="footer"><p class="copy">&copy; <?= date('Y') ?> Sora Coffee. UTS Pemrograman Web.</p></footer>
</body>
</html>
    <?php
}

/* =====================================================
   1. COUNTER  -> dipanggil index.html lewat proses.php?counter=1
   ===================================================== */
if (isset($_GET['counter'])) {
    header('Content-Type: text/plain; charset=utf-8');
    header('Cache-Control: no-store');
    echo number_format(hitungPageView(), 0, ',', '.');
    exit;
}

/* =====================================================
   2. CARI MENU  -> $_GET['q']
   ===================================================== */
if (isset($_GET['q'])) {
    $q = trim($_GET['q']);
    $hasil = [];
    foreach ($menu as $m) {
        if ($q === '' || stripos($m['nama'], $q) !== false || stripos($m['desc'], $q) !== false) {
            $hasil[] = $m;
        }
    }
    kepala('Hasil Pencarian');
    echo '<h2 class="title">Hasil pencarian</h2><span class="squiggle"></span>';
    echo '<p class="info">Kata kunci: <strong>' . htmlspecialchars($q === '' ? '-' : $q) . '</strong> &middot; Ditemukan <strong>' . count($hasil) . '</strong> menu</p>';
    if (count($hasil) === 0) {
        echo '<div class="empty">Yah, menunya belum ada. Coba kata kunci lain ya.</div>';
    } else {
        echo '<div class="cards">';
        foreach ($hasil as $m) {
            echo '<article class="card">'
                . '<span class="badge">' . rupiah($m['harga']) . '</span>'
                . '<div class="card-cup"><svg viewBox="0 0 100 100" style="color:' . $m['warna'] . '"><use href="#cup"/></svg></div>'
                . '<h3>' . htmlspecialchars($m['nama']) . '</h3>'
                . '<p>' . htmlspecialchars($m['desc']) . '</p>'
                . '<a href="index.html?pilih=' . $m['id'] . '#pesan" class="btn btn-sky btn-small">Pesan Sekarang</a>'
                . '</article>';
        }
        echo '</div>';
    }
    echo '<p style="margin-top:1.5rem"><a href="index.html#menu" class="btn btn-ghost btn-small">&larr; Kembali ke Menu</a></p>';
    kaki();
    exit;
}

/* =====================================================
   3. PESANAN  -> $_POST (aksi=pesan)
   ===================================================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['aksi'] ?? '') === 'pesan') {
    $nama      = trim($_POST['nama'] ?? '');
    $tipe      = $_POST['tipe'] ?? '';
    $mahasiswa = isset($_POST['mahasiswa']);
    $items     = (isset($_POST['item']) && is_array($_POST['item'])) ? $_POST['item'] : [];

    $errors = [];
    $rincian = [];
    $subtotal = 0;

    if ($nama === '') {
        $errors[] = 'Nama wajib diisi ya.';
    }
    if ($tipe !== 'Dine In' && $tipe !== 'Take Away') {
        $errors[] = 'Pilih Dine In atau Take Away.';
    }

    // Baca isi nota (tiap baris: menu + gula + es + jumlah)
    foreach ($items as $it) {
        if (!is_array($it)) {
            continue;
        }
        $m   = cariMenu($menu, $it['id'] ?? '');
        $qty = (int) ($it['qty'] ?? 0);
        if ($m === null || $qty < 1) {
            continue;
        }
        if ($qty > 20) {
            $qty = 20;
        }
        $gula = $it['gula'] ?? '';
        $es   = $it['es'] ?? '';
        if (!in_array($gula, $pilihanGula, true)) {
            $gula = 'Normal Sugar';
        }
        if (!in_array($es, $pilihanEs, true)) {
            $es = 'Normal Ice';
        }
        $sub = $qty * $m['harga'];                           // operator perkalian
        $rincian[] = ['nama' => $m['nama'], 'opsi' => $gula . ' · ' . $es, 'harga' => $m['harga'], 'qty' => $qty, 'sub' => $sub];
        $subtotal += $sub;                                   // operator penjumlahan
    }
    if (count($rincian) === 0) {
        $errors[] = 'Nota masih kosong, pilih minimal 1 menu.';
    }

    kepala('Hasil Pesanan');

    if (count($errors) > 0) {
        echo '<div class="alert" role="alert"><strong>Ups, cek lagi ya:</strong><ul>';
        foreach ($errors as $e) {
            echo '<li>' . $e . '</li>';
        }
        echo '</ul></div>';
        echo '<a href="index.html#pesan" class="btn btn-sky btn-small">&larr; Kembali ke form</a>';
    } else {
        $diskon = $mahasiswa ? $subtotal * 0.10 : 0;         // diskon mahasiswa 10%
        $total  = $subtotal - $diskon;
        $kode   = 'SORA-' . date('ymd') . '-' . rand(100, 999);
        ?>
        <div class="receipt">
            <h3>Pesanan Diterima ✓</h3>
            <p class="code">Kode: <strong><?= $kode ?></strong></p>
            <p>Nama: <strong><?= htmlspecialchars($nama) ?></strong></p>
            <p>Tipe: <strong><?= htmlspecialchars($tipe) ?></strong></p>
            <table class="table">
                <thead><tr><th>Menu</th><th>Harga</th><th>Qty</th><th class="r">Subtotal</th></tr></thead>
                <tbody>
                    <?php foreach ($rincian as $r): ?>
                        <tr>
                            <td><?= htmlspecialchars($r['nama']) ?><small class="opsi"><?= htmlspecialchars($r['opsi']) ?></small></td>
                            <td><?= rupiah($r['harga']) ?></td>
                            <td><?= $r['qty'] ?></td>
                            <td class="r"><?= rupiah($r['sub']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr><td colspan="3">Subtotal</td><td class="r"><?= rupiah($subtotal) ?></td></tr>
                    <?php if ($mahasiswa): ?>
                        <tr><td colspan="3">Diskon mahasiswa 10%</td><td class="r">- <?= rupiah($diskon) ?></td></tr>
                    <?php endif; ?>
                    <tr class="total"><td colspan="3">Total Bayar</td><td class="r"><?= rupiah($total) ?></td></tr>
                </tfoot>
            </table>
            <a href="index.html#pesan" class="btn btn-ghost btn-small">Buat pesanan baru</a>
        </div>
        <?php
    }
    kaki();
    exit;
}

/* =====================================================
   4. PROMO  -> $_POST (aksi=promo)
   ===================================================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['aksi'] ?? '') === 'promo') {
    $email = trim($_POST['email'] ?? '');
    kepala('Info Promo');
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="receipt"><h3>Terdaftar ✓</h3><p>Yay! Info promo akan dikirim ke <strong>' . htmlspecialchars($email) . '</strong> ☁️</p></div>';
    } else {
        echo '<div class="alert" role="alert">Format email belum benar, coba lagi ya.</div>';
    }
    echo '<p style="margin-top:1.5rem"><a href="index.html#kontak" class="btn btn-ghost btn-small">&larr; Kembali</a></p>';
    kaki();
    exit;
}

/* Kalau proses.php dibuka langsung tanpa data, kembali ke Home */
header('Location: index.html');
exit;