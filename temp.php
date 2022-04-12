<?php
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DB", "kinhdoanhdienthoai");
define("ROOT", dirname(__FILE__));
define("BASE_URL", "http://localhost/".ROOT."/");

class DB {
    protected $conn;
    function __construct()
	{
		$dsn = "mysql:host=" . HOST . "; dbname=" . DB;
		try {
			$this->conn = new PDO($dsn, USER, PASS);
			$this->conn->query("set names 'utf8' ");
		} catch (Exception $e) {
			echo 'Lỗi: ' . $e->getMessage();
			exit;
		}
	}
	public function __destruct()
	{
		$this->conn = null;
	}

	public function query($sql, $arr = array())
	{
		$stm = $this->conn->prepare($sql);
		$stm->execute($arr);
		$data = $stm->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}
}
class SQl extends DB {
    function reloadCartArea() {
        $_SESSION['soSPMua'] = 0;

        if (isset($_SESSION['ma_KH'])) {
            $sql_gioHang = "select * from giohang where maKH='".$_SESSION['ma_KH']."'";
            $gioHang = $this->query($sql_gioHang);

            if (count($gioHang)>0) {
                $_SESSION['soSPMua'] = count($gioHang);
            }  
        }
    }
}