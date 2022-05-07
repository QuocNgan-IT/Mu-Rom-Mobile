<?php    
    include("ket_noi.php");
    include("chuc_nang/dang_nhap/xac_dinh_dang_nhap.php");
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mũ Rơm Mobile</title>
    <link rel="stylesheet" type="text/css" href="giao_dien/giao_dien.css">
</head>

<body>
    <!-- Header -->
    <table style="width: 100%; height: 50px; background: #B51E1E; text-align: center; font-size: 35px; color: white;">
        <tr>
            <td width="50px">
                <img src="./hinh_anh/banner/icon.png">
            </td>
            <td align="left">
                <a href=" <?php echo $SITEURL.'index.php'; ?> ">
                    <div style="font-family: Reem Kufi; color: white;">Mũ Rơm Mobile</div>
                </a>
            </td>
            <td>
                <?php include("chuc_nang/tim_kiem/thanh_tim_kiem.php"); ?>
            </td>
            <td align="right">
                <?php
                    if( !isset($_SESSION['xac_dinh_dang_nhap']) or $_SESSION['xac_dinh_dang_nhap']=="khong" ) {
                        //echo "<input type=button onClick=window.open('chuc_nang/dang_nhap/dang_nhap.php','_blank','toolbar=yes,scrollbars=yes,resizable=no,location=no,top=100,left=500,width=500,height=600'); value='Đăng nhập'>";
                        echo "<input type=button onClick=window.open('chuc_nang/dang_nhap/dang_nhap.php'); value='Đăng nhập'>";
                    }
                    else {
                        if( $_SESSION['xac_dinh_dang_nhap']=="co" ) {
                            echo "<input type=button onClick=window.open('chuc_nang/dang_nhap/dang_xuat.php'); value='Đăng xuất'>";
                        }
                    }                         
                ?>
            </td>
            <td align="right" width="50px">
                <?php
                    if( isset($_SESSION['xac_dinh_dang_nhap']) and $_SESSION['xac_dinh_dang_nhap']=="co" ) {
                        echo $_SESSION['tenKH'];
                        include("chuc_nang/gio_hang/vung_gio_hang.php");
                    }
                    else {
                        echo "<input type=button onClick=window.open('./chuc_nang/dang_ky/dang_ky.php'); value='Đăng ký'>";
                    }                         
                ?>
            </td>
        </tr>
    </table>

    <!-- Main -->
    <table width="100%" height="auto">
        <tr>
            <td colspan="3">
                <?php
                        //include("chuc_nang/banner/banner.php");
                    //    include("san_pham/xuat_toan_bo_san_pham.php");
                    ?>
            </td>
        </tr>
        <tr>
            <td colspan="3"">
                    <?php
                        //include("chuc_nang/menu/menu.php");
                    ?>
                </td>
            </tr>
            <tr>
                <td width=" 10%" valign="top">
                <?php
                        //include("chuc_nang/danh_muc/danh_muc_san_pham.php");
                        //include("chuc_nang/san_pham/san_pham_moi.php");
                    ?>
            </td>
            <td width="auto" valign="top">
                <?php
                    include("chuc_nang/router.php");
                ?>
            </td>
            <td width="10%" valign="top">

            </td>
        </tr>
    </table>
</body>

<footer>
    <div style="width: 100%; height: 50px; background: #B51E1E; text-align: center; font-size: 35px; color: white;">©
        2022. Địa chỉ: Đường 3/2, phường Xuân Khánh, quận Ninh Kiều, thành phố Cần Thơ</div>
</footer>

</html>