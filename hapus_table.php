<?php
    include "koneksi.php";

    $id = $_GET['id'];

    $query = "DELETE FROM tb_siswa WHERE id_siswa = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        header("location: index.php");
        exit;
    } else {
        echo "gagal menghapus data: " . mysqli_error($koneksi);
    }
?>