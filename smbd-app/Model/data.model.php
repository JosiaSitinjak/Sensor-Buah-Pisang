<?php

class DataModel extends Connection
{
    // protected untuk kebutuhan variabel
    
    protected $Gas;
    protected $suhu_lingkungan;
    protected $warna_buah_id;
    

    protected function findAll()
{
    $datas = array(); // Inisialisasi array
    $sql = "SELECT data.*, warna_buah.warna FROM data LEFT OUTER JOIN warna_buah ON data.warna_buah_id = warna_buah.id ORDER BY created_at DESC";
    
    $result = $this->connect()->query($sql); // Pastikan koneksi database sudah dibuat

    if ($result) { // Periksa apakah query berjalan tanpa kesalahan
        if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $datas[] = $data;
            }
        }
    } else {
        // Handle error jika query gagal
        echo "Error: " . $this->connect()->error;
    }
    
    return $datas; // Mengembalikan array, bahkan jika tidak ada hasil
}

    protected function findAllIndex()
    {
        $sql = "SELECT data.*, warna_buah.warna AS warna_buah_warna  FROM data JOIN warna_buah ON data.warna_buah_id = warna_buah.id  JOIN (SELECT warna_buah_id, MAX(created_at) AS max_created_at FROM data GROUP BY warna_buah_id ) AS max_created ON data.warna_buah_id = max_created.warna_buah_id AND data.created_at = max_created.max_created_at";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $datas[] = $data;
            }
            return $datas;
        }
    }

    protected function buahLayakMakan()
    {
        $sql = "SELECT data.*, warna_buah.warna AS warna_buah_warna  FROM data JOIN warna_buah ON data.warna_buah_id = warna_buah.id JOIN (SELECT warna_buah_id, MAX(created_at) AS max_created_at FROM data WHERE kelayakan = true GROUP BY warna_buah_id ) AS max_created ON data.warna_buah_id = max_created.warna_buah_id AND data.created_at = max_created.max_created_at";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $datas[] = $data;
            }
            return $datas;
        }
    }
    protected function buahTidakLayakMakan()
    {
        $sql = "SELECT data.*, warna_buah.warna AS warna_buah_warna FROM data JOIN warna_buah ON data.warna_buah_id = warna_buah.id JOIN  (SELECT warna_buah_id, MAX(created_at) AS max_created_at FROM data WHERE kelayakan = false GROUP BY warna_buah_id ) AS max_created ON data.warna_buah_id = max_created.warna_buah_id AND data.created_at = max_created.max_created_at";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $datas[] = $data;
            }
            return $datas;
        }
    }
}
