<?php
   //Tính toán số sản phẩm để hiển thị theo trang
    $soDuLieu = 1; //15
    $countDT = $conn->query("select count(*) from dienthoai")->fetch_array();
    $soTrang = ceil( $countDT[0]/$soDuLieu );

    if( !isset($_GET['trang']) ) {
        //Vị trí bắt đầu
        $vtbd = 0;
    }
    else {
        $vtbd = ($_GET['trang']-1)*$soDuLieu;
    }
    //

    //Table dienthoai: MaDT,TenDT,GiaGoc,GiaKhuyenMai,MoTa,SoLuong,DaBan,MaHang
    $getDienThoai = $conn->query("select * from dienthoai order by MaDT desc limit $vtbd,$soDuLieu");
    
    echo "<div class='chi_muc'>Toàn bộ sản phẩm</div>";
    echo "<table border='1px' cellspacing='5px' width='100%'>";
    while( $dienThoaiArr=$getDienThoai->fetch_array()) {
        echo "<tr>";
            for( $i=1;$i<=5;$i++ ) {
                echo "<td width='20%'>";
                    if( $dienThoaiArr!=false ) {
                        //Lấy TenHinh ứng với MaDT
                        $maDT = $dienThoaiArr['MaDT'];

                        //table anhdt: MaDT,MaHinh
                        //table hinhanh: MaHinh,TenHinh,SlideShow
                        $getAnhDT = "select * from anhdt,hinhanh where anhdt.MaHinh=hinhanh.MaHinh and anhdt.MaDT='$maDT'";
                        $anhDTArr = $conn->query($getAnhDT)->fetch_array();

                        $linkAnh = "hinh_anh/san_pham/".$anhDTArr['TenHinh'];
                        $linkChiTiet = "?route=chi_tiet_san_pham&maDT=".$maDT;
                        
                        //Màu mè tý :)
                        echo "<table border='1px' width='100%'>";
                            echo "<tr>";
                                echo "<td height='400px' align='center'>";
                                    echo "<a href='$linkChiTiet'>";
                                        echo "<img width='100%'
                                        height='100%' object-fit='fill'; src='$linkAnh'>";
                                    echo "</a>";
                                echo "</td>";
                            echo "</tr>";
                            echo "<tr height='80px'>";
                                echo "<td align='center'>";
                                    echo "<a href='$linkChiTiet'>";
                                        echo $dienThoaiArr['TenDT'];
                                    echo "</a>";
                                echo "</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td align='center'>";
                                    if( $dienThoaiArr['GiaGoc']==$dienThoaiArr['GiaKhuyenMai'] ) {
                                        echo "<br>".number_format($dienThoaiArr['GiaGoc'], 0, '', ' ')."vnđ";
                                    } else {
                                        echo "<s>".number_format($dienThoaiArr['GiaGoc'], 0, '', ' ')."vnđ</s><br>";
                                        echo number_format($dienThoaiArr['GiaKhuyenMai'], 0, '', ' ')."vnđ";
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
                    $dienThoaiArr = $getDienThoai->fetch_array();
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