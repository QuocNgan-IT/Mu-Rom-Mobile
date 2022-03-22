<?php
include("/xampp/htdocs/MuRomMobile/ket_noi.php");
include("/xampp/htdocs/MuRomMobile/ham.php");

//Nếu đã đăng nhập thì khi load trang đăng ký -> trang đăng ký tự đóng
if (isset($_SESSION['xac_dinh_dang_nhap']) and $_SESSION['xac_dinh_dang_nhap'] == "co") {
  echo "<script>self.close()</script>";
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Register - Mũ Rơm Mobile</title>
    <link rel="stylesheet" type="text/css" href="../../giao_dien/giao_dien.css">

    <script>
    //Check password == confirm_password != null
    var check = function() {
        var pass = document.getElementById('password').value
        var cf_pass = document.getElementById('confirm_password').value
        var regex = /([a-zA-Z])[a-zA-Z0-9]{5,}/

        if ( pass == cf_pass && pass != '' && pass.match(regex) ) {
            document.getElementById('confirm_password').style.backgroundColor = '#00ff0080';
            // document.getElementById('message').innerHTML = 'matching';
        } else {
            document.getElementById('confirm_password').style.backgroundColor = '#ff000080';
            // document.getElementById('message').innerHTML = 'not matching';
        }
    }
    </script>
</head>

<body>
    <!-- Header -->
    <table style="width: 100%; height: 50px; background: #B51E1E; text-align: center; font-size: 35px; color: white;">
        <tr>
            <td width="50px">
                <img src="../../hinh_anh/banner/icon.png">
            </td>
            <td align="left">
                <a href=" <?php echo $SITEURL . 'index.php'; ?> ">
                    <div style="font-family: Reem Kufi; color: white;">Mũ Rơm Mobile</div>
                </a>
            </td>
            <td>
                <?php include("../tim_kiem/thanh_tim_kiem.php"); ?>
            </td>
            <td align="right">
                <?php
        // include("chuc_nang/tim_kiem/vung_tim_kiem.php");
        if (!isset($_SESSION['xac_dinh_dang_nhap']) or $_SESSION['xac_dinh_dang_nhap'] == "khong") {
          echo "<input type=button onClick=window.open('../dang_nhap/dang_nhap.php'); value='Đăng nhập'>";
          //include("chuc_nang/dang_nhap/dang_nhap.php");
        } else {
          if ($_SESSION['xac_dinh_dang_nhap'] == "co") {
            echo "<input type=button onClick=window.open('../dang_nhap/dang_xuat.php'); value='Đăng xuất'>";
          }
        }
        ?>
            </td>
        </tr>
    </table>

    <form name="Form" method="" action="">
        <table width="100%" height="auto"
            style="width: 100%; height: 50px; background: #F0C8C8; text-align: center; font-size: 35px; color: white;">
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
                                <input style="width: 100%;" type="text" name="username" placeholder="Nhập tên tài khoản"
                                    pattern="^([a-zA-Z])[a-zA-Z0-9]{5,}"
                                    title="Tối thiểu 5 ký tự từ a-Z và 0-9, ký tự đầu tiên không phải số" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input style="width: 100%;" type="password" id="password" name="password"
                                    placeholder="Nhập mật khẩu" title="Tối thiểu 5 ký tự từ a-Z và 0-9, ký tự đầu tiên không phải số" onkeyup='check();' required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input style="width: 100%;" type="password" id="confirm_password"
                                    name="confirm_password" placeholder="Nhập lại mật khẩu" onkeyup='check();' required>
                                <!-- <br>
                    <span id='message'>Check</span> -->
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input style="width: 100%;" type="text" name="fullname" placeholder="Nhập họ và tên"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input style="width: 100%;" type="email" name="email" placeholder="Nhập địa chỉ email"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input style="width: 100%;" type="text" name="phonenumber"
                                    placeholder="Nhập số điện thoại" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input style="width: 100%;" type="text" name="address" placeholder="Nhập địa chỉ"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input type="hidden" name="register" value="register">
                                <input type="submit" name="btn_register" style="background: #B51E1E; color: white;"
                                    value="Đăng ký">
                                <br>
                                <p id="return"></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <!-- <div>Bạn đã có tài khoản tại Mũ Rơm Mobile?<br><a href="" onClick="window.open('../dang_nhap/dang_nhap.php'); self.close();">Đăng nhập</a></div> -->
                                <div>Bạn đã có tài khoản tại Mũ Rơm Mobile?<br><a href="../dang_nhap/dang_nhap.php"
                                        target="_blank">Đăng nhập</a></div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
</body>

<footer>
    <div style="width: 100%; height: 50px; background: #B51E1E; text-align: center; font-size: 35px; color: white;">©
        2022. Địa chỉ: Đường 3/2, phường Xuân Khánh, quận Ninh Kiều, thành phố Cần Thơ</div>
</footer>

</html>