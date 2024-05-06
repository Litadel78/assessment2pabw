hapus magang

<?php
// Ambil input JSON
$input = file_get_contents("php://input");
$data = json_decode($input, true);
$id = $data['id'];

// Koneksi ke database
$koneksi = new mysqli("10.117.2.254", "root", "", "jobee");

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk menghapus data magang berdasarkan ID
$query = "DELETE FROM tabel_magang WHERE id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id);

// Eksekusi query
if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}

// Tutup statement dan koneksi
$stmt->close();
$koneksi->close();
?>