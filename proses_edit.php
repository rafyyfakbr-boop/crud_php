<?php
include "koneksi.php";

$id_siswa = $_POST['id_siswa'];
$nisn = $_POST['nisn'];
$nama_siswa = $_POST['nama_siswa'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$foto_lama = $_POST['foto_lama'];
$foto_siswa = $foto_lama;

$cekQuery = "SELECT id_siswa FROM tb_siswa WHERE nisn = ? AND id_siswa != ?";
$cekStmt = mysqli_prepare($koneksi, $cekQuery);
mysqli_stmt_bind_param($cekStmt, "si", $nisn, $id_siswa);
mysqli_stmt_execute($cekStmt);
mysqli_stmt_store_result($cekStmt);

if (mysqli_stmt_num_rows($cekStmt) > 0) {
    die("NISN sudah dipakai siswa lain, silakan periksa kembali data yang diinput.");
}

if (isset($_FILES['foto_siswa']) && $_FILES['foto_siswa']['error'] == 0) {
    $namaAsli        = $_FILES['foto_siswa']['name'];
    $lokasiSementara = $_FILES['foto_siswa']['tmp_name'];
    $ekstensi        = pathinfo($namaAsli, PATHINFO_EXTENSION);
    $namaBaru         = "foto_" . time() . "_" . uniqid() . "." . $ekstensi;
    $folderTujuan     = "photos/" . $namaBaru;

    if (move_uploaded_file($lokasiSementara, $folderTujuan)) {
        $foto_siswa = $namaBaru;

        if (!empty($foto_lama) && file_exists("photos/" . $foto_lama)) {
            unlink("photos/" . $foto_lama);
        }

    } else {
        die('gagal mengaupload foto baru');
    }

}

$query = "UPDATE tb_siswa SET nisn = ?, nama_siswa = ?, jenis_kelamin = ?, foto_siswa = ?, alamat = ? WHERE id_siswa =?";

$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "sssssi", $nisn, $nama_siswa, $jenis_kelamin, $foto_siswa, $alamat, $id_siswa);

if (mysqli_stmt_execute($stmt)) {
    header("location: index.php");
    exit;
} else {
    echo "gagal mengubah data: " . mysqli_error($koneksi);
}
?>