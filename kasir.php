<?php
include "koneksi.php";
session_start();
if (!isset($_SESSION['status'])) {
    header("location:index.php");
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include "koneksi.php";
    mysqli_query($conn, "DELETE FROM menu WHERE Id_menu = '$id'");
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
function list_menu()
{
    $sql = "SELECT * FROM menu ORDER BY id_kategori";
    require "koneksi.php";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        ?>
        <div class="col-xs-2">
            <div class="box box-info">
                <div class="box-body">
                    <h4><?= ucfirst($row['Nama']) ?></h4>
                    <!--<img src="#">-->
                    <input type="hidden" name="id_menu[]" value="<?= ($row['Id_menu']) ?>">
                    <input type="hidden" name="harga[]" value="<?= ($row['Harga']) ?>">
                    <input type="hidden" name="pokok[]" value="<?= ($row['Pokok']) ?>">
                    <input type="hidden" name="nama[]" value="<?= ($row['Nama']) ?>">
                    <h5 class="text-green"><?= number_format($row['Harga'], 2, ',', '.') ?></h5>
                    <div class="col-xs-10">
                        <input type="number" name="qty[]" min="0" max="99" maxlength="2" class="form-control <?= colors(call("theme")) ?>">
                    </div>
                </div>
            </div>
        </div>
<?php
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

        require "panel_navigasi.php";
        ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Cashier
                    <small>v 1.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#" height="100px"><i class="fa fa-dashboard"></i> Kasir</a></li>
                    <li class="active">Buka</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-responsive">
                            <form action="bayar.php" method="post">
                                <div class="box-header">
                                    <button type="submit" name="subtotal" class="btn btn-info"><span class="fa fa-money"> </span> Bayar</button>
                                </div>
                                <div class="box-body">
                                    <?= list_menu() ?>
                                </div>
                            </form>
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
    <!-- jQuery 2.2.3 -->

    <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- page script -->
    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
</body>

</html>