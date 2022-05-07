<?php
    if( trim($_GET['tuKhoa'])!="" ) {
        $m = explode(" ",$_GET['tuKhoa']); 
        $chuoiTimSql="";

        for( $i=0;$i<count($m);$i++ ) {
            $tu = trim($m[$i]);
            if( $tu!="" ) {
                $chuoiTimSql .= " TenDT like'%".$tu."%' or";
            }
        }

        //$chuoiTimSql sẽ thừa 'or' ở cuối, nên ta ghép lại chuỗi và bỏ từ cuối (là từ 'or' bị thừa)
        $m_2 = explode(" ",$chuoiTimSql);
        $chuoiTimSql2="";
        
        for( $i=0;$i<count($m_2)-1;$i++ ) {
            $chuoiTimSql2 = $chuoiTimSql2.$m_2[$i]." ";
        }

        //Tính toán số sản phẩm để hiển thị theo trang
        $soDuLieu = 15;
        $sql = "select count(*) from dienthoai where $chuoiTimSql2";
        $sql_1 = $conn->query($sql)->fetch_array();
        $soTrang = ceil( $sql_1[0]/$soDuLieu );

        if( !isset($_GET['trang']) ) {
            //Vị trí bắt đầu
            $vtbd = 0;
        }
        else {
            $vtbd = ($_GET['trang']-1) * $soDuLieu;
        }
        //

        $sql = "select MaDT,TenDT,GiaGoc,GiaKhuyenMai from dienthoai where $chuoiTimSql2 order by MaDT desc limit $vtbd,$soDuLieu";
        $sql_1 = $conn->query($sql);
        
        echo "<div class='chi_muc'>Toàn bộ sản phẩm</div>";
        echo "<table border='1px' cellspacing='5px' width='100%'>";
        while( $sql_2=$sql_1->fetch_array()) {
            echo "<tr>";
                for( $i=1;$i<=5;$i++ ) {
                    echo "<td width='20%'>";
                        if( $sql_2!=false ) {
                            //Lấy TenHinh ứng mới MaDT
                            $maDT = $sql_2['MaDT'];
                            $sql_3 = "select * from anhdt where MaDT='$maDT'";
                            $sql_4 = $conn->query($sql_3)->fetch_array();
                            $sql_5 = "select TenHinh from hinhanh where MaHinh='".$sql_4['MaHinh']."';";
                            $sql_6 = $conn->query($sql_5)->fetch_array();

                            $linkAnh = "hinh_anh/san_pham/".$sql_6['TenHinh'];
                            $linkChiTiet = "?route=chi_tiet_san_pham&maDT=".$maDT;
                            
                            //Màu mè tý :)
                            echo "<table border='1px' width='100%'>";
                                echo "<tr>";
                                    echo "<td height='400px' align='center'>";
                                        echo "<a href='$linkChiTiet' target='_blank'>";
                                            echo "<img width='100%'
                                            height='100%' object-fit='fill'; src='$linkAnh'>";
                                        echo "</a>";
                                    echo "</td>";
                                echo "</tr>";
                                echo "<tr height='80px'>";
                                    echo "<td align='center'>";
                                        echo "<a href='$linkChiTiet'>";
                                            echo $sql_2['TenDT'];
                                        echo "</a>";
                                    echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td align='center'>";
                                        if( $sql_2['GiaGoc']==$sql_2['GiaKhuyenMai'] ) {
                                            echo "<br>".$sql_2['GiaGoc']."vnđ";
                                        } else {
                                            echo "<s>".$sql_2['GiaGoc']."vnđ</s><br>";
                                            echo $sql_2['GiaKhuyenMai']."vnđ";
                                        }
                                        
                                    echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                        echo "<td align='center'>";
                                            echo "Đánh giá: ✩";
                                        echo "</td>";
                                echo "</tr>";
                            echo "</table>";
                        }
                        else {
                            echo "&nbsp;";
                        }
                    echo "</td>";
                    //Nếu i=5 thì bỏ qua lần lấy dữ liệu đấy, việc đấy để while xử lý
                    if( $i!=5 ) {
                        $sql_2 = $sql_1->fetch_array();
                    }
                }
            echo "</tr>";
            //Cho thêm khoảng trống giữa các dòng
            echo "<tr>";
            for( $i=1;$i<=5;$i++ ) {
                echo "<td style='border: none; font-size: smaller; color: gray' align=' center'>Mũ Rơm Mobile</td>";
            }
            echo "</tr>";
        }
            echo "<tr>";
                echo "<td colspan='5' align='center'>";
                    echo "<div class='phan_trang'>";
                        for( $i=1;$i<=$soTrang;$i++ ) {
                            $link = "?route=xuat_san_pham_2&trang=".$i;
                            echo "<a href='$link'>";
                                echo $i; echo " ";
                            echo "</a>";
                        }
                    echo "</div>";
                echo "</td>";
            echo "</tr>";
        echo "</table>";
    }
    else {
        echo "Bạn chưa nhập từ khóa";
    }
?>