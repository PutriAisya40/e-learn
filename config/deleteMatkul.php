<?php
include 'connection.php';
$id = $_GET['id'];
$deleteMatkul = mysqli_query($connection, "DELETE FROM matkul WHERE id=$id");
if($deleteMatkul){
    header('Location: ../view/admin/daftarMatkul.php');
}

?>