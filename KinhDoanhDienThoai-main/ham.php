<?php
    function reload_parent() {
        echo "<script>
                window.opener.location.reload(true);
                self.close();
            </script>";
    exit();
    }
?>