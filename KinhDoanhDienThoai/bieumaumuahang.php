<?php
    include("./config.php");
    include("./ham.php");
    session_start();
    //Đưa thông tin từ tài khoản vào biểu mẫu

    //table dienthoai:      MaDT,TenDT,GiaGoc,GiaKhuyenMai,TrangThaiKM,TenTTKM,MoTa,SoLuong,DaBan,MaHang
    //table dathang:        MaDH,MaKH,LoiNhan,NgayDH,NgayGH,TrangThaiDH
    //table chitietdathang: MaDHChiTiet,MaDH,MaDT,SoLuong,GiaDonHang
    //table khachhang:      MaKH,HoTenKH,SoDienThoai,Email,Username,Password
    //table diachikh:       MaDC,DiaChi,MacDinh,MaKH
    $maKH = $_SESSION['khachhang']['MaKH'];
    $sql_khachhang = $mysqli->query("SELECT * from khachhang where MaKH='$maKH'");
    
    if( mysqli_num_rows($sql_khachhang)!=0 ) {
        $sqlResult = $sql_khachhang->fetch_array(); //Có tồn tại thông tin của khách hàng
        $ten = $sqlResult['HoTenKH'];
        $sdt = $sqlResult['SoDienThoai'];
        $email = $sqlResult['Email'];
    } else {
        $ten = "";
        $sdt = "";
    }
?>
<link rel="stylesheet" type="text/css" href="./css/main.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    // Mua hàng
    $("#muaHang").click(function(e) {
      e.preventDefault();

      const tenNguoiMua   = $("#tenNguoiMua").val();
      const diaChi        = $("#diaChi").val();
      const soDienThoai   = $("#soDienThoai").val();
      const email         = $("#email").val();
      const loiNhan       = $("#loiNhan").val();

      $.post("action-muahang.php", {
        tenNguoiMua: tenNguoiMua,
        diaChi: diaChi,
        soDienThoai: soDienThoai,
        email: email,
        loiNhan: loiNhan,
        muaHang: true
      }, function(data) {
        $("#order-content").html(data);
      });
    });
});
</script>
  <table class="table product-table table-cart-v-2 required">
      <tr>
          <td colspan='2' class=''>
              Thông tin mua hàng
          </td>
      </tr>
      <tr>
          <td style='width: 200px; text-indent: 10px'>
              <label>Tên người mua (</label>): 
          </td>
          <td>
              <input type='text' style='width: 99%' id='tenNguoiMua' value='<?php echo $ten; ?>' required>
          </td>
      </tr>
      <tr>
          <td style='width: 200px; text-indent: 10px'>
              <label>Địa chỉ (</label>): 
          </td>
          <td>
              <?php 
                $sql_diachi = $mysqli->query("SELECT * FROM `diachikh` WHERE MaKH='$maKH' AND MacDinh=1");
                if(mysqli_num_rows($sql_diachi)!=0) :
                  $arr_diachi=$sql_diachi->fetch_array()
              ?>              
              <textarea style='resize: none; width: 99%; height: 100px' id="diaChi" value="<?php $arr_diachi['MaDC'] ?>" required><?php echo $arr_diachi['DiaChi'] ?></textarea>
              <?php endif; ?>
          </td>
      </tr>
      <tr>
          <td style='width: 200px; text-indent: 10px'>
              <label>Số điện thoại (</label>):
          </td>
          <td>
              <input type='text' style='width: 99%' id='soDienThoai' value='<?php echo $sdt; ?>' required>
          </td>
      </tr>
      <tr>
          <td style='width: 200px; text-indent: 10px'>
              Email: 
          </td>
          <td>
              <input type='text' style='width: 99%' id='email' pattern="^[a-zA-Z0-9.]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" value="<?php echo $email; ?>">
          </td>
      </tr>
      <tr>
          <td style='width: 200px; text-indent: 10px'>
              Lời nhắn: 
          </td>
          <td>
              <textarea style='resize: none; width: 99%; height: 200px' id='loiNhan'></textarea>
          </td>
      </tr>
      <tr>             
          <td colspan='2' align='center'>
              <hr>
              <input type='submit' id='muaHang' class='nut_submit' value='Mua hàng'>
          </td>
      </tr>
  </table>