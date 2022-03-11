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
            
        // case "them_vao_gio":
        //     include("chuc_nang/gio_hang/them_vao_gio.php");

        // case "gio_hang":
        //     include("chuc_nang/gio_hang/gio_hang.php");
        //     break;

        // case "dang_xuat":
        //     include("chuc_nang/dang_nhap/dang_xuat.php");
            //thong_bao_html_chuyen_trang("Bạn đã đăng xuất !", "index.php");
            //Ko break ở đây là để khi đăng xuất thì trang web tải lại phần slideshow     

        default:
         //   include("chuc_nang/slideshow/slideshow.php");
            include("san_pham/xuat_toan_bo_san_pham.php");
    }
?>