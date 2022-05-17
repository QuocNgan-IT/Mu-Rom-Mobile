<?php
    if (isset($_GET['maDTXoa'])) {
        $maDTXoa = $_GET['maDTXoa'];
        $conn->query("delete from giohang where MaDT='$maDTXoa'");

        //Cập nhật lại số SP mua
        (new SQL)->reloadCartArea(); 
        reload_parent();
    }
?>