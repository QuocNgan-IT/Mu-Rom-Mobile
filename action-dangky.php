<?php
include("./config.php");
include("./ham.php");
session_start();

if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $cfmPassword = $_POST['confirmPassword'];
  $fullname = $_POST['fullname'];

  $name = explode(' ', $_POST['fullname']);
  $name = array_pop($name);

  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

//   echo "username = " . $username . "<br>";
//   echo "password = " . $password . "<br>";
//   echo "cfmPass = " . $cfmPassword . "<br>";
//   echo "fullname = " . $fullname . "<br>";
//   echo "email = " . $email . "<br>";
//   echo "phone = " . $phone . "<br>";
//   echo "address = " . $address . "<br>";

  $checkUsername = $mysqli->query("SELECT * from khachhang where username='$username'");
  if (mysqli_num_rows($checkUsername)==0) {
      if ($password==$cfmPassword) {
          $checkEmail = $mysqli->query("SELECT * from khachhang where email='$email'");
          if (mysqli_num_rows($checkEmail)==0) {
              $checkPhone = $mysqli->query("SELECT * from khachhang where sodienthoai='$phone'");
              if (mysqli_num_rows($checkPhone)==0) {
                  //Table khachhang: maKH,tenKH,hotenKH,sodienthoai,email,AnhDaiDien,username,password
                  $sqlAddUser = "INSERT into khachhang value(null,'$name','$fullname','$phone','$email',null,'$username','$password')";
                  $mysqli->query($sqlAddUser);

                  //Table diachikh: madc,diachi,macdinh,makh
                  $lastUser = $mysqli->query("SELECT MaKH from khachhang order by MaKH desc limit 1")->fetch_array();
                  $mysqli->query("INSERT into diachikh value(null,'$address',1,'$lastUser[0]')");

                  NotificationAndGoto("Đăng ký thành công, mời đăng nhập!","dangnhap.php");

              } else NotificationAndGoback("Số điện thoại đã tồn tại!");
          } else NotificationAndGoback("Email đã tồn tại!");
      } else NotificationAndGoback("Mật khẩu không trùng khớp!");      
  } else NotificationAndGoback("Tên đăng nhập đã tồn tại!");
} else NotificationAndGoback("Không thể đăng ký!");