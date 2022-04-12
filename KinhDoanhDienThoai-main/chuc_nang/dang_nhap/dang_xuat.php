<?php
    include("/xampp/htdocs/KinhDoanhDienThoai/ket_noi.php");
    include("/xampp/htdocs/KinhDoanhDienThoai/ham.php");    

    unset($_POST['login']);
    unset($_SESSION['xac_dinh_dang_nhap']);
    //$_SESSION['xac_dinh_dang_nhap'] = "khong";      
    reload_parent();
?>