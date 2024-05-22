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
// echo $barang[0]['qty'];
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
                        <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="my-5">
        <div class="container ">


            <h1 class="text-center mb-5">
                Data Barang
            </h1>
            <div class="container">
                <a href="input.php" class="btn btn-primary mb-3">Tambah Barang</a>
                <table class="table">
                    <thead class="table-primary">
                        <tr c>
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php for ($i = 0; $i < count($barang); $i++) { ?>
                        <tr>
                            <th scope="row"><?= $i + 1; ?></th>
                            <td><?= $barang[$i]["barang"]; ?></td>
                            <td><?= $barang[$i]["kategori"]; ?></td>
                            <td><?= $barang[$i]["qty"]; ?></td>
                            <td><?= $barang[$i]["harga"]; ?></td>
                            <td><?= $barang[$i]["qty"] * $barang[$i]["harga"]; ?></td>
                            <td>
                                <a href="ubah.php?id_barang=<?= $barang[$i]["id_barang"]; ?>" class="btn btn-warning">
                                    Edit
                                </a>

                                <a href="hapus.php?id_barang=<?= $barang[$i]["id_barang"]; ?>"
                                    onclick="return confirm('Apakah Anda Yakin?');" class="btn btn-danger">
                                    Delete

                            </td>
                        </tr>

                        <?php } ?>
                        <tr class="table-primary">
                            <td colspan="5" class="text-center fw-bold">
                                GRAND TOTAL
                            </td>
                            <td>
                                <?php
                            $total = 0;
                            for ($i = 0; $i < count($barang); $i++) {
                                $total += $barang[$i]["qty"] * $barang[$i]["harga"];
                            }
                            echo $total;
                            ?>
                            </td>
                            <td>
                            </td>
                        </tr>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>