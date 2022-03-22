<?php
    function reload_parent() {
        echo "<script>
                window.opener.location.reload(true);
                self.close();
            </script>";
    exit();
    }

    function trang_truoc() {
        ?>
            <html>
                <head>
                    <meta charset="utf-8">
                    <title>Đang chuyển về trang trước</title>
                </head>

                <body>
                    <script type="text/javascript">
                        window.history.back();
                    </script>
                </body>
            </html>
        <?php
    }
    
    function thong_bao_html( $chuoi_thong_bao ) {        
        ?>
            <html>
                <head>
                    <meta charset="utf-8">
                    <title>Thông báo</title>
                </head>

                <body>
                    <script type="text/javascript">
                        alert("<?php echo $chuoi_thong_bao; ?>");
                    </script>
                    <?php echo trang_truoc(); ?>
                </body>
            </html>
        <?php
        /*?>
            <style>
                .alert {
                padding: 20px;
                background-color: #f44336;
                color: white;
                }

                .closebtn {
                margin-left: 15px;
                color: white;
                font-weight: bold;
                float: right;
                font-size: 22px;
                line-height: 20px;
                cursor: pointer;
                transition: 0.3s;
                }

                .closebtn:hover {
                color: black;
                }
            </style>
            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
            </div>
            <?php echo trang_truoc(); ?>
        <?php*/
        exit();
    }

    function thong_bao_html_chuyen_trang( $chuoi_thong_bao, $link_chuyen_trang ) {
        ?>
            <html>
                <head>
                    <meta charset="utf-8">
                    <title>Thông báo</title>
                </head>

                <body>
                    <script type="text/javascript">
                        alert("<?php echo $chuoi_thong_bao; ?>");
                        window.location = "<?php echo $link_chuyen_trang; ?>";
                    </script>
                </body>
            </html>
        <?php
        exit();
    }                                               
?>