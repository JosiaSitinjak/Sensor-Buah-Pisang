<?php
include '../conn.php';

$data = json_decode(file_get_contents('php://input'), true);

if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    // Invalid data
    echo "Invalid data.";
} else if (isset($data["gas"]) && isset($data["suhu_lingkungan"]) && isset($data["warna_buah_id"]) && isset($data["kelayakan"])) {
    try {
        $gas = $data['gas'];
        $suhu_lingkungan = $data['suhu_lingkungan'];
        $warna_buah_id = 1; //hijau
        $kelayakan = $data['kelayakan'];

        $query = "INSERT INTO data (gas, suhu_lingkungan, warna_buah_id, kelayakan) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ddii", $gas, $suhu_lingkungan, $warna_buah_id, $kelayakan);
        $stmt->execute();

        http_response_code(201);
        echo 'Data sensor berhasil disimpan';

        $stmt->close();
        $mysqli->close();
    } catch (Exception $e) {
        echo 'Data sensor gagal disimpan';
        echo 'Exception: ' . $e->getMessage();
    }
}
