<?php
include "connect.php";

$today = date("Y-m-d");

if (isset($_GET['search']) && isset($_GET['key']) && $_GET['key']!="") {
  $key = $_GET['key'];
  $sql = "SELECT * FROM `dathang`,`khachhang` WHERE `dathang`.MaKH=`khachhang`.MaKH AND `dathang`.NgayDH='$key' ORDER BY `dathang`.MaDH DESC";
  $_SESSION['mess'] = $key;
} else $sql = "SELECT * FROM `dathang`,`khachhang` WHERE `dathang`.MaKH=`khachhang`.MaKH ORDER BY `dathang`.MaDH DESC";

if (isset($_GET['xuly_don'])) {
  $trangThaiDHnew = $_GET['TrangThaiDHnew'];
  $maDHxuly = $_GET['MaDHxuly'];

  $sqlXuly = "UPDATE `dathang` SET `TrangThaiDH`='$trangThaiDHnew' WHERE MaDH='$maDHxuly'";
  mysqli_query($conn, $sqlXuly);
  $_SESSION['mess'] = "Trạng thái đơn hàng $maDHxuly -> $trangThaiDHnew";
}


$result = mysqli_query($conn, $sql);
?>

<script src="bootstrap/jquery-3.5.1.min.js"></script>
<script>
  $(document).ready(function() {
    $(".chitiet-dathang").click(function() {
      var MaDH = $(this).attr("MaDH");

      $.post("donhang.php", {
          MaDH: MaDH,
          chitiet_donhang: true
        }, function(data) {
          $("#content").html(data);
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

    $("#form-search").click(function(e) {
      e.preventDefault();

      var key = $("#search").val();

      $.get("donhang.php", {
        key: key,
        search: true
      }, function(data) {
        $("#content").html(data);
      }); 
    });

    $(".xuly-don").click(function(e) {
      e.preventDefault();

      var TrangThaiDHnew = $(this).attr("TrangThaiDHnew");
      var MaDHxuly      = $(this).attr("MaDH");

      $.get("donhang.php", {
        TrangThaiDHnew: TrangThaiDHnew,
        MaDHxuly: MaDHxuly,
        xuly_don: true
      }, function(data) {
        $("#content").html(data);
      });
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
<div class="row">
  <div class="col">
    <div class="list-personnel">
      <div class="row">
        <span class="list-personnel__title"> Danh sách đơn hàng </span>
      </div>
      <div class="row align-items-center justify-content-end">
        <div class="col-3">
          <form action="">
            <input type="date" name="" id="search" class="form-date" min="1970-01-01" max="<?php echo $today ?>" />
            <button type="submit" class="form-filer" id="form-search">
              <i class="fas fa-filter"></i>
            </button>
          </form>
        </div>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Mã đơn</th>
            <th scope="col">Tên khách hàng</th>
            <th scope="col">Lời nhắn</th>
            <th scope="col">Ngày đặt hàng</th>
            <th scope="col">Ngày giao</th>
            <th scope="col">Trạng thái đơn</th>
            <th scope="col">Chi tiết</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($result as $key) : ?>
            <tr>
              <th scope="row"><?php echo $key['MaDH'] ?></th>
              <td><?php echo $key['HoTenKH'] ?></td>
              <td><?php echo $key['LoiNhan'] ?></td>
              <td><?php echo $key['NgayDH'] ?></td>
              <td>
                <?php
                  if ($key['NgayGH']=="0000-00-00 00:00:00")
                  echo "Chưa giao hàng";
                  else echo $key['NgayGH'];
                 ?>
              </td>
              <td><?php echo $key['TrangThaiDH'] ?></td>
              <td>
                <span class="chitiet-dathang" MaDH="<?php echo $key['MaDH'] ?>">
                  <i class="fas fa-ellipsis-h form-icon"></i>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="form-layout"></div>

<?php
if (isset($_POST['chitiet_donhang']) && isset($_POST['MaDH'])) {
  $sum = 0;
  $MaDH = $_POST['MaDH'];

  //table dienthoai:      MaDT,TenDT,GiaGoc,GiaKhuyenMai,TrangThaiKM,TenTTKM,MoTa,SoLuong,DaBan,MaHang
  //table dathang:        MaDH,MaKH,LoiNhan,NgayDH,NgayGH,TrangThaiDH
  //table chitietdathang: MaDHChiTiet,MaDH,MaDT,SoLuong,GiaDonHang
  //table khachhang:      MaKH,HoTenKH,SoDienThoai,Email,Username,Password
  //table diachikh:       MaDC,DiaChi,MaKH

  // Lấy thông tin đơn hàng
  $sqlChiTiet = "SELECT * FROM `dathang`,`khachhang`,`diachikh`
  WHERE `dathang`.MaKH=`khachhang`.MaKH AND `khachhang`.MaKH=`diachikh`.MaKH AND `dathang`.MaDH='$MaDH'";

  $temp = mysqli_query($conn, $sqlChiTiet);
  $resultChiTiet = mysqli_fetch_array($temp);

  //Lấy thông tin chi tiết đơn hàng
  $sqlChiTietDH = "SELECT * FROM `dienthoai`,`chitietdathang` WHERE `dienthoai`.MaDT=`chitietdathang`.MaDT AND `chitietdathang`.MaDH='$MaDH'";

  $resultChiTietDH = mysqli_query($conn, $sqlChiTietDH);
?>

  <!-- Form chi tiết đơn hàng -->
  <div class="form form-edit">
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
            <li><b>- Họ tên khách hàng: </b><?php echo $resultChiTiet['HoTenKH'] ?></li>
            <li><b>- Số điện thoai: </b><?php echo $resultChiTiet['SoDienThoai'] ?></li>
            <li><b>- Email: </b><?php echo $resultChiTiet['Email'] ?></li>
            <li><b>- Địa chỉ: </b><?php echo $resultChiTiet['DiaChi'] ?></li>
          </div>
        </div>
      </div>
      <div class="row ">
        <div class="col list-personnel">
          <div class="row list-product">          
            <div class="col">
              <?php foreach ($resultChiTietDH as $key) : ?>
                <div class="row justify-content-between">
                  <div class="col-5">
                    <span class="row order-detail__list-product--title"><?php echo $key['TenDT'] ?></span>
                  </div>
                  <div class="col-2">
                    <span class="order-detail__list-product--quantity">x<?php echo $key['SoLuong'] ?></span>
                  </div>
                  <div class="col-5">
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
        <span type="button" class="col icon-add xuly-don" MaDH="<?php echo $MaDH ?>" TrangThaiDHnew="Chờ xác nhận">
            <i class="fas">Khôi phục trạng thái đơn hàng</i>
        </span>
        <!-- Xác nhận đơn -->
        <?php if ($resultChiTiet['TrangThaiDH'] == "Chờ xác nhận") : ?>
          <span type="button" class="col icon-add xuly-don" MaDH="<?php echo $MaDH ?>" TrangThaiDHnew="Đang đóng gói">
            <i class="fas">Duyệt đơn</i>
          </span>
        <?php endif; ?>
        <!-- Giao đơn -->
        <?php if ($resultChiTiet['TrangThaiDH'] == "Đang đóng gói") : ?>
          <span type="button" class="col icon-add xuly-don" MaDH="<?php echo $MaDH ?>" TrangThaiDHnew="Đang giao">
            <i class="fas">Giao hàng</i>
          </span>
        <?php endif; ?>
        <!-- Hủy đơn -->
        <?php if ($resultChiTiet['TrangThaiDH'] == "Đang giao") : ?>
          <span type="button" class="col icon-add xuly-don" MaDH="<?php echo $MaDH ?>" TrangThaiDHnew="Đã hủy">
            <i class="fas">Hủy đơn</i>
          </span>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php } ?>