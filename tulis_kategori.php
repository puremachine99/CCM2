<?php
include "koneksi.php";
$e = 0;
$kategori = $_POST['kategori'];

if (isset($_POST['tambah'])) {
    mysqli_query($conn,"INSERT INTO kategori VALUES('','$kategori')");
    header("location:form_kategori.php");
}
