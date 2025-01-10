<?php 
include 'connection.php';
$id = $_GET['id'];
$deleteInfo = mysqli_query($connection, "DELETE FROM informasi WHERE id=$id");
if($deleteInfo){
    header('Location: ../view/admin/informasi.php');
}

?>