<?php
/**
 * File     : proses_daftar.php
 * Deskripsi: proses simpan data pendaftaran beasiswa ke database, dipanggil
 *            waktu tombol "Daftar" di form daftar.php di-submit
 * Initial state : data form belum divalidasi & belum disimpan
 * Final state   : kalau lolos validasi, data tersimpan di tabel pendaftaran
 * Author   : Jaksa
 * Versi    : 1.0
 * Tanggal  : 05 Juli 2026
 */

session_start();
require_once "config/koneksi.php";
require_once "config/fungsi.php";

// cuma boleh diakses kalau emang dari form (method POST)
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: daftar.php");
    exit;
}

// ambil IPK dari session (karena field IPK di form disabled, jadi ga kekirim lewat $_POST)
$ipk = isset($_SESSION['ipk']) ? $_SESSION['ipk'] : 0;

// jaga-jaga, walaupun di form udah didisable, kita cek lagi disini
// biar ga bisa ditembus lewat cara curang (misal edit html manual)
if ($ipk < 3) {
    echo "IPK tidak memenuhi syarat, tidak bisa mendaftar.";
    echo "<br><a href='daftar.php'>Kembali</a>";
    exit;
}

// ambil semua data dari form
$nama          = $_POST['nama'];
$email         = $_POST['email'];
$no_hp         = $_POST['no_hp'];
$semester      = $_POST['semester'];
$jenis_beasiswa = $_POST['jenis_beasiswa'];

// validasi email
if (!cekEmail($email)) {
    echo "Format email tidak valid.";
    echo "<br><a href='daftar.php'>Kembali</a>";
    exit;
}

// validasi no hp cuma boleh angka
if (!cekNoHP($no_hp)) {
    echo "Nomor HP hanya boleh angka.";
    echo "<br><a href='daftar.php'>Kembali</a>";
    exit;
}

// validasi semester harus 1-8
if ($semester < 1 || $semester > 8) {
    echo "Semester tidak valid.";
    echo "<br><a href='daftar.php'>Kembali</a>";
    exit;
}

// cek berkas syarat udah diupload apa belum
if (!isset($_FILES['berkas']) || $_FILES['berkas']['error'] != 0) {
    echo "Berkas syarat wajib diupload.";
    echo "<br><a href='daftar.php'>Kembali</a>";
    exit;
}

// proses upload file ke folder uploads
$nama_file_asli = $_FILES['berkas']['name'];
$tmp_file       = $_FILES['berkas']['tmp_name'];

// kasih nama unik biar ga bentrok kalau ada yang upload nama file sama
$nama_file_baru = time() . "_" . $nama_file_asli;
$tujuan_upload  = "uploads/" . $nama_file_baru;

// pindahin file dari folder sementara ke folder uploads
if (!move_uploaded_file($tmp_file, $tujuan_upload)) {
    echo "Upload berkas gagal, coba lagi.";
    echo "<br><a href='daftar.php'>Kembali</a>";
    exit;
}

// status ajuan default waktu pertama daftar
$status_ajuan = "Belum Diverifikasi";
$tanggal      = date("Y-m-d H:i:s");

// simpan ke database, pakai prepared statement biar aman dari sql injection
$query = "INSERT INTO pendaftaran (nama, email, no_hp, semester, ipk, jenis_beasiswa, nama_file, status_ajuan, tanggal_daftar)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "sssidssss", $nama, $email, $no_hp, $semester, $ipk, $jenis_beasiswa, $nama_file_baru, $status_ajuan, $tanggal);

if (mysqli_stmt_execute($stmt)) {
    // kalau berhasil simpan, langsung arahkan ke halaman hasil
    header("Location: hasil.php");
    exit;
} else {
    echo "Gagal menyimpan data: " . mysqli_error($koneksi);
}
?>
