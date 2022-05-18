<script type="text/javascript" src="../../js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="../../js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="../../js/mdb.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
// Material Select Initialization
$(document).ready(function () {
    //$('.mdb-select').material_select();
    $("#cart-content").load("noidung-giohang.php");
});
/* WOW.js init */
new WOW().init();

// MDB Lightbox Init
$(function () {
    $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
});

// Tooltips Initialization
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

// SideNav Initialization
$(".button-collapse").sideNav();

</script>
<div class="container">
    <section class="section my-5 pb-5">
        <div class="card card-ecommerce">
            <div class="card-body">
                <div class="table-responsive" id="cart-content">
                </div>
            </div>
        </div>
    </section>
    <div id="order-content" style="padding: 0;"></div>
</div>

