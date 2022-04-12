<?php
   // $_SESSION['trang_chi_tiet_gio_hang'] = "co";
    //Thêm sản phẩm vào sanphamvuaxem

    $ma_DT = $_GET['MaDT'];

    //MaDT,TenDT,GiaGoc,GiaKhuyenMai,MoTa,SoLuong,DaBan,MaHang
    $sql = "select *
            from dienthoai
            where MaDT='$ma_DT'";
    $sql_1 = $conn->query($sql)->fetch_array();

    //MaDT,MaHinh
    $sql_2 = "select *
            from anhdt
            where MaDT='$ma_DT'";
    $sql_3 = $conn->query($sql_2)->fetch_array();
    //MaHinh,TenHinh,SlideShow
    $sql_4 = "select *
            from hinhanh
            where MaHinh='".$sql_3['MaHinh']."'";
    $sql_5 = $conn->query($sql_4)->fetch_array();

    //MaCH,MaDT,ManHinh,CameraSau,CameraTruoc,RAM,BoNhoTrong,CPU,GPU,Pin,HDH,Sim,XuatXu,NgayRaMat
    $sql_6 = "select *
            from cauhinhdt
            where MaDT='$ma_DT'";
    $sql_7 = $conn->query($sql_6)->fetch_array();

    $link_anh = "hinh_anh/san_pham/".$sql_5['TenHinh'];

    echo "<div class='chi_muc'>Chi tiết sản phẩm</div>";
    echo "<table border='1px' cellspacing='3px' width='100%' align='center'>";
        echo "<tr>";
            echo "<td rowspan='5' width='25%' align='center'>";
                echo "<img height='auto' width='100%' object-fit='fill' src='$link_anh'>";
                echo "<div align='right'><br>Da ban: ".$sql_1['DaBan']."</div>";
            echo "</td>";
            echo "<td class='chi_muc' height='80px'>";
                echo $sql_1['TenDT'];
            echo "</td>";
            echo "<td rowspan='5' width='30%'>";
                echo "<table width='100%' cellspacing='0'>";
                    echo "<tr valign='top'>";
                        echo "<td width='30%'>
                            Màn hình:";
                        echo "</td>";
                        echo "<td>"
                            .$sql_7['ManHinh']."";
                        echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td valign='top'>
                            Camera sau:";
                        echo "</td>";
                        echo "<td>"
                            .$sql_7['CameraSau']."";
                        echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td valign='top'>
                            Camera trước:";
                        echo "</td>";
                        echo "<td>"
                            .$sql_7['CameraTruoc']."";
                        echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td valign='top'>
                            RAM:";
                        echo "</td>";
                        echo "<td>"
                            .$sql_7['RAM']."";
                        echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td valign='top'>
                            Bộ nhớ trong:";
                        echo "</td>";
                        echo "<td>"
                            .$sql_7['BoNhoTrong']."";
                        echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td valign='top'>
                            CPU:";
                        echo "</td>";
                        echo "<td>"
                            .$sql_7['CPU']."";
                        echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td valign='top'>
                            Pin:";
                        echo "</td>";
                        echo "<td>"
                            .$sql_7['Pin']."";
                        echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td valign='top'>
                            SIM:";
                        echo "</td>";
                        echo "<td>"
                            .$sql_7['Sim']."";
                        echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td valign='top'>
                            Hệ điều hành:";
                        echo "</td>";
                        echo "<td>"
                            .$sql_7['HDH']."";
                        echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td valign='top'>
                            Xuất xứ:";
                        echo "</td>";
                        echo "<td>"
                            .$sql_7['XuatXu']."";
                        echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td valign='top'>
                            Ngày ra mắt:";
                        echo "</td>";
                        echo "<td>"
                            .$sql_7['NgayRaMat']."";
                        echo "</td>";
                    echo "</tr>";
                echo "</table>";
            echo "</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td class='chi_muc_bang_chi_tiet' height='50px'>";
                if( $sql_1['GiaGoc'] == $sql_1['GiaKhuyenMai'] ) {
                    echo "<br>".$sql_1['GiaGoc']."vnđ";
                } else {
                    echo "<s>".$sql_1['GiaGoc']."vnđ</s><br>";
                    echo $sql_1['GiaKhuyenMai']."vnđ";
                }
            echo "</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td>";
                if( $sql_1['SoLuong']-$sql_1['DaBan'] > 0 ) {
                    echo "<div style='font-style: oblique; color: green'>Còn hàng!</div>";
                }
            echo "</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td class='chi_muc_bang_chi_tiet' height='auto' style='vertical-align: top'>";
                echo "<div><b>Mô tả</b></div>";
                echo "<hr>";
                echo $sql_1['MoTa'];
            echo "</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td class='chi_muc_bang_chi_tiet' height='150px'>";
                echo "<form>";
                    echo "<input type='hidden' name='thamso' value='them_vao_gio'>";
                    echo "<input type='hidden' name='MaDT' value='".$_GET['MaDT']."'>";
                    echo "<b>Chọn mua: </b>";
                    echo "<input type='text' name='so_luong_mua' value='1' style='width: 40px'>";
                    echo "&nbsp;";
                    echo "<hr>";                    
                    echo "<br><br>";
                    if( !isset($_SESSION['xac_dinh_dang_nhap']) or $_SESSION['xac_dinh_dang_nhap']=="khong" ) {
                        echo "<div style='color: red'>Mời đăng nhập để thêm sản phẩm vào giỏ!</div>";
                    }
                    else {
                        echo "<input type='submit' class='nut_submit' value='Thêm vào giỏ hàng' style='margin-left: 15px'>";
                    }                    
                echo "</form>";
            echo "</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td colspan='2' class='chi_muc_bang_chi_tiet'>";
                echo "<div class='chi_muc'>";
                    echo "Phần đánh giá & Bình luận";
                echo "</div>";
                echo "<br><hr>";
                echo "<p align='center'>Tính năng đang trong quá trình phát triển..</p>";
                echo "<hr><br>";
            echo "</td>";
            echo "<td>";
                echo "Đánh giá";
            echo "</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td colspan='3'>";
            if( isset($_SESSION['xac_dinh_dang_nhap']) and $_SESSION['xac_dinh_dang_nhap']=="co" ) {
                echo "Sản phẩm vừa xem";
            }
            echo "</td>";
        echo "</tr>";
    echo "</table>";
?>