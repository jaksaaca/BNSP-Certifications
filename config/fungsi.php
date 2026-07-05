<?php
/**
 * File     : fungsi.php
 * Deskripsi: kumpulan fungsi-fungsi yang dipakai berulang di project ini
 * Initial state : belum ada fungsi yang dipanggil
 * Final state   : fungsi siap dipakai di halaman lain (daftar.php, proses_daftar.php, dll)
 * Author   : Jaksa
 * Versi    : 1.0
 * Tanggal  : 05 Juli 2026
 */

// fungsi buat ambil data IPK mahasiswa
// disini kita anggap IPK diambil otomatis dari sistem akademik
// karena ga ada sistem akademik beneran, jadi dibikin acak antara 2 nilai simulasi aja
function ambilIPK()
{
    // simulasi variable konstanta IPK sesuai instruksi soal
    // acak 2 kemungkinan, kadang di bawah 3 kadang di atas 3, biar bisa dites 2-2 nya
    $daftar_ipk_simulasi = array(3.4, 2.9);
    $index_acak = array_rand($daftar_ipk_simulasi);
    $ipk = $daftar_ipk_simulasi[$index_acak];

    return $ipk;
}

// fungsi buat daftar jenis beasiswa yang ada
// dipakai di halaman pilihan beasiswa dan juga dropdown form daftar
function daftarBeasiswa()
{
    $beasiswa = array(
        "akademik" => array(
            "nama"   => "Beasiswa Akademik",
            "syarat" => "IPK minimal 3.00, aktif sebagai mahasiswa, tidak sedang menerima beasiswa lain"
        ),
        "non_akademik" => array(
            "nama"   => "Beasiswa Non Akademik",
            "syarat" => "Aktif organisasi kampus / punya prestasi non akademik, melampirkan sertifikat/piagam"
        )
    );

    return $beasiswa;
}

// fungsi validasi email sederhana
function cekEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

// fungsi validasi no hp, cuma boleh angka
function cekNoHP($no_hp)
{
    // is_numeric ga cukup karena no hp biasa diawali 0, jadi pakai ctype_digit
    if (ctype_digit($no_hp)) {
        return true;
    } else {
        return false;
    }
}
?>
