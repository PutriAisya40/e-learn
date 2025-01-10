<?php
session_start();
$errorMessage = '';
if (isset($_POST['email']) && isset($_POST['password'])) {
    include '../config/connection.php';
    $email = $_POST['email'];
    $password = $_POST['password']; // Tidak menggunakan hash
    $result = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email' AND password ='$password'");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['id'] = $row['id'];
        if ($row['role'] == 'admin') {
            $_SESSION['loggedInAdmin'] = true;
            header('Location: admin/dashboard.php');
            exit;
        } else if ($row['role'] == 'dosen') {
            $_SESSION['loggedInDosen'] = true;
            header('Location: dosen/dashboard.php');
            exit;
        } else {
            $_SESSION['loggedInMahasiswa'] = true;
            header('Location: user/dashboard.php');
            exit;
        }
    } else {
        $errorMessage = 'Sorry, email or password was wrong';
    }
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body style="background-color: rgb(243, 243, 243);">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="jumbotron" style="margin-top:70px; background-color: white; box-shadow: 0 8px 16px -6px black;">
                    <div class="row">
                        <div class="col-md-7" style="padding: 0px 60px;">
                            <div style="text-align: center; ">
                                <img src="assets/pens.png" width="50px" style="margin-top: 35px;">
                            </div>
                            <h3 style="text-align: center; font-weight: bold; margin: 20px 0px;">SIGN IN</h3>
                            <?php
                            if ($errorMessage != '') {
                                echo "<p style='color: red; margin-top: -18px; margin-bottom: 10px; text-align: center'>$errorMessage</p>";
                            }
                            ?>
                            <form action="" method="POST">
                                <div class="form-group form-logres1">
                                    <span class="fa fa-user form-control-icon"></span>
                                    <input type="text" class="form-control form-logres2" name="email" placeholder="Email">
                                </div>
                                <div class="form-group form-logres1">
                                    <span class="fa fa-lock form-control-icon"></span>
                                    <input type="password" class="form-control form-logres2" name="password" placeholder="Password">
                                </div>
                                <div style="text-align: center;">
                                    <button type="submit" class="btn" style=" padding: 4px 20px; margin-top: 15px; background-color: #374780; color: #fff">SIGN IN</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-5" style="margin-top: -56px; margin-bottom: -56px;">
                            <img src="assets/pens2.jpg" width="312px" style="border-radius: 5px; margin-left: -20px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>

</html>