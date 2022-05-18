<?php
include("./config.php");
include("./autoload.php");
session_start();

if(isset($_GET['sapxep']) && isset($_GET['hangsx']) && isset($_GET['gia'])) {
    $sapxep = $_GET['sapxep'];
    $hangsx = $_GET['hangsx'];
    $gia = $_GET['gia'];
}
else {
    $sapxep = "moinhat";
    $hangsx = "tatca";
    $gia = "tatca";
}

$sql_dt = "SELECT * FROM dienthoai, hinhanh WHERE dienthoai.MaDT = hinhanh.MaDT AND hinhanh.Hinh_index = 1 AND dienthoai.TenDT like'%samsung%'";

switch($sapxep) {
    case "moinhat":
        $sql_sx = " ORDER BY dienthoai.MaDT DESC";
        break;
    case "cunhat":
        $sql_sx = " ORDER BY dienthoai.MaDT ASC";
        break;
    case "banchay":
        $sql_sx = " ORDER BY dienthoai.DaBan DESC";
        break;
    case "giatang":
        $sql_sx = " ORDER BY dienthoai.GiaKhuyenMai ASC";
        break;
    case "giagiam":
        $sql_sx = " ORDER BY dienthoai.GiaKhuyenMai DESC";
        break;
    case "ten":
        $sql_sx = " ORDER BY dienthoai.TenDT ASC";
        break;
}

switch($gia) {
    case "tatca":
        $sql_gia = " ";
        break;
    case "3":
        $sql_gia = " AND dienthoai.GiaKhuyenMai < 3000000";
        break;
    case "35":
        $sql_gia = " AND dienthoai.GiaKhuyenMai < 5000000 AND dienthoai.GiaKhuyenMai >= 3000000";
        break;
    case "58":
        $sql_gia = " AND dienthoai.GiaKhuyenMai < 8000000 AND dienthoai.GiaKhuyenMai >= 5000000";
        break;
    case "80":
        $sql_gia = " AND dienthoai.GiaKhuyenMai < 10000000 AND dienthoai.GiaKhuyenMai >= 8000000";
        break;
    case "100":
        $sql_gia = " AND dienthoai.GiaKhuyenMai >= 10000000";
        break;
}

if($hangsx == "tatca") {
    $sql_hangsx = " ";
}
else {
    $sql_hangsx = " AND dienthoai.MaHang = $hangsx";
}

$sql_tt = $sql_dt.' '.$sql_gia.' '.$sql_hangsx.' '.$sql_sx;
$query_tt = mysqli_query($mysqli, $sql_tt);

// echo '<p>'.$sapxep.'</p>';
// echo '<p>'.$hangsx.'</p>';
// echo '<p>'.$gia.'</p>';
while($row_tt = mysqli_fetch_array($query_tt)) {
    $sql_ttkm = "SELECT * FROM dienthoai WHERE MaDT = ".' '.$row_tt['MaDT'];
    $query_ttkm = mysqli_query($mysqli, $sql_ttkm);
    $row_ttkm = mysqli_fetch_array($query_ttkm);

    $sql_ttkm02 = "SELECT * FROM dienthoai WHERE MaDT = ".' '.$row_tt['MaDT'];
    $query_ttkm02 = mysqli_query($mysqli, $sql_ttkm02);
    $row_ttkm02 = mysqli_fetch_array($query_ttkm02);

    $sql_diemdg = "SELECT ROUND(AVG(DiemDG)) diem FROM danhgia WHERE MaDT = ".' '.$row_tt['MaDT'];
    $query_diemdg = mysqli_query($mysqli, $sql_diemdg);
    $row_diemdg = mysqli_fetch_array($query_diemdg);

    $sql_luotdg = "SELECT COUNT(MaDG) luotdg FROM danhgia WHERE MaDT = ".' '.$row_tt['MaDT'];
    $query_luotdg = mysqli_query($mysqli, $sql_luotdg);
    $row_luotdg = mysqli_fetch_array($query_luotdg);

    echo '
    <div class="col-lg-4 col-md-12 mb-4">
        <div class="card card-ecommerce">
            <div class="view overlay">
                <div class="dienthoai02">
                    <div class="tab-pane fade show in active" id="panel31" role="tabpanel">
                <!-- MDB-Portfolio-Templates-Pack_4.8.11/html/culinary.html -->
                        <div class="view view-cascade overlay zoom">
                            <img src="./Images/AnhDT/'.$row_tt['TenHinh'].'" style="padding: 10px" class="card-img-top">
                        </div>
                        <a href="?route=chitiet&id='.$row_tt['MaDT'].'">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                        <h5 style="margin-left: 10px;font-size: 18px;font-weight: bold;margin-top: -30px">'.$row_tt['TenDT'].'</h5>
                        ';
                        if ($row_ttkm['TrangThaiKM'] == 1) {
                            echo '<span class="badge badge-danger mb-2 ml-3">'.$row_tt['TenTTKM'].'</span>';
                        }
                        else if ($row_ttkm['TrangThaiKM'] == 2) {
                            echo '<span class="badge badge-info mb-2 ml-3">'.$row_tt['TenTTKM'].'></span>';
                        }
                        else if ($row_ttkm['TrangThaiKM'] == 3) {
                            echo '<span class="badge badge-warning mb-2 ml-3">'.$row_tt['TenTTKM'].'</span>';
                        }
                        echo '
                        <div class="row" style="width: 100%;">
                            <div class="col-sm-7 gia gia-dt" >
                                <p>&nbsp;&nbsp;'.number_format($row_tt['GiaKhuyenMai'],0,"",".").'đ</p>
                            </div>';                                                        
                            if ($row_ttkm02['TrangThaiKM'] == 1 || $row_ttkm02['TrangThaiKM'] == 3) {
                                    echo '<div class="col-sm-5 gia giagoc-dt">
                                    <p class=""><del>'.number_format($row_tt['GiaGoc'],0,"",".").'đ</del></p>
                                    </div>';
                            }
                        
                        echo '</div>
                        <div style="position:relative">
                            <ul class="rating" style="margin-left: 15px;">';
                            
                            for ($i = 1; $i <= $row_diemdg['diem']; $i++) {
                                echo '<li><i class="fas fa-star grey-text"></i></li>';
                            }
                            $khongdg = 5 - $row_diemdg['diem'];
                            for ($i = 1; $i <= $khongdg; $i++) {
                                echo '<li><i class="fas fa-star grey-text"></i></li>';
                            }
                                echo '<p style="position:absolute; right: 100px; bottom: -10px;font-size: 14px; color: black">(
                                    '.$row_luotdg['luotdg'].'
                                )</p>';
                        echo '</ul>
                        <p style="position:absolute; right: 15px; bottom: -10px; font-size: 14px; color: black">Đã bán: <b style="color: red">
                            '.$row_tt['DaBan'].'
                        </b></p> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';
}

?>