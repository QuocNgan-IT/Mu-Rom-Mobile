<?php
    if( isset($_GET['route']) ) {
        $route = $_GET['route'];
    }
    else {
        $route = "";
    }

    switch($route) {
        case "chi_tiet_san_pham":
            include("san_pham/chi_tiet_san_pham.php");
            break;
            
        case "tim_kiem":
            include("chuc_nang/tim_kiem/xuat_sp_tim_kiem.php");
            break;   

        case "gio_hang":
            include("chuc_nang/gio_hang/gio_hang.php");
            break;
            
        case "them_vao_gio":
            include("chuc_nang/gio_hang/them_vao_gio.php");
            break;

        case "delete":
            include("chuc_nang/gio_hang/xoa_khoi_gio.php");
            break;

        case "index":
            header("location:$SITEURL");
            break;

        default:
            include("san_pham/xuat_toan_bo_san_pham.php");
    }
?>