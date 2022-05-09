<?php
include "connect.php";
session_start();

// Login 
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $test_password_admin = md5($password);
    if ($username == '' || $password == '') {
        header("refresh:0; url= index.php");
    }
    if ($username == 'admin' && $test_password_admin == md5('MuRom123')) {
        $_SESSION['admin'] = true;
        header("refresh:0; url= admin.php");
    } else {
        $sql = "SELECT * FROM `nhanvien` WHERE Username ='$username'";
        $temp = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($temp);
        $hash = $row['Password'];
        $check_login = mysqli_num_rows($temp);

        if (password_verify($password, $hash)) {

            $_SESSION['MSNV'] = $row['MSNV'];
            header("refresh:0; url= nv.php");
        } else {
            header("refresh:0; url= index.php");
        }
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
}

// Order
// // Add Order

if (isset($_GET['sub_add_order']) && isset($_SESSION['cart_product']) && isset($_SESSION['cart_MSKH'])) {

    $MSKH = $_SESSION['cart_MSKH'];
    $MSNV = $_SESSION['MSNV'];
    $data_product = $_SESSION['cart_product'];
    $today = date("Y-m-d");

    $sql_add = "INSERT INTO `dathang` (`SoDonDH`, `MSKH`, `MSNV`, `NgayDH`, `NgayGH`) 
                    VALUES (NULL, '$MSKH', '$MSNV', '$today', NULL)";

    mysqli_query($conn, $sql_add);

    $sql_SoDonDH = "SELECT * FROM `dathang` WHERE MSKH='$MSKH' && MSNV='$MSNV' && NgayDH='$today' ORDER BY SoDonDH DESC";
    $temp = mysqli_query($conn, $sql_SoDonDH);
    $result = mysqli_fetch_assoc($temp);
    $SoDonDH = $result['SoDonDH'];

    foreach ($data_product as $key) :
        foreach ($key as $result) :
            $MSHH = $result['MSHH'];
            $SoLuong = $result['quantity'];
            $Gia = $result['price'];
            $Giam = $result['discount'];

            $sql_detail = "INSERT INTO `chitietdathang` (`SoDonDH`, `MSHH`, `SoLuong`, `GiaDatHang`, `GiamGia`) 
                                VALUES ('$SoDonDH', '$MSHH', '$SoLuong', '$Gia', '$Giam')";
            mysqli_query($conn, $sql_detail);
        endforeach;
    endforeach;

    unset($_SESSION['cart_MSKH']);
    unset($_SESSION['cart_product']);

    $_SESSION['mess'] = "Thêm đơn hàng thành công!";
}


// Customer
// // Add Customer

if (isset($_GET['sub_add_customer'])) {
    $name = $_GET['name'];
    $company = $_GET['company'];
    $n_phone = $_GET['n_phone'];
    $email = $_GET['email'];
    $address = $_GET['address'];

    $sql_add = "INSERT INTO `khachhang` (`MSKH`, `HoTenKH`, `TenCongTy`, `DiaChi`, `SoDienThoai`, `Email`) 
                    VALUES (NULL, '$name', '$company', '$address', '$n_phone', '$email')";

    mysqli_query($conn, $sql_add);

    $sql_MSKH = "SELECT * FROM `khachhang` WHERE HoTenKH='$name' && TenCongTy='$company' && DiaChi='$address' && SoDienThoai='$n_phone' && Email='$email'";
    $temp = mysqli_query($conn, $sql_MSKH);
    $result = mysqli_fetch_assoc($temp);
    $MSKH = $result['MSKH'];

    $sql_address = "INSERT INTO `diachikh` (`MaDC`, `DiaChi`, `MSKH`) VALUES (NULL, '$address', '$MSKH')";
    mysqli_query($conn, $sql_address);

    $_SESSION['mess'] = "Thêm khách hàng thành công";
}

// // Edit Customer

if (isset($_GET['sub_edit_customer']) && isset($_GET['MSKH'])) {

    $MSKH = $_GET['MSKH'];
    $name = $_GET['name'];
    $company = $_GET['company'];
    $n_phone = $_GET['n_phone'];
    $email = $_GET['email'];

    $sql_edit = "UPDATE `khachhang` 
                    SET `HoTenKH` = '$name', 
                        `TenCongTy` = '$company', 
                        `SoDienThoai` = '$n_phone', 
                        `Email` = '$email' 
                WHERE `khachhang`.`MSKH` = '$MSKH'";

    mysqli_query($conn, $sql_edit);

    $_SESSION['mess'] = "Chỉnh sửa khách hàng thành công";
}

// // Delete Customer

if (isset($_GET['sub_del_customer']) && isset($_GET['MSKH'])) {
    $MSKH = $_GET['MSKH'];

    $sql_delete = "DELETE FROM `khachhang` WHERE `khachhang`.`MSKH` = '$MSKH'";
    $sql_delete_address = "DELETE FROM `diachikh` WHERE `diachikh`.`MSKH` = '$MSKH'";

    mysqli_query($conn, $sql_delete_address);
    mysqli_query($conn, $sql_delete);

    $_SESSION['mess'] = "Xóa khách hàng thành công";
}

// // Add Customer Address
if (isset($_GET['sub_add_customer_address']) && isset($_GET['MSKH'])) {
    $MSKH = $_GET['MSKH'];
    $address = $_GET['address'];

    $sql_add = "INSERT INTO `diachikh` (`MaDC`, `DiaChi`, `MSKH`) VALUES (NULL, '$address', '$MSKH')";
    mysqli_query($conn, $sql_add);

    $sql_MaDC = "SELECT * FROM `diachikh` WHERE DiaChi='$address' && MSKH ='$MSKH'";
    $temp_MaDC = mysqli_query($conn, $sql_MaDC);
    $MaDC = mysqli_fetch_assoc($temp_MaDC);

    echo $MaDC['MaDC'];

    $_SESSION['mess'] = "Thêm địa chỉ thành công";
}

// // Delete Customer Address
if (isset($_GET['sub_del_customer_address']) && isset($_GET['MaDC'])) {
    $MaDC = $_GET['MaDC'];

    $sql_delete = "DELETE FROM `diachikh` WHERE `diachikh`.`MaDC` = '$MaDC'";
    mysqli_query($conn, $sql_delete);

    $_SESSION['mess'] = "Xóa địa chỉ thành công";
}

// Personnel
// // Check Username 
if (isset($_GET['check_username_personnel']) && isset($_GET['Username'])) {
    $Username = $_GET['Username'];

    $sql_edit = "SELECT * FROM `nhanvien` WHERE Username = '$Username'";
    $result = mysqli_query($conn, $sql_edit);
    if (mysqli_num_rows($result) == 1)
        echo 1;
    else
        echo 0;
}
// // Edit Personnel

if (isset($_GET['sub_edit_personnel']) && isset($_GET['MSNV'])) {
    $MSNV = $_GET['MSNV'];
    $name = $_GET['name'];
    $n_phone = $_GET['n_phone'];
    $address = $_GET['address'];
    $position = $_GET['position'];

    $sql_edit = "UPDATE `nhanvien` SET `HoTenNV` = '$name', `ChucVu` = '$position', `DiaChi` = '$address', `SoDienThoai` = '$n_phone' WHERE `nhanvien`.`MSNV` = '$MSNV'";
    mysqli_query($conn, $sql_edit);

    $_SESSION['mess'] = "Chỉnh sửa nhân viên thành công";
}

// // Add Personnel

if (isset($_GET['sub_add_personnel'])) {

    $name = $_GET['name'];
    $n_phone = $_GET['n_phone'];
    $address = $_GET['address'];
    $position = $_GET['position'];
    $username = $_GET['username'];
    $temp_password = $_GET['password'];
    $password = password_hash($temp_password, PASSWORD_BCRYPT);

    $sql_add = "INSERT INTO `nhanvien` (`HoTenNV`, `ChucVu`, `DiaChi`, `SoDienThoai`, `Username`, `Password`) VALUES ('$name', '$position', '$address', '$n_phone', '$username', '$password')";
    mysqli_query($conn, $sql_add);

    $_SESSION['mess'] = "Thêm nhân viên thành công";
}

// // Delete Personnel
if (isset($_GET['sub_del_personnel']) && isset($_GET['MSNV'])) {
    $MSNV = $_GET['MSNV'];

    $sql_delete = "DELETE FROM `nhanvien` WHERE `nhanvien`.`MSNV` = '$MSNV'";
    mysqli_query($conn, $sql_delete);

    $_SESSION['mess'] = "Xóa nhân viên thành công";
}


// Category
// // Them hangsx
if (isset($_GET['them_hangsx'])) {
    $name = $_GET['name'];

    $sql_add = "INSERT INTO `hangsx` (`TenHang`,`anh_hangsx`) VALUES ('$name','null')";
    mysqli_query($conn, $sql_add);

    $_SESSION['mess'] = "Thêm hãng điện thoại thành công";
}

// // Edit Category
if (isset($_GET['sua_hangsx']) && isset($_GET['MaHang'])) {
    $name = $_GET['name'];
    $MaHang = $_GET['MaHang'];

    $sql_edit = "UPDATE `hangsx` SET `TenHang`='$name' WHERE `hangsx`.`MaHang`='$MaHang'";
    mysqli_query($conn, $sql_edit);

    $_SESSION['mess'] = "Chỉnh sửa hãng điện thoại thành công";
}

// // Xoa hangsx
if (isset($_GET['xoa_hangsx']) && isset($_GET['MaHang'])) {
    $MaHang = $_GET['MaHang'];

    $sql_delete = "DELETE FROM `hangsx` WHERE `hangsx`.`MaHang` = '$MaHang'";
    mysqli_query($conn, $sql_delete);

    $_SESSION['mess'] = "Xóa hãng điện thoại thành công";
}

// Product
// // Edit Product
if (isset($_GET['sub_edit_product']) && isset($_GET['MSHH'])) {

    $MSHH = $_GET['MSHH'];
    $name = $_GET['name'];
    $rule = $_GET['rule'];
    $quantity = $_GET['quantity'];
    $price = $_GET['price'];
    $category = $_GET['category'];
    $description = $_GET['description'];

    $sql_list_product_edit = "UPDATE `hanghoa` 
        SET 
            `TenHH` = '$name', 
            `QuyCach` = '$rule', 
            `SoLuongHang` = '$quantity', 
            `Gia` = '$price', 
            `MaLoaiHang` = '$category', 
            `GhiChu` = '$description'
        WHERE `hanghoa`.`MSHH` = '$MSHH'";
    mysqli_query($conn, $sql_list_product_edit);

    $_SESSION['mess'] = "Chỉnh sửa sản phẩm thành công";
}

// // Add Product

if (isset($_GET['sub_add_product'])) {
    $name = $_GET['name'];
    $rule = $_GET['rule'];
    $quantity = $_GET['quantity'];
    $price = $_GET['price'];
    $category = $_GET['category'];
    $description = $_GET['description'];

    $sql_list_product_add = "INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`) 
    VALUES (NULL, '$name', '$rule', '$price', '$quantity', '$category', '$description')";
    mysqli_query($conn, $sql_list_product_add);

    $_SESSION['mess'] = "Thêm sản phẩm thành công";
}

// // Delete Product
if (isset($_GET['sub_del_product']) && isset($_GET['MSHH'])) {
    $MSHH = $_GET['MSHH'];

    $sql_list_product_delete = "DELETE FROM `hanghoa` WHERE `hanghoa`.`MSHH` = '$MSHH'";
    mysqli_query($conn, $sql_list_product_delete);

    $_SESSION['mess'] = "Xóa sản phẩm thành công";
}

// Revenue
if (isset($_GET['add_revenue'])) {

    $today = date("Y-m-d");

    $product = $_GET['product'];
    $order = $_GET['order'];
    $revenue = $_GET['revenue'];

    $sql = "INSERT INTO `doanhthu` (`Ngay`, `DoanhThu`, `SoDonHang`, `SoSanPham`) VALUES ('$today', '$revenue', '$order', '$product')";
    mysqli_query($conn, $sql);

    $_SESSION['mess'] = "Đóng ca thành công";
}

// Chart
// // Product Chart
if (isset($_GET['data_product_chart'])) {
    header('Content-Type: application/json');
    $today = date("Y-m-d");

    $result_product_day = array();
    $sql_category = "SELECT * FROM `loaihanghoa`";
    $result_category = mysqli_query($conn, $sql_category);
    foreach ($result_category as $key) :
        $sql_product_day = "SELECT  TenLoaiHang, SUM(SoLuong) as SoLuong
                      FROM `chitietdathang`, `dathang`, `loaihanghoa`, `hanghoa` 
                      WHERE chitietdathang.SoDonDH = dathang.SoDonDH && 
                            chitietdathang.MSHH = hanghoa.MSHH && 
                            hanghoa.MaLoaiHang = loaihanghoa.MaLoaiHang && 
                            NgayDH = '$today' && 
                            loaihanghoa.MaLoaiHang = " . $key['MaLoaiHang'];
        $temp_product_day = mysqli_query($conn, $sql_product_day);
        $product_day = mysqli_fetch_assoc($temp_product_day);
        $result_product_day[] = $product_day;
    endforeach;

    echo json_encode($result_product_day);
}

// // Revenue Chart
if (isset($_GET['data_revenue_chart'])) {
    header('Content-Type: application/json');
    $today = date("Y-m-d");

    $result_revenue = array();
    $sql_revenue = "SELECT Ngay, DoanhThu FROM `doanhthu` ORDER BY Ngay DESC LIMIT 7";
    $temp_revenue = mysqli_query($conn, $sql_revenue);
    foreach ($temp_revenue as $key) :
        $result_revenue[] = $key;
    endforeach;

    echo json_encode($result_revenue);
}

// // Product Order Chart
if (isset($_GET['data_product_order_chart'])) {
    header('Content-Type: application/json');
    $today = date("Y-m-d");

    $result_product_order = array();
    $sql_product_order = "SELECT Ngay, SoSanPham, SoDonHang FROM `doanhthu` ORDER BY Ngay DESC LIMIT 7";
    $temp_product_order = mysqli_query($conn, $sql_product_order);
    foreach ($temp_product_order as $key) :
        $result_product_order[] = $key;
    endforeach;

    echo json_encode($result_product_order);
}