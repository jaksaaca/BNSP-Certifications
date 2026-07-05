<?php
/**
 * File     : daftar.php
 * Deskripsi: halaman form pendaftaran beasiswa. IPK otomatis muncul dari sistem
 *            (disimulasikan pakai fungsi ambilIPK()), kalau IPK < 3 maka field
 *            pilihan beasiswa, upload berkas, sama tombol daftar jadi disable.
 * Initial state : belum ada IPK yang ke-generate
 * Final state   : IPK sudah ke-generate dan tersimpan di session, form siap diisi
 * Author   : Jaksa
 * Versi    : 1.0
 * Tanggal  : 05 Juli 2026
 */

session_start();
require_once "config/fungsi.php";

// setiap kali buka halaman daftar, ambil IPK baru dari "sistem" (simulasi)
// terus disimpan ke session, soalnya field IPK bakal di-disable pas dikirim
// (field yang disabled ga ikut kekirim pas form di-submit), jadi kita perlu
// simpan IPK-nya biar bisa dipakai lagi di proses_daftar.php
$_SESSION['ipk'] = ambilIPK();
$ipk = $_SESSION['ipk'];

// ini buat nentuin boleh lanjut apa engga
$boleh_lanjut = ($ipk >= 3) ? true : false;

$list_beasiswa = daftarBeasiswa();

require_once "header.php";
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <h2 class="mb-4 text-center">Form Pendaftaran Beasiswa</h2>
        
        <?php if (!$boleh_lanjut) { ?>
            <div class="alert alert-warning">
                <strong>Perhatian!</strong> IPK anda (<?php echo $ipk; ?>) belum memenuhi syarat minimum (IPK >= 3.00) untuk mendaftar beasiswa. Beberapa input dinonaktifkan.
            </div>
        <?php } ?>

        <form action="proses_daftar.php" method="POST" enctype="multipart/form-data" id="form_beasiswa" class="needs-validation">
            
            <div class="mb-3">
                <label class="form-label">Masukkan Nama <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Masukkan Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Nomor HP <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="no_hp" id="no_hp" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Semester saat ini <span class="text-danger">*</span></label>
                <select name="semester" class="form-select" required>
                    <option value="">-- Pilih Semester --</option>
                    <?php
                    for ($i = 1; $i <= 8; $i++) {
                        echo "<option value='$i'>Semester $i</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label">IPK Terakhir <span class="text-danger">*</span></label>
                <!-- Because IPK is assigned from PHP array, we display it simply -->
                <select class="form-select" disabled>
                    <option selected><?php echo $ipk; ?> <?php echo ($boleh_lanjut) ? '(Memenuhi Syarat)' : '(Tidak Memenuhi Syarat)'; ?></option>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Pilihan Beasiswa <span class="text-danger">*</span></label>
                <select name="jenis_beasiswa" id="jenis_beasiswa" class="form-select" <?php echo (!$boleh_lanjut) ? "disabled" : ""; ?> required>
                    <option value="">-- Pilih Jenis Beasiswa --</option>
                    <?php
                    foreach ($list_beasiswa as $kode => $item) {
                        echo "<option value='" . $item['nama'] . "'>" . $item['nama'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="mb-4">
                <label class="form-label">Upload Berkas Syarat <span class="text-danger">*</span></label>
                <input type="file" name="berkas" id="berkas" class="form-control" accept=".pdf,.jpg,.jpeg,.zip" <?php echo (!$boleh_lanjut) ? "disabled" : ""; ?> required>
                <div class="form-text">Format yang didukung: PDF, JPG, ZIP. Maksimal 2MB.</div>
            </div>
            
            <div class="d-flex gap-3 mt-5">
                <button type="submit" id="btn_daftar" class="btn btn-primary btn-lg rounded-pill px-5 flex-grow-1" <?php echo (!$boleh_lanjut) ? "disabled" : ""; ?>>Daftar Sekarang</button>
                <a href="index.php" class="btn btn-light btn-lg rounded-pill px-5 text-muted border">Batal</a>
            </div>

        </form>
    </div>
</div>

<script>
// kalau IPK udah lolos, otomatis fokus ke pilihan beasiswa
// biar user ga usah klik manual lagi ke situ
<?php if ($boleh_lanjut) { ?>
window.onload = function() {
    document.getElementById("jenis_beasiswa").focus();
};
<?php } ?>

// validasi no hp cuma boleh angka
document.getElementById("no_hp").addEventListener("input", function() {
    // ganti semua karakter yang bukan angka jadi kosong
    this.value = this.value.replace(/[^0-9]/g, "");
});
</script>

<?php
require_once "footer.php";
?>
