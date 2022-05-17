<?php
include "connect.php";
session_start();

// Login 
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $test_password_admin = md5($password);
    if ($username == '' || $password == '') {
        header("refresh:0; url= index.php");
    }
    if ($username == 'admin' && $test_password_admin == md5('MuRom123')) {
        $_SESSION['admin'] = true;
        header("refresh:0; url= admin.php");
    } else {
        header("refresh:0; url= index.php");
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
}

// Hang san xuat dien thoai
// // Them hangsx
if (isset($_GET['them_hangsx'])) {
    $name = $_GET['name']; 

    $sql_add = "INSERT INTO `hangsx` (`TenHang`,`anh_hangsx`) VALUES ('$name','null')";
    mysqli_query($conn, $sql_add);

    $_SESSION['mess'] = "Thêm hãng điện thoại thành công";
}

// // Sua hangsx
if (isset($_GET['sua_hangsx']) && isset($_GET['MaHang'])) {
    $name = $_GET['name'];
    $MaHang = $_GET['MaHang'];

    $sql_edit = "UPDATE `hangsx` SET `TenHang`='$name' WHERE `hangsx`.`MaHang`='$MaHang'";
    mysqli_query($conn, $sql_edit);

    $_SESSION['mess'] = "Chỉnh sửa hãng điện thoại thành công";
}

// // Xoa hangsx
if (isset($_GET['xoa_hangsx']) && isset($_GET['MaHang'])) {
    $MaHang = $_GET['MaHang'];

    $sql_delete = "DELETE FROM `hangsx` WHERE `hangsx`.`MaHang` = '$MaHang'";
    mysqli_query($conn, $sql_delete);

    $_SESSION['mess'] = "Xóa hãng điện thoại thành công";
}

// // Xóa điện thoại
if (isset($_GET['xoa_dienthoai']) && isset($_GET['maDT'])) {
    $MaDT = $_GET['maDT'];

    //Xoa hinhanh -> xoa cauhinhdt -> xoa dienthoai
    // // xoa hinhanh
    $sqlGetImage = mysqli_query($conn, "SELECT * FROM `hinhanh` WHERE `hinhanh`.MaDT='$MaDT'");
    while ($getImageArr = mysqli_fetch_array($sqlGetImage)) {
        $path = "../Images/AnhDT/" . $getImageArr['TenHinh'];
        if (file_exists($path)) {
            unlink($path);
        }
    }
    mysqli_query($conn, "DELETE FROM `hinhanh` WHERE `hinhanh`.MaDT='$MaDT'");

    // // xoa cauhinhdt
    mysqli_query($conn, "DELETE FROM `cauhinhdt` WHERE `cauhinhdt`.MaDT='$MaDT'");

    // // xoa uudiemdt
    mysqli_query($conn, "DELETE FROM `uudiemdt` WHERE `uudiemdt`.MaDT='$MaDT'");

    // // xoa dienthoai
    mysqli_query($conn, "DELETE FROM `dienthoai` WHERE `dienthoai`.MaDT='$MaDT'");

    $_SESSION['mess'] = "Xóa sản phẩm thành công";
}