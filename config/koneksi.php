<?php
/**
 * File     : koneksi.php
 * Deskripsi: koneksi ke database pakai mysqli (biasa dipakai di Laragon)
 * Initial state : belum ada koneksi ke database
 * Final state   : variabel $koneksi siap dipakai buat query
 * Author   : Jaksa
 * Versi    : 1.0
 * Tanggal  : 05 Juli 2026
 */

// setting default punya Laragon, user root tanpa password
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_beasiswa";

// coba konek ke database
$koneksi = mysqli_connect($host, $user, $pass, $db);

// kalau gagal konek langsung stop, biar ketahuan errornya
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
