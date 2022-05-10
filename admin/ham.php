<?php
include "connect.php";
session_start();

function ReloadContent($content) {
    ?><script type="text/javascript">
        alert("$content");
        $("#content").load("<?php echo $content . ".php" ?>");
    </script><?php
}