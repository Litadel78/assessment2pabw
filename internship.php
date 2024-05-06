<?php
// Koneksi ke database
$koneksi = new mysqli("10.117.2.254", "root", "", "jobee");

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk mengambil data magang
$query = "SELECT id, logo, nama_perusahaan, posisi FROM tabel_magang";
$result = $koneksi->query($query);

// Inisialisasi array untuk menyimpan data
$data = [];

// Loop melalui hasil query dan tambahkan ke array
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Tutup koneksi
$koneksi->close();

// Kirim data sebagai JSON
header('Content-Type: application/json');
echo json_encode($data);
?>