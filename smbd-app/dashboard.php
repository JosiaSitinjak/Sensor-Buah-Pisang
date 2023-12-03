<?php
session_start();
if (!isset($_SESSION["login"])) {
    $_SESSION = [];
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
include "conn.php";
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
    <title>Dashboard</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="public/css/sidebars.css" />
    <link rel="shortcut icon" href="public/image/untan.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    .card {
        border-radius: 5px;
        background-color: indigo;
    }

    .card:hover {
        background-color: blue;
    }

    .card2 {
        border-radius: 5px;
        background-color: green;
    }

    .card2:hover {
        background-color: blue;
    }
    </style>
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
            <li class="nav-item">
                <a href="index.php" class="nav-link active text-dashboard-item bg-primary">
                    Dashboard
                </a>
                <a href="index.php" class="nav-link active icon-dashboard-item p-0 m-0 py-1 text-center"
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
            <li>
                <a href="data-tables.php" class="nav-link link-body-emphasis text-dashboard-item">
                    Data Grafik
                </a>
                <a href="data-tables.php"
                    class="nav-link link-body-emphasis icon-dashboard-item p-0 m-0 py-1 text-center"
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
                        <button type="submit" class="dropdown-item " name="logout">
                            <span>
                                Log Out <i class="bi bi-box-arrow-right fs-5"></i>
                            </span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content" style="background-color: #FEF9DF;">
        <div class="container scrollarea">
            <div class="row">
                <div class="col-md-12 border-bottom bgi index bg-white">
                    <a href="" class="d-flex align-items-center me-md-auto text-dark text-decoration-none">
                        <span class="fs-6 text-muted me-2 fw-bold">Dashboard </span>
                    </a>
                </div>
            </div>
            <div class="mt-5 pt-3">
                <div class="row mt-2 ms-1 me-1 mt-lg-4 ms-lg-4 me-lg-4 ">
                    <div class="col-md-12">
                        <div class="card rounded-0 mb-4 rounded-3 shadow" style="background-color: #D2DE32;">
                            <div class="card-body pt-0 mt-3">
                                <h5 class="card-title">Hai, <span
                                        class="text text-black fw-boldest"><?= $_SESSION['admin-name'] ?></span></h5>
                                <p class="card-text fw-bold">Selamat Datang di Website Monitoring Kadar Gas Dan Suhu
                                    Pada Buah Pisang Kepok
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-4 mt-0">
                    <div class="col-md-12">
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <div class="card hoverable card-xl-stretch mb-5 mb-xl-8 rounded-1">
                                    <div class="shadow">
                                        <a class="text-decoration-none card" href="buah-layak-makan.php">
                                            <div class="card-body shadow" style="background: #EBB02D;">
                                                <div class="d-flex justify-content-between">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                        fill="currentColor" class="bi bi-moisture text-white"
                                                        viewBox="0 0 512 512">
                                                        <path
                                                            d="M160 32c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32c17.7 0 32 14.3 32 32V288c0 17.7-14.3 32-32 32c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32c-17.7 0-32-14.3-32-32V64c0-17.7 14.3-32 32-32zM32 448H320c70.7 0 128-57.3 128-128s-57.3-128-128-128V128c106 0 192 86 192 192c0 49.2-18.5 94-48.9 128H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H320 32c-17.7 0-32-14.3-32-32s14.3-32 32-32zm80-64H304c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                                                    </svg>
                                                    <div class="text-white fw-bolder fs-1 mb-2 mt-5 text-end">
                                                        <?php $datas->jumlahBuahLayakMakan() ?>
                                                    </div>
                                                </div>
                                                <div class="fw-bold text-white text-end fs-6">Jumlah Data Layak Dimakan
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card2 hoverable card-xl-stretch mb-5 mb-xl-8 rounded-1">
                                    <div class="shadow">
                                        <a class="text-decoration-none card2" href="buah-tidak-layak-dimakan.php">
                                            <div class=" card-body shadow" style="background: #EBB02D;">
                                                <div class="d-flex justify-content-between">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                        fill="currentColor" class="bi bi-moisture text-white"
                                                        viewBox="0 0 512 512">
                                                        <path
                                                            d="M160 32c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32c17.7 0 32 14.3 32 32V288c0 17.7-14.3 32-32 32c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32c-17.7 0-32-14.3-32-32V64c0-17.7 14.3-32 32-32zM32 448H320c70.7 0 128-57.3 128-128s-57.3-128-128-128V128c106 0 192 86 192 192c0 49.2-18.5 94-48.9 128H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H320 32c-17.7 0-32-14.3-32-32s14.3-32 32-32zm80-64H304c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                                                    </svg>
                                                    <div class="text-white fw-bolder fs-1 mb-2 mt-5 text-end">
                                                        <?php $datas->jumlahBuahTidakLayakMakan() ?>
                                                    </div>
                                                </div>
                                                <div class="fw-bolder text-end fs-6 text-white">Jumlah Data Tidak Layak
                                                    Dimakan</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/sidebars.js"></script>
    <script>
    $(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
    </script>

</body>

</html>