-- =======================================================
-- Database untuk Sistem Pendaftaran Beasiswa Online
-- Author : Jaksa
-- Tanggal: 05 Juli 2026
-- =======================================================

CREATE DATABASE IF NOT EXISTS db_beasiswa;
USE db_beasiswa;

-- tabel untuk simpan data pendaftar beasiswa
CREATE TABLE IF NOT EXISTS pendaftaran (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    semester INT(1) NOT NULL,
    ipk DECIMAL(3,2) NOT NULL,
    jenis_beasiswa VARCHAR(50) NOT NULL,
    nama_file VARCHAR(255) NOT NULL,
    status_ajuan VARCHAR(50) NOT NULL DEFAULT 'Belum Diverifikasi',
    tanggal_daftar DATETIME NOT NULL,
    PRIMARY KEY (id)
);

-- data contoh (boleh dihapus kalau ga perlu)
-- INSERT INTO pendaftaran (nama, email, no_hp, semester, ipk, jenis_beasiswa, nama_file, status_ajuan, tanggal_daftar)
-- VALUES ('Contoh Nama', 'contoh@email.com', '081234567890', 5, 3.40, 'Beasiswa Akademik', 'contoh.pdf', 'Belum Diverifikasi', NOW());
