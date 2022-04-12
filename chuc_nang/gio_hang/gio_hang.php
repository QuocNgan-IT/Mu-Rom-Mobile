<script>
    $('input.input-qty').each(function() {
        var $this = $(this),
            qty = $this.parent().find('.is-form'),
            min = Number($this.attr('min')),
            max = Number($this.attr('max'))
        if (min == 0) {
            var d = 0
        } else d = min
        $(qty).on('click', function() {
            if ($(this).hasClass('minus')) {
                if (d > min) d += -1
            } else if ($(this).hasClass('plus')) {
                var x = Number($this.val()) + 1
                if (x <= max) d += 1
            }
            $this.attr('value', d).val(d)
        })
    })
</script>

<?php
function remove($i) {
    $_SESSION['MaDT_mua'][$i] = null;
    $_SESSION['SL_mua'][$i] = null;
    $_SESSION['gia_don_hang'][$i] = null;
}

$maKH = $_SESSION['ma_KH'];

//Kiểm tra tình trạng giỏ hàng
if (isset($_SESSION['soSPMua'])) {
    if ($_SESSION['soSPMua'] == 0) {
        $gio_hang = "khong";
    } else {
        $gio_hang = "co";
    }
} else {
    $gio_hang = "khong";
}
//

echo "<div class='chi_muc'>Giỏ hàng</div>";
echo "<br>";
if ($gio_hang == "khong") {
    echo "Không có sản phẩm trong giỏ hàng";
} else {
    echo "<form action='' method='POST'>";
    //echo "<input type='hidden' name='cap_nhat_gio_hang' value='co'>";
        echo "<table class='bang_gio_hang' align='center'";
            echo "<tr>";
                echo "<td width='100px' class='chi_muc'>Hình ảnh</td>";
                echo "<td width='auto' class='chi_muc'>Sản phẩm</td>";
                echo "<td width='150px' class='chi_muc'>Đơn giá</td>";
                echo "<td width='140px' class='chi_muc'>Số lượng</td>";
                echo "<td width='180px' class='chi_muc'>Tổng tiền</td>";
                echo "<td width='100px' class='chi_muc'>Thao tác</td>";
            echo "</tr>";

    $tongTien = 0;
   
    //Table dienthoai: MaDT,TenDT,GiaGoc,GiaKhuyenMai,MoTa,SoLuong,DaBan,MaHang
    //Table giohang: MaKH,MaDT,SoLuongMua
    $sql = "select * from dienthoai,giohang where dienthoai.MaDT=giohang.MaDT and giohang.MaKH='$maKH'";
    $renderGioHang = $conn->query($sql);

    while ($renderGioHangArr=$renderGioHang->fetch_array()) {

        //Lấy thông tin điện thoại trong giỏ hàng
        $maDT = $renderGioHangArr['MaDT'];
        $tenDT = $renderGioHangArr['TenDT'];
        $donGiaGoc = $renderGioHangArr['GiaGoc'];
        $donGiaKM = $renderGioHangArr['GiaKhuyenMai'];
        $slMua = $renderGioHangArr['SoLuongMua'];
        $hangCon = $renderGioHangArr['SoLuong'] - $renderGioHangArr['DaBan'];
        $tien = $donGiaKM * $slMua;
        $tongTien+=$tien;

        //Lấy ảnh điện thoại
        //Table anhdt: MaDT,MaHinh
        //Table hinhanh: MaHinh,TenHinh,SlideShow
        $sql = $conn->query("select * from anhdt,hinhanh where anhdt.MaHinh=hinhanh.MaHinh and anhdt.MaDT='$maDT'")->fetch_array();
        $tenAnhDT = $sql['TenHinh'];
        $linkAnhDT = "hinh_anh/san_pham/" . $tenAnhDT;

        //Render HTML
        echo "<tr>";
            echo "<td><img height='auto' width='100%' object-fit='fill' src='$linkAnhDT'></td>";
            echo "<td>" . $tenDT . "</td>";
            echo "<td style='text-align: right; padding-right: 5px;'>
                    <s>" . number_format($donGiaGoc, 0, '', ' ') . " vnđ</s>
                    <br>
                    " . number_format($donGiaKM, 0, '', ' ') . " vnđ
                </td>";
            echo "<td>";
                echo "<div align='center'>";
                    //echo "<input type='hidden' name='" . $name_MaDT . "' value='" . $_SESSION['MaDT_mua'][$i] . "'>";
                    echo "<div align='center'>
                            <input class='minus is-form' type='button' value='-'>
                            <input aria-label='quantity' class='input-qty' min=1 max='$hangCon' name='' type='number' value='$maDT'>
                            <input class='plus  is-form' type='button' value='+'>
                        </div>";
                    //echo "<input type='text' style='width: 50%' id='CNSL' name='" . $name_SL . "' value='" . $_SESSION['SL_mua'][$i] . "'>";
                    //echo "<input type='hidden' name='cap_nhat_gio_hang' value='co'>";
                echo "</div>";
            echo "</td>";
            echo "<td style='text-align: right; padding-right: 5px'>" . number_format($tien, 0, '', ' ') . " vnđ </td>";

        //$_SESSION['gia_don_hang'][$i] = $tien;

            echo "<td align='center'>
                    <button onClick=window.open('?route=delete&MaDT_xoa=$maDT')>Xóa</button>
                </td>";
        echo "</tr>";
    }

    
    /*for ($i=0; $i<$_SESSION['soSPMua']; $i++) {
        //MaDT,TenDT,GiaGoc,GiaKhuyenMai,MoTa,SoLuong,DaBan,MaHang
        $sql = "select MaDT,TenDT,GiaGoc,GiaKhuyenMai,SoLuong,DaBan 
                from dienthoai 
                where MaDT='" . $_SESSION['MaDT_mua'][$i] . "'";
        $sql_1 = $conn->query($sql)->fetch_array();
        $tien = $sql_1['GiaKhuyenMai'] * $_SESSION['SL_mua'][$i];
        $tong_cong = $tong_cong + $tien;
        $name_MaDT = "MaDT_" . $i;
        $name_SL = "SL_" . $i;
        $hang_con_lai = $sql_1['SoLuong'] - $sql_1['DaBan'];

        //MaDT,MaHinh
        $sql_2 = "select *
                from anhdt
                where MaDT='" . $_SESSION['MaDT_mua'][$i] . "'";
        $sql_3 = $conn->query($sql_2)->fetch_array();
        //MaHinh,TenHinh,SlideShow
        $sql_4 = "select *
                from hinhanh
                where MaHinh='" . $sql_3['MaHinh'] . "'";
        $sql_5 = $conn->query($sql_4)->fetch_array();
        $link_anh = "hinh_anh/san_pham/" . $sql_5['TenHinh'];

        if ($_SESSION['SL_mua'][$i] != 0) {
            $STT++;
            echo "<tr>";
                echo "<td><img height='auto' width='100%' object-fit='fill' src='$link_anh'></td>";
                echo "<td>" . $sql_1['TenDT'] . "</td>";
                echo "<td style='text-align: right; padding-right: 5px;'>
                        <s>" . number_format($sql_1['GiaGoc'], 0, '', ' ') . " vnđ</s>
                        <br>
                        " . number_format($sql_1['GiaKhuyenMai'], 0, '', ' ') . " vnđ
                    </td>";
                echo "<td>";
                    echo "<div align='center'>";
                        echo "<input type='hidden' name='" . $name_MaDT . "' value='" . $_SESSION['MaDT_mua'][$i] . "'>";
                        echo "<div align='center'>
                                <input class='minus is-form' type='button' value='-'>
                                <input aria-label='quantity' class='input-qty' min=1 max='$hang_con_lai' name='' type='number' value='" . $_SESSION['SL_mua'][$i] . "'>
                                <input class='plus  is-form' type='button' value='+'>
                            </div>";
                        //echo "<input type='text' style='width: 50%' id='CNSL' name='" . $name_SL . "' value='" . $_SESSION['SL_mua'][$i] . "'>";
                        //echo "<input type='hidden' name='cap_nhat_gio_hang' value='co'>";
                    echo "</div>";
                echo "</td>";
                echo "<td rowspan='2' style='text-align: right; padding-right: 5px'>" . number_format($tien, 0, '', ' ') . " vnđ </td>";

            $_SESSION['gia_don_hang'][$i] = $tien;

                echo "<td align='center'>
                        <button onClick=window.open('?thamso=delete&MaDT_xoa=".$_SESSION['MaDT_mua'][$i]."')>Xóa</button>
                    </td>";
            echo "</tr>";
        }
    }*/
            echo "<tr style='background-color: rgb(255, 150, 200); color: white;'>";
                echo "<td colspan='3' align='right'>";
                    echo "<div ><strong>TỔNG GIÁ TRỊ ĐƠN HÀNG ==></strong></div>";
                echo "</td>";
                echo "<td colspan='2' align='center'>";
                    echo $tongTien . " VNĐ";

                $_SESSION['tongTien'] = $tongTien;

                echo "</td>";
            echo "</tr>";
        echo "</table>";
    echo "</form>";
    echo "<br>";
    // include("chuc_nang/gio_hang/bieu_mau_mua_hang.php");
    /*?>
<div align="center">
    <button class="nut_submit" onclick="myFunction()" id="nut_mua">Tiến hành mua hàng</button>
</div>
<hr><br>
<div id="event" align="center">
    <div class="chi_muc_bang_chi_tiet">
        Click nút trên để thực hiện mua hàng
    </div>
</div>

<script type="text/javascript">
change = 0

function myFunction() {
    if (change == 0) {
        document.getElementById("event").innerHTML = "<?php include("chuc_nang/gio_hang/bieu_mau_mua_hang.php"); ?>";

        document.getElementById("nut_mua").innerHTML = "Hủy mua hàng";

        document.getElementById("nut_cap_nhat").disable = true;

        change = 1
    } else {
        document.getElementById("event").innerHTML =
            "<div class='chi_muc_bang_chi_tiet'>Click nút trên để thực hiện mua hàng</div>";

        document.getElementById("nut_mua").innerHTML = "Tiến hành mua hàng";

        document.getElementById("CNSL").disable = false;

        change = 0
    }

}
</script>
<?php*/
}