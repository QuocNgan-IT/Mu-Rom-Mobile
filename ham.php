<?php
    include("/xampp/htdocs/MuRomMobile/ket_noi.php");

    function reload_parent() {
        echo "<script>
                window.opener.location.reload(true);
                self.close();
            </script>";
    exit();
    }
    
    function Notification($notification_str) {
        ?>
            <script type="text/javascript">
                alert("<?php echo $notification_str; ?>");
            </script>
        <?php
    }  
    function NotificationAndGoback($notification_str) {
        ?>
            <script type="text/javascript">
                alert("<?php echo $notification_str; ?>");
                window.history.back();
            </script>
        <?php
    }  
    function NotificationAndGoto($notification_str, $goto) {
        ?>
            <script type="text/javascript">
                alert("<?php echo $notification_str; ?>");
                window.location = "<?php echo $goto; ?>";
            </script>
        <?php
    } 
    
    
?>