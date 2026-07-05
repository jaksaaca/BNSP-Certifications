<?php
/**
 * File     : hasil.php
 * Deskripsi: nampilin semua data pendaftar beasiswa yang udah tersimpan di database,
 *            termasuk status_ajuan
 * Initial state : belum ada data ditampilkan
 * Final state   : semua data pendaftar tampil dalam bentuk tabel
 * Author   : Jaksa
 * Versi    : 1.0
 * Tanggal  : 05 Juli 2026
 */

require_once "config/koneksi.php";
require_once "header.php";

// ambil semua data pendaftaran, urutan terbaru di atas
$query = "SELECT * FROM pendaftaran ORDER BY id DESC";
$hasil = mysqli_query($koneksi, $query);
?>

<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center border-bottom pb-2">
        <h2 class="text-primary mb-0">Hasil Pendaftaran</h2>
        <a href="daftar.php" class="btn btn-outline-primary btn-sm">Daftar Baru</a>
    </div>
</div>

<?php if (mysqli_num_rows($hasil) == 0) { ?>
    <div class="alert alert-info">Belum ada mahasiswa yang mendaftar beasiswa.</div>
<?php } else { ?>

<div class="table-responsive rounded-4 shadow border border-light">
    <table class="table table-borderless table-hover align-middle mb-0">
        <thead class="bg-light text-center text-muted">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>HP</th>
                <th>Semester</th>
                <th>IPK</th>
                <th>Jenis Beasiswa</th>
                <th>Berkas</th>
                <th>Status Ajuan</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        // looping tiap baris data hasil query, terus ditampilin ke tabel
        while ($data = mysqli_fetch_assoc($hasil)) {
        ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($data['nama']); ?></td>
                <td><?php echo htmlspecialchars($data['email']); ?></td>
                <td><?php echo htmlspecialchars($data['no_hp']); ?></td>
                <td class="text-center"><?php echo $data['semester']; ?></td>
                <td class="text-center"><strong><?php echo $data['ipk']; ?></strong></td>
                <td><?php echo htmlspecialchars($data['jenis_beasiswa']); ?></td>
                <td class="text-center">
                    <a href="uploads/<?php echo htmlspecialchars($data['nama_file']); ?>" target="_blank" class="btn btn-sm btn-primary rounded-pill px-3">Lihat File</a>
                </td>
                <td class="text-center">
                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2"><?php echo htmlspecialchars($data['status_ajuan']); ?></span>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php } ?>

<?php
require_once "footer.php";
?>
