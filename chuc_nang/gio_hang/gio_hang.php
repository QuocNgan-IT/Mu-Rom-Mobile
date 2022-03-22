<div class="chi_muc">Giỏ hàng</div>

<table border="2px solid" width="100%">
    <tr>
        <td width="auto" align="center">
            Số sản phẩm
        </td>
        <td width="30%" align="center">
            <?php
            $so_luong = 0;
            if (isset($_SESSION['MSHH_them_vao_gio'])) {
                for ($i = 0; $i < count($_SESSION['MSHH_them_vao_gio']); $i++) {
                    $so_luong = $so_luong + $_SESSION['sl_them_vao_gio'][$i];
                }
            }
            echo $so_luong;
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <a href="?thamso=gio_hang"><input type="submit" class="nut_submit" value="Xem giỏ hàng"></a>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <a href="?thamso=dang_xuat"><input type="submit" class="nut_submit" value="Đăng xuất"></a>
        </td>
    </tr>
</table>