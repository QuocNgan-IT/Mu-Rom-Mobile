<?php
include("./config.php");
include("./ham.php");
session_start(); 

if (isset($_POST['muaHang'])) {
    //render tên KH
    $maKH = $_SESSION['khachhang']['MaKH'];
    $hoTenNguoiMua = $_POST['tenNguoiMua'];
    $tenNguoiMua = explode(' ', $hoTenNguoiMua);
    $tenNguoiMua = array_pop($tenNguoiMua);

    //render địa chỉ,sdt KH
    $diaChi = $_POST['diaChi'];
    $soDienThoai = $_POST['soDienThoai'];

    //check and render email, lời nhắn
    if (isset($_POST['email'])) $email = $_POST['email']; 
    else $email = ""; 
    if (isset($_POST['loiNhan'])) $loiNhan = $_POST['loiNhan']; 
    else $loiNhan = ""; 
    
    $checkGioHang = $mysqli->query("SELECT * FROM giohang WHERE MaKH='$maKH'");   
    if (mysqli_num_rows($checkGioHang) == 0) NotificationAndGoto("Giỏ hàng trống!","index.php?route=giohang");
    else {
        if ($tenNguoiMua!="" and $diaChi!="" and $soDienThoai!="") {
            //Tạo đơn hàng
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $ngayDH = date('Y-m-d H:i:s');
            $ngayGH = date('Y-m-d H:i:s', strtotime($ngayDH. ' + 4 days'));

            $mysqli->query("INSERT into dathang(MaKH,LoiNhan,NgayDH,NgayGH,TrangThaiDH) value('$maKH','$loiNhan','$ngayDH','$ngayGH','Chờ xác nhận');");

            //Table chitietdathang: MaDHChiTiet,MaDH,MaDT,SoLuong,GiaDonHang
                //Lấy mã DH vừa thêm
                $sql = $mysqli->query("SELECT MaDH from dathang order by MaDH desc limit 1;")->fetch_array();
                $maDH = $sql[0];

            //Table giohang: MaKH,MaDT,MauSac,SoLuongMua
            $gioHang = $mysqli->query("SELECT * FROM giohang, dienthoai WHERE giohang.MaDT=dienthoai.MaDT AND giohang.MaKH='$maKH'");
            $i = 0;
            while ($gioHangArr=$gioHang->fetch_array()) {
                $maDT = $gioHangArr['MaDT'];
                $mauSac = $gioHangArr['MauSac'];
                $soLuong = $gioHangArr['SoLuongMua'];
                $giaDH = $gioHangArr['GiaKhuyenMai']*$soLuong;

                $mysqli->query("INSERT into chitietdathang value(null,'$maDH','$maDT','$mauSac','$soLuong','$giaDH');");
                $i++;
            }

            //Làm sạch giỏ hàng sau khi đặt hàng
            $mysqli->query("DELETE from giohang where MaKH='$maKH'");
            //Thông báo mua hàng thành công
            NotificationAndGoto("Đặt hàng thành công!","trangcanhan.php");
        } else {
            Notification("Trường có dấu * là bắt buộc!");
        }
    }  
}