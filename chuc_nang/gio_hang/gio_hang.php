<?php
    $maKH = $_SESSION['maKH'];

    //Table dienthoai: MaDT,TenDT,GiaGoc,GiaKhuyenMai,MoTa,SoLuong,DaBan,MaHang
        //Table giohang: MaKH,MaDT,SoLuongMua
        $sql = "select * from dienthoai,giohang where dienthoai.MaDT=giohang.MaDT and giohang.MaKH='$maKH'";
        $renderGioHang = $conn->query($sql);

    //Kiểm tra tình trạng giỏ hàng
    if (mysqli_num_rows($renderGioHang)!=0) {
            $gioHang = "co";
    } else {
        $gioHang = "khong"; 
    }
     

    echo "<div class='chi_muc'>Giỏ hàng</div>";
    echo "<br>";
    if ( $gioHang=="khong" ) {
        echo "Không có sản phẩm trong giỏ hàng";
    } else {
        echo "<form action='' method='POST'>";
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
    
        

        $i = 0; //Biến xác định số sp trong giỏ, giúp lưu vào Session
        while ($renderGioHangArr=$renderGioHang->fetch_array()) {

            //Lấy thông tin điện thoại trong giỏ hàng
            $maDT = $renderGioHangArr['MaDT'];
            $tenDT = $renderGioHangArr['TenDT'];
            $donGiaGoc = $renderGioHangArr['GiaGoc'];
            $donGiaKM = $renderGioHangArr['GiaKhuyenMai'];
            $slMua = $renderGioHangArr['SoLuongMua'];
            $hangCon = $renderGioHangArr['SoLuong']-$renderGioHangArr['DaBan'];
            $_SESSION['giaDH'][$i] = $tien = $donGiaKM*$slMua;
            $tongTien += $tien;

            //Lấy ảnh điện thoại
            //Table anhdt: MaDT,MaHinh
            //Table hinhanh: MaHinh,TenHinh,SlideShow
            $sql = $conn->query("select * from anhdt,hinhanh where anhdt.MaHinh=hinhanh.MaHinh and anhdt.MaDT='$maDT'")->fetch_array();
            $tenAnhDT = $sql['TenHinh'];
            $linkAnhDT = "hinh_anh/san_pham/" . $tenAnhDT;

            //Render HTML
            ?>
            <tr>
                <td>
                    <img height='auto' width='100%' object-fit='fill' src='<?php echo $linkAnhDT; ?>'>
                </td>
                <td>
                    <?php echo $tenDT; ?>
                </td>
                <td style='text-align: right; padding-right: 5px;'>
                    <s><?php echo number_format($donGiaGoc, 0, '', ' '); ?> vnđ</s>
                    <br>
                    <?php echo number_format($donGiaKM, 0, '', ' '); ?> vnđ
                </td>
                <td align='center'>
                    <div class='buttons_added'>
                            <button class="is-form minus" onClick=window.open("?route=changeSL&slGiam&maDTchange=<?php echo $maDT; ?>")>-</button>
                            <input class="input-qty" value="<?php echo $slMua; ?>" disabled>
                            <button class="is-form plus" onClick=window.open("?route=changeSL&slTang&maDTchange=<?php echo $maDT; ?>")>+</button>
                    </div>
                </td>
                <td style='text-align: right; padding-right: 5px'>
                    <?php echo number_format($tien, 0, '', ' '); ?> vnđ 
                </td>

                <!-- Lưu giá DH cho từng sản phẩm trong giỏ hàng -->
                <?php $_SESSION['gia_DH'][$i] = $tien; ?>

                <td align='center'>
                    <button onClick=window.open("?route=delete&maDTXoa=<?php echo $maDT; ?>")>Xóa</button>
                </td>
            </tr>

        <?php 
            $i++;             
        }?>
                <tr>
                    <td colspan='3' align='right'>
                        <div style='color: red;'>
                            <?php
                                if (isset($_SESSION['err'])) {
                                    echo $_SESSION['err'];
                                    unset($_SESSION['err']);
                                } 
                            ?>
                        </div>
                    </td>
                </tr>
                <tr style='background-color: rgb(255, 150, 200); color: white;'>
                    <td colspan='3' align='right'>
                        <div ><strong>TỔNG GIÁ TRỊ ĐƠN HÀNG ==></strong></div>
                    </td>
                    <td colspan='2' align='center'>
                        <?php echo number_format($tongTien, 0, '', ' '); ?> VNĐ
                    </td>

                    <!-- Lưu tổng tiền đơn hàng -->
                    <?php $_SESSION['tongTien'] = $tongTien; ?>

                </tr>
            </table>
        </form>
        <br>
                        
        <!-- Biểu mẫu mua hàng -->
        <?php include("bieu_mau_mua_hang.php"); 
    }
        ?>
<!-- Loại bỏ xác nhận gửi lại biểu mẫu -->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>