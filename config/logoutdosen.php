<?php
session_start();
if (isset($_SESSION['loggedInDosen'])) {
    unset($_SESSION['loggedInDosen']);
}
header('Location: ../view/login.php');
?>