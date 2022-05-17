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
        // Validate
        var check_name = true; //form edit
        var check_company = true; //form edit
        var check_n_phone = true; //form edit
        var check_email = true; //form edit
        var check_address = false; //form add address
        // Name
        $(".name").keyup(function(e) {
            var value = $(this).val();
            if (value.length == 0 || value.length > 25) {
                if (value.length == 0) $(".error_name").text("*Vui lòng nhập họ tên!");
                if (value.length > 25) $(".error_name").text("*Họ tên không được quá 25 ký tự");
                check_name = false;
            } else {
                $(".error_name").text("");
                check_name = true;
            }
        });

        // Company 
        $(".company").keyup(function(e) {
            var value = $(this).val();
            if (value.length == 0 || value.length > 25) {
                if (value.length == 0) $(".error_company").text("*Vui lòng nhập tên công ty!");
                if (value.length > 0) $(".error_company").text("*Tên công ty không quá 25 ký tự!");
                check_company = false;

            } else {
                $(".error_company").text("");
                check_company = true;

            }
        });

        // Phone
        $(".n_phone").keyup(function(e) {
            var value = $(this).val();

            if (value.length != 10) {
                if (value.length != 10) $(".error_n_phone").text("*Số điện thoại phải có 10 ký tự!");
                check_n_phone = false;

            } else {
                $(".error_n_phone").text("");
                check_n_phone = true;

            }
        });

        // Email
        $(".email").keyup(function(e) {
            var value = $(this).val();
            var check_mail = value.indexOf('@gmail.com');
            if (value.length == 0 || check_mail == -1) {
                if (value.length == 0) $(".error_email").text("*Vui lòng nhập email!");
                if (check_mail == -1) $(".error_email").text("*Email phải có dạng ...@gmail.com!");
                check_email = false;

            } else {
                $(".error_email").text("");
                check_email = true;

            }
        });

        // Address
        $(".address").keyup(function(e) {
            var value = $(this).val();

            if (value.length == 0 || value.length > 100) {
                if (value.length == 0) $(".error_address").text("*Vui lòng nhập địa chỉ!");
                if (value.length > 100) $(".error_address").text("*Địa chỉ quá dài  !");
                check_address = false;

            } else {
                $(".error_address").text("");
                check_address = true;

            }
        });

        // Edit Customer
        $(".edit-customer").click(function() {
            var MSKH = $(this).attr("MSKH");

            $.post("customer.php", {
                    id: MSKH,
                    edit_customer: true
                },
                function(data) {

                    $("#content").html(data);
                    $(".form-edit").show(500);
                    $(".form-layout").show();
                }
            );
        });

        $("#edit-save").click(function(e) {
            e.preventDefault();

            if (check_name && check_company && check_n_phone && check_email) {

                const MSKH = $("#MSKH").val(); //Mã khách hàng
                const name = $("#name").val(); //Mã khách hàng
                const company = $("#company").val(); //Mã khách hàng
                const n_phone = $("#n_phone").val(); //Mã khách hàng
                const email = $("#email").val(); //Mã khách hàng

                $.get("action.php", {

                    MSKH: MSKH,
                    name: name,
                    company: company,
                    n_phone: n_phone,
                    email: email,
                    sub_edit_customer: true

                }, function() {
                    $("#content").load("customer.php");
                });
            } else return false;


        });

        // Delete Customer
        $(".delete-customer").click(function() {
            var MSKH = $(this).attr("MSKH");

            $.get("action.php", {
                    MSKH: MSKH,
                    sub_del_customer: true
                },
                function() {
                    $("#content").load("customer.php");
                }
            );

        });

        // Thêm địa chỉ cho khách hàng
        $("#icon-add-customer-address").click(function(e) {
            e.preventDefault();
            var MSKH = $(this).attr("MSKH");

            $.post("customer.php", {
                    id: MSKH,
                    customer_add_address: true
                },
                function(data) {

                    $("#content").html(data);
                    $(".form-edit").show(500);
                    $(".form-layout").show();
                }
            );
        });

        // Save address
        $("#add-customer-address").click(function(e) {
            e.preventDefault();
            if (check_address) {

                const MSKH = $("#MSKH").val(); //Mã khách hàng
                const address = $("#address").val(); //Mã khách hàng

                $.get("action.php", {

                    MSKH: MSKH,
                    address: address,
                    sub_add_customer_address: true

                }, function() {
                    $("#content").load("customer.php");
                });
            } else return false;

        });

        // Xóa địa chỉ cho khách hàng
        $(".delete-customer-address").click(function() {
            var MaDC = $(this).attr("MaDC");

            $.get("action.php", {
                    MaDC: MaDC,
                    sub_del_customer_address: true
                },
                function() {
                    $("#content").load("customer.php");
                }
            );

        });

        // Search
        $("#form-search").click(function(e) {
            e.preventDefault();

            var key = $("#search").val();


            $.get("customer.php", {
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
