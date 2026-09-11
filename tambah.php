<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f4f4; padding: 40px; }
    </style>
</head>
<body>
<div class="container" style="max-width: 500px;">

    <a href="index.php" class="d-inline-block mb-3">&larr; Kembali ke daftar</a>

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-3">Tambah Data Siswa</h4>
            <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">NISN</label>
                    <input type="text" class="form-control" name="nisn" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" name="nama_siswa" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="jenis_kelamin" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Siswa</label>
                    <input type="file" class="form-control" name="foto_siswa" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG, atau GIF. Boleh dikosongkan.</small>
                </div>

                <button type="submit" class="btn btn-success w-100">Simpan</button>
            </form>
        </div>
    </div>

</div>
</body>
</html>