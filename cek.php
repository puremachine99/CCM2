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
function bahan()
{
    ?>
    <option value="">--Pilih Bahan--</option>
    <?php
        $sql = "SELECT * FROM komposisi";
        require "koneksi.php";
        $res = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($res)) {
            ?>
        <option value="<?= $row['id_bahan'] ?>"><?= $row['Nama'] ?></option>
    <?php
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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Bahan</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>*</td>
                                                <td>Produksi</td>
                                                <td> - </small></td>
                                                <td align="right"><span class="pull-left">Rp</span><?= number_format(1500, 2, ',', '.') ?></td>
                                            </tr>
                                            <?= listing() ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4">Total : <span class="pull-right">Rp <?= number_format(total(), 2, ',', '.') ?></span></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="col-xs-6">
                                    <table class="col-xs-12">
                                        <tr>
                                            <td>
                                                <h4>Harga Pokok : </h4>
                                            </td>
                                            <td align="right">
                                                <h4><span class="pull-left">Rp</span>
                                                    <?= number_format(total(), 2, ',', '.') ?></h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4>Saran : </h4>
                                            <td align="right">
                                                <h4><span class="pull-left">Rp</span>
                                                    <?= number_format(rekomendasi(total()), 2, ',', '.') ?></h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <hr>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4>Laba :</h4>
                                            </td>
                                            <td align="right">
                                                <h4><span class="pull-left">Rp</span>
                                                    <?= number_format(nett(), 2, ',', '.') ?></h4>
                                            </td>
                                        </tr>
                                    </table>
                                    <button onclick="deal()" class="btn btn-default btn-md pull-right"><span class="fa fa-dollar"></span>Tulis Harga</button>
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