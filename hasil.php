<!DOCTYPE html>
<html lang="en">

<?php include_once "template/header.php"; ?>
<?php include_once "template/extension.php"; ?>

<body style="overflow: hidden;">
    <?php include_once "template/bottombar.php"; ?>
    <main>
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
                                            <h4 id="penyakitName"><b>Menunggu Hasil Deteksi</b></h4>
                                        </td>
                                    </tr>
                                    <tr style="background-color: transparent;">
                                        <td id="posisiMotor" style="background-color: transparent; border:none">
                                            <img id="idhasil" src="assets/img/loading.png" class="w-100" style="object-fit: fill; width: 30px; height:320px;" alt="Responsive image of peta">
                                        </td>
                                    </tr>
                                    <tr style="background-color: transparent;">
                                        <td align="center" style="background-color: transparent; border:none">
                                            <button type="button" class="btn btn-successs btn-xm btn-modal" data-img-name="kadasKurap">
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
                                    <div class="modal-body" id="modalBody">
                                        <!-- Konten modal akan diisi di sini -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-successs" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Script untuk memperbarui src gambar terbaru -->
                        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                        <script>
                            let lastImgName = ""; // Variabel untuk menyimpan nama gambar terakhir

                            function updateDeteksiGambar() {
                                var imgElement = document.getElementById('idhasil');
                                var penyakitNameElement = document.getElementById('penyakitName');
                                fetch('fetch_data.php')
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.img.length > 0) {
                                            var newImageUrl = 'hasildeteksi/' + data.img[0].img;
                                            imgElement.src = newImageUrl;

                                            // Mengupdate nama penyakit
                                            var imgName = data.img[0].img.split('_')[0];
                                            penyakitNameElement.innerHTML = "<b>" + imgName.charAt(0).toUpperCase() + imgName.slice(1) + "</b>";
                                            document.querySelector('.btn-modal').setAttribute('data-img-name', imgName);
                                        } else {
                                            console.error('Gambar tidak ditemukan.');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Kesalahan dalam mengambil gambar terbaru:', error);
                                    });
                            }

                            // Event listener untuk tombol modal
                            document.addEventListener('click', function(event) {
                                if (event.target.matches('.btn-modal')) {
                                    var imgName = event.target.getAttribute('data-img-name');
                                    showModal(imgName); // Memanggil fungsi showModal dengan nama gambar
                                }
                            });

                            $('.close, .btn[data-dismiss="modal"]').on('click', function() {
                                $('#photoModal').modal('hide');
                            });


                            // Fungsi untuk menampilkan modal berdasarkan nama penyakit
                            function showModal(imgName) {
                                var modalContent = "";
                                var modalTitle = "";

                                // Menentukan isi modal berdasarkan nama penyakit
                                switch (imgName) {
                                    case "kadasKurap":
                                        modalTitle = "Kadas Kurap";
                                        modalContent = `
                                            <p>Kadas/Kurap (Tinea Corporis) adalah infeksi jamur pada kulit yang ditandai dengan bercak merah berbentuk cincin, yang bisa menyebabkan rasa gatal.</p>
                                            <p><b>Penyebabnya:</b> Disebabkan oleh infeksi jamur dermatofita yang hidup di jaringan kulit mati. Jamur ini dapat menyebar melalui kontak langsung dengan orang yang terinfeksi, hewan, atau benda-benda yang terkontaminasi.</p>
                                            <b>Cara Penangannya:</b>
                                            <ol type="1">
                                                <li>Obat Antijamur: Gunakan salep atau krim antijamur seperti clotrimazole atau miconazole yang dijual bebas.</li>
                                                <li>Menjaga Kebersihan: Jaga kebersihan kulit, terutama area yang terinfeksi. Hindari berbagi pakaian atau handuk.</li>
                                                <li>Konsultasi Dokter: Jika infeksi meluas atau tidak membaik, sebaiknya periksa ke dokter untuk mendapatkan resep obat antijamur oral.</li>
                                            </ol>
                                        `;
                                        break;
                                    case "bisul":
                                        modalTitle = "Bisul";
                                        modalContent = `
                                            <p>Bisul adalah infeksi pada kulit yang menyebabkan benjolan yang penuh dengan nanah dan sering kali menyakitkan.</p>
                                            <p><b>Penyebabnya:</b> Bisul biasanya disebabkan oleh bakteri, terutama Staphylococcus aureus.</p>
                                            <b>Cara Penangannya:</b>
                                            <ol type="1">
                                                <li>Jaga kebersihan area yang terinfeksi.</li>
                                                <li>Kompres dengan air hangat untuk membantu mengeluarkan nanah.</li>
                                                <li>Konsultasi dokter jika bisul tidak membaik atau semakin parah.</li>
                                            </ol>
                                        `;
                                        break;
                                    case "fluSingapura":
                                        modalTitle = "Flu Singapura";
                                        modalContent = `
                                            <p>Flu Singapura adalah penyakit virus yang ditandai dengan ruam dan sering kali disertai dengan demam.</p>
                                            <p><b>Penyebabnya:</b> Disebabkan oleh enterovirus, yang biasanya menyebar melalui kontak langsung.</p>
                                            <b>Cara Penangannya:</b>
                                            <ol type="1">
                                                <li>Istirahat yang cukup dan minum banyak cairan.</li>
                                                <li>Obat pereda nyeri dapat digunakan untuk mengurangi ketidaknyamanan.</li>
                                                <li>Konsultasi dokter jika gejala semakin parah.</li>
                                            </ol>
                                        `;
                                        break;
                                    case "biduran":
                                        modalTitle = "Biduran";
                                        modalContent = `
                                            <p>Biduran adalah reaksi alergi yang ditandai dengan bercak merah dan gatal di kulit.</p>
                                            <p><b>Penyebabnya:</b> Bisa disebabkan oleh alergi makanan, obat, atau faktor lingkungan.</p>
                                            <b>Cara Penangannya:</b>
                                            <ol type="1">
                                                <li>Hindari pemicu alergi jika diketahui.</li>
                                                <li>Obat antihistamin dapat membantu meredakan gejala.</li>
                                                <li>Konsultasi dokter jika gejala berlanjut.</li>
                                            </ol>
                                        `;
                                        break;
                                    default:
                                        modalTitle = "Penyakit Tidak Dikenali";
                                        modalContent = "<p>Maaf, informasi tentang penyakit ini tidak tersedia.</p>";
                                        break;
                                }

                                // Update modal content
                                document.getElementById('modalLabel').innerText = modalTitle;
                                document.getElementById('modalBody').innerHTML = modalContent;

                                // Tampilkan modal
                                $('#photoModal').modal('show');
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
                                border-radius: 5px;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="assets/js/main.js"></script>
</body>

</html>