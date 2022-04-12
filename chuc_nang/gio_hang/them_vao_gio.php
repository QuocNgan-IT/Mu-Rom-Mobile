<?php
    include("/xampp/htdocs/MuRomMobile/ket_noi.php");
    include("/xampp/htdocs/MuRomMobile/ham.php");
    include("/xampp/htdocs/MuRomMobile/temp.php");

    if (isset($_POST['MaDT_mua'])) {
        $maKH = $_SESSION['ma_KH'];
        $maDT_mua = $_POST['MaDT_mua'];
        $soLuongMua = 1;

        $getSoLuong = "select SoLuong, DaBan
                    from dienthoai
                    where MaDT='$maDT_mua';";
            $arrSoLuong = $conn->query($getSoLuong)->fetch_array();
            $hangCon = $arrSoLuong['SoLuong'] - $arrSoLuong['DaBan'];

        $getGioHang = $conn->query("select * from giohang where maKH='$maKH'");
 
        if (mysqli_num_rows($getGioHang)>0) {
            
            $coTrongGio="";
            while ($arrGioHang=$getGioHang->fetch_array()) {

                //Nếu sp vừa thêm có trong giỏ hàng
                if ($arrGioHang['MaDT']==$maDT_mua) {
                    $coTrongGio="Yes";

                    //Xử lý khi: số lượng mua trong giỏ + số lượng vừa thêm > số hàng còn trong kho
                    if ($arrGioHang['SoLuongMua']+$soLuongMua > $hangCon) {
                        NotificationAndGoback("Bạn đã thêm hết số lượng hàng còn lại của sản phẩm vào giỏ hàng, mời mở giỏ hàng và tiến hành thanh toán !");
                        break;
                    }else {
                        $conn->query("update giohang set SoLuongMua=SoLuongMua+1 where MaKH='$maKH' and MaDT='$maDT_mua'");
                        (new SQL)->reloadCartArea();

                        //for dev only: Thông báo loại thêm nào được thực hiện
                        NotificationAndGoback("Đã có trong giỏ, cập nhật!");
                        break;
                    }
                } 
            }
            //Nếu sp vừa thêm ko có trong giỏ hàng
            if ($coTrongGio!="Yes") {
                $conn->query("insert into giohang value('$maKH','$maDT_mua','$soLuongMua');");
                (new SQL)->reloadCartArea();

                //for dev only: Thông báo loại thêm nào được thực hiện
                NotificationAndGoback("Ko có trong giỏ, thêm mới!");
            }
        }else {
            $conn->query("insert into giohang value('$maKH','$maDT_mua','$soLuongMua');");
            (new SQL)->reloadCartArea();

            //for dev only: Thông báo loại thêm nào được thực hiện
            NotificationAndGoback("Chưa có giỏ, tạo giỏ và thêm mới!");
        }
    }else NotificationAndGoback("Ko thêm được!"); //for dev only: Thông báo loại thêm nào được thực hiện
?>
