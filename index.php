<?php
session_start();

if(!isset($_SESSION['status'])){
    header("location:login.php");
}else{
    header("location:form_menu.php");
}
?>