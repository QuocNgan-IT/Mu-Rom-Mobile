<?php
    include("./xac_dinh_dang_nhap.php");

    //Nếu đã đăng nhập thì khi load trang đăng nhập -> trang đăng nhập tự đóng
    // if (isset($_SESSION['xac_dinh_dang_nhap']) and $_SESSION['xac_dinh_dang_nhap'] == "co") {
    //   header("location:../../index.php");
    // }
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Login - Mũ Rơm Mobile</title>
        <link rel="stylesheet" type="text/css" href="../../giao_dien/giao_dien.css">
    </head>

    <body>
        <!-- Header -->
        <table style="width: 100%; height: 50px; background: #B51E1E; text-align: center; font-size: 35px; color: white;">
            <tr>
                <td width="50px">
                    <img src="../../hinh_anh/banner/icon.png">
                </td>
                <td align="left">
                    <a href=" <?php echo $SITEURL.'index.php'; ?> ">
                        <div style="font-family: Reem Kufi; color: white;">Mũ Rơm Mobile</div>
                    </a>
                </td>
                <td>
                    <?php include("../tim_kiem/thanh_tim_kiem.php"); ?>
                </td>
                <td align="right" width="50px">
                    <?php
                        if (isset($_SESSION['xac_dinh_dang_nhap']) and $_SESSION['xac_dinh_dang_nhap']=="co") {
                            echo $_SESSION['username'];
                        } else {
                            echo "<input type=button onClick=window.open('../dang_ky/dang_ky.php'); value='Đăng ký'>";
                        }
                    ?>
                </td>
            </tr>
        </table>

        <form method="POST">
            <table width="100%" height="auto"
                style="width: 100%; height: 50px; background: #F0C8C8; text-align: center; font-size: 35px; color: white;">
                <tr>
                    <td width="50%" rowspan="5">
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
                                    <div style="font-family: Reem Kufi; color: #B51E1E;">Đăng Nhập</div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="width: 100%;" type="text" name="username" placeholder="Nhập tên tài khoản">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input style="width: 100%;" type="password" name="password" placeholder="Nhập mật khẩu">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <input type="hidden" name="login" value="login">
                                    <input type="submit" style="background: #B51E1E; color: white;" value="Đăng nhập">
                                    <div align="right"><a href="" target="_blank">Quên mật khẩu</a></div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <!-- <div>Bạn lần đầu đến với Mũ Rơm Mobile?<br><a href="" onClick="window.open('../dang_ky/dang_ky.php'); self.close();">Đăng ký</a></div> -->
                                    <div>Bạn lần đầu đến với Mũ Rơm Mobile?<br><a href="../dang_ky/dang_ky.php" target="_blank">Đăng ký</a></div>
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