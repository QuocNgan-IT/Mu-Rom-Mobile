<?php
include "connect.php";
session_start();

$thismonth = date("m");
$temp = strtotime(date("Y-m"));
$last1month = date("m", strtotime("-1 month", $temp));
$timerange = " MONTH(NgayDH)>=MONTH(DATE_ADD(CURDATE(),INTERVAL -2 MONTH));";
$result_revenue_total = 0;

//table dienthoai:      MaDT,TenDT,GiaGoc,GiaKhuyenMai,TrangThaiKM,TenTTKM,MoTa,SoLuong,DaBan,MaHang
  //table dathang:        MaDH,MaKH,LoiNhan,TongGiaTri,NgayDH,NgayGH,TrangThaiDH
  //table chitietdathang: MaDHChiTiet,MaDH,MaDT,SoLuong,GiaDonHang
  //table khachhang:      MaKH,HoTenKH,SoDienThoai,Email,Username,Password
  //table diachikh:       MaDC,DiaChi,MaKH
$sql_revenue_product = "SELECT SUM(SoLuong) as SoLuong FROM `dathang`, `chitietdathang` WHERE `dathang`.MaDH=`chitietdathang`.MaDH and $timerange";
$sql_revenue_order = "SELECT COUNT(MaDH) as SoDon FROM `dathang` WHERE $timerange";
$sql_revenue_total = "SELECT GiaDonHang as DoanhThu FROM `dathang`,`chitietdathang` WHERE `dathang`.MaDH=`chitietdathang`.MaDH and $timerange";

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

<div class="row">
    <span class="revenue-description__title"> <?php echo "từ tháng #" . $last1month . " đến tháng #" . $thismonth . " này" ?></span>
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