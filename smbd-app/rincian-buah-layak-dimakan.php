<?php
session_start();
if (!isset($_SESSION["login"])) {
    $_SESSION = [];
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

require 'conn.php';
include "./Model/data.model.php";
include "./Controller/data.controller.php";
include "./View/data.view.php";
$datas = new DataView();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard | Rincian Buah Layak Dimakan</title>
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
                <span class="text-dashboard-item">Metopen App</span>
            </span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="index.php" class="nav-link active text-dashboard-item">
                    Dashboard
                </a>
                <a href="index.php" class="nav-link active icon-dashboard-item p-0 m-0 py-1 text-center" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Dashboard">
                    <i class="bi bi-speedometer fs-5"></i>
                </a>
            </li>
            <li>
                <a href="all-grafik.php" class="nav-link link-body-emphasis text-dashboard-item">
                    Semua Grafik
                </a>
                <a href="all-grafik.php" class="nav-link link-body-emphasis icon-dashboard-item p-0 m-0 py-1 text-center" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Semua Grafik">
                    <i class="bi bi-graph-up fs-5"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="data-tables.php" class="nav-link link-body-emphasis text-dashboard-item">
                    Data Grafik
                </a>
                <a href="data-tables.php" class="nav-link link-body-emphasis icon-dashboard-item p-0 m-0 py-1 text-center" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Data Grafik">
                    <i class="bi bi-table fs-5"></i>
                </a>
            </li>
            
            
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
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
                        <span class="fs-6 text-muted me-2">Dashboard </span><span class="fs-4 text-muted"> - </span><span class="ms-2 fs-6 fw-bold"> Data <?= $_GET['warna-buah'] ?></span>
                    </a>
                </div>
            </div>
            <div class="row m-2 mt-5">
                <div class="row mt-5">
                    <div class="col-md-12">
                        <a href="buah-layak-makan.php" class="text-decoration-none">
                            <button type="button" class="btn btn-outline-warning"><i class="bi bi-arrow-left-circle me-2"></i>Kembali</button>
                        </a>
                    </div>
                </div>
                <div class="col-md-12 shadow-lg border border-0 rounded-4 mt-4 mb-5">
                    <div class="row mb-2">
                        <div class="col-md-12 bg-primary text-center border-0 border-bottom rounded-top-4 p-2">
                            <span class="fs-5 text-white fw-bold">
                                Tabel Semua Data <?= $_GET['warna-buah'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="container p-3">
                        <div class="col-md-12 table-responsive text-center">
                            <table class="table table-striped align-middle" id="data_grafik_table">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center">No</th>
                                        <th class="align-middle text-center">Waktu</th>
                                        <th class="align-middle text-center">Gas (ppm)</th>
                                        <th class="align-middle text-center">Suhu Lingkungan (°C)</th>
                                        <th class="align-middle text-center">Warna Buah</th>
                                        <th class="align-middle text-center">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $warna_buah = $_GET['warna-buah'];
                                    $query = "SELECT data.*, warna_buah.warna AS warna_buah_warna FROM data JOIN warna_buah ON data.warna_buah_id = warna_buah.id  WHERE kelayakan = true && warna = ? ORDER BY created_at DESC";
                                    $stmt = $mysqli->prepare($query);
                                    $stmt->bind_param("s", $warna_buah);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    $no = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        if ($row['kelayakan'] == true) {
                                            $keterangan = "Layak Dimakan";
                                        } else {
                                            $keterangan = "Tidak Layak Dimakan";
                                        } ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['created_at'] ?></td>
                                            <td><?= $row['gas'] ?></td>
                                            <td><?= $row['suhu_lingkungan'] ?></td>
                                            <td><?= $row['warna_buah_warna'] ?></td>
                                            <td><?= $keterangan ?></td>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/sidebars.js"></script>
    <script src="public/js/script.js"></script>
</body>

</html>