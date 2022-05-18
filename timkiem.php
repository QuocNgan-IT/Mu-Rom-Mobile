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

        $m_2 = explode(" ",$chuoiTimSql);
        $chuoiTimSql2="";
        
        for( $i=0;$i<count($m_2)-1;$i++ ) {
            $chuoiTimSql2 = $chuoiTimSql2.$m_2[$i]." ";
        }

        $sql_tt = "SELECT * FROM dienthoai, hinhanh WHERE dienthoai.MaDT = hinhanh.MaDT AND hinhanh.Hinh_index = 1 AND $chuoiTimSql2";
        $query_tt = mysqli_query($mysqli, $sql_tt);

    }
?>

<div class="body-kddt">
<div class="row" style="width: 100%;margin-left: 0">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        
        <section>
            <div class="dienthoai-hot">
                <div class="row">
                    <div class="col-sm-3">
                        <p class="tieudenho" style="margin-left: 24px">Sắp xếp theo</p>
                        <div style="margin-left: 24px;">
                            <div class="form-group">
                                <input class="form-check-input" name="sapxep" type="radio" id="sx-moinhat" value="moinhat" checked>
                                <label for="sx-moinhat" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <h6 style="font-weight:bold;color: #4f4f4f;">Mới nhất</h6>
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input" name="sapxep" type="radio" id="sx-cunhat" value="cunhat">
                                <label for="sx-cunhat" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <h6 style="color: #4f4f4f;font-weight:bold">Cũ nhất</h6>
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input" name="sapxep" type="radio" id="sx-banchay" value="banchay">
                                <label for="sx-banchay" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <h6 style="color: #4f4f4f;font-weight:bold">Bán chạy nhất</h6>
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input" name="sapxep" type="radio" id="sx-giatang" value="giatang">
                                <label for="sx-giatang" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <h6 style="color: #4f4f4f;font-weight:bold">Giá tăng dần</h6>
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input" name="sapxep" type="radio" id="sx-giagiam" value="giagiam">
                                <label for="sx-giagiam" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <h6 style="color: #4f4f4f;font-weight:bold">Giá giảm dần</h6>
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input" name="sapxep" type="radio" id="sx-ten" value="ten">
                                <label for="sx-ten" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <h6 style="color: #4f4f4f;font-weight:bold">Tên</h6>
                                </label>
                            </div>
                        </div>
                        
                        <p class="tieudenho" style="margin-left: 24px">Hãng sản xuất</p>
                        <div style="margin-left: 24px;">
                            <div class="form-group">
                                <input class="form-check-input" name="hangsx" type="radio" id="hang-tatca" value="tatca" checked>
                                <label for="hang-tatca" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <h6 style="color: #4f4f4f;font-weight:bold">Tất cả</h6>
                                </label>
                            </div>
                            <?php
                                $sql_hangdt = "SELECT * FROM hangsx";
                                $query_hangdt = mysqli_query($mysqli,$sql_hangdt);
                                while($row_hangdt = mysqli_fetch_array($query_hangdt)) {
                                    ?>
                                        <div class="form-group">
                                            <input class="form-check-input" name="hangsx" type="radio" id="hang-<?php echo $row_hangdt['MaHang'] ?>" value="<?php echo $row_hangdt['MaHang'] ?>">
                                            <label for="hang-<?php echo $row_hangdt['MaHang'] ?>" class="form-check-label dark-grey-text" onclick="locsp()">
                                                <h6 style="color: #4f4f4f;font-weight:bold"><?php echo $row_hangdt['TenHang'] ?></h6>
                                            </label>
                                        </div>                                    
                                    <?php
                                }
                            ?>
                        </div>

                        <p class="tieudenho" style="margin-left: 24px">Giá</p>
                        <div style="margin-left: 24px;">
                            <div class="form-group">
                                <input class="form-check-input" name="gia" type="radio" id="gia-tatca" value="tatca" checked>
                                <label for="gia-tatca" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <h6 style="color: #4f4f4f;font-weight:bold">Tất cả</h6>
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input" name="gia" type="radio" id="gia-3" value="3">
                                <label for="gia-3" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <h6 style="color: #4f4f4f;font-weight:bold">Dưới 3tr</h6>
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input" name="gia" type="radio" id="gia-35" value="35">
                                <label for="gia-35" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <h6 style="color: #4f4f4f;font-weight:bold">Từ 3tr đến 5tr</h6>
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input" name="gia" type="radio" id="gia-58" value="58">
                                <label for="gia-58" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <h6 style="color: #4f4f4f;font-weight:bold">Từ 5tr đến 8tr</h6>
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input" name="gia" type="radio" id="gia-80" value="80">
                                <label for="gia-80" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <h6 style="color: #4f4f4f;font-weight:bold">Từ 8tr đến 10tr</h6>
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input" name="gia" type="radio" id="gia-100" value="100">
                                <label for="gia-100" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <h6 style="color: #4f4f4f;font-weight:bold">Trên 10tr</h6>
                                </label>
                            </div>  
                        </div>

                        <div style="text-align: center">
                            <button type="button" class="btn btn-danger" style="text-align: center" onclick="locsp02()">Lọc</button>                          
                        </div>

                        <!-- <p class="tieudenho" style="margin-left: 24px">Đánh giá</p>
                        <div style="margin-left: 24px;">
                            <div class="form-group">
                                <input class="form-check-input" name="danhgia" type="radio" id="dg-tatca" value="tatca" checked>
                                <label for="gia-tatca" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <h6 style="color: #4f4f4f;font-weight:bold">Tất cả</h6>
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input" name="danhgia" type="radio" id="dg-4" value="4">
                                <label for="dg-4" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <ul class="rating" style="display: inline-block;">
                                        <li><i class="fas fa-star yellow-text"></i></li>
                                        <li><i class="fas fa-star yellow-text"></i></li>
                                        <li><i class="fas fa-star yellow-text"></i></li>
                                        <li><i class="fas fa-star yellow-text"></i></li>
                                        <li><i class="fas fa-star yellow-text"></i></li>
                                    </ul>
                                    <h6 style="color: #4f4f4f;font-weight:bold;display: inline-block;margin-left: 5px">Trên 4 sao</h6>
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input" name="danhgia" type="radio" id="dg-34" value="34">
                                <label for="dg-34" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <ul class="rating" style="display: inline-block;">
                                        <li><i class="fas fa-star yellow-text"></i></li>
                                        <li><i class="fas fa-star yellow-text"></i></li>
                                        <li><i class="fas fa-star yellow-text"></i></li>
                                        <li><i class="fas fa-star yellow-text"></i></li>
                                        <li><i class="fas fa-star grey-text"></i></li>
                                    </ul>
                                    <h6 style="color: #4f4f4f;font-weight:bold;display: inline-block;margin-left: 5px">3 - 3.99</h6>
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input" name="danhgia" type="radio" id="dg-3" value="3">
                                <label for="dg-3" class="form-check-label dark-grey-text" onclick="locsp()">
                                    <ul class="rating" style="display: inline-block;">
                                        <li><i class="fas fa-star yellow-text"></i></li>
                                        <li><i class="fas fa-star yellow-text"></i></li>
                                        <li><i class="fas fa-star yellow-text"></i></li>
                                        <li><i class="fas fa-star grey-text"></i></li>
                                        <li><i class="fas fa-star grey-text"></i></li>
                                    </ul>
                                    <h6 style="color: #4f4f4f;font-weight:bold;display: inline-block;margin-left: 5px">Dưới 3 sao</h6>
                                </label>
                            </div>
                            
                        </div> -->
                        
                    </div>
                    <div class="col-sm-9" >
                        <div class="row p-3" style="width: 100%" id="locsp">
                            <?php
                                while ($row_tt = mysqli_fetch_array($query_tt)) {
                                    ?>           
                                    <div class="col-lg-4 col-md-12 mb-4">
                                        <div class="card card-ecommerce">
                                            <div class="view overlay">
                                                <div class="dienthoai02">
                                                    <div class="tab-pane fade show in active" id="panel31" role="tabpanel">
                                                <!-- MDB-Portfolio-Templates-Pack_4.8.11/html/culinary.html -->
                                                    <div class="view view-cascade overlay zoom">
                                                    <img src="./Images/AnhDT/<?php echo $row_tt['TenHinh'] ?>" style="padding: 10px" class="card-img-top">
                                                    </div>
                                                    <a href="?route=chitiet&id=<?php echo $row_tt['MaDT'] ?>">
                                                        <div class="mask rgba-white-slight"></div>
                                                    </a>
                                                    <h5 style="margin-left: 10px;font-size: 18px;font-weight: bold;margin-top: -30px"><?php echo $row_tt['TenDT'] ?></h5>
                                                    <?php
                                                        $sql_ttkm = "SELECT * FROM dienthoai WHERE MaDT = ".' '.$row_tt['MaDT'];
                                                        $query_ttkm = mysqli_query($mysqli, $sql_ttkm);
                                                        $row_ttkm = mysqli_fetch_array($query_ttkm);
                                                        if ($row_ttkm['TrangThaiKM'] == 1) {
                                                            ?>
                                                            <span class="badge badge-danger mb-2 ml-3"><?php echo $row_tt['TenTTKM'] ?></span>
                                                        <?php
                                                        }
                                                        else if ($row_ttkm['TrangThaiKM'] == 2) {
                                                            ?>
                                                            <span class="badge badge-info mb-2 ml-3"><?php echo $row_tt['TenTTKM'] ?></span>
                                                            <?php
                                                        }
                                                        else if ($row_ttkm['TrangThaiKM'] == 3) {
                                                            ?>
                                                            <span class="badge badge-warning mb-2 ml-3"><?php echo $row_tt['TenTTKM'] ?></span>
                                                            <?php
                                                        }
                                                    ?>
                                                    
                                                    <div class="row" style="width: 100%;">
                                                        <div class="col-sm-7 gia gia-dt" >
                                                        <p>&nbsp;&nbsp;<?php echo number_format($row_tt['GiaKhuyenMai'],0,"",".") ?>đ</p>
                                                        </div>
                                                        <?php
                                                            $sql_ttkm02 = "SELECT * FROM dienthoai WHERE MaDT = ".' '.$row_tt['MaDT'];
                                                            $query_ttkm02 = mysqli_query($mysqli, $sql_ttkm02);
                                                            $row_ttkm02 = mysqli_fetch_array($query_ttkm02);
                                                            if ($row_ttkm02['TrangThaiKM'] == 1 || $row_ttkm02['TrangThaiKM'] == 3) {
                                                                ?>
                                                                    <div class="col-sm-5 gia giagoc-dt">
                                                                    <p class=""><del><?php echo number_format($row_tt['GiaGoc'],0,"",".") ?>đ</del></p>
                                                                    </div>
                                                                <?php
                                                            }
                                                        ?>
                                                        
                                                    </div>
                                                    <div style="position:relative">
                                                        <ul class="rating" style="margin-left: 15px;">
                                                        <?php
                                                            $sql_diemdg = "SELECT ROUND(AVG(DiemDG)) diem FROM danhgia WHERE MaDT = ".' '.$row_tt['MaDT'];
                                                            $query_diemdg = mysqli_query($mysqli, $sql_diemdg);
                                                            $row_diemdg = mysqli_fetch_array($query_diemdg);
                                                            // echo '<p> '.$row_diemdg['diem'].' </p>';
                                                            for ($i = 1; $i <= $row_diemdg['diem']; $i++) {
                                                                ?>
                                                                    <li><i class="fas fa-star grey-text"></i></li>
                                                                <?php
                                                                }
                                                                    $khongdg = 5 - $row_diemdg['diem'];
                                                                for ($i = 1; $i <= $khongdg; $i++) {
                                                                ?>
                                                                        <li><i class="fas fa-star grey-text"></i></li>
                                                                    <?php
                                                            }
                                                                ?>
                                                                        <p style="position:absolute; right: 88px; bottom: -10px;font-size: 14px; color: black">(<?php
                                                                            $sql_luotdg = "SELECT COUNT(MaDG) luotdg FROM danhgia WHERE MaDT = ".' '.$row_tt['MaDT'];
                                                                            $query_luotdg = mysqli_query($mysqli, $sql_luotdg);
                                                                            $row_luotdg = mysqli_fetch_array($query_luotdg);
                                                                            echo $row_luotdg['luotdg'];
                                                                        ?>)</p>
                                                                <?php
                                                        ?>
                                                        </ul>
                                                        <p style="position:absolute; right: 15px; bottom: -10px; font-size: 14px; color: black">Đã bán: <b style="color: red">
                                                            <?php echo $row_tt['DaBan'] ?>
                                                        </b></p> 
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        
    </div>
    <div class="col-sm-1"></div>
    
</div>
</div>

<script>
    function locsp02() {
        var checkbox1 = document.getElementsByName("sapxep");
        for (var i=0; i < checkbox1.length; i++) {
            if (checkbox1[i].checked === true) {
                var sapxep = checkbox1[i].value;
            }
        }

        var checkbox2 = document.getElementsByName("hangsx");
        for (var i=0; i < checkbox2.length; i++) {
            if (checkbox2[i].checked === true) {
                var hangsx = checkbox2[i].value;
            }
        }

        var checkbox3 = document.getElementsByName("gia");
        for (var i=0; i < checkbox3.length; i++) {
            if (checkbox3[i].checked === true) {
                var gia = checkbox3[i].value;
            }
        }

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("locsp").innerHTML =(this.responseText); //=>kết quả trả về thêm vào element này, có html vẫn hiện được
            }
        };
        xmlhttp.open("GET", "locsptimkiem.php?sapxep=" + sapxep + "&hangsx=" + hangsx + "&gia=" + gia, true);
        xmlhttp.send();
    }
</script>