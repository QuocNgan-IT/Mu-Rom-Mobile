<?php
include "connect.php";
session_start();

$sql_address = "SELECT * FROM `diachikh`";
$sql = "SELECT * FROM `khachhang`";

if (isset($_GET['search']) && isset($_GET['key'])) {
    $key = $_GET['key'];
    $sql = "SELECT * FROM `khachhang` WHERE HoTenKH LIKE '%$key%'";
}


$result_address = mysqli_query($conn, $sql_address);
$result = mysqli_query($conn, $sql);

?>

<script src="bootstrap/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        // Search
        $("#form-search").click(function(e) {
            e.preventDefault();

            var key = $("#search").val();

            $.get("khachhang.php", {
                key: key,
                search: true
            }, function(data) {
                $("#content").html(data);
            });

        });

        // Close
        $(".icon-close").click(function() {
            $(".form").hide(500);
            $(".form-layout").hide();
        });

        $(".message-overlay").click(function(e) {
            $(".message").hide(500);
            $(".message-overlay").hide();
        });
    });
</script>
<?php if (isset($_SESSION['mess'])) {
    echo '<span class="message-overlay"></span>';
    echo '<span class="message">' . $_SESSION['mess'] . '</span>';
    unset($_SESSION['mess']);
} ?>
<div class="row">
    <div class="col">
        <div class="list-personnel">
            <div class="row">
                <span class="list-personnel__title"> Danh sách khách hàng </span>
            </div>
            <div class="row align-items-center justify-content-end">
                <div class="col-3">
                    <form action="">
                        <input type="text" name="" id="search" class="form-input" placeholder="Search" />
                        <button type="submit" class="form-search" id="form-search">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Mã KH</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">SĐT</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $key) : ?>
                        <tr>
                            <th scope="row"><?php echo $key['MaKH'] ?></th>
                            <td><?php echo $key['HoTenKH'] ?></td>
                            <td>
                                <?php
                                foreach ($result_address as $key_1) :
                                    if ($key_1['MaKH'] == $key['MaKH']) {
                                        echo '<li> - ' . $key_1['DiaChi'] . '</li>';
                                    }
                                endforeach;
                                ?>
                            </td>
                            <td><?php echo $key['SoDienThoai'] ?></td>
                            <td><?php echo $key['Email'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="form-layout"></div>
