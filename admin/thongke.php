<?php
include "connect.php";
session_start();

$today = date("Y-m-d");
$result_revenue_total = 0;

//table dienthoai:      MaDT,TenDT,GiaGoc,GiaKhuyenMai,TrangThaiKM,TenTTKM,MoTa,SoLuong,DaBan,MaHang
  //table dathang:        MaDH,MaKH,LoiNhan,TongGiaTri,NgayDH,NgayGH,TrangThaiDH
  //table chitietdathang: MaDHChiTiet,MaDH,MaDT,SoLuong,GiaDonHang
  //table khachhang:      MaKH,HoTenKH,SoDienThoai,Email,Username,Password
  //table diachikh:       MaDC,DiaChi,MaKH
$sql_revenue_product = "SELECT SUM(SoLuong) as SoLuong FROM `dathang`, `chitietdathang` WHERE `dathang`.MaDH=`chitietdathang`.MaDH and NgayDH='$today'";
$sql_revenue_order = "SELECT COUNT(MaDH) as SoDon FROM `dathang` WHERE NgayDH='$today'";
$sql_revenue_total = "SELECT GiaDonHang as DoanhThu FROM `dathang`,`chitietdathang` WHERE `dathang`.MaDH=`chitietdathang`.MaDH and NgayDH='$today'";

$temp_revenue_product = mysqli_query($conn, $sql_revenue_product);
$temp_revenue_order = mysqli_query($conn, $sql_revenue_order);
$temp_revenue_total = mysqli_query($conn, $sql_revenue_total);

$result_revenue_product = mysqli_fetch_assoc($temp_revenue_product);
$result_revenue_order = mysqli_fetch_assoc($temp_revenue_order);
foreach ($temp_revenue_total as $key) :
  $result_revenue_total += $key['DoanhThu'];
endforeach;
?>
<script src="bootstrap/jquery-3.5.1.min.js"></script>
<script>
  $(document).ready(function() {

    $("#revenue-content").load("thongke-1thang.php");

    $("#thongKe-1thang").click(function(e) {
        $("#revenue-content").load("thongke-1thang.php");
    });

    $("#thongKe-2thang").click(function(e) {
      $("#revenue-content").load("thongke-2thang.php");
    });

    $("#thongKe-1nam").click(function(e) {
      $("#revenue-content").load("thongke-1nam.php");
    });

    $(".revenue").click(function() {
      $('.revenue').removeClass('active');
      $(this).toggleClass('active');
    });

    // Mess
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
<!-- Thống kê oanh thu ngày -->
<div class="row"> 
  <div class="col">
    <div class="revenue-description">
      <div class="row">
        <span class="revenue-description__title"> Doanh thu: #<?php echo $today ?></span>
      </div>
      <div class="row mt-4 justify-content-between">
        <div class="col-6">
          <li>Số sản phẩm bán được:</li>
          <li>Số đơn hàng hoàn thành:</li>
          <li>Doanh thu hôm nay:</li>
        </div>
        <div class="col-3 revenue-description__table">
          <li id="revenue_product">
            <?php
            if ($result_revenue_product['SoLuong'] != "")
              echo $result_revenue_product['SoLuong'];
            else
              echo 0;
            ?>
          </li>
          <li id="revenue_order">
            <?php
            if ($result_revenue_order['SoDon'] != "")
              echo $result_revenue_order['SoDon'];
            else
              echo 0;
            ?>
          </li>
          <li id="revenue_revenue">
            <?php
            if ($result_revenue_total != "")
              echo number_format($result_revenue_total, 0, '', '.');
            else
              echo 0;
            ?>
          </li>
        </div>
        <div class="col-2 revenue-description__table">
          <li>SP</li>
          <li>đơn</li>
          <li>VNĐ</li>
        </div>
      </div>
    </div>
  </div>  
</div>
<br/>
<!-- Thống kê doanh thu -->
<div class="row justify-content-between">
  <div class="col">
    <div class="revenue-chart-day">
      <div class="row">
        <div class="col">
          <span class="revenue-description__title"> Thống kê doanh thu </span>
        </div>
        <div class="col-4">
          <div class="chart-icon-group">
            <span class="revenue chart-icon active" id="thongKe-1thang"> 1 Tháng </span>
            <span class="revenue chart-icon" id="thongKe-2thang"> 2 Tháng </span>
            <span class="revenue chart-icon" id="thongKe-1nam"> 1 Năm </span>
          </div>
        </div>
      </div>
      <div id="revenue-content"></div>
    </div>
  </div>
</div>