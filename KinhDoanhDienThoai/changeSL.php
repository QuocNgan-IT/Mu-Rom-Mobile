<?php 
include("./config.php");

    if (isset($_GET['maGH'])) {
        $maGHchange = $_GET['maGH'];

        $sql = "SELECT * from dienthoai,giohang where dienthoai.MaDT=giohang.MaDT and giohang.MaGH='$maGHchange'";
        $sqlResult = $mysqli->query($sql)->fetch_array();

        $soLuongMua = $sqlResult['SoLuongMua'];
        $hangCon = $sqlResult['SoLuong']-$sqlResult['DaBan'];
        // Event nút giảm
        if (isset($_GET['giamSL'])) {
            if ($soLuongMua <= 1) {
                $_SESSION['err'] = "Số lượng đặt hàng đạt tối thiểu, mời xóa nêu muốn!";
            } else {
                $mysqli->query("UPDATE giohang set SoLuongMua=SoLuongMua-1 where giohang.MaGH='$maDTchange'");
            }
        }
        // Event nút tăng
        if (isset($_GET['slTang'])) {
            if ($soLuongMua > $hangCon) {
                $_SESSION['err'] = "Số lượng đặt hàng đạt tối đa!";
            } else {
                $mysqli->query("UPDATE giohang set SoLuongMua=SoLuongMua+1 where giohang.MaGH='$maDTchange'");
            }
        }
    }
?>