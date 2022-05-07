<?php
    if (isset($_POST['muaHang'])) {

        $tongGiaTri = $_SESSION['tongTien'];
        $soSPMua = $_SESSION['soSPMua'];        //Nếu code lỗi thì dùng đếm số sp trong giỏ hàng để thay thế

        //render tên KH
        $maKH = $_SESSION['maKH'];
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

        if ($tenNguoiMua!="" and $diaChi!="" and $soDienThoai!="") {

        //Cập nhật lại thông tin khách hàng, nếu có thay đổi
            //Table khachhang: maKH,tenKH,hotenKH,sodienthoai,email,username,password
            $conn->query("update khachhang set tenKH='$tenNguoiMua',hotenKH='$hoTenNguoiMua',sodienthoai='$soDienThoai',email='$email' where maKH='$maKH'");

            //Table diachikh: MaDC,DiaChi,MaKH
            $conn->query("update diachikh set DiaChi='$diaChi' where maKH='$maKH'");

        //Tạo đơn hàng
            $ngayDH = date('Y-m-d');

            //Table dathang: MaDH,MaKH,LoiNhan,TongGiaTri,NgayDH,NgayGH,TrangThaiDH
            $conn->query("insert into dathang(MaDH,MaKH,LoiNhan,TongGiaTri,NgayDH,TrangThaiDH) value(null,'$maKH','$loiNhan','$tongGiaTri','$ngayDH','Chờ xác nhận');");

            //Table chitietdathang: MaDHChiTiet,MaDH,MaDT,SoLuong,GiaDonHang
                //Lấy mã DH vừa thêm
                $sql = $conn->query("select MaDH from dathang order by MaDH desc limit 1;")->fetch_array();
                $maDH = $sql[0];

            //Table giohang: MaKH,MaDT,SoLuongMua
            $gioHang = $conn->query("select * from giohang where MaKH='$maKH';");
            $i = 0;
            while ($gioHangArr=$gioHang->fetch_array()) {
                $maDT = $gioHangArr['MaDT'];
                $soLuong = $gioHangArr['SoLuongMua'];
                $giaDH = $_SESSION['giaDH'][$i];

                $conn->query("insert into chitietdathang value(null,'$maDH','$maDT','$soLuong','$giaDH');");
                $i++;
            }

            //Làm sạch giỏ hàng sau khi đặt hàng
            $conn->query("delete from giohang where MaKH='$maKH'");
            //Refresh phần vùng giỏ hàng
            (new SQL)->reloadCartArea();
            //Thông báo mua hàng thành công
            NotificationAndGoback("Đặt hàng thành công!");
        } else {
            Notification("Trường có dấu * là bắt buộc!");
        }
    }
?>