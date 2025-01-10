<?php
include '../../config/connection.php';
session_start();
if ((!isset($_SESSION['loggedInMahasiswa']) || $_SESSION['loggedInMahasiswa'] !== true)) {
    header('Location: ../login.php');
    exit;
}
$id = $_SESSION['id'];
$query = mysqli_query($connection, "SELECT * FROM user WHERE id = $id");
$result = mysqli_fetch_assoc($query);
$data = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM mahasiswa WHERE id = $result[user_id]"));

if (isset($_POST['editProfile'])) {
    $directory = '../../profileUser/';
    $namaFoto = $_FILES['foto']['name'];
    $tipeFoto = $_FILES['foto']['type'];
    $tempFoto = $_FILES['foto']['tmp_name'];
    move_uploaded_file($tempFoto, $directory . $namaFoto);
    $update = mysqli_query($connection, "UPDATE user SET nama_foto = '$namaFoto', tipe_foto = '$tipeFoto' WHERE id = $id");
    $updateMahasiswa = mysqli_query($connection, "UPDATE mahasiswa SET nama_foto = '$namaFoto', tipe_foto = '$tipeFoto' WHERE id = $result[user_id]");
    if ($update && $updateMahasiswa)
        header('Location: dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../assets/penss.png">
    <title>Dashboard</title>
</head>

<body style="background: #fafafa">
    <nav class="navbar navbar-light fixed-top" style="padding: 10px 40px; background-color: #374780">
        <a class="navbar-brand" href="#" style="color: #ffff">
            <img src="../assets/pens_putih.png" width="30" height="30" class="d-inline-block align-top" alt="">
            e-Learning
        </a>
        <span class="navbar-text">
            <a href="../../config/logoutDosen.php" style="color: #ffff; text-decoration: none">Logout</a>
        </span>
    </nav>
    <div class="wrapper">
        <nav id="sidebar">
            <div style="text-align: center; margin-top: 15px">
                <?php
                if ($result['nama_foto'] == '') {
                ?><img src="../assets/user.png" width="90px" height="90px" class="rounded-circle border border-dark"><br><br>
                <?php
                } else {
                ?><img src="../../profileUser/<?php echo $result['nama_foto'] ?>" width="100px" height="100px" class="rounded-circle border border-dark"><br><br>
                <?php
                }
                ?>
                <p style="margin-top: -12px; font-weight: bold; margin-bottom: 2px"><?php echo $result['nama'] ?></p>
                <p style="margin-top: -3px; margin-bottom: 0px">Mahasiswa</p>
                <a href="" style="color:#374780" data-toggle="modal" data-target="#editProfile">Edit Profile</a>
            </div>
            <hr>
            <ul class="list-unstyled components" style="margin-top: 10px">
                <li class="active">
                    <a href="dashboard.php"><span class="fas fa-home" style="margin-right: 20px;"></span>Dashboard</a>
                </li>
                <li>
                    <a href="jadwalKuliah.php"><span class="fas fa-calendar-alt" style="margin-right: 20px;"></span>Jadwal Kuliah</a>
                </li>
                <li>
                    <a href="tugasOnline.php"><span class="fas fa-edit" style="margin-right: 20px;"></span>Tugas Online</a>
                </li>
            </ul>
        </nav>
        <div class="content">
            <div style="padding: 30px 20px">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card" style="padding: 10px 10px 10px 30px; border-color: rgb(250, 250, 250); box-shadow: 0 8px 13px -4px rgb(199, 199, 199);">
                            <div class="card-body" style="flex-direction: column; align-items: flex-start;">
                                <div style="display: flex;">
                                    <i class="fal fa-clipboard-list" style="font-size: 60px; color:#7dafff; margin-top: 10px; color: orange"></i>
                                    <div class="display: column" style="margin-left: 30px">
                                        <p style="color:grey">Jumlah Tugas</p>
                                        <?php
                                        $jTugas = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM daftar_tugas WHERE kelas_id = $data[kelas_id]"));
                                        ?>
                                        <h1 style="margin-top: -5px; font-weight: bold"><?php echo $jTugas ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="padding: 10px 10px 10px 30px; border-color: rgb(250, 250, 250); box-shadow: 0 8px 13px -4px rgb(199, 199, 199);">
                            <div class="card-body" style="flex-direction: column; align-items: flex-start;">
                                <div style="display: flex;">
                                    <i class="fal fa-check-circle" style="font-size: 60px; color:#7dafff; margin-top: 10px; color: green"></i>
                                    <div class="display: column" style="margin-left: 30px">
                                        <p style="color:grey">Sudah Selesai</p>
                                        <?php
                                        $jSudah = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM tugas WHERE user_id = $result[user_id]"));
                                        ?>
                                        <h1 style="margin-top: -5px; font-weight: bold"><?php echo $jSudah ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="padding: 10px 10px 10px 30px; border-color: rgb(250, 250, 250); box-shadow: 0 8px 13px -4px rgb(199, 199, 199);">
                            <div class="card-body" style="flex-direction: column; align-items: flex-start;">
                                <div style="display: flex;">
                                    <i class="fal fa-times-circle" style="font-size: 60px; color:#7dafff; margin-top: 10px; color: red"></i>
                                    <div class="display: column" style="margin-left: 30px">
                                        <p style="color:grey">Belum Selesai</p>
                                        <?php
                                        $jBelum = $jTugas - $jSudah;
                                        ?>
                                        <h1 style="margin-top: -5px; font-weight: bold"><?php echo $jBelum ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-7">
                        <div class="jumbotron" style="background-color: white">
                        <h5 style="font-weight: bold; margin-top: -25px; margin-bottom: 20px">Tugas Terbaru</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Mata Kuliah</th>
                                        <th scope="col">Judul Tugas</th>
                                        <th scope="col">Deadline</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $tugas = mysqli_query($connection, "SELECT * FROM daftar_tugas WHERE kelas_id = $data[kelas_id] ORDER BY id DESC LIMIT 5");
                                foreach($tugas as $key=>$value){
                                ?>
                                    <tr>
                                        <?php $matkul = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM matkul WHERE id = $value[matkul_id]"));?>
                                        <td><?php echo $matkul['matkul'] ?></td>
                                        <td><?php echo $value['judul'] ?></td>
                                        <td><?php echo date('d F Y', strtotime($value['deadline'])) ?></td>
                                    </tr>
                                <?php 
                                }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="jumbotron" style="background-color: white">
                        <h5 style="font-weight: bold; margin-top: -25px; margin-bottom: 20px">Pengumuman</h5>
                            <table class="table">
                                <tbody>
                                <?php
                                $info = mysqli_query($connection, "SELECT * FROM informasi ORDER BY id DESC LIMIT 3");
                                foreach($info as $value){
                                ?>
                                    <tr>
                                        <td><?php echo "<p style='margin-bottom:-20px; font-weight: bold'>$value[judul]</p>" ?>
                                        <br><?php echo "<p style='margin-bottom:-10px; text-align: justify'>$value[deskripsi]</p>"?>
                                        <br><a href="../../config/download.php?filename=<?php echo $value['nama_file'] ?>" class="btn btn-primary">Download File</a></td>
                                    </tr>
                                <?php 
                                }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="text-align: center; margin-top: 10px">
                        <?php
                        if ($result['nama_foto'] == '') {
                        ?><img src="../assets/user.png" width="90px" height="90px" class="rounded-circle border border-dark"><br><br>
                        <?php
                        } else {
                        ?><img src="../../profileUser/<?php echo $result['nama_foto'] ?>" width="100px" height="100px" class="rounded-circle border border-dark"><br><br>
                        <?php
                        }
                        ?>
                        <p style="margin-top: -5px; font-weight: bold; margin-bottom: 25px"><?php echo $result['nama'] ?></p>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div>
                            <div class="row" style="margin-bottom: 40px; margin-right: 20px; margin-left: 20px">
                                <div class="col-md-10">
                                    <input style="padding: 2px 0px 0px 5px;" class="form-control" type="file" name="foto" autocomplete="off" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" name="editProfile" class="btn btn-primary" style="width: 70px; margin-left: -22px">Save</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../font.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>

</html>