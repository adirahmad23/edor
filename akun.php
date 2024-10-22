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
if (isset($_POST['update'])) {
    // Mendapatkan data dari input
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $id = $_POST['ids'];

    // Logika untuk memperbarui profil di database
    $update_query = "UPDATE login SET nama='$nama', email='$email', alamat='$alamat' WHERE id='$id'";
    if ($kon->kueri($update_query)) {
        // Redirect ke halaman yang sama dengan hash ke profil tab
        header("Location: " . $_SERVER['PHP_SELF'] . "#profile");
        exit; // pastikan untuk menghentikan script lebih lanjut
    } else {
        echo "Terjadi kesalahan saat memperbarui profil.";
    }
}



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
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFlu">
                                                    View
                                                </button>

                                            </li>

                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="hasildeteksi/<?= $kadasKurap; ?>" alt="Card image" class="img-fluid rounded-circle" style="width: 55px; height: 55px; margin-right: 16px;">
                                                    <div class="ms-1">
                                                        <strong>Kudas Kurap</strong><br>
                                                        <span><?= $kadasKurap_waktu; ?></span>

                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalKadas">
                                                    View
                                                </button>
                                            </li>

                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="hasildeteksi/<?= $biduran; ?>" alt="Card image" class="img-fluid rounded-circle" style="width: 55px; height: 55px; margin-right: 16px;">
                                                    <div class="ms-1">
                                                        <strong>Biduran</strong><br>
                                                        <span><?= $biduran_waktu; ?></span>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBiduran">
                                                    View
                                                </button>
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
                                        <form class="profile-form" method="post" action="">
                                            <input type="hidden" id="ids" name="ids" class="form-control" value="<?= $ids ?>">
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" id="nama" name="nama" class="form-control" value="<?= $akun['nama']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" name="email" class="form-control" value="<?= $akun['email']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" id="alamat" name="alamat" class="form-control" value="<?= $akun['alamat']; ?>">
                                            </div>
                                            <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
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

    <!-- modal -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="modalKadas" tabindex="-1" role="dialog" aria-labelledby="modalKadasLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKadasLabel">Kadas/Kurap</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Kadas/Kurap (Tinea Corporis) adalah infeksi jamur pada kulit yang ditandai dengan bercak merah berbentuk cincin, yang bisa menyebabkan rasa gatal.</p>
                    <p><b>Penyebabnya:</b> Disebabkan oleh infeksi jamur dermatofita yang hidup di jaringan kulit mati. Jamur ini dapat menyebar melalui kontak langsung dengan orang yang terinfeksi, hewan, atau benda-benda yang terkontaminasi.</p>
                    <b>Cara Penangannya:</b>
                    <ol type="1">
                        <li>Obat Antijamur: Gunakan salep atau krim antijamur seperti clotrimazole atau miconazole yang dijual bebas.</li>
                        <li>Menjaga Kebersihan: Jaga kebersihan kulit, terutama area yang terinfeksi. Hindari berbagi pakaian atau handuk.</li>
                        <li>Konsultasi Dokter: Jika infeksi meluas atau tidak membaik, sebaiknya periksa ke dokter untuk mendapatkan resep obat antijamur oral.</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFlu" tabindex="-1" role="dialog" aria-labelledby="modalFluLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFluLabel">Flu Singapura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Flu Singapura adalah penyakit virus yang ditandai dengan ruam dan sering kali disertai dengan demam.
                    </p>
                    <p><b>Penyebabnya:</b> Disebabkan oleh enterovirus, yang biasanya menyebar melalui kontak langsung.</p>
                    <b>Cara Penangannya:</b>
                    <ol type="1">
                        <li>Istirahat yang cukup dan minum banyak cairan.</li>
                        <li>Obat pereda nyeri dapat digunakan untuk mengurangi ketidaknyamanan.</li>
                        <li>Konsultasi dokter jika gejala semakin parah.</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalBiduran" tabindex="-1" role="dialog" aria-labelledby="modalBiduranLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBiduranLabel">Biduran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Biduran adalah reaksi alergi yang ditandai dengan bercak merah dan gatal di kulit.</p>
                    <p><b>Penyebabnya:</b> Bisa disebabkan oleh alergi makanan, obat, atau faktor lingkungan.</p>
                    <b>Cara Penangannya:</b>
                    <ol type="1">
                        <li>Hindari pemicu alergi jika diketahui.</li>
                        <li>Obat antihistamin dapat membantu meredakan gejala.</li>
                        <li>Konsultasi dokter jika gejala berlanjut.</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })
    </script>
    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>