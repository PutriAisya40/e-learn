<?php
include '../../config/connection.php';
session_start();
if ((!isset($_SESSION['loggedInAdmin']) || $_SESSION['loggedInAdmin'] !== true)) {
    header('Location: ../login.php');
    exit;
}
$id = $_SESSION['id'];
$query = mysqli_query($connection, "SELECT * FROM user WHERE id = $id");
$result = mysqli_fetch_assoc($query);
if (isset($_POST['editProfile'])) {
    $directory = '../../profileUser/';
    $namaFoto = $_FILES['foto']['name'];
    $tipeFoto = $_FILES['foto']['type'];
    $tempFoto = $_FILES['foto']['tmp_name'];
    move_uploaded_file($tempFoto, $directory . $namaFoto);
    $update = mysqli_query($connection, "UPDATE user SET nama_foto = '$namaFoto', tipe_foto = '$tipeFoto' WHERE id = $id");
    if ($update)
        header('Location: dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Dashboard</title>
</head>

<body style="background: #fafafa">
    <nav class="navbar navbar-light fixed-top" style="padding: 10px 40px; background-color: #374780">
        <a class="navbar-brand" href="#" style="color: #ffff">
            <img src="../assets/pens_putih.png" width="30" height="30" class="d-inline-block align-top" alt="">
            e-Learning
        </a>
        <span class="navbar-text">
            <a href="../../config/logout.php" style="color: #ffff; text-decoration: none">Logout</a>
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
                <p style="margin-top: -3px; margin-bottom: 0px">Admin</p>
                <a href="" style="color:#374780" data-toggle="modal" data-target="#editProfile">Edit Profile</a>
            </div>
            <hr>
            <ul class="list-unstyled components" style="margin-top: 10px">
                <li class="active">
                    <a href="dashboard.php"><span class="fas fa-home" style="margin-right: 20px;"></span>Dashboard</a>
                </li>
                <li>
                    <a href="daftarMahasiswa.php"><span class="fas fa-user-graduate" style="margin-right: 20px;"></span>Mahasiswa</a>
                </li>
                <li>
                    <a href="daftarDosen.php"><span class="fas fa-user" style="margin-right: 20px;"></span>Dosen</a>
                </li>
                <li>
                    <a href="daftarJurusan.php"><span class="fas fa-graduation-cap" style="margin-right: 20px;"></span>Jurusan</a>
                </li>
                <li>
                    <a href="daftarKelas.php"><span class="fas fa-chalkboard" style="margin-right: 20px;"></span>Kelas</a>
                </li>
                <li>
                    <a href="daftarMatkul.php"><span class="fas fa-book-open" style="margin-right: 20px;"></span>Mata Kuliah</a>
                </li>
                <li>
                    <a href="jadwalKuliah.php"><span class="fas fa-calendar-alt" style="margin-right: 20px;"></span>Jadwal Kuliah</a>
                </li>
                <li>
                    <a href="informasi.php"><span class="fas fa-info-circle" style="margin-right: 20px;"></span>Informasi</a>
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
                                    <i class="fal fa-user-tie" style="font-size: 60px; color:orange; margin-top: 10px"></i>
                                    <div style="margin-left: 30px">
                                        <p style="color:grey">Jumlah Dosen</p>
                                        <?php
                                        $jDosen = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM dosen"));
                                        ?>
                                        <h1 style="margin-top: -5px; font-weight: bold"><?php echo $jDosen ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="padding: 10px 10px 10px 30px; border-color: rgb(250, 250, 250); box-shadow: 0 8px 13px -4px rgb(199, 199, 199);">
                            <div class="card-body" style="flex-direction: column; align-items: flex-start;">
                                <div style="display: flex;">
                                    <i class="fal fa-user-graduate" style="font-size: 60px; color:green; margin-top: 10px"></i>
                                    <div style="margin-left: 30px">
                                        <p style="color:grey">Jumlah Mahasiswa</p>
                                        <?php
                                        $jMahasiswa = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM mahasiswa"));
                                        ?>
                                        <h1 style="margin-top: -5px; font-weight: bold"><?php echo $jMahasiswa ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="padding: 10px 10px 10px 30px; border-color: rgb(250, 250, 250); box-shadow: 0 8px 13px -4px rgb(199, 199, 199);">
                            <div class="card-body" style="flex-direction: column; align-items: flex-start;">
                                <div style="display: flex;">
                                    <i class="fal fa-users-class" style="font-size: 60px; color:red; margin-top: 10px"></i>
                                    <div style="margin-left: 30px">
                                        <p style="color:grey">Jumlah Kelas</p>
                                        <?php
                                        $jKelas = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM kelas"));
                                        ?>
                                        <h1 style="margin-top: -5px; font-weight: bold"><?php echo $jKelas ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-6">
                        <div class="jumbotron" style="background-color: white">
                            <h5 style="font-weight: bold; margin-top: -25px; margin-bottom: 20px">Mahasiswa Baru</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">NRP</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $mahasiswa = mysqli_query($connection, "SELECT * FROM mahasiswa ORDER BY id DESC LIMIT 5");
                                    foreach ($mahasiswa as $value) {
                                    ?>
                                        <tr>
                                            <td><?php echo $value['nrp'] ?></td>
                                            <td><?php echo $value['nama_depan'] . ' ' . $value['nama_belakang'] ?></td>
                                            <?php $kelas = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM kelas WHERE id = $value[kelas_id]")); ?>
                                            <td><?php echo date('d F Y', strtotime($kelas['kelas'])) ?></td>
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="jumbotron" style="background-color: white">
                            <h5 style="font-weight: bold; margin-top: -25px; margin-bottom: 20px">Dosen Baru</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">NIDN</th>
                                        <th scope="col">Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $dosen = mysqli_query($connection, "SELECT * FROM dosen ORDER BY id DESC LIMIT 5");
                                    foreach ($dosen as $value) {
                                    ?>
                                        <tr>
                                            <td><?php echo $value['nidn'] ?></td>
                                            <td><?php echo $value['nama_depan'] . ' ' . $value['nama_belakang'] ?></td>
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="jumbotron" style="background-color: white">
                    <h5 style="font-weight: bold; margin-top: -25px; margin-bottom: 20px">Pengumuman Terbaru</h5>
                    <table class="table">
                        <tbody>
                            <?php
                            $info = mysqli_query($connection, "SELECT * FROM informasi ORDER BY id DESC LIMIT 3");
                            foreach ($info as $value) {
                            ?>
                                <tr>
                                    <td><?php echo "<p style='margin-bottom:-20px; font-weight: bold'>$value[judul]</p>" ?>
                                        <br><?php echo "<p style='margin-bottom:-10px; text-align: justify'>$value[deskripsi]</p>" ?>
                                        <br><a href="../../config/download.php?filename=<?php echo $value['nama_file'] ?>" class="btn btn-primary">Download File</a>
                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer" style="background-color: #374780; color: #ffffff; padding: 10px 0; text-align: center; position: relative; bottom: 0; width: 100%;">
        <div class="container">
            <span>&copy; <?php echo date("Y"); ?> e-Learning. N2Y - Novia Yenny Nanda.</span>
        </div>
    </footer>

    <script src="../font.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</body>

</html>