<?php
    if (isset($_GET['MaDT_mua']) and $_SESSION['trang_chi_tiet_gio_hang']=="co") {
        $_SESSION['trang_chi_tiet_gio_hang'] = "huy_bo";
        $maKH = $_SESSION['ma_KH'];
        if (isset($_SESSION['MaDT_mua'])) {
            $so = count($_SESSION['MaDT_mua']);
            $trung_lap = "khong";

            $sql = "select SoLuong, DaBan
                    from dienthoai
                    where MaDT=".$_GET['MaDT_mua'].";";
            $sql_1 = $conn->query($sql)->fetch_array();
            $hang_con = $sql_1['SoLuong'] - $sql_1['DaBan'];

            for ($i=0; $i<$so; $i++) {
                if ($_SESSION['MaDT_mua'][$i] == $_GET['MaDT_mua']) {
                    $trung_lap = "co";
                    $vi_tri_trung_lap = $i;
                    break;
                }
            }
            if ($trung_lap == "khong") {
                $maDT = $_SESSION['MaDT_mua'][$so] = $_GET['MaDT_mua'];
                $SLmua = $_SESSION['SL_mua'][$so] = 1;

                //MaKH,MaDT,SoLuongMua
                $conn->query("insert
                            into giohang
                            value ('$maKH', '$maDT', '$SLmua')");
            }
            if ($trung_lap == "co") {
                //Xử lý khi số hàng trong giỏ + số lượng mua > hàng còn
                if ($_SESSION['SL_mua'][$vi_tri_trung_lap] + 1 > $hang_con) {
                    $_SESSION['SL_mua'][$vi_tri_trung_lap] = $hang_con;
                    thong_bao_html("Bạn đã thêm hết số lượng hàng còn lại của sản phẩm vào giỏ hàng, mời mở giỏ hàng và tiến hành thanh toán !");
                } else {
                    $SLmua = $_SESSION['SL_mua'][$vi_tri_trung_lap] = $_SESSION['SL_mua'][$vi_tri_trung_lap] + 1;
                    $maDT = $_SESSION['MaDT_mua']['$vi_tri_trung_lap'];

                    $conn->query("update giohang
                                set SoLuongMua='$SLmua'
                                where MaKH='$maKH' and MaDT='$maDT'");
                }
            }
        } else {
            $maDT = $_SESSION['MaDT_mua'][0] = $_GET['MaDT_mua'];
            $SLmua = $_SESSION['SL_mua'][0] = 1;

            //MaKH,MaDT,SoLuongMua
            $conn->query("insert
                into giohang
                value ('$maKH', '$maDT', '$SLmua')");
        }
    } 
?>
<script type="text/javascript">
    window.history.back();
</script>
