<?php
    include("/xampp/htdocs/MuRomMobile/ket_noi.php");
    include("/xampp/htdocs/MuRomMobile/ham.php");   

    unset($_POST['login']);
    unset($_SESSION['xac_dinh_dang_nhap']);
    unset($_SESSION['username']);
    unset($_SESSION['maKH']);    
    reload_parent();
?>