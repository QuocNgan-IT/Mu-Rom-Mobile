<?php
    include("/xampp/htdocs/MuRomMobile/chuc_nang/gio_hang/action_mua_hang.php");
    //Đưa thông tin từ tài khoản vào biểu mẫu

    //Table khachhang: MaKH,TenKH,HoTenKH,SoDienThoai,Email,Username,Password
    //Table diachikh: MaDC,DiaChi,MaKH
    $username = $_SESSION['username'];
    $sql = $conn->query("select * from khachhang,diachikh where khachhang.MaKH=diachikh.MaKH and khachhang.Username like'$username'");
    
    if( mysqli_num_rows($sql)!=0 ) {
        $sqlResult = $sql->fetch_array(); //Có tồn tại thông tin của khách hàng
        $ten = $sqlResult['HoTenKH'];
        $dchi = $sqlResult['DiaChi'];
        $sdt = $sqlResult['SoDienThoai'];
        $email = $sqlResult['Email'];
    } else {
        $ten = "";
        $dchi = "";
        $sdt = "";
    }
?>

    <form method='POST' action=''>
        <table width='80%' align='center' class='chi_muc_bang required'>
            <tr>
                <td colspan='2' class='chi_muc'>
                    Thông tin mua hàng
                </td>
            </tr>
            <tr>
                <td style='width: 200px; text-indent: 10px'>
                    <label>Tên người mua (</label>): 
                </td>
                <td>
                    <input type='text' style='width: 99%' name='tenNguoiMua' value='<?php echo $ten; ?>' required>
                </td>
            </tr>
            <tr>
                <td style='width: 200px; text-indent: 10px'>
                    <label>Địa chỉ (</label>): 
                </td>
                <td>
                    <textarea style='resize: none; width: 99%; height: 100px' name='diaChi' required><?php echo $dchi; ?></textarea>
                </td>
            </tr>
            <tr>
                <td style='width: 200px; text-indent: 10px'>
                    <label>Số điện thoại (</label>):
                </td>
                <td>
                    <input type='text' style='width: 99%' name='soDienThoai' value='<?php echo $sdt; ?>' required>
                </td>
            </tr>
            <tr>
                <td style='width: 200px; text-indent: 10px'>
                    Email: 
                </td>
                <td>
                    <input type='text' style='width: 99%' name='email' pattern="^[a-zA-Z0-9.]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" value="<?php echo $email; ?>">
                </td>
            </tr>
            <tr>
                <td style='width: 200px; text-indent: 10px'>
                    Lời nhắn: 
                </td>
                <td>
                    <textarea style='resize: none; width: 99%; height: 200px' name='loiNhan'></textarea>
                </td>
            </tr>
            <tr>             
                <td colspan='2' align='center'>
                    <hr>
                    <input type='submit' name='muaHang' class='nut_submit' value='Mua hàng'>
                </td>
            </tr>
        </table>
    </form>