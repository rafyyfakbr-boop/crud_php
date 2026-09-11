<?php
include "koneksi.php";

// Ambil id dari URL (contoh: edit.php?id=3)
$id = $_GET['id'];

// Ambil data siswa yang sesuai dengan id tersebut
$query = "SELECT * FROM tb_siswa WHERE id_siswa = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$siswa = mysqli_fetch_assoc($result);

// Kalau data dengan id tersebut tidak ditemukan, hentikan dan kembali
if (!$siswa) {
    die("Data siswa tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f4f4; padding: 40px; }
        img.preview { max-width: 120px; border-radius: 4px; }
    </style>
</head>
<body>
<div class="container" style="max-width: 500px;">

    <a href="index.php" class="d-inline-block mb-3">&larr; Kembali ke daftar</a>

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-3">Edit Data Siswa</h4>
            <form action="proses_edit.php" method="POST" enctype="multipart/form-data">

                <!-- Simpan id_siswa di input tersembunyi, supaya ikut terkirim saat submit -->
                <input type="hidden" name="id_siswa" value="<?= htmlspecialchars($siswa['id_siswa']) ?>">

                <div class="mb-3">
                    <label class="form-label">NISN</label>
                    <input type="text" class="form-control" name="nisn" value="<?= htmlspecialchars($siswa['nisn']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" name="nama_siswa" value="<?= htmlspecialchars($siswa['nama_siswa']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="jenis_kelamin" required>
                        <option value="Laki-laki" <?= $siswa['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="Perempuan" <?= $siswa['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat" value="<?= htmlspecialchars($siswa['alamat']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Foto Saat Ini</label>
                    <?php if (!empty($siswa['foto_siswa'])) : ?>
                        <img class="preview mb-2" src="photos/<?= htmlspecialchars($siswa['foto_siswa']) ?>" alt="Foto siswa">
                    <?php else: ?>
                        <small class="text-muted d-block mb-2">Belum ada foto</small>
                    <?php endif; ?>

                    <label class="form-label">Ganti Foto (opsional)</label>
                    <input type="file" class="form-control" name="foto_siswa" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                </div>

                <button type="submit" class="btn btn-warning w-100">Update</button>
            </form>
        </div>
    </div>

</div>
</body>
</html>