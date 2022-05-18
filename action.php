<?php
include("./config.php");
session_start();

// Xử lý thêm comment
if (isset($_POST['them_comment'])) {
    $comment = $_POST['comment'];
    $maKH = $_SESSION['khachhang']['MaKH'];
    $MaDT = $_POST['MaDT'];

    $mysqli->query("INSERT INTO `comment`(`MaBL`, `NoiDung`, `MaKH`, `MaDT`) VALUES (null,'$comment','$maKH','$MaDT')");
}

// Xử lý đơn hàng - khách hàng
if (isset($_GET['xuly_don'])) {
    $trangThaiDHnew = $_GET['TrangThaiDHnew'];
    $maDHxuly = $_GET['MaDHxuly']; 

    if ($trangThaiDHnew == "Đã nhận hàng") {
        $maKH = $_SESSION['khachhang']['MaKH'];

        $getSLmua = $mysqli->query("SELECT * FROM `dathang`,`chitietdathang` WHERE `dathang`.MaDH=`chitietdathang`.MaDH AND `dathang`.MaKH='$maKH'");
        while ($arrSLmua=$getSLmua->fetch_array()) {
            $maDT = $arrSLmua['MaDT'];
            $SLmua = $arrSLmua['SoLuong'];

            $mysqli->query("UPDATE `dienthoai` SET `DaBan`='$SLmua' WHERE MaDT='$maDT'");
        }
    }
  
    $sqlXuly = "UPDATE `dathang` SET `TrangThaiDH`='$trangThaiDHnew' WHERE MaDH='$maDHxuly'";
    mysqli_query($mysqli, $sqlXuly);
    $_SESSION['mess'] = "Trạng thái đơn hàng $maDHxuly -> $trangThaiDHnew";
  }