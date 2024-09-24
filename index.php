<?php
include_once "proses/koneksi.php";
$kon = new Koneksi();

$abc = $kon->kueri("SELECT * FROM tb_imgdeteksi");
$data = $kon->hasil_array($abc);

$names = [];
foreach ($data as $item) {
    $nama = $item['nama'];
    $parts = explode('_', $nama);
    $name = $parts[0];
    $names[$name][] = $nama;
}

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
    $latest_images[$type] = $latest_image;
}

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

<?php include_once "template/header.php" ?>
<?php include_once "template/extension.php" ?>

<body style="overflow: hidden;">
    <!--=============== Bottom Bar ===============-->
    <?php include_once "template/bottombar.php" ?>
    <main>
        <!--=============== HOME ===============-->
        <section class="container-app section__height" id="home">
            <div class="container mt-">
                <div class="row">
                    <div class="col-sm-4 my-2">
                        <!-- Tambahkan Header -->
                        <div class="card mb-2" style="background-color: #FFE0B5;">
                            <img src="assets/img/edor.png" alt="Contoh Gambar" class="card-img-top" style="width: 302px; height: 160px;">
                        </div>


                        <hr>

                        <div class="card mb-3" style="max-width: 540px; background-color: #FFE0B5;">
                            <div class="row g-0">
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <img src="hasildeteksi/<?= $bisul; ?>" alt="Card image" class="img-fluid rounded-circle" style="width: 70px; height: 70px; margin-right: 16px;">
                                            <div>
                                                <h5 class="card-title">Bisulan</h5>
                                                <p class="card-text"><small class="text-muted"><?= $bisul_waktu; ?></small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3" style="max-width: 540px; background-color: #FFE0B5;">
                            <div class="row g-0">
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <img src="hasildeteksi/<?= $kadasKurap; ?>" alt="Card image" class="img-fluid rounded-circle" style="width: 70px; height: 70px; margin-right: 16px;">
                                            <div>
                                                <h5 class="card-title">Kadas Kurap</h5>
                                                <p class="card-text"><small class="text-muted"><?= $kadasKurap_waktu; ?></small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3" style="max-width: 540px; background-color: #FFE0B5;">
                            <div class="row g-0">
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <img src="hasildeteksi/<?= $biduran; ?>" alt="Card image" class="img-fluid rounded-circle" style="width: 70px; height: 70px; margin-right: 16px;">
                                            <div>
                                                <h5 class="card-title">Biduran</h5>
                                                <p class="card-text"><small class="text-muted"><?= $biduran_waktu; ?></small></p>
                                            </div>
                                        </div>
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
</body>

</html>