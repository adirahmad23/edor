<?php
$target_dir = "img/"; // Folder tempat file akan disimpan
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true); // Buat folder jika belum ada
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Mengambil ekstensi file
    $imageFileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    // Membuat nama file baru dengan format tanggal-waktu
    $newFileName = date('Ymd_His') . '.' . $imageFileType; // Format: TahunBulanTanggal_JamMenitDetik
    $target_file = $target_dir . $newFileName;

    $uploadOk = 1;

    // Cek apakah file yang diupload adalah gambar
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Batasi ukuran file
    if ($file["size"] > 2097152) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Cek format file
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Jika tidak ada error, upload file
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars($newFileName). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo "No file uploaded.";
}
?>
