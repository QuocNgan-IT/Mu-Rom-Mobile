<?php
  include("./config.php");
  include("./autoload.php");
  session_start();

 // echo $_SESSION['khachhang'];
 print_r($_SESSION['khachhang']);
 echo "<br><br>";
 echo $_SESSION['khachhang']['TenKH'];