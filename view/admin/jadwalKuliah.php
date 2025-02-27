<?php
include '../../config/connection.php';
session_start();
if (!isset($_SESSION['loggedInAdmin']) || $_SESSION['loggedInAdmin'] !== true) {
    header('Location: ../login.php');
    exit;
}
$id = $_SESSION['id'];
$query = mysqli_query($connection, "SELECT * FROM user WHERE id = $id");
$result = mysqli_fetch_assoc($query);

if (isset($_POST['submit']) || isset($_POST['edit'])) {
    $idMatkul = $_POST['matkul'];
    $idDosen = $_POST['dosen'];
    $idKelas = $_POST['kelas'];
    $hari = $_POST['hari'];
    $jamMulai = $_POST['jamMulai'];
    $jamSelesai = $_POST['jamSelesai'];
    if (isset($_POST['submit'])) {
        $inputJadwal = mysqli_query($connection, "INSERT INTO jadwal VALUES('', '$idMatkul', '$idDosen', '$idKelas', '$hari','$jamMulai', '$jamSelesai')");
        if ($inputJadwal) {
            header('Location: jadwalKuliah.php');
        }
    } else if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $updateMatkul = mysqli_query($connection, "UPDATE jadwal SET matkul_id='$idMatkul', dosen_id='$idDosen', kelas_id='$idKelas', hari='$hari', jam_mulai='$jamMulai', jam_selesai='$jamSelesai' WHERE id='$id'");
        if ($updateMatkul) {
            header('Location: jadwalKuliah.php');
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
    if ($update)
        header('Location: jadwalKuliah.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Jadwal Kuliah</title>
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
            <ul class="list-unstyled components" style="margin-top: -10px">
                <li>
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
                <li class="active">
                    <a href="jadwalKuliah.php"><span class="fas fa-calendar-alt" style="margin-right: 20px;"></span>Jadwal Kuliah</a>
                </li>
                <li>
                    <a href="informasi.php"><span class="fas fa-info-circle" style="margin-right: 20px;"></span>Informasi</a>
                </li>
            </ul>
        </nav>
        <div class="content">
            <div style="padding: 30px 20px">
                <div class="jumbotron" style="background-color: #fff">
                    <div style="display: flex; justify-content: space-between">
                        <h5 style="margin-top: -15px; margin-bottom: 15px"><span class="fas fa-calendar-alt" style="margin-right: 10px;"></span>Jadwal Kuliah</h5>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inputData" style="margin-top: -15px; margin-bottom: 15px">
                            + Tambah Jadwal
                        </button>
                        <div class="modal fade" id="inputData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Jadwal Kuliah</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <?php
                                                $matkul = mysqli_query($connection, "SELECT * FROM matkul");
                                                ?>
                                                <label>Mata Kuliah</label>
                                                <select class="form-control" name="matkul" required>
                                                    <option selected>Pilih</option>
                                                    <?php
                                                    foreach ($matkul as $vmatkul) {
                                                        echo "<option value=" . $vmatkul['id'] . ">" . $vmatkul['matkul'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <?php
                                                $dosen = mysqli_query($connection, "SELECT * FROM dosen");
                                                ?>
                                                <label>Dosen Pengajar</label>
                                                <select class="form-control" name="dosen" required>
                                                    <option selected>Pilih</option>
                                                    <?php
                                                    foreach ($dosen as $vdosen) {
                                                        echo "<option value=" . $vdosen['id'] . ">" . $vdosen['nama_depan'] . ' ' . $vdosen['nama_belakang'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <?php
                                                $kelas = mysqli_query($connection, "SELECT * FROM kelas");
                                                ?>
                                                <label>Kelas</label>
                                                <select class="form-control" name="kelas" required>
                                                    <option selected>Pilih</option>
                                                    <?php
                                                    foreach ($kelas as $vkelas) {
                                                        echo "<option value=" . $vkelas['id'] . ">" . $vkelas['kelas'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Hari</label>
                                                <select class="form-control" name="hari" required>
                                                    <option selected>Pilih</option>
                                                    <option value="Senin">Senin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Kamis">Kamis</option>
                                                    <option value="Jumat">Jumat</option>
                                                </select>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Jam Mulai</label>
                                                    <input type="time" class="form-control" name="jamMulai" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Jam Selesai</label>
                                                    <input type="time" class="form-control" name="jamSelesai" required>
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

                    <section>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">Mata Kuliah</th>
                                    <th style="text-align: center">Dosen Pengajar</th>
                                    <th style="text-align: center">Kelas</th>
                                    <th style="text-align: center">Hari</th>
                                    <th style="text-align: center">Jam</th>
                                    <th style="text-align: center">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dataMatkul = mysqli_query($connection, "SELECT * FROM jadwal");
                                foreach ($dataMatkul as $key => $value) {
                                    $matkul = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM matkul WHERE id='$value[matkul_id]'"));
                                    $dosen = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM dosen WHERE id='$value[dosen_id]'"));
                                    $kelas = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM kelas WHERE id='$value[kelas_id]'")) ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo ++$key ?></td>
                                        <td><?php echo $matkul['matkul'] ?></td>
                                        <td><?php echo $dosen['nama_depan'] . ' ' . $dosen['nama_belakang'] ?></td>
                                        <td><?php echo $kelas['kelas'] ?></td>
                                        <td style="text-align: center"><?php echo $value['hari'] ?></td>
                                        <td style="text-align: center"><?php echo $value['jam_mulai'] . ' - ' . $value['jam_selesai'] ?></td>
                                        <td style="text-align: center">
                                            <a href="" data-toggle="modal" data-target="#editData<?php echo $value['id'] ?>">Edit</a> |
                                            <a href="" data-toggle="modal" data-target="#deleteData<?php echo $value['id'] ?>">Hapus</a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editData<?php echo $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Jadwal Kuliah</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                                                        <div class="form-group">
                                                            <?php
                                                            $matkul = mysqli_query($connection, "SELECT * FROM matkul");
                                                            ?>
                                                            <label>Mata Kuliah</label>
                                                            <select class="form-control" name="matkul" required>
                                                                <option selected>Pilih</option>
                                                                <?php
                                                                foreach ($matkul as $vmatkul) { ?>
                                                                    <option value="<?php echo $vmatkul['id'] ?>" <?php if ($value['matkul_id'] == $vmatkul['id']) echo "selected" ?>><?php echo $vmatkul['matkul'] ?></option>
                                                                <?php }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <?php
                                                            $dosen = mysqli_query($connection, "SELECT * FROM dosen");
                                                            ?>
                                                            <label>Dosen Pengajar</label>
                                                            <select class="form-control" name="dosen" required>
                                                                <option selected>Pilih</option>
                                                                <?php
                                                                foreach ($dosen as $vdosen) { ?>
                                                                    <option value="<?php echo $vdosen['id'] ?>" <?php if ($value['dosen_id'] == $vdosen['id']) echo "selected" ?>><?php echo $vdosen['nama_depan'] . ' ' . $vdosen['nama_belakang'] ?></option>
                                                                <?php }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <?php
                                                            $kelas = mysqli_query($connection, "SELECT * FROM kelas");
                                                            ?>
                                                            <label>Kelas</label>
                                                            <select class="form-control" name="kelas" required>
                                                                <option selected>Pilih</option>
                                                                <?php
                                                                foreach ($kelas as $vkelas) { ?>
                                                                    <option value="<?php echo $vkelas['id'] ?>" <?php if ($value['kelas_id'] == $vkelas['id']) echo "selected" ?>><?php echo $vkelas['kelas'] ?></option>
                                                                <?php }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Hari</label>
                                                            <select class="form-control" name="hari" required>
                                                                <option selected>Pilih</option>
                                                                <option value="Senin" <?php if ($value['hari'] == 'Senin') echo "selected" ?>>Senin</option>
                                                                <option value="Selasa" <?php if ($value['hari'] == 'Selasa') echo "selected" ?>>Selasa</option>
                                                                <option value="Rabu" <?php if ($value['hari'] == 'Rabu') echo "selected" ?>>Rabu</option>
                                                                <option value="Kamis" <?php if ($value['hari'] == 'Kamis') echo "selected" ?>>Kamis</option>
                                                                <option value="Jumat" <?php if ($value['hari'] == 'Jumat') echo "selected" ?>>Jumat</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label>Jam Mulai</label>
                                                                <input type="time" class="form-control" name="jamMulai" value="<?php echo $value['jam_mulai'] ?>" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Jam Selesai</label>
                                                                <input type="time" class="form-control" name="jamSelesai" value="<?php echo $value['jam_selesai'] ?>" required>
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
                                    <div class="modal fade" id="deleteData<?php echo $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div style="text-align: center; margin-top: 10px; color: #dc3545; "><span class="fas fa-exclamation-circle" style="font-size: 60px;"></span></div>
                                                    <p style="text-align: center; margin-top: 20px;">Apakah Anda yakin akan menghapus data ini?</p>
                                                    <div style="text-align: center; margin-bottom: 20px">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Batal</button>
                                                        <a href="../../config/deleteJadwal.php?id=<?php echo $value['id'] ?>" class="btn btn-danger" style="margin-left: 10px">Yakin</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

    <footer class="footer" style="background-color: #374780; color: #ffffff; padding: 10px 0; text-align: center; position: relative; bottom: 0; width: 100%;">
        <div class="container">
            <span>&copy; <?php echo date("Y"); ?> e-Learning. N2Y - Novia Yenny Nanda.</span>
        </div>
        <footer class="footer" style="background-color: #374780; color: #ffffff; padding: 10px 0; text-align: center; width: 100%;">
            <div class="container">
                <span>&copy; <?php echo date("Y"); ?> e-Learning. N2Y - Novia Yenny Nanda.</span>
            </div>
        </footer>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>

</body>

</html>