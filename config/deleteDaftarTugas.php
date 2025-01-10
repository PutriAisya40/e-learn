<?php
include 'connection.php';
$id = $_GET['id'];
$matkul = $_GET['matkul'];
$kelas = $_GET['kelas'];
$delete = mysqli_query($connection, "DELETE FROM daftar_tugas WHERE id = $id");
if($delete){
    header("Location: ../view/dosen/daftarTugas.php?matkul=" . $matkul . "&kelas=" . $kelas);
}
?>