<?php
include '../../config/connection.php';
session_start();
if ((!isset($_SESSION['loggedInDosen']) || $_SESSION['loggedInDosen'] !== true)) {
    header('Location: ../login.php');
    exit;
}
$id = $_SESSION['id'];
$query = mysqli_query($connection, "SELECT * FROM user WHERE id = $id");
$result = mysqli_fetch_assoc($query);
$matkul_id = $_GET['matkul'];
$kelas_id = $_GET['kelas'];
if (isset($_POST['submit']) || isset($_POST['edit'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $deadline = $_POST['deadline'];
    $matkul = $_POST['matkul'];
    $kelas = $_POST['kelas'];
    $jam = $_POST['jam'];
    if (isset($_POST['submit'])) {
        $inputTugas = mysqli_query($connection, "INSERT INTO daftar_tugas VALUES('', '$matkul', '$result[user_id]', '$kelas', '$judul', '$deskripsi', '$deadline', '$jam')");
        if ($inputTugas) {
            header("Location: daftarTugas.php?matkul=" . $matkul_id . "&kelas=" . $kelas_id);
        }
    } else if (isset($_POST['edit'])) {
        $id_tugas = $_POST['id'];
        $editTugas = mysqli_query($connection, "UPDATE daftar_tugas SET judul='$judul', deskripsi='$deskripsi', deadline='$deadline', jam='$jam' WHERE id='$id_tugas'");
        if ($editTugas) {
            header("Location: daftarTugas.php?matkul=" . $matkul_id . "&kelas=" . $kelas_id);
        }
    }
}
if (isset($_POST['editProfile'])) {
    $directory = '../../profileUser/';
    $namaFoto = $_FILES['foto']['name'];
    $tipeFoto = $_FILES['foto']['type'];
    $tempFoto = $_FILES['foto']['tmp_name'];
    move_uploaded_file($tempFoto, $directory . $namaFoto);
    $update = mysqli_query($connection, "UPDATE user SET nama_foto = '$namaFoto', tipe_foto = '$tipeFoto' WHERE id = $id");
    $updateDosen = mysqli_query($connection, "UPDATE dosen SET nama_foto = '$namaFoto', tipe_foto = '$tipeFoto' WHERE id = $result[user_id]");
    if ($update && $updateDosen)
        header("Location: daftarTugas.php?matkul=" . $matkul_id . "&kelas=" . $kelas_id);
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
    <title>Daftar Tugas</title>
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
                <p style="margin-top: -3px; margin-bottom: 0px">Dosen</p>
                <a href="" style="color:#374780" data-toggle="modal" data-target="#editProfile">Edit Profile</a>
            </div>
            <hr>
            <ul class="list-unstyled components" style="margin-top: 10px">
                <li>
                    <a href="dashboard.php"><span class="fas fa-home" style="margin-right: 20px;"></span>Dashboard</a>
                </li>
                <li>
                    <a href="jadwalKuliah.php"><span class="fas fa-calendar-alt" style="margin-right: 20px;"></span>Jadwal Kuliah</a>
                </li>
                <li class="active">
                    <a href="tugasOnline.php"><span class="fas fa-edit" style="margin-right: 20px;"></span>Tugas Online</a>
                </li>
            </ul>
        </nav>
        <div class="content">
            <div style="padding: 30px 20px">
                <div class="jumbotron" style="background-color: #fff">
                    <div style="display: flex; justify-content: space-between">
                        <h5 style="margin-top: -15px; margin-bottom: 15px"><span class="fas fa-edit" style="margin-right: 10px;"></span>Tugas Online</h5>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inputData" style="margin-top: -15px; margin-bottom: 15px">
                            + Tambah Tugas
                        </button>
                        <div class="modal fade" id="inputData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Tugas</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <input type="hidden" name="matkul" value="<?php echo $matkul_id ?>">
                                            <input type="hidden" name="kelas" value="<?php echo $kelas_id ?>">
                                            <div class="form-group">
                                                <label>Judul Tugas</label>
                                                <input type="text" class="form-control" name="judul" placeholder="Judul" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi Tugas</label>
                                                <textarea class="form-control" rows="3" name="deskripsi" placeholder="Deskripsi" required></textarea>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Deadline</label>
                                                    <input type="date" class="form-control" name="deadline" placeholder="Deadline" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Jam</label>
                                                    <input type="time" class="form-control" name="jam" placeholder="Jam" required>
                                                </div>
                                            </div>
                                            <hr style="margin-left: -15px; margin-right: -15px;">
                                            <div style="margin-top: 5px; float: right; display: block">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $tugas = mysqli_query($connection, "SELECT * FROM daftar_tugas WHERE matkul_id=$matkul_id AND kelas_id=$kelas_id AND dosen_id=$result[user_id]");
                        while ($vtugas = mysqli_fetch_assoc($tugas)) { ?>
                            <div class="col-md-4">
                                <div class="card" style="margin-top: 20px; height: 230px; border-color: #748bdb">
                                    <div class="card-body" style="flex-direction: column; align-items: flex-start; justify-content:space-between">
                                        <div>
                                            <p class="card-text" style="font-weight: bold; color:  #575555"><?php echo $vtugas['judul'] ?></p>
                                            <p class="card-text" style="margin-top: -10px;"><?php echo $vtugas['deskripsi'] ?></p>
                                        </div>
                                        <div style="color:#3672ff">
                                            <p style="margin-top: 10px;"><i class="fas fa-clock"></i>&nbsp;Deadline : <?php echo date('d F Y', strtotime($vtugas['deadline'])) . '&nbsp;&nbsp;-&nbsp;&nbsp;' . $vtugas['jam'] ?></p>
                                        </div>
                                    </div>
                                    <div class="card-footer" style="text-align:center">
                                        <a href="listPengumpulan.php?tugas=<?php echo $vtugas['id'] ?>" class="btn btn-primary">Pengumpulan</a>
                                        <button class="btn btn-success" style="width: 70px" data-toggle="modal" data-target="#editData<?php echo $vtugas['id'] ?>">Edit</button>
                                        <a href="../../config/deleteDaftarTugas.php?id=<?php echo $vtugas['id'] ?>&matkul=<?php echo $vtugas['matkul_id'] ?>&kelas=<?php echo $vtugas['kelas_id'] ?>" class="btn btn-danger">Hapus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="editData<?php echo $vtugas['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Tugas</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $vtugas['id'] ?>">
                                                <input type="hidden" name="matkul" value="<?php echo $vtugas['matkul_id'] ?>">
                                                <input type="hidden" name="kelas" value="<?php echo $vtugas['kelas_id'] ?>">
                                                <div class="form-group">
                                                    <label>Judul Tugas</label>
                                                    <input type="text" class="form-control" name="judul" value="<?php echo $vtugas['judul'] ?>" placeholder="Judul" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi Tugas</label>
                                                    <textarea class="form-control" rows="3" name="deskripsi" placeholder="Deskripsi" required><?php echo $vtugas['deskripsi'] ?></textarea>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Deadline</label>
                                                        <input type="date" class="form-control" name="deadline" value="<?php echo $vtugas['deadline'] ?>" placeholder="Deadline" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Jam</label>
                                                        <input type="time" class="form-control" name="jam" value="<?php echo $vtugas['jam'] ?>" placeholder="Jam" required>
                                                    </div>
                                                </div>
                                                <hr style="margin-left: -15px; margin-right: -15px;">
                                                <div style="margin-top: 5px; float: right; display: block">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="edit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>

</html>