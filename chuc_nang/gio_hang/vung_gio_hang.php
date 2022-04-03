<table border="2px solid" width="100%">
    <tr>
        <td width="auto" align="center">            
            Số sản phẩm trong giỏ
        </td>
        <td width="30%" align="center">
            <?php
                $so_luong = 0;

                if (isset($_SESSION['MaDT_mua'])) {
                   $so_luong = count($_SESSION['MaDT_mua']);  
                }                    

                echo $so_luong; 
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <a href="?thamso=gio_hang"><input type="submit" class="nut_submit" value="Giỏ hàng"></a>
        </td>
    </tr>
</table>