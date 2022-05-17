<?php
    if(isset($_GET['route'])) {
        $route = $_GET['route'];
    }
    else {
        $route = "";
    }

    //Cần refresh lại trang để title hiển thị đúng

    switch($route) {
        case "chitiet":
            include("chitietdienthoai.php");            
            break;
        case "tatca":
            include("tatcadienthoai.php");            
            break;
        case "giohang":
            include("giohang.php");            
            break;
        case "trangcanhan":
            include("trangcanhan.php");            
            break;

        default:
            include("trangchu02.php");            
    }
?>