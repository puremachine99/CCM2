<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>IPOSMachine</title>

  <link rel="shortcut icon" href="../assets/ico.png">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../dist/css/skins/skin-midnight.css">

  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="../assets/users/custom.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<style>
  .putih {
    color: white;
  }

  .hitam {
    color: black;
  }

  .jumboo {
    height: 80px;
    font-size: 36px;
    direction: rtl;
    font-style: bold;
  }
</style>

<body class="fixed sidebar-mini skin-<?= tema($_SESSION['status']) ?> sidebar-mini">
  <div class="wrapper">
    <style>
      .rusak {
        cursor: not-allowed;
      }
    </style>
    <header class="main-header">
      <!-- Logo -->
      <?php
      function hehe($kode)
      {
        $x = $_SESSION['status'];
        $sql = "SELECT $kode FROM akun where usernames='$x'";
        require "koneksi.php";
        $res = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($res)) {
          return $row[$kode];
        }
      }
      function tipe($kode)
      {
        if (hehe("Jenis") == 0) {
          ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-cutlery text-aqua"></i>
              <span>Menu</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="liebening"><a href="form_menu.php" data-placement="right" data-toggle="tooltip" data-original-title="Buat Resep Baru"><i class="fa fa-plus"></i> Buat Menu</a></li>
              <li class="liebening"><a href="list_menu.php" data-placement="right" data-toggle="tooltip" data-original-title="Resep Kamu"><i class="fa fa-table"></i> List Menu</a></li>
              <li class="liebening"><a href="list_bahan.php" data-placement="right" data-toggle="tooltip" data-original-title="Resep Kamu"><i class="fa fa-archive"></i> Komposisi</a></li>
              <li class="liebening"><a href="list_kategori.php" data-placement="right" data-toggle="tooltip" data-original-title="Kategori"><i class="fa fa-bookmark"></i> List Kategori</a></li>
            <?php
              } else {
                ?>
              <li class="treeview">
                <a href="#">
                  <i class="glyphicon glyphicon-cd text-aqua"></i>
                  <span>Item</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="form_item.php" data-placement="right" data-toggle="tooltip" data-original-title="Buat Resep Baru"><i class="fa fa-plus"></i> Item Baru</a></li>
                  <li><a href="list_item.php" data-placement="right" data-toggle="tooltip" data-original-title="Resep Kamu"><i class="fa fa-table"></i> List Item</a></li>
                  <li><a href="form_kategori.php" data-placement="right" data-toggle="tooltip" data-original-title="Buat Kategori Baru"><i class="fa fa-plus"></i> Tambah Kategori</a></li>
                  <li><a href="list_kategori.php" data-placement="right" data-toggle="tooltip" data-original-title="Kategori"><i class="fa fa-bookmark"></i> List Kategori</a></li>
              <?php
                }
              }
              ?>
              <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><i class="glyphicon glyphicon-tree-deciduous"></i></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><?= hehe("Nama_kafe") ?></span>
              </a>
              <!-- Header Navbar: style can be found in header.less -->
              <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                  <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                    <li>
                      <a href="logout.php"><i class="fa fa-power-off"></i></a>
                    </li>
                  </ul>
                </div>
              </nav>
    </header>
    <aside class="main-sidebar bening">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <ul class="sidebar-menu">
          <li class="header">&nbsp;</li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-dollar text-green"></i>
              <span>Cashier</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="kasir.php" data-placement="right" data-toggle="tooltip" data-original-title="Mulai Jualan"><i class="fa fa-tags"></i> Buka</a></li>
              <li><a href="list_nota.php" data-placement="right" data-toggle="tooltip" data-original-title="Nota penjualan nih"><i class="fa fa-sticky-note-o"></i> Nota</a></li>
              <li><a href="#" class="rusak" data-placement="right" data-toggle="tooltip" data-original-title="Dalam Proses"><i class="fa fa-power-off"></i> Tutup</a></li>

            </ul>
          </li>

          <?= tipe(hehe("Jenis")) ?>
        </ul>
        </li>
        <li><a href="#" class="rusak" data-placement="right" data-toggle="tooltip" data-original-title="Dalam Proses"><i class="fa fa-shopping-cart text-yellow"></i> <span>Pengeluaran</span></a></li>
        <li><a href="#" class="rusak" data-placement="right" data-toggle="tooltip" data-original-title="Dalam Proses"><i class="fa fa-suitcase text-red"></i> <span>Keuangan</span></a></li>
        <li><a href="pengaturan.php"><i class="fa fa-gear"></i> <span>Pengaturan</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>