<?php
    //Thêm sản phẩm vào sanphamvuaxem

    $maDT = $_GET['maDT'];
    $tinhTrangHang = "con hang";

    //table dienthoai: MaDT,TenDT,GiaGoc,GiaKhuyenMai,MoTa,SoLuong,DaBan,MaHang
    $sql = "select * from dienthoai where MaDT='$maDT'";
    $sql_1 = $conn->query($sql)->fetch_array();

    //MaDT,MaHinh
    $sql_2 = "select *from anhdt where MaDT='$maDT'";
    $sql_3 = $conn->query($sql_2)->fetch_array();
    //MaHinh,TenHinh,SlideShow
    $sql_4 = "select * from hinhanh where MaHinh='".$sql_3['MaHinh']."'";
    $sql_5 = $conn->query($sql_4)->fetch_array();

    //MaCH,MaDT,ManHinh,CameraSau,CameraTruoc,RAM,BoNhoTrong,CPU,GPU,Pin,HDH,Sim,XuatXu,NgayRaMat
    $sql_6 = "select * from cauhinhdt where MaDT='$maDT'";
    $sql_7 = $conn->query($sql_6)->fetch_array();

    $linkAnh = "hinh_anh/san_pham/".$sql_5['TenHinh'];
?>
    <div class='chi_muc'>Chi tiết sản phẩm</div>
    <table border='1px' cellspacing='3px' width='100%' align='center'>
        <tr>
            <td rowspan='5' width='25%' align='center'>
                <img height='auto' width='100%' object-fit='fill' src='<?php echo $linkAnh; ?>'>
                <div align='right'><br>Đã bán: <?php echo $sql_1['DaBan']; ?></div>
            </td>
            <td colspan='2' class='chi_muc' height='80px'>
                <?php echo $sql_1['TenDT']; ?>
            </td>
            <td rowspan='5' width='30%'>
                <table width='100%' cellspacing='0'>
                    <tr valign='top'>
                        <td width='30%'>
                            Màn hình:
                        </td>
                        <td>
                            <?php echo $sql_7['ManHinh']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            Camera sau:
                        </td>
                        <td>
                            <?php echo $sql_7['CameraSau']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            Camera trước:
                        </td>
                        <td>
                            <?php echo $sql_7['CameraTruoc']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            RAM:
                        </td>
                        <td>
                            <?php echo $sql_7['RAM']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            Bộ nhớ trong:
                        </td>
                        <td>
                            <?php echo $sql_7['BoNhoTrong']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            CPU:
                        </td>
                        <td>
                            <?php echo $sql_7['CPU']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            Pin:
                        </td>
                        <td>
                            <?php echo $sql_7['Pin']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            SIM:
                        </td>
                        <td>
                            <?php echo $sql_7['Sim']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            Hệ điều hành:
                        </td>
                        <td>
                            <?php echo $sql_7['HDH']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            Xuất xứ:
                        </td>
                        <td>
                            <?php echo $sql_7['XuatXu']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            Ngày ra mắt:
                        </td>
                        <td>
                            <?php echo $sql_7['NgayRaMat']; ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td  colspan='2' class='chi_muc_bang_chi_tiet' height='50px'>
                <?php
                    if( $sql_1['GiaGoc'] == $sql_1['GiaKhuyenMai'] ) {
                        echo "<br>".number_format($sql_1['GiaGoc'], 0, '', ' ')."vnđ";
                    } else {
                        echo "<s>".number_format($sql_1['GiaGoc'], 0, '', ' ')."vnđ</s><br>";
                        echo number_format($sql_1['GiaKhuyenMai'], 0, '', ' ')."vnđ";
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                <?php
                    if( $sql_1['SoLuong']-$sql_1['DaBan'] > 0 ) {
                        echo "<div style='text-align: center; font-style: oblique; color: green;'>Còn hàng!</div>";
                    } else {
                        echo "<div style='text-align: center; font-style: oblique; color: red;'>Hết hàng!</div>";
                        $tinh_trang_hang = "het hang";
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan='2' class='chi_muc_bang_chi_tiet' height='auto' style='vertical-align: top'>
                <div><b>Mô tả</b></div>
                <hr>
                <?php echo $sql_1['MoTa']; ?>
            </td>
        </tr>
        <?php
            if ($tinhTrangHang=="het hang") {
                echo "<tr>
                    <td>
                        <div style='text-align: center; font-style: oblique; color: red;'>
                            Sản phẩm đang tạm hết hàng, xin mời quay lại sau!
                        </div>
                    </td>
                </tr>";
            } else {
                echo "<tr class='chi_muc_bang_chi_tiet'>";
                    echo "<td>";
                        echo "<form>";
                            if (!isset($_SESSION['xac_dinh_dang_nhap']) or $_SESSION['xac_dinh_dang_nhap']=="khong") {
                                echo "<button onClick=\"NotificationAndGoto('Mời đăng nhập để mua hàng')\">Mua ngay</button>";
                            }
                            //echo "<button type='submit'>Mua ngay</button>";                  
                        echo "</form>";
                    echo "</td>";
                    echo "<td>";
                        if (!isset($_SESSION['xac_dinh_dang_nhap']) or $_SESSION['xac_dinh_dang_nhap']=="khong") {
                            echo "<button onClick=window.open('chuc_nang/dang_nhap/dang_nhap.php')>Thêm vào giỏ hàng</button>";
                        } else {
                            echo "<form method='POST' action='$SITEURL/chuc_nang/gio_hang/them_vao_gio.php'>";
                                echo "<input type='hidden' name='maDTMua' value='$maDT'>";    
                                echo "<button type='submit'>Thêm vào giỏ hàng</button>";  
                            echo "</form>";
                        } 
                    echo "</td>";
                echo "</tr>";
            }
        ?>
        <tr>
            <td colspan='3' class='chi_muc_bang_chi_tiet'>
                
                    <div class='chi_muc'>
                        Bình luận
                    </div>
                    <?php
                       
                        if( isset($_SESSION['xac_dinh_dang_nhap']) and $_SESSION['xac_dinh_dang_nhap']=="co" ) {
                            $maKH = $_SESSION['maKH']; 

                            //table comment: MaBL,NoiDung,MaKH,MaDT
                            $daComment = $conn->query("select * from comment where MaKH='$maKH'");

                            //Nếu đã comment rồi thì ko thể comment thêm, chỉ có thể sửa
                            if (mysqli_num_rows($daComment)==0) {
                                ?>
                                    <br>
                                    <form action="chuc_nang/san_pham/action_comment.php" method='POST'>
                                        <input type='hidden' name='maDT' value='<?php echo $maDT; ?>'>
                                        <textarea name='comment' style='width: 95%; height: 100px;'></textarea>
                                        <div align='right'>
                                            <button name='btnComment'>Bình luận</button>
                                        </div>
                                    </form>
                                <?php
                            } else {
                                $commentArr = $daComment->fetch_array();
                                $tenKH = $_SESSION['tenKH'];
                                $noiDung = $commentArr['NoiDung'];

                                ?>
                                    <div align='left' id='editComment'>
                                        <p><b><?php echo $tenKH; ?></b></p>
                                        <p><?php echo $noiDung; ?></p>
                                    
                                        <button align='left' style='display: inline;' onclick='showEditComment()'>Sửa bình luận</button>
                                        <button align='right' style='display: inline;' name='btnDeleteComment'>Xóa bình luận</button>
                                    </div>
                                    <hr>
                                <?php
                            }
                        }
                    ?>
                
                <script>
                    function showEditComment() {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("editComment").innerHTML = (this.responseText); 
                            }
                        };
                        xmlhttp.open("GET", "./action_edit_comment.php", true);
                        xmlhttp.send();
                    }
                </script>
                
                <hr>
                    <?php
                        //render comment
                        //table comment: MaBL,NoiDung,MaKH,MaDT
                        $sqlComment = $conn->query("select * from comment where MaDT='$maDT'");

                        //render comment
                        while ($commentArr = $sqlComment->fetch_array()) {
                            $maKH = $commentArr['MaKH'];

                            //bỏ qua comment của KH hiện tại, vì đã render ở trên
                            if ($maKH==$_SESSION['maKH']) {continue;} 

                            $getTenKH = $conn->query("select TenKH,HoTenKH from khachhang where MaKH='$maKH'")->fetch_array();
                            $tenKH = $getTenKH['TenKH'];
                            $noiDung = $commentArr['NoiDung'];

                            echo "<div align='left'>
                                    <p><b>$tenKH</b></p>
                                    <p>$noiDung</p>
                                </div>";
                            echo "<hr>";
                        }

                    ?>
                <br>
            </td>
            <td>
                Đánh giá
            </td>
        </tr>
        <tr>
            <td colspan='4'>
                <?php
                    if( isset($_SESSION['xac_dinh_dang_nhap']) and $_SESSION['xac_dinh_dang_nhap']=="co" ) {
                        echo "Sản phẩm vừa xem";
                    }
                ?>
            </td>
        </tr>
    </table>

<!-- Loại bỏ xác nhận gửi lại biểu mẫu -->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>