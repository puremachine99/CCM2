<?php
$nama = $_POST['nama'];
$qty = $_POST['qty'];
$harga = $_POST['harga'];
$satuan = $_POST['satuan'];

require "koneksi.php";
mysqli_query($conn,"INSERT INTO komposisi VALUES('','$nama','$harga','$qty','$satuan')");
header("location:list_komposisi.php")
?>