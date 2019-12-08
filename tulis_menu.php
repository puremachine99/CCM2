<?php
include "koneksi.php";
$e = 0;
$jumlah = count($_POST['gr']);
$bahan = $_POST['Bahan'];
$qty = $_POST['gr'];
$menu = $_POST['menu'];
$jual = $_POST['jual'];
$kategori = $_POST['kategori'];
$produksi = 0;
$resep = "";

function bulat($angka)
{
    $x = ceil($angka / 1000);
    return $x;
}
function total(){
    $e = 0;
    $jumlah = count($_POST['gr']);
    $bahan = $_POST['Bahan'];
    $qty = $_POST['gr'];
    $menu = $_POST['menu'];
    $jual = $_POST['jual'];
    $kategori = $_POST['kategori'];
    $produksi = 0;
    $resep = "";
    for ($i = 0; $i < $jumlah; $i++) {
        $sql = "SELECT * FROM komposisi WHERE id_bahan = '$bahan[$i]'";
        require "koneksi.php";
        $res = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_assoc($res)) {
            $ecer = ($row['Harga'] / $row['Stok']) * $qty[$i];
            $resep = $resep . $bahan[$i] . ":" . $qty[$i] . ",";
            $produksi = $produksi + $ecer;
        }
    }
return $produksi+1500;
}
function rekomendasi($harga){
    $rekom = ceil(bulat($harga * 2.1))*1000;
    return $rekom;
}
function nett(){
    $pokok = total();
    $rekom = rekomendasi(total());
    $selisih = $rekom - $pokok;
    return $selisih;
}
function listing()
{
    $e = 0;
    $jumlah = count($_POST['gr']);
    $bahan = $_POST['Bahan'];
    $qty = $_POST['gr'];
    $menu = $_POST['menu'];
    $jual = $_POST['jual'];
    $kategori = $_POST['kategori'];
    $produksi = 0;
    $resep = "";
    for ($i = 0; $i < $jumlah; $i++) {
        $sql = "SELECT * FROM komposisi WHERE id_bahan = '$bahan[$i]'";
        require "koneksi.php";
        $res = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_assoc($res)) {
            $ecer = ($row['Harga'] / $row['Stok']) * $qty[$i] 
?>
            <tr>
                <td><?=$row['id_bahan'] ?></td>
                <td><?= $row['Nama'] ?></td>
                <td><?= $qty[$i] ?> <small><?= $row['Satuan'] ?></small></td>
                <td align="right"><span class="pull-left">Rp</span><?= number_format($ecer, 2, ',', '.') ?></td>
            </tr>
<?php
            $resep = $resep . $bahan[$i] . ":" . $qty[$i] . ",";
            $produksi = $produksi + $ecer;
        }
    }
}



if (isset($_POST['tambah'])) {
    for ($i = 0; $i < $jumlah; $i++) {
        $sql = "SELECT * FROM komposisi WHERE id_bahan = '$bahan[$i]'";
        require "koneksi.php";
        $res = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_assoc($res)) {
            echo $row['Nama'] . " | " . $ecer = ($row['Harga'] / $row['Stok']) * $qty[$i];
            echo "<br>";
            $resep = $resep . $bahan[$i] . ":" . $qty[$i] . ",";
            $produksi = $produksi + $ecer;
        }
    }
    $e = $produksi + 1500;
    $d = $e; //bulat($e)*1000;
    mysqli_query($conn,"INSERT INTO menu VALUES('','$menu','$kategori','$jual','$d','$resep')");
    header("location:form_menu.php");
} else if (isset($_POST['cek'])) {
    include "cek.php";
}
