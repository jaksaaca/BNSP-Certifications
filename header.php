<?php
/**
 * File     : header.php
 * Deskripsi: bagian atas halaman (navbar) yang dipakai di semua halaman
 * Author   : Jaksa
 * Versi    : 1.0
 * Tanggal  : 05 Juli 2026
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pendaftaran Beasiswa Online</title>
    
    <!-- Font Google: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Bootstrap 5 melalui CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- CSS Kustom Minimal -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">

    <!-- Navigasi Utama -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top border-bottom">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="index.php">Portal Beasiswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active fw-semibold' : ''; ?>" href="index.php">Pilihan Beasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'daftar.php') ? 'active fw-semibold' : ''; ?>" href="daftar.php">Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'hasil.php') ? 'active fw-semibold' : ''; ?>" href="hasil.php">Hasil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Area Konten Utama -->
    <div class="container my-5">
        <div class="bg-white p-4 p-md-5 rounded-4 shadow border-0">
