<?php
include("./config.php");
include("./autoload.php");
session_start();

if(isset($_GET['mausac']) && isset($_GET['madt'])) {
    $mausac = $_GET['mausac'];
    $madt = $_GET['madt'];
}
else {
    $mausac = "0";
    $madt = "0";
}


    $check02 = "SELECT COUNT(MaGH) ktra FROM giohang WHERE MauSac = $mausac AND MaDT = $madt AND MaKH = 1";
    $query_check02 = mysqli_query($mysqli, $check02);

    if ($mausac != 0) {
        $row_check02 = mysqli_fetch_array($query_check02);

        if ($row_check02['ktra'] == 0) {
            $add_giohang = "INSERT INTO giohang VALUES (null,1,'$madt','$mausac',1)";
            $mysqli->query($add_giohang);
        }
        else {
            echo '<p style="color: red; font-weight: bold">Sản phẩm màu này đã được thêm vào giỏ hàng</p>';
        }
    }
    else {
        echo '<p style="color: red; font-weight: bold">Vui lòng chọn màu sắc</p>';
    }



?>