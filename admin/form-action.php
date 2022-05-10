<?php
include "connect.php";
include "ham.php";
session_start();

// Ảnh 
// // Thêm ảnh TempIndex    
if (isset($_FILES['anhIndex-them'])) { 
    // file name
    $filename = $_FILES['anhIndex-them']['name'];
    // Location
    $location = '../Images/Temp/' . $filename;        
    // Upload file
    if (move_uploaded_file($_FILES['anhIndex-them']['tmp_name'], $location)) {
        mysqli_query($conn, "DELETE FROM temp WHERE TempIndex='1'");
        mysqli_query($conn, "INSERT INTO temp VALUE(null,'$filename',1)");
    }     
}
// // Xóa ảnh index
if (isset($_GET['xoa_anhIndex']) && isset($_GET['path'])) {
    $path = $_GET['path'];
    mysqli_query($conn, "DELETE FROM temp WHERE TempIndex='1'");
    if (file_exists($path)) {
        unlink($path);
    }
}
// // Thêm ảnh khác
if (isset($_FILES['anhDT-them'])) { 
    // file name
    $filename = $_FILES['anhDT-them']['name'];
    // Location
    $location = '../Images/Temp/' . $filename;        
    // Upload file
    if (move_uploaded_file($_FILES['anhDT-them']['tmp_name'], $location)) {
        //mysqli_query($conn, "DELETE FROM temp WHERE TempIndex='1'");
        mysqli_query($conn, "INSERT INTO temp VALUE(null,'$filename',0)");
    }     
}
// // Xóa ảnh khác
if (isset($_GET['xoa_anh']) && isset($_GET['maTemp']) && isset($_GET['path'])) {
    $maTemp = $_GET['maTemp'];
    $path = $_GET['path'];
    mysqli_query($conn, "DELETE FROM temp WHERE MaTemp='$maTemp'");
    if (file_exists($path)) {
        unlink($path);
    }
}

// // Thêm điện thoại
if (isset($_POST['them_dienThoai'])) {
    $tenDT      = $_POST['tenDT'];
    $soLuong    = $_POST['soLuong'];
    $gia        = $_POST['gia'];
    $giaKM      = $_POST['giaKM'];
    $maTTKM     = $_POST['maTTKM'];
    $tenTTKM    = $_POST['tenTTKM'];
    $hangsx     = $_POST['hangsx'];
    $namRaMat   = $_POST['namRaMat'];
    $manHinh    = $_POST['manHinh'];
    $HDH        = $_POST['HDH'];
    $CPU        = $_POST['CPU'];
    $boNhoTrong = $_POST['boNhoTrong'];
    $RAM        = $_POST['RAM'];
    $cameraTruoc    = $_POST['cameraTruoc'];
    $cameraSau      = $_POST['cameraSau'];
    $pin            = $_POST['pin'];
    $SIM            = $_POST['SIM'];
    $moTa           = $_POST['moTa'];

    //table dienthoai: MaDT,TenDT,GiaGoc,GiaKhuyenMai,TrangThaiKM,TenTTKM,MoTa,SoLuong,DaBan,MaHang
    $sqlDienThoai = "INSERT INTO `dienthoai` VALUES(null,'$tenDT','$gia','$giaKM','$maTTKM','$tenTTKM','$moTa','$soLuong',0,'$hangsx')";

    mysqli_query($conn, $sqlDienThoai);

    //table cauhinhdt: MaCH,MaDT,ManHinh,CameraSau,CameraTruoc,RAM,BoNhoTrong,CPU,GPU,Pin,HDH,SIM,NamRaMat
    $sqlGetMaDT = $conn->query("SELECT MaDT FROM `dienthoai` ORDER BY MaDT DESC LIMIT 1")->fetch_array();

    $maDTnew = $sqlGetMaDT[0];

    $sqlCauHinh = "INSERT INTO `cauhinhdt` VALUES (null,'$maDTnew','$manHinh','$cameraSau','$cameraTruoc','$RAM','$boNhoTrong','$CPU','$GPU','$pin','$HDH','$SIM','$namRaMat')";

    mysqli_query($conn, $sqlCauHinh);

    //Đưa ảnh từ folder Temp -> folder AnhDT
    $sqlGetTemp = mysqli_query($conn, "SELECT * FROM temp");

    while ($getTempArr = mysqli_fetch_array($sqlGetTemp)) {
        $index = $getTempArr['TempIndex'];
        $image = $getTempArr['TempData'];

        //table hinhanh: MaHinh,TenHinh,MaDT,Hinh_index
        mysqli_query($conn, "INSERT INTO `hinhanh` VALUES(null,'$image','$maDTnew','$index')");

        $oldDir = "../Images/Temp/" . $image;
        $newDir = "../Images/AnhDT/" . $image;
        if (file_exists($oldDir)) {
            rename($oldDir,$newDir);
        }        
    }
    mysqli_query($conn, "DELETE FROM temp");
    $_SESSION['mess'] = "Thêm thành công!";
}
