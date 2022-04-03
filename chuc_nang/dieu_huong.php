<?php
    if( isset($_GET['thamso']) ) {
        $tham_so = $_GET['thamso'];
    }
    else {
        $tham_so = "";
    }

    switch( $tham_so ) {
        // case "xuat_san_pham":
        //     include("chuc_nang/san_pham/xuat_theo_danh_muc.php");
        //     break;

        case "chi_tiet_san_pham":
            include("san_pham/chi_tiet_san_pham.php");
            break;

        // case "xuat_mot_tin":
        //     include("chuc_nang/xuat_mot_tin.php");
        //     break;
          
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

        default:
            include("san_pham/xuat_toan_bo_san_pham.php");
    }
?>