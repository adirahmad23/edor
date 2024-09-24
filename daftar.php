<?php
session_start();
include "proses/koneksi.php";
$kon = new Koneksi();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = $_POST['tuser'];
    $alamat = $_POST['talamat'];
    $nama = $_POST['tnama'];
    $email = $_POST['temail'];
    $password = md5($_POST['tpass']);
    // $abc = $kon->kueri("INSERT INTO login(user, pass, usia, pekerja, nama) VALUES ('$user','$password','$usia','$kerja','$nama')");

    $checkUserQuery = "SELECT * FROM login WHERE user = '$user'";
    $result = $kon->kueri($checkUserQuery);
    $jumlah = $kon->jumlah_data($result);
    // echo $jumlah;
    if ($jumlah > 0) {
        echo "
            <div class='container mt-5'>
                <div class='alert alert-danger' role='alert'>
                    Username sudah ada. Silakan coba dengan username lain.
                </div>
            </div>
            <script>
                setTimeout(function(){
                    window.location.href = 'daftar.php';
                }, 1000);
            </script>

    ";
    } else {
        $abc = $kon->kueri("INSERT INTO login(user, pass, alamat, email, nama,role) VALUES ('$user','$password','$alamat','$email','$nama','warga')");

        if ($abc == true) {
            echo "
       
            <div class='container mt-5'>
                <div class='alert alert-success' role='alert'>
                    Daftar berhasil!
                </div>
            </div>
            <script>
                setTimeout(function(){
                    window.location.href = 'login.php';
                }, 1000);
            </script>
 
        ";
        } else {
            echo "
        
            <div class='container mt-5'>
                <div class='alert alert-danger' role='alert'>
                    Pendaftaran gagal. Silakan coba lagi.
                </div>
            </div>
            <script>
                setTimeout(function(){
                    window.location.href = 'daftar.php';
                }, 1000);
            </script>
  
        ";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets\css\login\login.css" /> -->
    <!-- Favicons -->
    <link href="img/logo1.png" rel="icon">
    <title>Daftar Monitoring Carbon</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

    <!-- css -->
    <link href="assets/css/login/login.css" rel="stylesheet">
</head>

<body>

    <style>
        body {
            background-color: #FFE0B5;


        }
    </style>

    <div class="container">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-md-7">
                <!-- <img src="img/y.png" class="w-100" ;> -->
            </div>
            <div class="col-md-5">
                <form class="register-form" method="post">

                    <div class="p-5 text-center">
                        <!-- <img src="img\logo1.png" width="190px"> -->
                        <h4>Daftar Akun</h4>
                        <?php
                        // Display any error messages
                        if (isset($error)) {
                            echo '<h6 class="text-danger">' . $error . '</h6>';
                            // echo '<script>alert($error)</script>';
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="tnama" placeholder="Masukkan Lengkap">
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Alamat Lengkap</label>
                        <input type="text" class="form-control" name="talamat" placeholder="Masukkan Alamat Lengkap">
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Email</label>
                        <input type="email" class="form-control" name="temail" placeholder="Masukkan Email">
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Username</label>
                        <input type="text" class="form-control" name="tuser" placeholder="Masukkan Username">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="tpass" placeholder="Masukan Password">
                    </div>

                    <div class="mb-3 py-4">
                        <button type="submit" class="btn btn-primarys w-100">Daftar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .btn-primarys {
            background-color: #FFE0B5;
            /* Background color */
            color: #0E2473;
            /* Text color */
            border: none;
            /* Remove default button border */
        }
    </style>
    <script src="assets/css/login/app.js"></script>
</body>

</html>