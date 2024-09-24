<!DOCTYPE html>
<html lang="en">

<?php include_once "template/header.php" ?>
<?php include_once "template/extension.php" ?>

<body style="overflow: hidden;">
    <!--=============== Bottom Bar ===============-->
    <?php include_once "template/bottombar.php" ?>
    <main>
        <!--=============== HOME ===============-->
        <section class="container-app section__height">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-sm-4 my-3">
                        <div class="card">
                            <h4 class="card-header text-center" style="background-color: #D8AE7E;">Hasil Deteksi</h4>
                            <div class="card-body bg-card">
                                <table class="table" style="background-color: transparent; border: none;">
                                    <tr style="background-color: transparent;">
                                        <td align="center" style="background-color: transparent; border:none">
                                            <h4><b>Kadas Kurap</b></h4>
                                        </td>
                                    </tr>
                                    <tr style="background-color: transparent;">
                                        <td id="posisiMotor" style="background-color: transparent; border:none">
                                            <img id="idhasil" src="assets/img/loading.png" class="w-100" style="object-fit: fill; width: 30px; height:320px;" alt="Responsive image of peta">
                                        </td>
                                    </tr>
                                    <tr style="background-color: transparent;">
                                        <td align="center" style="background-color: transparent; border:none">
                                            <button type="button" class="btn btn-successs btn-xm" data-toggle="modal" data-target="#photoModal">
                                                Detail Penyakit
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!--=============== Modal ===============-->
                        <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Detail Penyakit</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Kadas/Kurap (Tinea Corporis) adalah infeksi jamur pada kulit yang ditandai dengan bercak merah berbentuk cincin, yang bisa menyebabkan rasa gatal.
                                        </p>
                                        <p>
                                            <b>Penyebabnya : </b>Disebabkan oleh infeksi jamur dermatofita yang hidup di jaringan kulit mati. Jamur ini dapat menyebar melalui kontak langsung dengan orang yang terinfeksi, hewan, atau benda-benda yang terkontaminasi.
                                        </p>
                                        <b>Cara Penangannya : </b>
                                        <ol type="1">
                                            <li>
                                                Obat Antijamur: Gunakan salep atau krim antijamur seperti clotrimazole atau miconazole yang dijual bebas.
                                            </li>
                                            <li>
                                            Menjaga Kebersihan: Jaga kebersihan kulit, terutama area yang terinfeksi. Hindari berbagi pakaian atau handuk.
                                            </li>
                                            <li>
                                            Konsultasi Dokter: Jika infeksi meluas atau tidak membaik, sebaiknya periksa ke dokter untuk mendapatkan resep obat antijamur oral.
                                            </li>

                                        </ol>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-successs" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Script untuk memperbarui src gambar terbaru -->
                        <script>
                            function updateDeteksiGambar() {
                                var imgElement = document.getElementById('idhasil');
                                fetch('fetch_data.php')
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.img.length > 0) {
                                            var newImageUrl = 'hasildeteksi/' + data.img[0].img;
                                            imgElement.src = newImageUrl;
                                        } else {
                                            console.error('Gambar tidak ditemukan.');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Kesalahan dalam mengambil gambar terbaru:', error);
                                    });
                            }

                            // Perbarui gambar setiap 2 detik
                            setInterval(updateDeteksiGambar, 1000);
                        </script>

                        <style>
                            .btn-successs {
                                background-color: #D8AE7E;
                                color: #0E2473;
                                border: none;
                            }

                            .scrollable-list {
                                max-height: 370px;
                                overflow-y: auto;
                                border: 1px solid #ddd;
                                padding: 10px;
                                margin-top: 10px;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
</body>

</html>