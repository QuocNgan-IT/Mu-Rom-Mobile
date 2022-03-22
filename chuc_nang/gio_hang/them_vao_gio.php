<?php
if (!isset($_SESSION['xac_dinh_dang_nhap']) or $_SESSION['xac_dinh_dang_nhap'] == "khong") {
    echo "<div style='color: red'>Mời đăng nhập để thêm sản phẩm vào giỏ!</div>
    ";
    
    echo $_SESSION['xac_dinh_dang_nhap'];
} else {
    //Nếu ko có đoạn $_SESSION['trang_chi_tiet_gio_hang']=="co" thì khi refresh giỏ hàng, web sẽ tự chạy lại (lấy thông tin trên url) và thêm dồn sản phẩm vào giỏ hàng. Đoạn code đấy là để xác định ta có truy cập vào trang chi tiết sản phẩm
    if (isset($_GET['MSHH']) and $_SESSION['trang_chi_tiet_gio_hang'] == "co") {
        $_SESSION['trang_chi_tiet_gio_hang'] = "huy_bo";
        //Sau khi xác nhận điều kiện bên trên, ta gán $_SESSION['trang_chi_tiet_gio_hang'] = "huy_bo" để khi refresh trang, web sẽ ko tự chạy lại
        if (isset($_SESSION['MSHH_them_vao_gio'])) {
            $so = count($_SESSION['MSHH_them_vao_gio']);
            $trung_lap = "khong";

            //Xử lý khi không nhập số lượng hợp lệ
            if ($_GET['so_luong_mua'] == null or $_GET['so_luong_mua'] < 0) {
                $_GET['so_luong_mua'] = 0;
                thong_bao_html("Chưa nhập số lượng thêm vào giỏ hàng !");
            }
            //

            //Xử lý khi số lượng mua > số hàng còn lại
            $sql = "select SoLuongHang,QuyCach
                    from hanghoa
                    where MSHH=" . $_GET['MSHH'] . ";";
            $sql_1 = $conn_dathang->query($sql)->fetch_array();
            $hang_con = $sql_1['SoLuongHang'];

            if ($_GET['so_luong_mua'] > $hang_con) {
                thong_bao_html("Số sản phẩm còn lại không đủ, mời giảm số lượng <= " . $hang_con . " " . $sql_1['QuyCach'] . ", xin cảm ơn !");
            } else {
                for ($i = 0; $i < $so; $i++) {
                    if ($_SESSION['MSHH_them_vao_gio'][$i] == $_GET['MSHH']) {
                        $trung_lap = "co";
                        $vi_tri_trung_lap = $i;
                        break;
                    }
                }
                if ($trung_lap == "khong") {
                    $_SESSION['MSHH_them_vao_gio'][$so] = $_GET['MSHH'];
                    $_SESSION['sl_them_vao_gio'][$so] = $_GET['so_luong_mua'];
                }
                if ($trung_lap == "co") {
                    //Xử lý khi số hàng trong giỏ + số lượng mua > hàng còn
                    if ($_SESSION['sl_them_vao_gio'][$vi_tri_trung_lap] + $_GET['so_luong_mua'] > $hang_con) {
                        $_SESSION['sl_them_vao_gio'][$vi_tri_trung_lap] = $hang_con;
                        thong_bao_html("Bạn đã thêm hết số lượng hàng còn lại của sản phẩm vào giỏ hàng, mời mở giỏ hàng và tiến hành thanh toán !");
                    } else {
                        $_SESSION['sl_them_vao_gio'][$vi_tri_trung_lap] = $_SESSION['sl_them_vao_gio'][$vi_tri_trung_lap] + $_GET['so_luong_mua'];
                    }
                }
            }
        } else {
            $_SESSION['MSHH_them_vao_gio'][0] = $_GET['MSHH'];
            $_SESSION['sl_them_vao_gio'][0] = $_GET['so_luong_mua'];
        }
    }
    trang_truoc();
}
