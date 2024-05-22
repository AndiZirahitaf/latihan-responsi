<?php
session_start();
if (isset($_COOKIE['login']) && $_COOKIE['login'] == 'true') {
    $_SESSION['login'] = true;
}
if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
require 'koneksi.php';
$barang = query("SELECT * FROM barang");

if (isset($_POST['simpan'])) {
    $barang = $_POST['barang'];
    $kategori = $_POST['kategori'];
    $qty = $_POST['qty'];
    $harga = $_POST['harga'];

    $query = "INSERT INTO barang VALUES ('', '$barang', '$kategori', '$qty', '$harga')";
    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
    .navbar-custom {
        background-color: skyblue;
    }

    th {
        background-color: blue;
        color: white;
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Selamat Datang, admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Logout</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="my-5">
        <div class="container ">


            <h1 class="text-center mb-5">
                Input Barang
            </h1>
            <div class="d-flex justify-content-center align-items-center">


                <!-- <div class="container"> -->
                <form class="col-6" method="post" action="">
                    <div class="mb-3">
                        <label for="barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="barang" name="barang" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori">
                            <!-- <option selected>Pilih Kategori</option> -->
                            <option value="Pakaian">Pakaian</option>
                            <option value="Alat Tulis">Alat Tulis</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Elektronik">Elektronik</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label">Qty</label>
                        <input type="number" class="form-control" id="qty" name="qty">
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga">
                    </div>
                    <button type="submit" class="btn btn-primary" name="simpan">Submit</button>
                </form>
                <!-- </div> -->
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>