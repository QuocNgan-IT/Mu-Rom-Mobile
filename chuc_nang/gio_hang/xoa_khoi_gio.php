<?php
    if (isset($_GET['MaDT_xoa'])) {
        for ($i=0; $i<count($_SESSION['MaDT_mua']); $i++) {
            if ($_SESSION['MaDT_mua'][$i] == $_GET['MaDT_xoa']) {
                unset($_SESSION['MaDT_mua'][$i]);
                //$_SESSION['SL_mua'][$i] = 0;

                $maDT_xoa = $_GET['MaDT_xoa'];
                $conn->query("delete
                            from giohang
                            where MaDT='$maDT_xoa'");

                reload_parent();
            }
        }
    }
?>