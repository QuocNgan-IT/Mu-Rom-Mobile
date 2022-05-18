<?php
  include("./config.php");
  include("./autoload.php");
  // include("./xacdinhdangnhap.php");
  session_start();

  if (isset($_GET['dangxuat'])) unset($_SESSION['khachhang']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Mũ Rơm Mobile</title>
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="./css/mdb.min.css" rel="stylesheet">
    <!-- <link href="./css/mdb02.min.css" rel="stylesheet"> -->
    <style>
      :root {
          --color-1-: #B51E1E;
      }
    </style>
        
</head>
<body id="router"  style="padding: 0;">
  <!--Header-->
  <nav class="navbar navbar-expand-lg" style="margin: 0; padding: 0">
    <div class="container-fluid" style="background-color: var(--color-1-)">
    
      <div>
        <a class="navbar-brand" href="./index.php">
          <img src="./Images/logo.PNG">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>

      <!-- <div>
        <form style="display: flex">
          <input type="hidden" name="route" value="timkiem">
          <input type="search" class="input_search form-control" name="keyword" placeholder="Bạn cần gì" maxlength="400px">
          <button type="submit"><i class="icon-search"></i></button>
        </form>
      </div> -->
      
      

      <div class="collapse navbar-collapse" id="navbarColor03">
        <ul class="navbar-nav ml-auto nav-li">
          <li class="nav-item">
            <div style="display: inline-flex;">
            <form>
              <input type="hidden" name="route" value="timKiem">
              <input type="search" style="position: absolute; top: 14px; left: 431px; width: 430px" class="input_search form-control" name="tuKhoa" placeholder="Bạn tìm gì..">
              <button class="btn btn-danger my-2 my-sm-0" type="submit" style="height: 38px;background-color: yellow;display: flex;
    align-items: center;justify-content: center;margin-right: 75px;position: absolute; left: 866px; top: 14px">Search</button>
            </form>
          </div>
    
          </li>
          <li class="nav-item ten-hover">
            <a href="?route=giohang" class="nav-link font-weight-bold ">          
                Giỏ hàng
                <?php
                 if (isset($_SESSION['khachhang'])) {
                   $MaKH = $_SESSION['khachhang']['MaKH'];
                   $sql_soluonggh = "SELECT COUNT(MaGH) soluong FROM giohang WHERE MaKH='$MaKH'";
                  
                  //$sql_soluonggh = "SELECT COUNT(MaGH) soluong FROM giohang";
                  $query_soluonggh = mysqli_query($mysqli, $sql_soluonggh);
                  $row_soluonggh = mysqli_fetch_array($query_soluonggh);
                  if ($row_soluonggh['soluong'] != 0) {
                    ?>
                    <span class="badge danger-color">
                      <?php echo $row_soluonggh['soluong'] ?>
                    </span>
                    <?php
                  }}
                ?>
            </a>
          </li>
                <!--  <li class='nav-item dropdown ml-3'>
                   <a class='nav-link dropdown-toggle waves-effect waves-light dark-grey-text font-weight-bold'
                   id='navbarDropdownMenuLink-4' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                     ".$_SESSION['khachhang']['TenKH']."
                   </a>
                   <div class='dropdown-menu dropdown-menu-right dropdown-cyan' aria-labelledby='navbarDropdownMenuLink-4'>
                     <a class='dropdown-item waves-effect waves-light' href='#'>Trang cá nhân</a>
                     <a class='dropdown-item waves-effect waves-light' href='#'>Đăng xuất</a>
                   </div>
                 </li>"; -->

                 <?php if (isset($_SESSION['khachhang'])) { ?>
          <li class='nav-item dropdown ml-3'>
            <a class='nav-link ten-hover dropdown-toggle waves-effect waves-light font-weight-bold'
            id='navbarDropdownMenuLink-4' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'
             style="color: white">
              <?php echo $_SESSION['khachhang']['Username'] ?>
            </a>
            <div class='dropdown-menu dropdown-menu-right dropdown-cyan' aria-labelledby='navbarDropdownMenuLink-4'>
              <a class='dropdown-item waves-effect waves-light' href='trangcanhan.php'>Trang cá nhân</a>
              <a class='dropdown-item waves-effect waves-light' href='index.php?dangxuat'>Đăng xuất</a>
            </div>
          </li>
          <?php }else { ?>
          <li class='nav-item ten-hover'>
            <a href='dangnhap.php' class='nav-link font-weight-bold'>
                Đăng nhập
            </a>
          </li>
          <li class='nav-item ten-hover'>
            <a href='dangky.php' class='nav-link font-weight-bold'>
                  Đăng ký
            </a>
          </li>
          <?php } ?>
          
      </div>
    </div>
  </nav>

  <?php include("router.php") ?>
      

<!--Footer-->

<footer class="page-footer text-center text-md-left pt-0" style="background-color: #ff685f">

<div style="background-color: rgb(177, 9, 9)">

  <div class="container">

    <!-- Grid row -->
    <div class="row py-4 d-flex align-items-center">

      <!-- Grid column -->
      <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">

        <h6 class="mb-0 white-text">Liên hệ với chúng tôi qua các mạng xã hội!</h6>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-6 col-lg-7 text-center text-md-right">

        <!-- Facebook -->
        <a class="fb-ic ml-0 px-2" href="https://www.facebook.com/">

          <i class="fab fa-facebook-f white-text"> </i>

        </a>

        <!-- Twitter -->

        <!-- Instagram -->
        <a class="ins-ic px-2" href="https://www.instagram.com/">

          <i class="fab fa-instagram white-text"> </i>

        </a>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>

</div>

<!-- Footer Links -->
<div class="container mt-5 mb-4 text-center text-md-left">

  <div class="row mt-3">

    <!-- First column -->
    <div class="col-md-3 col-lg-4 col-xl-3 mb-4">

      <h6 class="text-uppercase font-weight-bold">

        <strong>MŨ RƠM MOBILE</strong>

      </h6>

      <hr class="blue mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">

      <p>Mũ Rơm Mobile là trang web bán điện thoại cùng các phụ kiện,
        với mong muốn mang đến những trải nghiệm tốt đẹp cho khách hàng.
        Mũ Rơm Mobile luôn bán đúng giá và đúng chất lượng.
        Chúc quý khách chọn được sản phẩm ưng ý.
      </p>

    </div>
    <!-- First column -->

    <!-- Second column -->
    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

      <h6 class="text-uppercase font-weight-bold">

        <strong>Products</strong>

      </h6>

      <hr class="blue mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">

      <p>

        <a href="#!">MDBootstrap</a>

      </p>

      <p>

        <a href="#!">MDWordPress</a>

      </p>

      <p>

        <a href="#!">BrandFlow</a>

      </p>

      <p>

        <a href="#!">Bootstrap Angular</a>

      </p>

    </div>
    <!-- Second column -->

    <!-- Third column -->
    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

      <h6 class="text-uppercase font-weight-bold">

        <strong>Useful links</strong>

      </h6>

      <hr class="blue mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">

      <p>

        <a href="#!">Your Account</a>

      </p>

      <p>

        <a href="#!">Become an Affiliate</a>

      </p>

      <p>

        <a href="#!">Shipping Rates</a>

      </p>

      <p>

        <a href="#!">Help</a>

      </p>

    </div>
    <!-- Third column -->

    <!-- Fourth column -->
    <div class="col-md-4 col-lg-3 col-xl-3">

      <h6 class="text-uppercase font-weight-bold">

        <strong>LIÊN HỆ</strong>

      </h6>

      <hr class="blue mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">

      <p>

        <i class="fas fa-home mr-3"></i>Đường 3/2, Xuân Khánh, Ninh Kiều, Cần Thơ</p>

      <p>

        <i class="fas fa-envelope mr-3"></i> murommobile@gmail.com</p>

      <p>

        <i class="fas fa-phone mr-3"></i> + 083 78 76 273</p>

      <p>

        <i class="fas fa-print mr-3"></i> + 0968 892 700</p>

    </div>
    <!-- Fourth column -->

  </div>

</div>
<!-- Footer Links -->

<!-- Copyright -->
<div class="footer-copyright py-3 text-center">

  <div class="container-fluid">

    © 2022 Copyright:

    <a href="https://mdbootstrap.com/education/bootstrap/" class="text-decoration-none" target="_blank"> Mũ Rơm Mobile </a>

  </div>

</div>
<!-- Copyright -->

</footer>



<script type="text/javascript" src="./js/jquery-3.4.1.min.js"></script>

  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="./js/popper.min.js"></script>

  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="./js/bootstrap.min.js"></script>

  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="./js/mdb.min.js"></script>


</body>
</html>