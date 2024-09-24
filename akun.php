<?php
include_once "proses/koneksi.php";
$kon = new Koneksi();

// Ambil semua data dari tabel tb_imgdeteksi
$abc = $kon->kueri("SELECT * FROM tb_imgdeteksi");
$data = $kon->hasil_array($abc);

// Array untuk menyimpan nama-nama gambar berdasarkan jenis penyakit
$names = [];
foreach ($data as $item) {
    $nama = $item['nama'];
    $parts = explode('_', $nama);
    $name = $parts[0]; // Ambil jenis penyakit dari nama file gambar
    $names[$name][] = $nama; // Masukkan nama file ke array berdasarkan jenis penyakit
}

// Ambil gambar terbaru berdasarkan timestamp
$latest_images = [];
foreach ($names as $type => $image_names) {
    $latest_image = null;
    $latest_timestamp = 0;
    foreach ($data as $item) {
        $nama = $item['nama'];
        if (in_array($nama, $image_names)) {
            $timestamp = strtotime($item['waktu']);
            if ($timestamp > $latest_timestamp) {
                $latest_timestamp = $timestamp;
                $latest_image = $nama;
            }
        }
    }
    $latest_images[$type] = $latest_image; // Simpan gambar terbaru per penyakit
}

// Ambil timestamp untuk gambar terbaru
$latest_images_with_timestamps = [];
foreach ($latest_images as $type => $image_name) {
    foreach ($data as $item) {
        if ($item['nama'] == $image_name) {
            $timestamp = $item['waktu'];
            $latest_images_with_timestamps[$type] = date('d-m-Y H:i:s', strtotime($timestamp));
            break;
        }
    }
}

// Data gambar terbaru dan waktu untuk setiap penyakit
$bisul = $latest_images['bisul'];
$panu = $latest_images['panu'];
$kadasKurap = $latest_images['kadasKurap'];
$fluSingapura = $latest_images['fluSingapura'];
$biduran = $latest_images['biduran'];

$bisul_waktu = $latest_images_with_timestamps['bisul'];
$panu_waktu = $latest_images_with_timestamps['panu'];
$kadasKurap_waktu = $latest_images_with_timestamps['kadasKurap'];
$fluSingapura_waktu = $latest_images_with_timestamps['fluSingapura'];
$biduran_waktu = $latest_images_with_timestamps['biduran'];

?>

<!DOCTYPE html>
<html lang="en">

<?php include_once "template/header.php"; ?>
<?php include_once "template/extension.php"; ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        margin-top: 50px;
    }

    .card {
        border-radius: 15px;
    }

    .card-header {
        background-color: #d4a373;
        color: white;
        border-radius: 15px 15px 0 0;
    }

    .list-group-item {
        border-radius: 0;
    }

    .btn-primary {
        background-color: #bb9457;
        border-color: #bb9457;
    }

    .btn-primary:hover {
        background-color: #a07842;
        border-color: #a07842;
    }

    .navbar {
        background-color: #d4a373;
        padding: 10px;
        border-radius: 0 0 15px 15px;
    }

    .navbar-nav .nav-link {
        color: white;
    }

    .navbar-nav .nav-link:hover {
        color: #f8f9fa;
    }

    .profile-form label {
        font-weight: bold;
    }

    .profile-form input[type="text"],
    .profile-form input[type="email"],
    .profile-form input[type="date"] {
        border-radius: 5px;
        border: 1px solid #ced4da;
    }

    .profile-form .btn-primary {
        width: 100%;
    }
</style>

<body style="overflow: hidden;">
    <!--=============== Bottom Bar ===============-->
    <?php include_once "template/bottombar.php"; ?>
    <main>
        <!--=============== HOME ===============-->
        <section class="container-app section__height" id="home">
            <div class="container mt-">
                <div class="row">
                    <div class="col-sm-4 my-5">
                        <div class="card">
                            <div class="card-header text-center">
                                <img src="assets/icon/profile.png" class="rounded-circle" alt="Profile Picture" width="60" height="60">
                                <h4 class="mt-2"><?= $_SESSION['nama']; ?></h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="diagnosis-tab" data-toggle="tab" href="#diagnosis" role="tab" aria-controls="diagnosis" aria-selected="true">Histori Diagnosa</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="diagnosis" role="tabpanel" aria-labelledby="diagnosis-tab">
                                        <ul class="list-group mt-3">
                                            <!-- Daftar Diagnosa -->
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="hasildeteksi/<?= $fluSingapura; ?>" alt="Card image" class="img-fluid rounded-circle" style="width: 55px; height: 55px; margin-right: 16px;">
                                                    <div class="ms-1">
                                                        <strong>Flu Singapura</strong><br>
                                                        <span><?= $fluSingapura_waktu; ?></span>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary">View</button>
                                            </li>

                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="hasildeteksi/<?= $bisul; ?>" alt="Card image" class="img-fluid rounded-circle" style="width: 55px; height: 55px; margin-right: 16px;">
                                                    <div class="ms-1">
                                                        <strong>Bisulan</strong><br>
                                                        <span><?= $bisul_waktu; ?></span>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary">View</button>
                                            </li>

                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="hasildeteksi/<?= $biduran; ?>" alt="Card image" class="img-fluid rounded-circle" style="width: 55px; height: 55px; margin-right: 16px;">
                                                    <div class="ms-1">
                                                        <strong>Biduran</strong><br>
                                                        <span><?= $biduran_waktu; ?></span>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary">View</button>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Bagian Profil -->
                                    <?php
                                    $ids = $_SESSION['id'];
                                    $akuns = $kon->kueri("SELECT * FROM login WHERE id = '$ids'");
                                    $akun = $kon->hasil_data($akuns);
                                    ?>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <form class="profile-form">
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" id="nama" class="form-control" value="<?= $akun['nama']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" class="form-control" value="<?= $akun['email']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" id="alamat" class="form-control" value="<?= $akun['alamat']; ?>">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update Profile</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
