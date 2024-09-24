<?php
// session_start();
include_once "proses/koneksi.php";
$kon = new Koneksi();

// Prepare data for aqi
$img = $kon->kueri("SELECT * FROM `tb_imgdeteksi` ORDER BY id DESC LIMIT 1");


// $mataangin = $_SESSION['arahangin']; // Data dari sesi

$data = array();

// Process aqi data
$data['img'] = array();
while ($row = $kon->hasil_data($img)) {
    $data['img'][] = array(
        "img" => $row['nama'],
    );
}


// $data['kondisicems'] = array();
// while ($row = $kon->hasil_data($kondisicems)) {
//     // Dapatkan nilai arahangin dari database
//     $arahangin = $row['area1'];
    
//     // Buat pengkondisian berdasarkan arahangin
//     // if ($arahangin === $mataangin) {
//     //     $peringatan = 'bahaya';
//     // } else {
//     //     $peringatan = 'normal';
//     // }

//     // // Tambahkan hasil ke dalam array kondisicems
//     // $data['kondisicems'][] = array(
//     //     "arahangin" => $arahangin,
//     //     "peringatan" => $peringatan, // Tambahkan peringatan ke dalam array
//     // );
// }


// Return data in JSON format
echo json_encode($data);
