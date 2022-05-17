<?php
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
function Goback() {
    ?>
        <script type="text/javascript">
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