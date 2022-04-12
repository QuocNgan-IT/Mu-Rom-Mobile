<?php
   //Tính toán số sản phẩm để hiển thị theo trang
    $so_du_lieu = 1; //15
    $sql = "select count(*)
            from dienthoai";
    $sql_1 = $conn->query($sql)->fetch_array();
    $so_trang = ceil( $sql_1[0] / $so_du_lieu );

    if( !isset($_GET['trang']) ) {
        //Vị trí bắt đầu
        $vtbd = 0;
    }
    else {
        $vtbd = ($_GET['trang']-1) * $so_du_lieu;
    }

    //

    $sql = "select MaDT,TenDT,GiaGoc,GiaKhuyenMai
            from dienthoai 
            order by MaDT desc
            limit $vtbd,$so_du_lieu";
    $sql_1 = $conn->query($sql);
    
    echo "<div class='chi_muc'>Toàn bộ sản phẩm</div>";
    echo "<table border='1px' cellspacing='5px' width='100%'>";
    while( $sql_2=$sql_1->fetch_array()) {
        echo "<tr>";
            for( $i=1;$i<=5;$i++ ) {
                echo "<td width='20%'>";
                    if( $sql_2!=false ) {
                        //Lấy TenHinh ứng với MaDT
                        $ma_DT = $sql_2['MaDT'];
                        $sql_3 = "select *
                            from anhdt
                            where MaDT='$ma_DT'";
                        $sql_4 = $conn->query($sql_3)->fetch_array();
                        $sql_5 = "select TenHinh
                            from hinhanh
                            where MaHinh='".$sql_4['MaHinh']."';";
                        $sql_6 = $conn->query($sql_5)->fetch_array();

                        $link_anh = "hinh_anh/san_pham/".$sql_6['TenHinh'];
                        $link_chi_tiet = "?route=chi_tiet_san_pham&MaDT=".$ma_DT;
                        

                        //Màu mè tý :)
                        echo "<table border='1px' width='100%'>";
                            echo "<tr>";
                                echo "<td height='400px' align='center'>";
                                    echo "<a href='$link_chi_tiet'>";
                                        echo "<img width='100%'
                                        height='100%' object-fit='fill'; src='$link_anh'>";
                                    echo "</a>";
                                echo "</td>";
                            echo "</tr>";
                            echo "<tr height='80px'>";
                                echo "<td align='center'>";
                                    echo "<a href='$link_chi_tiet'>";
                                        echo $sql_2['TenDT'];
                                    echo "</a>";
                                echo "</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td align='center'>";
                                    if( $sql_2['GiaGoc'] == $sql_2['GiaKhuyenMai'] ) {
                                        echo "<br>".number_format($sql_2['GiaGoc'], 0, '', ' ')."vnđ";
                                    } else {
                                        echo "<s>".number_format($sql_2['GiaGoc'], 0, '', ' ')."vnđ</s><br>";
                                        echo number_format($sql_2['GiaKhuyenMai'], 0, '', ' ')."vnđ";
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
                    for( $i=1;$i<=$so_trang;$i++ ) {
                        $link = "?route=xuat_san_pham_2&trang=".$i;
                        echo "<a href='$link'>";
                            echo $i; echo " ";
                        echo "</a>";
                    }
                echo "</div>";
            echo "</td>";
        echo "</tr>";
    echo "</table>";