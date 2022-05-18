<?php
  include("./config.php");
  include("./autoload.php");
  // include("./xacdinhdangnhap.php");
  session_start();
  $MaKH = $_SESSION['khachhang']['MaKH'];

if (isset($_POST['chitiet_donhang']) && isset($_POST['MaDH'])) {
  $sum = 0;
  $MaDH = $_POST['MaDH'];

  //table dienthoai:      MaDT,TenDT,GiaGoc,GiaKhuyenMai,TrangThaiKM,TenTTKM,MoTa,SoLuong,DaBan,MaHang
  //table dathang:        MaDH,MaKH,LoiNhan,NgayDH,NgayGH,TrangThaiDH
  //table chitietdathang: MaDHChiTiet,MaDH,MaDT,MauSac,SoLuong,GiaDonHang
  //table khachhang:      MaKH,HoTenKH,SoDienThoai,Email,Username,Password
  //table diachikh:       MaDC,DiaChi,MaKH

  // Lấy thông tin đơn hàng
  $sqlChiTiet = "SELECT * FROM `dathang`,`khachhang`,`diachikh`
  WHERE `dathang`.MaKH=`khachhang`.MaKH AND `khachhang`.MaKH=`diachikh`.MaKH AND `dathang`.MaDH='$MaDH'";

  $temp = mysqli_query($mysqli, $sqlChiTiet);
  $resultChiTiet = mysqli_fetch_array($temp);

  //Lấy thông tin chi tiết đơn hàng
  $sqlChiTietDH = "SELECT * FROM `dienthoai`,`chitietdathang` WHERE `dienthoai`.MaDT=`chitietdathang`.MaDT AND `chitietdathang`.MaDH='$MaDH'";

  $resultChiTietDH = mysqli_query($mysqli, $sqlChiTietDH);
?>
<script>
  $(document).ready(function() {
    $(".xuly-don").click(function(e) {
      e.preventDefault();

      var TrangThaiDHnew = $(this).attr("TrangThaiDHnew");
      var MaDHxuly      = $(this).attr("MaDH");

      $.get("action.php", {
        TrangThaiDHnew: TrangThaiDHnew,
        MaDHxuly: MaDHxuly,
        xuly_don: true
      }, function(data) {
        location.reload();
      });
    });
  });
</script>
  <!-- Form chi tiết đơn hàng -->
  <div class="form form-edit" style="width: 40rem;">
    <div class=" col">
      <div class="row justify-content-end">
        <i class="fas fa-times icon-close" id="icon-close"></i>
      </div>
      <div class="row">
        <span class="form-title">Chi tiết đơn hàng: #<?php echo $resultChiTiet['MaDH'] ?></span>
      </div>
      <div class="row">
        <div class="col list-personnel">
          <div class="row customer-detail">
            <li><b>- Số điện thoai nhận hàng: </b><?php echo $resultChiTiet['SoDienThoai'] ?></li>
            <li><b>- Địa chỉ giao hàng: </b><?php echo $resultChiTiet['DiaChi'] ?></li>
            <li><b>- Lời nhắn: </b><?php echo $resultChiTiet['LoiNhan'] ?></li>
          </div>
        </div>
      </div>
      <div class="row ">
        <div class="col list-personnel">
          <div class="row list-product">          
            <div class="col">
              <?php foreach ($resultChiTietDH as $key) : ?>
                <div class="row justify-content-between">
                  <div class="col-4">
                    <span class="row order-detail__list-product--title"><?php echo $key['TenDT'] ?></span>
                  </div>
                  <div class="col-3">
                    <span class="order-detail__list-product--quantity">
                      <?php
                        $getTenMS = "SELECT TenMS FROM `mausacdt` WHERE MaMS='" . $key['MauSac'] . "'";
                        $tenMS = $mysqli->query($getTenMS)->fetch_array();
                       echo $tenMS[0];  
                       ?>
                    </span>
                  </div>
                  <div class="col-1">
                    <span class="order-detail__list-product--quantity">x<?php echo $key['SoLuong'] ?></span>
                  </div>                  
                  <div class="col-4">
                    <span class="order-detail__list-product--quantity"><?php $sum+=($key['GiaDonHang']); echo number_format(($key['GiaDonHang']), 0, '', '.') ?> vnd</span>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col order-detail__list-product--total">
          <span>Giá trị đơn hàng: </span>
          <span><?php echo number_format($sum, 0, '', '.') ?> vnd</span>
        </div>
      </div>
      <div class="row justify-content-between">
        <!-- Nhận đơn -->
        <?php if ($resultChiTiet['TrangThaiDH'] == "Đang giao") : ?>
          <span type="button" class="col icon-add xuly-don" MaDH="<?php echo $MaDH ?>" TrangThaiDHnew="Đã nhận hàng">
            <i class="fas">Đã nhận hàng</i>
          </span>
        <?php endif; ?>
        <!-- Hủy đơn -->
        <?php if ($resultChiTiet['TrangThaiDH'] == "Chờ xác nhận" || $resultChiTiet['TrangThaiDH'] == "Đang đóng gói") : ?>
          <span type="button" class="col icon-add xuly-don" MaDH="<?php echo $MaDH ?>" TrangThaiDHnew="Đã hủy">
            <i class="fas">Hủy đơn</i>
          </span>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php } ?>