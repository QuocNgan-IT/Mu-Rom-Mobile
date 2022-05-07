<?php
    include("/xampp/htdocs/MuRomMobile/ket_noi.php");
    include("/xampp/htdocs/MuRomMobile/ham.php");
    include("/xampp/htdocs/MuRomMobile/temp.php");

    if (isset($_POST['btnComment'])) {
        $comment = $_POST['comment'];
        $maKH = $_SESSION['maKH'];
        $maDT = $_POST['maDT'];

        //table comment: MaBL,NoiDung,MaKH,MaDT
        $conn->query("insert into comment value(null,'$comment','$maKH','$maDT');");
        Goback();
    }
?>