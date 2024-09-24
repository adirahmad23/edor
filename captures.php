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
            <div class="container mt-3">
                <div class="row">
                    <div class="col-sm-4 my-5">
                        <div class="card-body bg-card">
                            <center><video id="video" class="img-fluid" autoplay></video></center>
                            <canvas id="canvas" width="480" height="640" style="display: none;"></canvas>
                            <div id="snapshots" style="display: none;"></div>

                            <!-- Add margin-bottom to create space between components -->
                            <div class="text-center mb-3">
                                <button id="capture" class="btn btn-block btn-sm rounded-circle" style="background-color: #D8AE7E; width: 70px; height: 70px; padding: 0;">
                                    <i class='bx bxs-camera' style="font-size: 35px; vertical-align: middle; color: #032B44;"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body bg-card">
                            <form id="uploadForm" enctype="multipart/form-data">
                                <!-- Add margin-bottom to create space between components -->
                                <div class="input-group mb-3">
                                    <input type="file" id="fileInput" name="file" class="form-control">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-successs"><i class='bx bx-upload'></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-successs btn-lg" data-toggle="modal" data-target="#photoModal">
                                Cara Pemotretan
                            </button>
                        </div>
                        <!--=============== Modal ===============-->
                        <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Cara Pemotretan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Ikuti langkah-langkah berikut untuk mengambil foto:</p>
                                        <ol type="1">
                                            <li>Arahkan kamera ke objek yang ingin Anda potret.</li>
                                            <li>Jarak Maximum adal 30cm dari objek.</li>
                                            <li>Pastikan objek terlihat jelas di layar kamera.</li>
                                            <li>Klik tombol  kamera untuk mengambil gambar.</li>
                                            <li>Akan ada notifikasi apakah berhasil terupload, jika gagal anda dapat mengulangi lagi</li>
                                            <li>Klik ok dan anda akan diarahkan ke halaman hasil deteksi</li>
                                        </ol>
                                        <p>Jika Anda mengalami masalah, harap coba lagi atau pastikan kamera telah diaktifkan.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-successs" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Move the custom button style to the top of the HTML file or in an external CSS file -->
                        <style>
                            .btn-successs {
                                background-color: #D8AE7E;
                                /* Background color */
                                color: #0E2473;
                                /* Text color */
                                border: none;
                                /* Remove default button border */
                            }
                        </style>
                        <script>
                            // Webcam capture
                            const video = document.getElementById('video');
                            const canvas = document.getElementById('canvas');
                            const context = canvas.getContext('2d');

                            // Akses kamera belakang (environment camera)
                            navigator.mediaDevices.getUserMedia({
                                    video: {
                                        facingMode: {
                                            exact: "environment" // Memilih kamera belakang
                                        }
                                    }
                                })
                                .then(stream => {
                                    video.srcObject = stream;
                                })
                                .catch(error => {
                                    console.error("Error accessing the camera: ", error);
                                });

                            // Capture gambar dari webcam
                            document.getElementById('capture').addEventListener('click', () => {
                                context.drawImage(video, 0, 0, 640, 480);
                                canvas.toBlob(blob => {
                                    const formData = new FormData();
                                    const date = new Date();
                                    const filename = `image_${date.toISOString().replace(/[:.]/g, '-')}.png`;
                                    formData.append('file', blob, filename);

                                    // Upload gambar ke server
                                    fetch('upload.php', {
                                            method: 'POST',
                                            body: formData
                                        })
                                        .then(response => response.text())
                                        .then(result => {
                                            alert(result);
                                           
                                                window.location.href = 'hasil.php';
                                            
                                        })
                                        .catch(error => {
                                            console.error('Error uploading image:', error);
                                        });
                                }, 'image/png');
                            });

                            // Upload file dari direktori
                            document.getElementById('uploadForm').addEventListener('submit', function(event) {
                                event.preventDefault();

                                const fileInput = document.getElementById('fileInput');
                                const file = fileInput.files[0];

                                if (!file) {
                                    alert('Pilih gambar terlebih dahulu.');
                                    return;
                                }

                                const formData = new FormData();
                                formData.append('file', file);

                                fetch('upload.php', {
                                        method: 'POST',
                                        body: formData
                                    })
                                    .then(response => response.text())
                                    .then(result => {
                                       
                                    
                                            window.location.href = 'hasil.php';
                                        // }
                                    })
                                    .catch(error => {
                                        console.error('Error uploading file:', error);
                                    });
                            });
                        </script>

                    </div>
                </div>
            </div>
        </section>


    </main>


    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>