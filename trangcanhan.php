<?php 
  include("./config.php");
  include("./autoload.php");
  // include("./xacdinhdangnhap.php");
  session_start();
  $MaKH = $_SESSION['khachhang']['MaKH'];

  //table dienthoai:      MaDT,TenDT,GiaGoc,GiaKhuyenMai,TrangThaiKM,TenTTKM,MoTa,SoLuong,DaBan,MaHang
  //table dathang:        MaDH,MaKH,LoiNhan,NgayDH,NgayGH,TrangThaiDH
  //table chitietdathang: MaDHChiTiet,MaDH,MaDT,SoLuong,GiaDonHang
  //table khachhang:      MaKH,HoTenKH,SoDienThoai,Email,Username,Password

  $sql = "SELECT * FROM `dathang`,`khachhang` WHERE `dathang`.MaKH=`khachhang`.MaKH AND `khachhang`.MaKH='$MaKH' ORDER BY `dathang`.MaDH DESC";

  $sql_chitiet = "SELECT * FROM `dienthoai`,`chitietdathang` WHERE `dienthoai`.MaDT=`chitietdathang`.MaDT ORDER BY `chitietdathang`.MaDH DESC";

  $result = mysqli_query($mysqli, $sql);
  $result_chitiet = mysqli_query($mysqli, $sql_chitiet);
?>
<link rel="stylesheet" href="./admin/css/style.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="bootstrap/jquery-3.5.1.min.js"></script>
<script>
  $(document).ready(function() {
    $(".chitiet-dathang").click(function(e) {
      e.preventDefault();
      var MaDH = $(this).attr("MaDH");

      $.post("chitietdonhang.php", {
          MaDH: MaDH,
          chitiet_donhang: true
        }, function(data) {
          $("#oderdetail-content").html(data);
          $(".form-edit").show(500);
          $(".form-layout").show();
        }
      );
    });

    $(".icon-close").click(function() {
      $(".form").hide(500);
      $(".form-layout").hide();
    });

    $(".form-layout").click(function() {
      $(".form").hide(500);
      $(".form-layout").hide();
    });

    // close message
    $(".message-overlay").click(function(e) {
      $(".message").hide(500);
      $(".message-overlay").hide();
    });
  });
</script>
<?php if (isset($_SESSION['mess'])) {
    echo '<span class="message-overlay"></span>';
    echo '<span class="message">' . $_SESSION['mess'] . '</span>';
    unset($_SESSION['mess']);
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>M?? R??m Mobile</title>
    <link rel="stylesheet" type="text/css" href="./css/khachhang/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <link href="./css/khachhang/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="./css/khachhang/mdb.min.css" rel="stylesheet">
    <!-- <link href="./css/mdb02.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="./css/khachhang/addons/datatables.min.css">
    <link rel="stylesheet" href="./css/khachhang/addons/datatables-select.min.css">
    <style>
      :root {
          --color-1-: #B51E1E;
      }
    </style>
        
</head>
<body class="fixed-sn white-skin" style="padding: 0;">
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
          <input type="search" class="input_search form-control" name="keyword" placeholder="B???n c???n g??" maxlength="400px">
          <button type="submit"><i class="icon-search"></i></button>
        </form>
      </div> -->
      
      

      <div class="collapse navbar-collapse" id="navbarColor03">
        <ul class="navbar-nav ml-auto nav-li">
          <li class="nav-item">
            <div style="display: inline-flex;">
              <input type="hidden" name="route" value="timkiem">
              <input type="search" class="input_search form-control" name="keyword" placeholder="B???n t??m g??.." style="width: 400px">
              <button class="btn btn-danger my-2 my-sm-0" type="submit" style="height: 38px;background-color: yellow;display: flex;
    align-items: center;justify-content: center;margin-right: 75px">Search</button>
            </div>
          </li>
          </li>
          <li class="nav-item ten-hover">
            <a href="index.php?route=giohang" class="nav-link font-weight-bold " style="color: white;">          
                Gi??? h??ng
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
                     <a class='dropdown-item waves-effect waves-light' href='#'>Trang c?? nh??n</a>
                     <a class='dropdown-item waves-effect waves-light' href='#'>????ng xu???t</a>
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
              <a class='dropdown-item waves-effect waves-light' href='trangcanhan.php'>Trang c?? nh??n</a>
              <a class='dropdown-item waves-effect waves-light' href='index.php?dangxuat'>????ng xu???t</a>
            </div>
          </li>
          <?php }else { ?>
          <li class='nav-item ten-hover'>
            <a href='dangnhap.php' class='nav-link font-weight-bold'>
                ????ng nh???p
            </a>
          </li>
          <li class='nav-item ten-hover'>
            <a href='dangky.php' class='nav-link font-weight-bold'>
                  ????ng k??
            </a>
          </li>
          <?php } ?>
      </div>
    </div>
  </nav>

<main>
    <div class="container-fluid" style="margin-top: -85px">
        <section class="section team-section">
            <div class="row text-center">
                <div class="col-md-8 mb-4">
                    <div class="card card-cascade cascading-admin-card user-card">
                        <div class="admin-up d-flex justify-content-center tendt">
                            <div class="data" style="text-align: center">
                                <h5 class="font-weight-bold dark-grey-text">DANH S??CH ????N H??NG</h5>
                            </div>
                        </div>

                        <div class="container-fluid mb-5">
                            <section>
                                <div class="col-md-12">
                                    <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                            <th scope="col">M?? ????n</th>
                                            <th scope="col">Ng??y ?????t h??ng</th>
                                            <th scope="col">Ng??y giao</th>
                                            <th scope="col">Tr???ng th??i ????n</th>
                                            <th scope="col">Chi ti???t</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($result as $key) : ?>
                                            <tr>
                                              <th scope="row"><?php echo $key['MaDH'] ?></th>
                                              <td><?php echo $key['NgayDH'] ?></td>
                                              <td>
                                                <?php
                                                  if ($key['NgayGH']=="0000-00-00 00:00:00")
                                                  echo "Ch??a giao h??ng";
                                                  else echo $key['NgayGH'];
                                                ?>
                                              </td>
                                              <td><?php echo $key['TrangThaiDH'] ?></td>
                                              <td>
                                                <a class="chitiet-dathang" MaDH="<?php echo $key['MaDH'] ?>">
                                                  <i class="fas fa-ellipsis-h form-icon"></i>
                                                </a>
                                              </td>
                                            </tr>
                                          <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div><div  id="oderdetail-content" class="form-layout"></div>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card profile-card">
                        <div class="avatar z-depth-1-half mb-4">
                            <img src="./Images/photo-1-1599888048800211691483.jpg" class="rounded-circle" alt="First sample avatar image" width="140px" height="140px">
                        </div>

                        <div class="card-body pt-0 mt-0">
                            <!-- T??n -->
                            <h3 class="mb-3 font-weight-bold"><strong><?php
                                $sql_kh = "SELECT * FROM khachhang WHERE MaKH ='$MaKH'";
                                $query_kh = mysqli_query($mysqli, $sql_kh);
                                $row_kh = mysqli_fetch_array($query_kh);
                                echo $row_kh['TenKH'];
                            ?></strong></h3>

                            <p><b>Email:</b> <?php echo $row_kh['Email'] ?></p>
                            <p><b>SDT:</b> <?php echo $row_kh['SoDienThoai'] ?></p>
                            <p><b>?????a ch???:</b> <?php
                                $sql_diachikh = "SELECT * FROM diachikh WHERE MaKH ='$MaKH' LIMIT 1";
                                $query_diachikh = mysqli_query($mysqli, $sql_diachikh);
                                $row_diachikh = mysqli_fetch_array($query_diachikh);
                                echo $row_diachikh['DiaChi'];
                            ?></p>

                            <a class="btn btn-danger btn-rounded">C???p nh???t th??ng tin</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<footer class="page-footer text-center text-md-left pt-0" style="background-color: #ff685f">
    <div style="background-color: rgb(177, 9, 9)">

        <div class="container">

        <!-- Grid row -->
        <div class="row py-4 d-flex align-items-center">

        <!-- Grid column -->
        <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">

            <h6 class="mb-0 white-text">Li??n h??? v???i ch??ng t??i qua c??c m???ng x?? h???i!</h6>

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
    <div class="container mt-5 mb-4 text-center text-md-left">

        <div class="row mt-3">

        <!-- First column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mb-4">

        <h6 class="text-uppercase font-weight-bold">

            <strong>M?? R??M MOBILE</strong>

        </h6>

        <hr class="blue mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">

        <p>M?? R??m Mobile l?? trang web b??n ??i???n tho???i c??ng c??c ph??? ki???n,
            v???i mong mu???n mang ?????n nh???ng tr???i nghi???m t???t ?????p cho kh??ch h??ng.
            M?? R??m Mobile lu??n b??n ????ng gi?? v?? ????ng ch???t l?????ng.
            Ch??c qu?? kh??ch ch???n ???????c s???n ph???m ??ng ??.
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

            <strong>LI??N H???</strong>

        </h6>

        <hr class="blue mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">

        <p>

            <i class="fas fa-home mr-3"></i>???????ng 3/2, Xu??n Kh??nh, Ninh Ki???u, C???n Th??</p>

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
    <div class="footer-copyright py-3 text-center">

        <div class="container-fluid">

            ?? 2022 Copyright:

            <a href="https://mdbootstrap.com/education/bootstrap/" class="text-decoration-none" target="_blank"> M?? R??m Mobile </a>

        </div>

    </div>
</footer>

  <script src="./js/khachhang/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips  -->
  <script type="text/javascript" src="./js/khachhang/popper.min.js"></script>
  <!-- Bootstrap core JavaScript  -->
  <script type="text/javascript" src="./js/khachhang/bootstrap.js"></script>
  <!-- MDB core JavaScript  -->
  <script type="text/javascript" src="./js/khachhang/mdb.min.js"></script>
  <!-- DataTables  -->
  <script type="text/javascript" src="./js/khachhang/addons/datatables.min.js"></script>
  <!-- DataTables Select  -->
  <script type="text/javascript" src="./js/khachhang/addons/datatables-select.min.js"></script>
  <!-- Custom scripts -->
 
  <script>
    // SideNav Initialization
    $(".button-collapse").sideNav();

    let container = document.querySelector('.custom-scrollbar');
    var ps = new PerfectScrollbar(container, {
      wheelSpeed: 2,
      wheelPropagation: true,
      minScrollbarLength: 20
    });

    $('#dtMaterialDesignExample').DataTable();

    $('#dt-material-checkbox').dataTable({

      columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
      }],
      select: {
        style: 'os',
        selector: 'td:first-child'
      }
    });

    $('#dtMaterialDesignExample_wrapper, #dt-material-checkbox_wrapper').find('label').each(function () {
      $(this).parent().append($(this).children());
    });
    $('#dtMaterialDesignExample_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').find(
      'input').each(function () {
      $('input').attr("placeholder", "Search");
      $('input').removeClass('form-control-sm');
    });
    $('#dtMaterialDesignExample_wrapper .dataTables_length, #dt-material-checkbox_wrapper .dataTables_length').addClass(
      'd-flex flex-row');
    $('#dtMaterialDesignExample_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').addClass(
      'md-form');
    $('#dtMaterialDesignExample_wrapper select, #dt-material-checkbox_wrapper select').removeClass(
      'custom-select custom-select-sm form-control form-control-sm');
    $('#dtMaterialDesignExample_wrapper select, #dt-material-checkbox_wrapper select').addClass('mdb-select');
    $('#dtMaterialDesignExample_wrapper .mdb-select, #dt-material-checkbox_wrapper .mdb-select').materialSelect();
    $('#dtMaterialDesignExample_wrapper .dataTables_filte, #dt-material-checkbox_wrapper .dataTables_filterr').find(
      'label').remove();

  </script>


</body>
</html>

