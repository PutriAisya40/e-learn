<?php 
include 'connection.php';
$id = $_GET['id'];
$deleteJurusan = mysqli_query($connection, "DELETE FROM jurusan WHERE id=$id");
if($deleteJurusan){
    header('Location: ../view/admin/daftarJurusan.php');
}
?>