<?php
include 'connection.php';
$id = $_GET['id'];
$deleteMahasiswa = mysqli_query($connection, "DELETE FROM mahasiswa WHERE id='$id'");
$deleteUser = mysqli_query($connection, "DELETE FROM user WHERE user_id='$id' AND role='mahasiswa'");
if($deleteMahasiswa){
    header('Location: ../view/admin/daftarMahasiswa.php');
}
?>