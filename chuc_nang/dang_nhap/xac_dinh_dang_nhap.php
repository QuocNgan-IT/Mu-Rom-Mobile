<?php
    include("/xampp/htdocs/MuRomMobile/ket_noi.php");
    include("/xampp/htdocs/MuRomMobile/ham.php");
    include("/xampp/htdocs/MuRomMobile/temp.php");

    if( isset($_POST['login']) ) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        //Dùng like để so sánh tên tài khoản không phân biệt hoa thường
        $sqlCheckLogin = $conn->query("select * from khachhang where Username like'$username' and Password='$password'");

        if( $loginArr=$sqlCheckLogin->fetch_array() ) {
            $_SESSION['xac_dinh_dang_nhap'] = "co";
            $_SESSION['username'] = $username;
            $_SESSION['maKH'] = $loginArr['MaKH'];
            $_SESSION['tenKH'] = $loginArr['TenKH'];
            (new SQL)->reloadCartArea();
            //NotificationAndGoto("Đăng nhập thành công! Chào mừng ".$username."!", "$SITEURL");
            //header("location:$SITEURL");
            reload_parent();
            //reload_self();
        }
        else {
            NotificationAndGoback("Thông tin nhập vào không đúng !");
        }
    }
?>