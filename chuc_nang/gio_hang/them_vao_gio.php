<?php
    include("/xampp/htdocs/MuRomMobile/ket_noi.php");
    include("/xampp/htdocs/MuRomMobile/ham.php");
    include("/xampp/htdocs/MuRomMobile/temp.php");

    if (isset($_POST['maDTMua'])) {

        if ($_SESSION['xac_dinh_dang_nhap']=="co") {

            //Thêm vào giỏ của khách hàng đã đăng nhập
            $maKH = $_SESSION['maKH'];
            $maDTMua = $_POST['maDTMua'];
            $soLuongMua = 1;

            $getSoLuong = "select SoLuong,DaBan from dienthoai where MaDT='$maDTMua';";
            $soLuongArr = $conn->query($getSoLuong)->fetch_array();
            $hangCon = $soLuongArr['SoLuong']-$soLuongArr['DaBan'];

            $getGioHang = $conn->query("select * from giohang where maKH='$maKH'");
    
            if (mysqli_num_rows($getGioHang)>0) {
                
                $coTrongGio="";
                while ($gioHangArr=$getGioHang->fetch_array()) {

                    //Nếu sp vừa thêm có trong giỏ hàng
                    if ($gioHangArr['MaDT']==$maDTMua) {
                        $coTrongGio="Yes"; 

                        //Xử lý khi: số lượng mua trong giỏ + số lượng vừa thêm > số hàng còn trong kho
                        if ($gioHangArr['SoLuongMua']+$soLuongMua > $hangCon) {
                            NotificationAndGoback("Bạn đã thêm hết số lượng hàng còn lại của sản phẩm vào giỏ hàng, mời mở giỏ hàng và tiến hành thanh toán !");
                            break;
                        }else {
                            $conn->query("update giohang set SoLuongMua=SoLuongMua+1 where MaKH='$maKH' and MaDT='$maDTMua'");

                            //Refresh vùng giỏ hàng
                            (new SQL)->reloadCartArea();

                            //for dev only: Thông báo loại thêm nào được thực hiện
                            NotificationAndGoback("Đã có trong giỏ, cập nhật!");
                            break;
                        }
                    } 
                }
                //Nếu sp vừa thêm ko có trong giỏ hàng
                if ($coTrongGio!="Yes") {
                    $conn->query("insert into giohang value('$maKH','$maDTMua','$soLuongMua');");
                    (new SQL)->reloadCartArea();

                    //for dev only: Thông báo loại thêm nào được thực hiện
                    NotificationAndGoback("Ko có trong giỏ, thêm mới!");
                }
            }else {
                $conn->query("insert into giohang value('$maKH','$maDTMua','$soLuongMua');");
                (new SQL)->reloadCartArea();

                //for dev only: Thông báo loại thêm nào được thực hiện
                NotificationAndGoback("Chưa có giỏ, tạo giỏ và thêm mới!");
            }
        } else {

            //Nếu khách hàng chưa đăng nhập
            
        }

    }else NotificationAndGoback("Ko thêm được!"); //for dev only: Thông báo loại thêm nào được thực hiện
?>
