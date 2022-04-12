<?php
  include("ket_noi.php");
  include("ham.php");

  //Nếu đã đăng nhập thì khi load trang đăng ký -> trang đăng ký tự đóng
  if( isset($_SESSION['xac_dinh_dang_nhap']) and $_SESSION['xac_dinh_dang_nhap']=="co" ) {
    echo "<script>self.close()</script>";
  }
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Register - Mũ Rơm Mobile</title>
        <link rel="stylesheet" type="text/css" href="../../giao_dien/giao_dien.css">

        <table style="width: 100%; height: 50px; background: #B51E1E; text-align: center; font-size: 35px; color: white;">
          <tr>
            <td width="50px">
              <img src="../../hinh_anh/banner/icon.png">
            </td>
            <td align="left">
              <div style="font-family: Reem Kufi;">Mũ Rơm Mobile</div>
            </td>
            <td align="right" width="150px">
              <?php
                  // include("chuc_nang/tim_kiem/vung_tim_kiem.php");
                  if( !isset($_SESSION['xac_dinh_dang_nhap']) or $_SESSION['xac_dinh_dang_nhap']=="khong" ) {
                      echo "<input type=button onClick=window.open('./chuc_nang/dang_nhap/dang_nhap.php'); value='Đăng nhập'>";
                      //include("chuc_nang/dang_nhap/dang_nhap.php");
                  }
                  else {
                      if( $_SESSION['xac_dinh_dang_nhap']=="co" ) {
                          //include("chuc_nang/gio_hang/vung_gio_hang.php");  
                          echo "<input type=button onClick=window.open('./chuc_nang/dang_nhap/dang_xuat.php'); value='Đăng xuất'>";
                      }
                  }                         
                ?>
            </td>
          </tr>
        </table>    
    </head>

    <body>
      <form name="Form" method="POST" action="">
        <table width="100%" height="auto" style="width: 100%; height: 50px; background: #F0C8C8; text-align: center; font-size: 35px; color: white;">
          <tr>
            <td width="50%" rowspan="10">
              <img src="../../hinh_anh/banner/large-icon.png">
              <div style="font-family: Reem Kufi; color: #B51E1E;">Chào mừng đến với Mũ Rơm Mobile</div><br>
            </td>
            <td>
              <table width="80%" height="90%" style="background: white;">
                <tr>
                  <td width="40%" align="right">
                    <img src="../../hinh_anh/banner/defaut-avatar.png">
                  </td>
                  <td align="left">
                  <div style="font-family: Reem Kufi; color: #B51E1E;">Đăng Ký</div>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <input style="width: 100%;" type="text" name="uname" placeholder="Nhập tên tài khoản" required>
                  </td>
                </tr>
                <tr>
                  <td colspan="2"> 
                    <input style="width: 100%;" type="password" name="passwd" placeholder="Nhập mật khẩu" required>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <input style="width: 100%;" type="password" name="repasswd" placeholder="Nhập lại mật khẩu" required>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <input style="width: 100%;" type="text" name="fullname" placeholder="Nhập họ và tên" required>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <input style="width: 100%;" type="email" name="em" placeholder="Nhập địa chỉ email" required>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <input style="width: 100%;" type="text" name="phonenumber" placeholder="Nhập số điện thoại" required>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <input style="width: 100%;" type="text" name="address" placeholder="Nhập địa chỉ" required>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" align="center">
                    <input type="hidden" name="login" value="login">
                    <input type="submit" name="btn_login" style="background: #B51E1E; color: white;" value="Đăng ký">
                    <br>
                  </td>                  
                </tr>
                <tr>
                  <td colspan="2" align="center">
                    <!-- <div>Bạn đã có tài khoản tại Mũ Rơm Mobile?<br><a href="" onClick="window.open('../dang_nhap/dang_nhap.php'); self.close();">Đăng nhập</a></div> -->
                    <div>Bạn đã có tài khoản tại Mũ Rơm Mobile?<br><a href="../dang_nhap/dang_nhap.php" target="_blank">Đăng nhập</a></div>
                  </td>                  
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <script src="check.js"></script>
      </form>
    </body>

    <footer>
        <div style="width: 100%; height: 50px; background: #B51E1E; text-align: center; font-size: 35px; color: white;">© 2022. Địa chỉ: Đường 3/2, phường Xuân Khánh, quận Ninh Kiều, thành phố Cần Thơ</div>
    </footer>
</html>