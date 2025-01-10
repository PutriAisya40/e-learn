<?php 
include 'connection.php';
$id = $_GET['id'];
$deleteKelas = mysqli_query($connection, "DELETE FROM kelas WHERE id=$id");
if($deleteKelas){
    header('Location: ../view/admin/daftarKelas.php');
}

?>