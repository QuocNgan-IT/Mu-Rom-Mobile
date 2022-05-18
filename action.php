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
  
    $sqlXuly = "UPDATE `dathang` SET `TrangThaiDH`='$trangThaiDHnew' WHERE MaDH='$maDHxuly'";
    mysqli_query($mysqli, $sqlXuly);
    $_SESSION['mess'] = "Trạng thái đơn hàng $maDHxuly -> $trangThaiDHnew";
  }