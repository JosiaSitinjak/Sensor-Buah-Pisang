<?php
session_start();
include "conn.php";

if (!isset($_SESSION["login"])) {
    $_SESSION = [];
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// Pastikan ID dikirim melalui URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: data-tables.php");
    exit();
}

$id = $_GET['id'];

// Ambil data dari database sesuai dengan ID
$sql = "SELECT * FROM data WHERE id = $id";
$result = $mysqli->query($sql);

if ($result->num_rows == 1) {
    $data = $result->fetch_assoc();
} else {
    echo "Data not found";
    exit();
}

// Proses form edit jika ada data yang dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $gas = $_POST['gas'];
    $suhu_lingkungan = $_POST['suhu_lingkungan'];
    $warna_buah_id = $_POST['warna_buah_id'];

    // Update data di database
    $updateSql = "UPDATE data SET gas='$gas', suhu_lingkungan='$suhu_lingkungan', warna_buah_id='$warna_buah_id' WHERE id=$id";

    if ($mysqli->query($updateSql)) {
        // Redirect dengan parameter success=true
        header("Location: edit.php?id=$id&success=true");
        exit();
    } else {
        echo "Error updating data: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard | Edit Data</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="public/css/sidebars.css" />
    <link rel="shortcut icon" href="public/image/untan.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="sidebar d-flex flex-column flex-shrink-0 p-1 p-md-3 bg-body-secondary">
        <a href="" class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <span class="fs-4 fw-bold text-text-center">
                <img src="public/image/untan.png" width="30px" class="mx-1 me-md-2">
                <span class="text-dashboard-item">Smbd App</span>
            </span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="index.php" class="nav-link link-body-emphasis text-dashboard-item">
                    Dashboard
                </a>
                <a href="index.php" class="nav-link link-body-emphasis icon-dashboard-item p-0 m-0 py-1 text-center"
                    data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Dashboard">
                    <i class="bi bi-speedometer fs-5"></i>
                </a>
            </li>
            <li>
                <a href="all-grafik.php" class="nav-link link-body-emphasis text-dashboard-item">
                    Semua Grafik
                </a>
                <a href="all-grafik.php"
                    class="nav-link link-body-emphasis icon-dashboard-item p-0 m-0 py-1 text-center"
                    data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Semua Grafik">
                    <i class="bi bi-graph-up fs-5"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="data-tables.php" class="nav-link active text-dashboard-item">
                    Data Grafik
                </a>
                <a href="data-tables.php" class="nav-link active icon-dashboard-item p-0 m-0 py-1 text-center"
                    data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Data Grafik">
                    <i class="bi bi-table fs-5"></i>
                </a>
            </li>

        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle fs-3 me-2"></i>

                <strong class="text-dashboard-item"><?= $_SESSION['admin-name'] ?></strong>
            </a>
            <ul class="dropdown-menu text-small shadow">
                <li>
                    <form action="logout.php" method="POST">
                        <button type="submit" class="dropdown-item" name="logout">
                            <span>
                                Log Out <i class="bi bi-box-arrow-right fs-5"></i>
                            </span></button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <div class="container scrollarea">
            <div class="row">
                <div class="col-md-12 pt-3 pb-3 border-bottom bg index">
                    <a href="" class="d-flex align-items-center me-md-auto text-dark text-decoration-none">
                        <span class="fs-6 text-muted me-2">Dashboard </span><span class="fs-4 text-muted"> -
                        </span><span class="ms-2 fs-6 fw-bold"> Data Grafik</span>
                    </a>
                </div>
            </div>

            <div class="row m-2 mt-5">
                <div class="col-md-8 offset-md-2 shadow-lg border rounded-4 mt-5 mb-5 p-4 bg-light">
                    <div class="text-center mb-4">
                        <h2 class="text-primary fw-bold">Edit Data</h2>
                    </div>

                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="gas" class="form-label">Gas (ppm):</label>
                            <input type="text" name="gas" class="form-control" value="<?php echo $data['gas']; ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="suhu_lingkungan" class="form-label">Suhu Lingkungan (°C):</label>
                            <input type="text" name="suhu_lingkungan" class="form-control"
                                value="<?php echo $data['suhu_lingkungan']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="warna_buah_id" class="form-label">Warna Buah:</label>
                            <select name="warna_buah_id" class="form-select" required>
                                <?php
                                $warnaSql = "SELECT * FROM warna_buah";
                                $resultWarna = $mysqli->query($warnaSql);

                                while ($warna = $resultWarna->fetch_assoc()) {
                                    $selected = ($warna['id'] == $data['warna_buah_id']) ? "selected" : "";
                                    echo "<option value='" . $warna['id'] . "' $selected>" . $warna['warna'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Simpan Perubahan</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <a href="data-tables.php" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left-circle me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/sidebars.js"></script>
    <script src="public/js/script.js"></script>

    <script>
    // Fungsi untuk menampilkan notifikasi
    function showNotification(message, type) {
        // Tambahkan logika di sini untuk menampilkan notifikasi sesuai kebutuhan
        // Dalam contoh ini, saya menggunakan alert sebagai notifikasi sederhana
        alert(message);
    }

    // Periksa apakah parameter 'success' ada dalam URL (menandakan berhasil disubmit)
    const urlParams = new URLSearchParams(window.location.search);
    const successParam = urlParams.get('success');

    // Jika parameter 'success' ada dan bernilai 'true', tampilkan notifikasi
    if (successParam === 'true') {
        showNotification('Data berhasil diubah!', 'success');
    }
    </script>
</body>

</html>