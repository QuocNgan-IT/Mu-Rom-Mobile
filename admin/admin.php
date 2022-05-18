<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mũ Rơm Mobile | Admin</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
  <script src="https://kit.fontawesome.com/194e38739f.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php if (!isset($_SESSION['admin'])) {
    header("refresh:0; url=index.php");
    exit();
  } ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-2 menu">
        <h4 class="menu-title">ADMIN</h4>
        <hr />
        <li class="menu-item active" id="thongke">Thống kê</li>
        <li class="menu-item" id="donhang">Đơn hàng</li>
        <li class="menu-item" id="khachhang">Khách hàng</li>
        <li class="menu-item" id="hangsx">Hãng điện thoại</li>
        <li class="menu-item" id="dienthoai">Điện thoại</li>
        <!-- <li class="menu-item" id="test">Test sửa điện thoại</li> -->
      </div>
      <div class="col-10 content">
        <div class="row user justify-content-between align-items-center">
          <div class="col-3">
            <span class="user-hello">Xin chào, Admin</span>
          </div>
          <div class="col-2">
            <span class="user-icon" id="logout">
              Logout <i class="fas fa-sign-out-alt"></i>
            </span>
          </div>
        </div>
        <div id="content"></div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script src="bootstrap/jquery-3.5.1.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#content").load("thongke.php");
      // Menu Click

      $("#thongke").click(function(e) {
        $("#content").load("thongke.php");
      });

      $("#donhang").click(function(e) {
        $("#content").load("donhang.php");
      });

      $("#khachhang").click(function(e) {
        $("#content").load("khachhang.php");
      });

      $("#hangsx").click(function(e) {
        $("#content").load("hangsx.php");
      });

      $("#dienthoai").click(function(e) {
        $("#content").load("dienthoai.php");
      });

      // $("#test").click(function(e) {
      //   $("#content").load("form-themDT.php");
      // });

      $(".menu-item").click(function() {
        $(".menu-item").removeClass("active");
        $(this).toggleClass("active");
      });

      $("#logout").click(function(e) {

        $.post("action.php", {
          logout: true
        }, function() {
          window.location.href = 'index.php';
        });
      });
    });
  </script>
</body>

</html>