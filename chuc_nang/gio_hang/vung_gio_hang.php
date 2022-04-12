<table border="2px solid" width="100%">
    <tr>
        <td width="auto" align="center">            
            Số sản phẩm trong giỏ
        </td>
        <td width="30%" align="center">
            <?php
                if (isset($_SESSION['soSPMua'])) {
                    echo $_SESSION['soSPMua']; 
                }
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <a href="?route=gio_hang"><input type="submit" class="nut_submit" value="Giỏ hàng"></a>
        </td>
    </tr>
</table>