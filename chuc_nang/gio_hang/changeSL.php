<?php 
    if (isset($_GET['maDTchange'])) {
        $maDTchange = $_GET['maDTchange'];
        $maKH = $_SESSION['maKH'];

        //Table dienthoai: MaDT,TenDT,GiaGoc,GiaKhuyenMai,MoTa,SoLuong,DaBan,MaHang
        //Table giohang: MaKH,MaDT,SoLuongMua
        $sql = "select * from dienthoai,giohang where dienthoai.MaDT=giohang.MaDT and giohang.MaKH='$maKH' and giohang.MaDT='$maDTchange'";
        $sqlResult = $conn->query($sql)->fetch_array();

        $soLuongMua = $sqlResult['SoLuongMua'];
        $hangCon = $sqlResult['SoLuong']-$sqlResult['DaBan'];

        // Event nút giảm
        if (isset($_GET['slGiam'])) {
            if ($soLuongMua <= 1) {
                $_SESSION['err'] = "Số lượng đặt hàng đạt tối thiểu, mời xóa nêu muốn!";
                reload_parent();
            } else {
                $conn->query("update giohang set SoLuongMua=SoLuongMua-1 where MaKH='$maKH' and MaDT='$maDTchange'");
                reload_parent();
            }
        }

        // Event nút tăng
        if (isset($_GET['slTang'])) {
            if ($soLuongMua > $hangCon) {
                $_SESSION['err'] = "Số lượng đặt hàng đạt tối đa!";
                reload_parent();
            } else {
                $conn->query("update giohang set SoLuongMua=SoLuongMua+1 where MaKH='$maKH' and MaDT='$maDTchange'");
                reload_parent();
            }
        }
    }
?>