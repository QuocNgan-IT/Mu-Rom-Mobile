<?php
    include("/xampp/htdocs/MuRomMobile/ket_noi.php");
    include("/xampp/htdocs/MuRomMobile/ham.php");
    include("/xampp/htdocs/MuRomMobile/temp.php");

    if( isset($_POST['login']) ) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        //Dùng like để so sánh tên tài khoản không phân biệt hoa thường
        $sql = "select *
                from khachhang
                where Username like '$username' and Password='$password'";
        $sql_1 = $conn->query($sql);

        if( $sql_2=$sql_1->fetch_array() ) {
            $_SESSION['xac_dinh_dang_nhap'] = "co";
            $_SESSION['username'] = $username;
            $_SESSION['ma_KH'] = $sql_2['MaKH'];
            (new SQL)->reloadCartArea();
            NotificationAndGoto("Đăng nhập thành công! Chào mừng ".$username."!", "$SITEURL");
        }
        else {
            NotificationAndGoback("Thông tin nhập vào không đúng !");
        }
    }
?>