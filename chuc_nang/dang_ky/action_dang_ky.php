<?php
    include("/xampp/htdocs/MuRomMobile/ket_noi.php");
    include("/xampp/htdocs/MuRomMobile/ham.php");

    if (isset($_POST['btn_register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cfmPassword = $_POST['confirmPassword'];
        $fullname = $_POST['fullname'];

        $name = explode(' ', $_POST['fullname']);
        $name = array_pop($name);

        $email = $_POST['email'];
        $phone = $_POST['phonenumber'];
        $address = $_POST['address'];

        $checkUsername = $conn->query("select * from khachhang where username='$username'");
        if (mysqli_num_rows($checkUsername)==0) {
            $checkEmail = $conn->query("select * from khachhang where email='$email'");

            if ($password==$cfmPassword) {
                if (mysqli_num_rows($check_email)==0) {
                    $checkPhone = $conn->query("select * from khachhang where sodienthoai='$phone'");

                    if (mysqli_num_rows($checkPhone)==0) {
                        //Table khachhang: maKH,tenKH,hotenKH,sodienthoai,email,username,password
                        $sql_add_user = "insert into khachhang value(null,'$name','$fullname','$phone','$email','$username','$password')";
                        $conn->query($sqlAddUser);

                        //Table diachikh: madc,diachi,makh
                        $lastUser = $conn->query("select MaKH from khachhang order by MaKH desc limit 1")->fetch_array();
                        $conn->query("insert into diachikh value(null,'$address','$lastUser[0]')");

                        NotificationAndGoto("Đăng ký thành công, mời đăng nhập!","../dang_nhap/dang_nhap.php");

                    } else NotificationAndGoback("Số điện thoại đã tồn tại!");
                } else NotificationAndGoback("Email đã tồn tại!");
            } else NotificationAndGoback("Mật khẩu không trùng khớp!");
            
        } else NotificationAndGoback("Tên đăng nhập đã tồn tại!");
    }
?>