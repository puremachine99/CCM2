<?php

function tema($kode){
    $sql = "SELECT * FROM akun WHERE usernames = '$kode'";
    require "koneksi.php";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        return $row['theme'];
    }
  }

session_start();
@$usernames = $_POST['users'];
@$passwords = $_POST['pass'];
@$login = "SELECT * FROM akun WHERE usernames ='$usernames' and passwords ='$passwords'";
require "koneksi.php";
$res = mysqli_query($conn, $login);
    while ($row = mysqli_fetch_assoc($res)) {
        $_SESSION['status'] = $usernames;
        $_SESSION['theme'] = tema($usernames);
        header("location:form_menu.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IPOSMachine | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<style>
    .rounds {
        border-radius: 15px;
        background-color: rgba(255, 255, 255, 0.2);

    }

    #slide {
        position: absolute;
        margin-top:12%;
        left: -500px;
        -webkit-animation: slide 0.5s forwards;
        -webkit-animation-delay: 2s;
        animation: slide 0.5s forwards;
        animation-delay: 2s;
    }

    @-webkit-keyframes slide {
        75% {
            left: 13%;
        }
        100%{
            left: 11%;
        }
    }

    @keyframes slide {
        75% {
            left: 13%;
        }
        100%{
            left: 11%;
        }
    }

    .no-scroll {
        overflow: hidden;
        background-image: url('img/bg-login2.jpg');    
        background-size:100%;
        background-position-y: -100px;
    }
</style>

<body class="hold-transition login-page no-scroll">
    <div id="slide" class="login-box">
        <div class="login-logo">
            <a href="#">
                <font color="white">POS <b>Machine</b></font>
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body rounds">

            <form action="login.php" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="users" class="form-control" placeholder="Username" autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="pass" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-success btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


            <!-- /.social-auth-links -->



        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
</body>
<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>


</html>