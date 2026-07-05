<?php
/**
 * File     : index.php
 * Deskripsi: halaman utama, nampilin jenis-jenis beasiswa beserta syaratnya
 * Initial state : belum ada data beasiswa ditampilkan
 * Final state   : list beasiswa tampil ke user
 * Author   : Jaksa
 * Versi    : 1.0
 * Tanggal  : 05 Juli 2026
 */

require_once "config/fungsi.php";

// ambil data jenis-jenis beasiswa dari fungsi yang sudah dibuat
$list_beasiswa = daftarBeasiswa();

require_once "header.php";
?>

<div class="row mb-4">
    <div class="col-12">
        <h2 class="text-primary mb-3">Informasi Pilihan Beasiswa</h2>
        <p class="text-muted">Berikut adalah jenis beasiswa yang bisa didaftarkan oleh mahasiswa Kampus Kuaja. Silakan baca syarat dan ketentuan sebelum mendaftar.</p>
    </div>
</div>

<div class="row g-4">
<?php
// looping semua beasiswa yang ada, terus tampilkan satu-satu pakai card
$is_first = true;
foreach ($list_beasiswa as $kode => $item) {
    $title_color = $is_first ? 'text-primary' : 'text-success';
    $btn_color = $is_first ? 'btn-primary' : 'btn-success text-white';
    $is_first = false;
?>
    <div class="col-md-6">
        <div class="card h-100 border-0 shadow rounded-4">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h4 class="card-title <?php echo $title_color; ?> fw-bold mb-0"><?php echo $item['nama']; ?></h4>
            </div>
            <div class="card-body">
                <hr>
                <h6 class="fw-bold">Syarat & Ketentuan:</h6>
                <p class="text-muted small"><?php echo $item['syarat']; ?></p>
            </div>
            <div class="card-footer bg-white border-0 text-end pb-3 pr-3">
                <a href="daftar.php" class="btn <?php echo $btn_color; ?> rounded-pill px-4">Daftar Sekarang</a>
            </div>
        </div>
    </div>
<?php
}
?>
</div>

<?php
require_once "footer.php";
?>
