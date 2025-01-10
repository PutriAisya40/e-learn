<?php 
include 'connection.php';
$id = $_GET['id'];
$deleteDosen = mysqli_query($connection, "DELETE FROM dosen WHERE id='$id'");
$deleteUser = mysqli_query($connection, "DELETE FROM user WHERE user_id='$id' AND role='dosen'");
if($deleteDosen){
    header('Location: ../view/admin/daftarDosen.php');
}
?>