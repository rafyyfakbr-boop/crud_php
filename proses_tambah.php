<?php
include "koneksi.php";

$nisn = $_POST['nisn'];
$nama_siswa = $_POST['nama_siswa'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$foto_siswa = "";

$cekQuery = "SELECT id_siswa FROM tb_siswa WHERE nisn = ?";
$cekStmt = mysqli_prepare($koneksi, $cekQuery);
mysqli_stmt_bind_param($cekStmt, "s", $nisn);
mysqli_stmt_execute($cekStmt);
mysqli_stmt_store_result($cekStmt);

if (mysqli_stmt_num_rows($cekStmt)) {
    die("NISN sudah terdaftar, silakan periksa kembali data yang diinput.");
}

if (isset($_FILES['foto_siswa']) && $_FILES['foto_siswa']['error'] == 0 ) {
    $namaAsli   = $_FILES['foto_siswa']['name'];        // nama file asli dari komputer user
    $lokasiSementara = $_FILES['foto_siswa']['tmp_name'];

    $ekstensi = pathinfo($namaAsli, PATHINFO_EXTENSION);
    $nama_baru = "foto" . time() . "_" . uniqid() . "." . $ekstensi; //membuat nama unik
    $folder_tujuan = "photos/" . $nama_baru; //folder tujuan untuk menyimpan foto

    if (move_uploaded_file($lokasiSementara, $folder_tujuan)) {
        $foto_siswa = $nama_baru; //untuk nama yang di simpan ke database
    } else {
        die('Gagal mengaupload foto');
    }
};

$query = "INSERT INTO tb_siswa (nisn, nama_siswa, jenis_kelamin, foto_siswa, alamat) 
          VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "sssss", $nisn, $nama_siswa, $jenis_kelamin, $foto_siswa, $alamat);

if (mysqli_stmt_execute($stmt)) {
    header("location: index.php");
    exit;
} else {
    echo "gagal menyimpan data: " . mysqli_errno($koneksi);
}
?>