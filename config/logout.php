<?php
session_start();
if (isset($_SESSION['loggedInAdmin'])) {
    unset($_SESSION['loggedInAdmin']);
}
header('Location: ../view/login.php');
?>