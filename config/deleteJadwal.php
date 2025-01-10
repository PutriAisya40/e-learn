<?php 
include 'connection.php';
$id = $_GET['id'];
$deleteJadwal = mysqli_query($connection, "DELETE FROM jadwal WHERE id=$id");
if($deleteJadwal){
    header('Location: ../view/admin/jadwalKuliah.php');
}

?>