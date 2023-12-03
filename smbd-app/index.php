<?php
session_start();
if (isset($_SESSION["login"])) {
    header("Location: dashboard.php");
}

include "conn.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring gas</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="shortcut icon" href="public/image/untan.png" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="d-flex border-dark fixed-top" style="background: #E7B10A;">
        <div class=" p-2 ms-5 flex-grow-1">
            <button class="btn btn-outline-dark text-center active">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                    class="bi bi-house-check" viewBox="0 0 16 16">
                    <path
                        d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708L7.293 1.5Z" />
                    <path
                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514Z" />
                </svg>
                HOME
            </button>
        </div>
        <div class="p-2 me-5">
            <a href="login.php">
                <button class="btn btn-outline-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                        <path fill-rule="evenodd"
                            d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                    </svg>
                    LOGIN
                </button>
            </a>
        </div>
    </div>
    <div class="container text-center" style="margin-top: 80px;">
        <h1 style="color: #45474B;">
            Website Monitoring Kadar Gas Dan Suhu Pada Buah Pisang Kepok Menggunakan Sensor MQ-3 Dan
            Sensor DHT-11
        </h1>
        <!-- <img src="public/image/pisang.png" width="500px"> -->
        <img src="public/image/pisang1.jpg" width="500px">
        </video>
    </div>

    <div class="footer">
        <div class="d-flex border-dark shadow-sm" style="background: #E7B10A;">
            <div class="p-2 ms-5 flex-grow-1">
                <img src="public/image/untan.png" width="30px" class="mx-1 me-md-2">
                <span style="color: black;">
                    H1051211010 - JOSIA WISE SITINJAK
                </span>
            </div>
        </div>
    </div>
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/script.js"></script>
</body>

</html>