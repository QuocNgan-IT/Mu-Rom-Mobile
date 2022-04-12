<?php
    include("ket_noi.php");

    $maKH = $_SESSION['ma_KH'];
    //Table dienthoai: MaDT,TenDT,GiaGoc,GiaKhuyenMai,MoTa,SoLuong,DaBan,MaHang
    //Table giohang: MaKH,MaDT,SoLuongMua
    $sql = "select * from dienthoai,giohang where dienthoai.MaDT=giohang.MaDT and giohang.MaKH='$maKH'";
    $renderGioHang = $conn->query($sql)->fetch_array();

    print_r($renderGioHang);