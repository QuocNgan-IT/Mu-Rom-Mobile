<?php
include("./config.php");
include("./autoload.php");
include("./ham.php");
session_start();

?>

<!DOCTYPE html>
<html lang="en" id="test">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Mũ Rơm Mobile</title>
    <link rel="stylesheet" type="text/css" href="./css/trangchu/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <link href="./css/bootstrap03.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="./css/mdb03.min.css" rel="stylesheet">
    <!-- <link href="./css/mdb02.min.css" rel="stylesheet"> -->
    <style>
      :root {
          --color-1-: #B51E1E;
      }
    </style>
    <script>
        //Check password == confirm_password != null
        var check = function() {
            var pass = document.getElementById('password').value
            var cf_pass = document.getElementById('confirmPassword').value
            var regex = /([a-zA-Z])[a-zA-Z0-9]{3,}/

            if (pass==cf_pass && pass!='' && pass.match(regex)) {
                document.getElementById('confirmPassword').style.backgroundColor = '#00ff0080';
                // document.getElementById('message').innerHTML = 'matching';
            } else {
                document.getElementById('confirmPassword').style.backgroundColor = '#ff000080';
                // document.getElementById('message').innerHTML = 'not matching';
            }
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="bootstrap/jquery-3.5.1.min.js"></script>        
</head>
<body style="background-color: #eee" class="fixed-sn white-skin">
    <header>
        <div style="height: 72px; background-color:var(--color-1-);">
            <div>
                <a class="navbar-brand" href="./index.php">
                    <img src="./Images/logo.PNG">
                    
                </a>
                <p style="display:inline-block;color: white;font-weight:bold;font-size: 18px">ĐĂNG KÝ</p>
            </div>
        </div>
    </header>
    <main>
        <div class="container-fluid" style="margin-top: -66px">
            <!-- Section Sửa ảnh đại diện -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="card card-cascade narrower">
                            <div class="view view-cascade gradient-card-header mdb-color danger-color-dark">
                                <h5 class="mb-0 font-weight-bold">Ảnh đại diện</h5>
                            </div>
                            <div class="card-body card-body-cascade text-center">
                                <img src="./Images/photo-1-1599888048800211691483.jpg" alt="User Photo" class="z-depth-1 mb-3 mx-auto" width="120px" height="120px" />

                                <p class="text-muted"><small>Ảnh đại diện sẽ được thay đổi tự động</small></p>
                                <div class="row flex-center">
                                <button class="btn btn-info btn-rounded btn-sm">Cập nhật</button><br>
                                <!-- <button class="btn btn-danger btn-rounded btn-sm">Xóa</button> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 mb-4">
                        <form method="POST" action="action-dangky.php">
                        <div class="card card-cascade narrower">
                            <div class="view view-cascade gradient-card-header mdb-color danger-color-dark">
                                <h5 class="mb-0 font-weight-bold">Thông tin cá nhân</h5>
                            </div>

                            <div class="card-body card-body-cascade text-center">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="md-form mb-0">
                                                <input type="text" name="username" id="username" class="form-control validate" required>
                                                <label for="username" >Tên đăng nhập</label>
                                            </div> 
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="md-form mb-0">
                                                <input type="password" name="password" id="password" onkeyup='check();' class="form-control validate" pattern="^([a-zA-Z])[a-zA-Z0-9]{3,}" title="Tối thiểu 3 ký tự từ a-Z và 0-9, ký tự đầu tiên không phải số" required>
                                                <label for="password" >Mật khẩu</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="md-form mb-0">
                                                <input type="text" name="fullname" id="fullname" class="form-control validate" required>
                                                <label for="fullname" data-error="wrong" data-success="right">Họ tên khách hàng</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="md-form mb-0">
                                                <input type="password" name="confirmPassword" id="confirmPassword" onkeyup='check();' class="form-control validate" required>
                                                <label id="lb-cnfpass" for="confirmPassword" >Nhập lại mật khẩu</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="md-form mb-0">
                                                <input type="text" name="phone" id="phone" class="form-control validate" required>
                                                <label for="phone">Số điện thoại</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="md-form mb-0">
                                                <input type="email" name="email" id="email" class="form-control validate" required>
                                                <label for="email">Email</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="md-form mb-0">
                                                <textarea type="text" name="address" id="address" class="md-textarea form-control" rows="3" required></textarea>
                                                <label for="address">Địa chỉ</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 text-center my-4">
                                            <input type="submit" name="register" id="register" value="Đăng ký" class="btn btn-danger btn-rounded">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="./js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="./js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="./js/bootstrap.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="./js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script>
        // SideNav Initialization
        $(".button-collapse").sideNav();

        var container = document.querySelector('.custom-scrollbar');
        var ps = new PerfectScrollbar(container, {
        wheelSpeed: 2,
        wheelPropagation: true,
        minScrollbarLength: 20
        });

    </script>
</body>
</html>