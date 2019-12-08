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
    function orderan()
    {
      $menu = $_POST['orderan'];
      $bayar = $_POST['bayar'];
      $subtotal = $_POST['total'];
      $no = no_nota();
      $tgl = date("d/m/Y");
      $a = explode(",", $menu);
      $jml = count($a);
      for ($i = 0; $i < $jml; $i++) {
        $b = explode(":", $a[$i]);
        $id = $b[0];
        $sql = "SELECT * FROM menu WHERE id_menu = '$id'";
        require "koneksi.php";
        $res = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($res)) {
          mysqli_query($conn,"INSERT INTO terjual VALUES('$no','$id','$b[1]','$tgl')");

          ?>
      <tr>
        <td><span class="hitam"><?= $i + 1 ?></span></td>
        <td><span class="hitam"><?= $row['Nama'] ?></span></td>
        <td align="center"><span class="hitam"><?= $b[1] ?></span></td>
        <td align="right"><span class="hitam">Rp <?= number_format($row['Harga'], 2, ',', '.') ?></span></td>
        <td align="right"><span class="hitam">Rp <?= number_format($b[1] * $row['Harga'], 2, ',', '.') ?></span></td>

      </tr>
<?php
    }
  }
  require "koneksi.php";
  mysqli_query($conn,"INSERT INTO nota VALUES('$no','$tgl','$bayar','$subtotal')");
}
function total()
{
  $bayar = $_POST['bayar'];
  $subtotal = $_POST['total'];

  return $bayar . "|" . $subtotal;
}
function no_nota(){
  $tanggal = date("d/m/Y");
  $tgl = date("dmy");
  $sql = "SELECT COUNT(tanggal) as jml FROM nota WHERE tanggal = '$tanggal'";
  require "koneksi.php";
  $res = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($res)){
    return $tgl.$row['jml']+1;
  }
}

    require "panel_navigasi.php";
    ?>

    <div class="content-wrapper">
      <section class="content-header">
      
      </section>

      <!-- Main content -->
      <section class="invoice col-xs-6 hitam">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="glyphicon glyphicon-tree-deciduous"></i> <?= call("Nama_kafe") ?>
              <small class="pull-right">Date: <?= no_nota()//date("d/m/Y") ?></small>
            </h2>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-6 invoice-col hitam">
            <address>
              <?= call("alamat") ?><br>
              <?= call("kontak") ?><br>
              <?= call("email") ?><br>
              <?= call("instagram") ?>
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-2 invoice-col">

          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b></b><br>
            <b>Order ID:</b> <?=no_nota()?><br>
            <b>Payment Due:</b> <?= date("d/m/Y") ?><br>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>
                    <center class="hitam"> #</center>
                  </th>
                  <th>
                    <center class="hitam">Item</center>
                  </th>
                  <th>
                    <center class="hitam">Jumlah</center>
                  </th>
                  <th>
                    <center class="hitam">Harga</center>
                  </th>
                  <th>
                    <center class="hitam">SubTotal</center>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?= orderan() ?>
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <!-- accepted payments column
          <div class="col-xs-6">
            <p class="lead">Cara Pembayaran:</p>
            <img src="../dist/img/credit/visa.png" alt="Visa">
            <img src="../dist/img/credit/mastercard.png" alt="Mastercard">
            <img src="../dist/img/credit/american-express.png" alt="American Express">
            <img src="../dist/img/credit/paypal2.png" alt="Paypal">

            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium possimus nam repudiandae, facere autem ullam. Pariatur facere perspiciatis quod. Perspiciatis ea, modi consequatur deleniti aperiam maxime quas sunt alias vero!
            </p>
          </div> -->
          <!-- /.col -->
          <div class="col-xs-6"></div>
          <div class="col-xs-6">
            <!--<p class="lead">Pembayaran</p>-->
            <hr>
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th><span class="hitam">Bayar:</span></th>
                  <td align="right">
                    <span class="hitam">
                      <?php $a = explode("|", total());
                      echo "Rp " . number_format($a[0], 2, ',', '.'); ?></span>
                  </td>
                </tr>
                <tr>
                  <th style="width:50%"><span class="hitam">Subtotal:</span></th>
                  <td align="right">
                    <span class="hitam">
                      <?php $a = explode("|", total());
                      echo "Rp " . number_format($a[1], 2, ',', '.'); ?></span></td>
                </tr>
                <tr>
                  <th><span class="hitam">PPN :</span></th>
                  <td align="right"><span class="hitam"> - </span></td>
                </tr>
                <tr>
                  <th><span class="hitam">Kembalian :</span></th>
                  <td align="right"><span class="hitam">
                      <?php $a = explode("|", total());
                      echo "Rp" . number_format($a[0] - $a[1], 2, ',', '.'); ?></span></td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
          <div class="col-xs-12">
            <!--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
            <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
            </button>

          </div>
        </div>
      </section>

      <!-- /.content -->
      <div class="clearfix"></div>
    </div>
    <!-- Content Header (Page header) -->
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
</body>

</html>