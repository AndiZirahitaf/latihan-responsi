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

$id = $_GET['id_barang'];

$query = "DELETE FROM barang WHERE id_barang = $id";
mysqli_query($conn, $query);

header("Location: index.php");
?>