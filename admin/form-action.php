<?php
include "connect.php";
include "ham.php";
session_start();

// Ảnh 
// // Thêm ảnh TempIndex    
if (isset($_FILES['anhIndex'])) { 
    $_SESSION['dontCleanTemp'] = true;
    // file name
    $filename = $_FILES['anhIndex']['name'];
    // Location
    $location = '../Images/Temp/' . $filename;        
    // Upload file
    if (move_uploaded_file($_FILES['anhIndex']['tmp_name'], $location)) {
        mysqli_query($conn, "DELETE FROM temp WHERE TempIndex='1'");
        mysqli_query($conn, "INSERT INTO temp VALUE(null,'$filename',1)");
    }     
}
// // Xóa ảnh index
if (isset($_GET['xoa_anhIndex']) && isset($_GET['path'])) {
    $_SESSION['dontCleanTemp'] = true;
    $path = $_GET['path'];
    mysqli_query($conn, "DELETE FROM temp WHERE TempIndex='1'");
    if (file_exists($path)) {
        unlink($path);
    }
}
// // Thêm ảnh khác
if (isset($_FILES['anhDT'])) { 
    $_SESSION['dontCleanTemp'] = true;
    // file name
    $filename = $_FILES['anhDT']['name'];
    // Location
    $location = '../Images/Temp/' . $filename;        
    // Upload file
    if (move_uploaded_file($_FILES['anhDT']['tmp_name'], $location)) {
        //mysqli_query($conn, "DELETE FROM temp WHERE TempIndex='1'");
        mysqli_query($conn, "INSERT INTO temp VALUE(null,'$filename',0)");
    }     
}
// // Xóa ảnh khác
if (isset($_GET['xoa_anh']) && isset($_GET['maTemp']) && isset($_GET['path'])) {
    $_SESSION['dontCleanTemp'] = true;
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
    $GPU        = $_POST['GPU'];
    $boNhoTrong = $_POST['boNhoTrong'];
    $RAM        = $_POST['RAM'];
    $cameraTruoc    = $_POST['cameraTruoc'];
    $cameraSau      = $_POST['cameraSau'];
    $pin            = $_POST['pin'];
    $SIM            = $_POST['SIM'];
    $moTa           = $_POST['moTa'];
    $tenUD1         = $_POST['tenUD1'];
    $tenUD2         = $_POST['tenUD2'];
    $tenUD3         = $_POST['tenUD3'];
    $tenUD4         = $_POST['tenUD4'];
    $ndUD1          = $_POST['ndUD1'];
    $ndUD2          = $_POST['ndUD2'];
    $ndUD3          = $_POST['ndUD3'];
    $ndUD4          = $_POST['ndUD4'];

    //table dienthoai: MaDT,TenDT,GiaGoc,GiaKhuyenMai,TrangThaiKM,TenTTKM,MoTa,SoLuong,DaBan,MaHang
    $sqlDienThoai = "INSERT INTO `dienthoai` VALUES(null,'$tenDT','$gia','$giaKM','$maTTKM','$tenTTKM','$moTa','$soLuong',0,'$hangsx')";

    mysqli_query($conn, $sqlDienThoai);

    //table cauhinhdt: MaCH,MaDT,ManHinh,CameraSau,CameraTruoc,RAM,BoNhoTrong,CPU,GPU,Pin,HDH,SIM,NamRaMat
    $sqlGetMaDT = $conn->query("SELECT MaDT FROM `dienthoai` ORDER BY MaDT DESC LIMIT 1")->fetch_array();

    $maDTnew = $sqlGetMaDT[0];

    $sqlCauHinh = "INSERT INTO `cauhinhdt` VALUES (null,'$maDTnew','$manHinh','$cameraSau','$cameraTruoc','$RAM','$boNhoTrong','$CPU','$GPU','$pin','$HDH','$SIM','$namRaMat')";

    mysqli_query($conn, $sqlCauHinh);

    //table uudiemdt: MaUD,TenUD,NoiDung,MaDT
    for ($i=1; $i<=4; $i++) {
        if (${"tenUD".$i} != "") {
            $tenUD = ${"tenUD".$i};
            $ndUD = ${"ndUD".$i};
            mysqli_query($conn, "INSERT INTO `uudiemdt` VALUES(null,'$i','$tenUD','$ndUD','$maDTnew')");
        }
    }

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

// Sửa điện thoại
// // Gọi form
if (isset($_POST['sua_dienthoai']) && isset($_POST['maDT'])) {
    $_SESSION['maDT-sua'] = $_POST['maDT'];
}
// // Sửa
if (isset($_POST['sua_dienThoai'])) {
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
    $GPU        = $_POST['GPU'];
    $boNhoTrong = $_POST['boNhoTrong'];
    $RAM        = $_POST['RAM'];
    $cameraTruoc    = $_POST['cameraTruoc'];
    $cameraSau      = $_POST['cameraSau'];
    $pin            = $_POST['pin'];
    $SIM            = $_POST['SIM'];
    $moTa           = $_POST['moTa'];
    $maDT           = $_POST['maDT'];
    $tenUD1         = $_POST['tenUD1'];
    $tenUD2         = $_POST['tenUD2'];
    $tenUD3         = $_POST['tenUD3'];
    $tenUD4         = $_POST['tenUD4'];
    $ndUD1          = $_POST['ndUD1'];
    $ndUD2          = $_POST['ndUD2'];
    $ndUD3          = $_POST['ndUD3'];
    $ndUD4          = $_POST['ndUD4'];

    //table dienthoai: MaDT,TenDT,GiaGoc,GiaKhuyenMai,TrangThaiKM,TenTTKM,MoTa,SoLuong,DaBan,MaHang
    $sqlDienThoai = "UPDATE `dienthoai` 
                    SET 
                        `TenDT`         = '$tenDT',
                        `GiaGoc`        = '$gia',
                        `GiaKhuyenMai`  = '$giaKM',
                        `TrangThaiKM`   = '$maTTKM',
                        `TenTTKM`       = '$tenTTKM',
                        `MoTa`          = '$moTa',
                        `SoLuong`       = '$soLuong',
                        `DaBan`         = 0,
                        `MaHang`        = '$hangsx'
                    WHERE `MaDT`        = '$maDT'";

    mysqli_query($conn, $sqlDienThoai);

    //table cauhinhdt: MaCH,MaDT,ManHinh,CameraSau,CameraTruoc,RAM,BoNhoTrong,CPU,GPU,Pin,HDH,SIM,NamRaMat
    $sqlCauHinh = "UPDATE `cauhinhdt`
                SET 
                    `ManHinh`           = '$manHinh',
                    `CameraSau`         = '$cameraSau',
                    `CameraTruoc`       = '$cameraTruoc',
                    `RAM`               = '$RAM',
                    `BoNhoTrong`        = '$boNhoTrong',
                    `CPU`               = '$CPU',
                    `GPU`               = '$GPU',
                    `Pin`               = '$pin',
                    `HDH`               = '$HDH',
                    `Sim`               = '$SIM',
                    `NamRaMat`          = '$namRaMat'
                WHERE `MaDT`            = '$maDT'";

    mysqli_query($conn, $sqlCauHinh);

    //Ưu điểm điện thoại
    $sqlGetUD = mysqli_query($conn, "SELECT * FROM `uudiemdt` WHERE `uudiemdt`.MaDT='$maDT'");
    while ($resultGetUD = mysqli_fetch_array($sqlGetUD)) {
        $stt = $resultGetUD['STT'];
        ${"sttUD".$stt} = $stt;
    }
    for ($i=1; $i<=4; $i++) {
        // Nếu STT hiện tại = $i -> có tồn tại UD -> Update
        if (isset(${"sttUD".$i})) {
            $tenUDi = ${"tenUD".$i};
            $ndUDi = ${"ndUD".$i};
            if ($tenUDi != "") {
                ${"sqlUuDiem".$i} = "UPDATE `uudiemdt`
                                    SET
                                        `TenUD`     = '$tenUDi',
                                        `NoiDung`   = '$ndUDi'
                                    WHERE `MaDT`    = '$maDT' AND `STT` = $i";
            } else {  //Nếu tên ưu điểm thứ $i trống -> delete
                ${"sqlUuDiem".$i} = "DELETE FROM `uudiemdt` WHERE `uudiemdt`.MaDT='$maDT' AND STT=$i";
            }             
        } else { // Nếu STT hiện tại != $i -> ko tồn tại UD -> Insert
            $tenUDi = ${"tenUD".$i};
            $ndUDi = ${"ndUD".$i};
            if ($tenUDi != "") {
                ${"sqlUuDiem".$i} = "INSERT INTO `uudiemdt`
                                VALUES(null,'$i','$tenUDi','$ndUDi','$maDT')";
            } else {  //Nếu tên ưu điểm thứ $i trống -> delete
                ${"sqlUuDiem".$i} = "DELETE FROM `uudiemdt` WHERE `uudiemdt`.MaDT='$maDT' AND STT=$i";
            }           
        }
    }

    mysqli_query($conn, $sqlUuDiem1);
    mysqli_query($conn, $sqlUuDiem2);
    mysqli_query($conn, $sqlUuDiem3);
    mysqli_query($conn, $sqlUuDiem4);

    //Đưa ảnh từ folder Temp -> folder AnhDT
    // // Clean ảnh cũ để thêm ảnh mới
    $sqlGetImage = mysqli_query($conn, "SELECT * FROM `hinhanh` WHERE MaDT='$maDT'");
    if (mysqli_num_rows($sqlGetImage) != 0) {
        while ($getImageArr = mysqli_fetch_array($sqlGetImage)) {
            $imageDir = "../Images/AnhDT/" . $getImageArr['TenAnh'];

            if (file_exists($imageDir)) {
                unlink($imageDir);
            }
        }
        mysqli_query($conn, "DELETE FROM `hinhanh` WHERE MaDT='$maDT'");
    }   

    $sqlGetTemp = mysqli_query($conn, "SELECT * FROM temp");    
    // // Temp -> Hinhanh
    while ($getTempArr = mysqli_fetch_array($sqlGetTemp)) {
        $index = $getTempArr['TempIndex'];
        $image = $getTempArr['TempData'];

        //table hinhanh: MaHinh,TenHinh,MaDT,Hinh_index        
        mysqli_query($conn, "INSERT INTO `hinhanh` VALUES(null,'$image','$maDT','$index')");

        $oldDir = "../Images/Temp/" . $image;
        $newDir = "../Images/AnhDT/" . $image;
        if (file_exists($oldDir)) {
            rename($oldDir,$newDir);
        }        
    }
    mysqli_query($conn, "DELETE FROM temp");
    $_SESSION['mess'] = "Sửa thành công!";
}
