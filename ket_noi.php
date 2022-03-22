<?php
/*
define('HOST','localhost');
define('USERNAME','root');
define('PASSWORD','');
define('DATABASE','kinhdoanhdienthoai');
define('SITEURL','http://localhost/KinhDoanhDienThoai/');
session_start();

function clearStringSql($value) {
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if($conn -> connect_error) {
        die("Kết nối CSDL thất bại!<br>--> ".$conn->connect_error);
        exit();
    }
    return $conn -> real_escape_string($value);
}

function execute($sql) {
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if($conn -> connect_error) {
        die("Kết nối CSDL thất bại!<br>--> ".$conn->connect_error);
        exit();
    }
    $result = mysqli_query($conn, $sql);
    $conn -> close();
    return $result;
}

function executeResult($sql) {
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if($conn -> connect_error) {
        return $conn -> connect_error;
    }
    $result = mysqli_query($conn, $sql);
    $data = array();
    while($row = mysqli_fetch_array($result, 1)){
        $data[] = $row;
    }
    $conn -> close();
    return $data;
}
    //Biện pháp tránh lỗi font khi dùng các phiên bản xampp khác nhau
    mysqli_set_charset($conn, 'utf8');
*/
?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//Test cái cũ
$server   = "localhost";               //Khai báo server
$username = "root";                 //Khai báo username
$password = "";                      //Khai báo password
$database = "kinhdoanhdienthoai";   //Khai báo database
$SITEURL = "http://localhost/MuRomMobile/";

// Kết nối database
$conn = new mysqli($server, $username, $password, $database);

//Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
if ($conn->connect_error) {
    die("Kết nối CSDL thất bại!<br>--> " . $conn->connect_error);
    exit();
}
//echo "Kết nối thành công!";

//Gán các biến database
$conn->select_db('kinhdoanhdienthoai');

//Biện pháp tránh lỗi font khi dùng các phiên bản xampp khác nhau
mysqli_set_charset($conn, 'utf8');
// if (!function_exists('your_function_name'))   {
//     function your_function_name()  {
//       ........
//     }
//   }
?>