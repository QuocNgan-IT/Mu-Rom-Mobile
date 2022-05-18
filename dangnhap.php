<?php
  include("./config.php");
  include("./autoload.php");
  // include("./xacdinhdangnhap.php");
  session_start();

  $conn = mysqli_connect("localhost", "root", "", "kinhdoanhdienthoai03") or die ('Không thể kết nối tới database');

  if(isset($_POST["uname"])&&isset($_POST["passwd"])){
    
    $sql = "select * from khachhang where username='".$_POST["uname"]."' and password='".$_POST["passwd"]."'";
    $kt = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
    
    if(
        is_null($kt) || !isset($kt) || empty($kt)
    ) $_SESSION["err"] = "Tên tài khoản hoặc mật khẩu sai";
    else{
        $_SESSION["khachhang"] = $kt[0];
        header("location:index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Mũ Rơm Mobile</title>
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="./css/mdb.min.css" rel="stylesheet">
    <!-- <link href="./css/mdb02.min.css" rel="stylesheet"> -->
    <style>
      :root {
          --color-1-: #B51E1E;
      }
    </style>
        
</head>
<body style="background-color: #eee">
    <header>
        <div style="height: 72px; background-color:var(--color-1-);">
            <div>
                <a class="navbar-brand" href="./index.php">
                    <img src="./Images/logo.PNG">
                    <p style="display:inline-block;color: white;font-weight:bold;font-size: 18px">ĐĂNG NHẬP</p>
                </a>
            </div>
        </div>
    </header>
    <main>
        <div class="row" style="width: 100%">
            <div class="col-sm-7" style="text-align: center;">
                <img src="./Images/logo-murommibie.png" alt="Mũ Rơm Mobile" width="500px" height="500px"
                style="margin-top: 60px;">
                <p class="tieudenho" style="margin-top: -90px">Chào mừng bạn đến với Mũ Rơm Mobile</p>
                
            </div>
            <div class="col-sm-4">
                <div class="card z-depth-1 widget-spacing p-5" style="margin-top: 95px">
                    <div class="p-3">
                        <p style="text-align: center;margin-top: 5px" class="tendt">ĐĂNG NHẬP</p>
                    </div>
                    <form action="" method="POST">
                        <div style="text-align: center">
                            <span class="text-danger">
                                <?php if(isset($_SESSION["err"])) {echo $_SESSION["err"]; unset($_SESSION["err"]);} ?> 
                            </span>
                        </div>
                        
                        <div class="md-form">
                            <i class="fas fa-user prefix grey-text"></i>
                            <input type="text" id="form3" name="uname" class="form-control" required>
                            <label for="form3">
                                Tên đăng nhập
                            </label>
                        </div>
                            
                        <div class="md-form" style="margin-top: 5px">
                            <i class="fas fa-lock prefix grey-text"></i>
                            <input type="password" id="form-pass" name="passwd" class="form-control" required>
                            <label for="form-pass">
                                Mật khẩu
                            </label>
                        </div>
                        <div style="text-align: center">
                            <input type="submit" value="Đăng nhập" class="btn btn-sm btn-danger">
                        </div>
                    </form>
                    

                    <p style="text-align: center;margin-top: 30px">Nếu chưa có tài khoản ?
                        <a href="dangky.php" style="color: red">Đăng ký</a>
                    </p>  
                </div>
            </div>
        </div>
    </main>
    

    <script type="text/javascript" src="./js/jquery-3.4.1.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="./js/popper.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="./js/mdb.min.js"></script>
</body>
</html>