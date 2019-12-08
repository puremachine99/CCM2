<?php
include "koneksi.php";
session_start();
if (!isset($_SESSION['status'])) {
    header("location:index.php");
}
function tema($kode)
{
    $sql = "SELECT * FROM akun WHERE usernames = '$kode'";
    require "koneksi.php";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        return $row['theme'];
    }
}
function colors($tema)
{
    if ($tema == "midnight") {
        return "putih";
    } else {
        return "hitam";
    }
}
function kategori()
{
    ?>
    <option value="">--Pilih Kategori--</option>
    <?php
        $sql = "SELECT * FROM kategori";
        require "koneksi.php";
        $res = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($res)) {
            ?>
        <option value="<?= $row['id_kategori'] ?>"><?= $row['nama'] ?></option>
        <?php
            }
        }
        function bayar()
        {
            $jidm = count($_POST['id_menu']);
            $id = $_POST['id_menu'];
            $harga = $_POST['harga'];
            $nama = $_POST['nama'];
            $pokok = $_POST['pokok'];
            $qty = $_POST['qty'];
            $total = 0;
            for ($i = 0; $i < $jidm; $i++) {
                if ($qty[$i] != 0) {
                    ?>
            <tr>
                <td><?= $id[$i] ?></td>
                <td><?= $nama[$i] ?></td>
                <td align="right"><span class="pull-left">Rp</span><?= number_format($harga[$i], 2, ',', '.') ?></td>
                <td align="right"><?= $qty[$i] ?></td>
                <td align="right"><span class="pull-left">Rp</span><?= number_format(($harga[$i] * $qty[$i]), 2, ',', '.') ?></td>

            </tr>
<?php
            $total = $total + ($harga[$i] * $qty[$i]);
        }
    }
}
function total()
{
    $jidm = count($_POST['id_menu']);
    $id = $_POST['id_menu'];
    $harga = $_POST['harga'];
    $nama = $_POST['nama'];
    $pokok = $_POST['pokok'];
    $qty = $_POST['qty'];
    $total = 0;
    for ($i = 0; $i < $jidm; $i++) {
        if ($qty[$i] != 0) {
            $total = $total + ($harga[$i] * $qty[$i]);
        }
    }
    return $total;
}
function orderan()
{
    $jidm = count($_POST['id_menu']);
    $id = $_POST['id_menu'];
    $harga = $_POST['harga'];
    $nama = $_POST['nama'];
    $pokok = $_POST['pokok'];
    $qty = $_POST['qty'];
    $total = 0;
    $menu = "";
    for ($i = 0; $i < $jidm; $i++) {
        if ($qty[$i] != 0) {
            $menu = $menu . $id[$i] . ":" . $qty[$i] . ",";
            $total = $total + ($harga[$i] * $qty[$i]);
        }
    }
    return $menu;
}
function call($field)
{
    $kode = $_SESSION['status'];
    $sql = "SELECT $field FROM akun WHERE usernames = '$kode'";
    require "koneksi.php";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        return $row[$field];
    }
}
require "panel_navigasi.php";
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rincian
            <small>Detail dari harga bahan pokok pembuatan menu</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
            <li class="active">Detail</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body">
                        <div class="col-xs-6">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>SubTotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?= bayar() ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5">Total : <span class="pull-right">Rp <?= number_format(total(), 2, ',', '.') ?></span></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-xs-6">
                            <form action="tulis_nota.php" method="post">
                                <label>Bayar : </label>
                                <input type="text" name="bayar" id="userinput" pattern="[0-9]*" class="form-control jumboo <?= colors(call("theme")) ?>" autofocus>
                                <input type="hidden" name="total" class="form-control" value="<?= total() ?>">
                                <input type="hidden" name="orderan" value="<?= orderan() ?>">
                                <br>
                                <!--<button name= "120k" type="submit" class="btn btn-success btn-sm"><span class="fa fa-dollar"></span> 120.000</button>
                                        <button name= "100k" type="submit" class="btn btn-success btn-sm"><span class="fa fa-dollar"></span> 100.000</button>
                                        <button name= "70k" type="submit" class="btn btn-success btn-sm"><span class="fa fa-dollar"></span> 70.000</button>
                                        <button name= "50k" type="submit" class="btn btn-success btn-sm"><span class="fa fa-dollar"></span> 50.000</button>
                                        <button name= "20k" type="submit" class="btn btn-success btn-sm"><span class="fa fa-dollar"></span> 20.000</button>
                                        <button name= "10k" type="submit" class="btn btn-success btn-sm"><span class="fa fa-dollar"></span> 10.000</button>-->
                                <button name="submit" type="submit" class="btn btn-info pull-right"><span class="fa fa-thumbs-up"></span> Selesai</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

</div>
<!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>

<div class="tampil-data"></div>

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="../plugin
s/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script>
    function deal() {
        window.history.back();
    }
</script>
</body>

</html>