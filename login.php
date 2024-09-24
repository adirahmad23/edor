<?php
session_start();
include "proses/koneksi.php";
$kon = new Koneksi();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the input values
    $user = $_POST['tuser'];
    $password = md5($_POST['tpass']);
    if (empty($_POST['tuser']) || empty(md5($_POST['tpass']))) {
        $error = 'Masukan user & Password.';
    } else {
        $abc = $kon->kueri("SELECT * FROM login WHERE user='$user' AND pass = '$password' ");
        $user = $kon->hasil_data($abc);
        if (!$user) {
            $error = 'Invalid user atau Password.';
        } else {
            // Check if the password matches the hshed password stored in the database
            if (($password == $user['pass'])) {
                // Passwords match, so create a session for the user and redirect to a secured page
                $_SESSION['id'] = $user['id'];
                $_SESSION['user'] = $user['user'];
                $_SESSION['nama'] = $user['nama'];
                header('Location: index.php');
                exit;
            } else if ($password != $user['pass']) {
                // Passwords do not match, so display an error message
                $error = 'Invalid user/email atau password.';
            }
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
    <link href="img/logo.png" rel="icon">
    <title>Login</title>
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
                <img src="img/y.png" class="w-100" ;>
            </div>
            <div class="col-md-5">
                <form class="register-form" method="post">

                    <div class="p-5 text-center">
                        <img src="assets/icon/logo.png" width="100px">
                        <h4>E-skin Detector</h4>
                        <?php
                        // Display any error messages
                        if (isset($error)) {
                            echo '<h6 class="text-danger">' . $error . '</h6>';
                            // echo '<script>alert($error)</script>';
                        }
                        ?>
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
                        <button type="submit" class="btn btn-primarys w-100">Sign In</button>
                        <p><a href="daftar.php" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                <center>Sign Up</center>
                            </a></p>
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