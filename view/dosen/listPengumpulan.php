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
$tugas_id = $_GET['tugas'];
$nama_tugas = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM daftar_tugas WHERE id = $tugas_id"));
if (isset($_POST['submit']) || isset($_POST['edit'])) {
    $tugass_id = $_POST['id'];
    $nilai = $_POST['nilai'];
    $notes = $_POST['notes'];
    if (isset($_POST['submit'])) {
        $inputNilai = mysqli_query($connection, "UPDATE tugas SET nilai='$nilai', notes_dosen='$notes' WHERE id = $tugass_id");
        if ($inputNilai) {
            header("Location: listPengumpulan.php?tugas=" . $tugas_id);
        }
    } else if (isset($_POST['edit'])) {
        $inputNilai = mysqli_query($connection, "UPDATE tugas SET nilai='$nilai', notes_dosen='$notes' WHERE id = $tugass_id");
        if ($inputNilai) {
            header("Location: listPengumpulan.php?tugas=" . $tugas_id);
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
        header("Location: listPengumpulan.php?tugas=" . $tugas_id);
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>List Pengumpulan</title>
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
                    <div>
                    </div>
                    <h5 style="margin-top: -15px; margin-bottom: 30px"><span class="fas fa-edit" style="margin-right: 10px;"></span>Tugas Online&nbsp; - &nbsp;<?php echo $nama_tugas['judul'] ?></h5>
                    <section>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">NRP</th>
                                    <th style="text-align: center">Nama Mahasiswa</th>
                                    <th style="text-align: center">File</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tugas = mysqli_query($connection, "SELECT * FROM tugas WHERE dtugas_id = $tugas_id");
                                foreach ($tugas as $key => $value) {
                                    $mahasiswa = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM mahasiswa WHERE id='$value[user_id]'")); ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo ++$key ?></td>
                                        <td style="text-align: center;"><?php echo $mahasiswa['nrp'] ?></td>
                                        <td><?php echo $mahasiswa['nama_depan'] . ' ' . $mahasiswa['nama_belakang'] ?></td>
                                        <td style="color: blue"><a href="../../config/download.php?filename=<?php echo $value['nama_file'] ?>"><?php echo $value['nama_file'] ?></a></td>
                                        <td style="text-align: center">
                                            <?php
                                            if ($value['nilai'] != '') { ?>
                                                <p style="color:green"><i class="fas fa-check-circle"></i> Sudah Dinilai</p>
                                            <?php } else { ?>
                                                <p style="color:red"><i class="fas fa-minus-circle"></i> Belum Dinilai</p>
                                            <?php }
                                            ?>

                                        </td>
                                        <td style="text-align: center">
                                            <a href="" data-toggle="modal" data-target="#nilai<?php echo $value['id'] ?>">Nilai |</i></a>
                                            <a href="" data-toggle="modal" data-target="#editNilai<?php echo $value['id'] ?>"> Edit</a>
                                        </td>
                                        <div class="modal fade" id="nilai<?php echo $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Nilai Tugas - <?php echo $mahasiswa['nama_depan'] . ' ' . $mahasiswa['nama_belakang'] ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                                                            <div class="form-group">
                                                                <label>Nilai</label>
                                                                <input type="number" class="form-control" name="nilai" placeholder="Nilai" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Notes Tambahan</label>
                                                                <textarea class="form-control" rows="3" name="notes" placeholder="Notes Tambahan" required></textarea>
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

                                        <div class="modal fade" id="editNilai<?php echo $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Nilai Tugas - <?php echo $mahasiswa['nama_depan'] . ' ' . $mahasiswa['nama_belakang'] ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                                                            <div class="form-group">
                                                                <label>Nilai</label>
                                                                <input type="number" class="form-control" name="nilai" placeholder="Nilai" value="<?php echo $value['nilai'] ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Notes Tambahan</label>
                                                                <textarea class="form-control" rows="3" name="notes" placeholder="Notes Tambahan" required><?php echo $value['notes_dosen'] ?></textarea>
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
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>

                        </table>
                    </section>
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
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
</body>

</html>