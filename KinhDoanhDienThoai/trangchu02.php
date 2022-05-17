<section>
    <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-1z" data-slide-to="1"></li>
        <li data-target="#carousel-example-1z" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner" role="listbox">

        <!-- First slide -->
        <div class="carousel-item active">

          <div class="view h-100">

            <img class="d-block h-100 w-lg-100" src="https://mdbootstrap.com/img/Photos/Others/ecommerce4.jpg"
              alt="First slide">

          </div>

        </div>
        <!-- First slide -->

        <!-- Second slide -->
        <div class="carousel-item h-100">

          <div class="view h-100">

            <img class="d-block h-100 w-lg-100" src="https://mdbootstrap.com/img/Photos/Others/ecommerce2.jpg"
              alt="Second slide">

          </div>

        </div>
        <!-- Second slide -->

        <!-- Third slide -->
        <div class="carousel-item">

          <div class="view h-100">

            <img class="d-block h-100 w-lg-100" src="https://mdbootstrap.com/img/Photos/Others/ecommerce3.jpg"
              alt="Third slide">

          </div>

        </div>
        <!-- Third slide -->

      </div>

      <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">

        <span class="carousel-control-prev-icon" aria-hidden="true"></span>

        <span class="sr-only">Previous</span>

      </a>

      <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">

        <span class="carousel-control-next-icon" aria-hidden="true"></span>

        <span class="sr-only">Next</span>

      </a>

    </div>
</section>

<div class="row"  style="width: 100%">
    <div class="col-sm-3"></div>
    <div class="col-sm-2 ">
      <a href="#" class="text-decoration-none">
        <div class="tieude tieude1">
          <p>BAO DA ỐP LƯNG</p>
        </div>
      </a>
      
    </div>
    <div class="col-sm-2">
      <a href="#" class="text-decoration-none">
        <div class="tieude tieude2">
          <p>TAI NGHE</p>
        </div>
      </a>
      
    </div>
    <div class="col-sm-2">
      <a href="#" class="text-decoration-none">
        <div class="tieude tieude3">
          <p>SẠC DỰ PHÒNG</p>
        </div>
      </a>
      
    </div>
    <div class="col-sm-3"></div>
</div>


  <div class="body-kddt">
    <div class="row"  style="width: 100%; margin-left: 0px">
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <div class="dienthoai-hot" >
          <div style="margin: 20px 0 0 20px;padding: 3px">
            <p >HÃNG ĐIỆN THOẠI</p>
          </div>
          
          <div class="tieude" style="margin-right: 50px; overflow-x: auto; width: 100%; white-space: nowrap">         
            <?php
              $sql_hangdt = "SELECT * FROM hangsx";
              $query_hangdt = mysqli_query($mysqli,$sql_hangdt);
              while($row_hangdt = mysqli_fetch_array($query_hangdt)) {
                ?>
                  <a href="#" class="text-decoration-none">
                    <div class="o-hangdt">
                      <img src="./Images/Hangdienthoai/<?php echo $row_hangdt['anh_hangsx'] ?>">
                    </div>
                  </a>
                  
                <?php
              }
            ?>
          </div>
        </div>

        <!-- Khuyến mãi 1 -->
        <div class="khuyenmai">
            <img src="./Images/khuyenmai/Capture.PNG" alt="khuyenmai">
        </div>

        <section id="products" class="pb-5">
          <div class="dienthoai-hot ">
            <div style="margin: 20px 0px -40px 0px;padding: 5px;" class="canhgiua">
              <img src="./Images/khuyenmai/Capture02.PNG" width="80%" style="margin-left: 100px;">
            </div>
            <br>
            <div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">
              <div class="controls-top">
                <a class="btn-floating danger-color" href="#multi-item-example" data-slide="prev">
                  <i class="fas fa-chevron-left"></i>
                </a>
                <a class="btn-floating danger-color" href="#multi-item-example" data-slide="next">
                  <i class="fas fa-chevron-right"></i>
                </a>
              </div>

              <ol class="carousel-indicators">
                <li class="danger-color" data-target="#multi-item-example" data-slide-to="0" class="active"></li>
                <li class="danger-color" data-target="#multi-item-example" data-slide-to="1"></li>
                <li class="danger-color" data-target="#multi-item-example" data-slide-to="2"></li>
              </ol>

              <div class="carousel-inner" role="listbox">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                  <div class="row p-3">
                  <!-- Điện thoại 1 -->
                  <div class="col-lg-3 col-md-12 mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                        <div class="dienthoai02">
                          <img src="./Images/AnhDT/Galaxy-S22-Ultra-Burgundy-600x600.jpg" style="padding: 10px">
                          <a>
                            <div class="mask rgba-white-slight"></div>
                          </a>
                          <h5 style="margin-left: 10px;font-size: 18px;font-weight: bold;">Samsung Galaxy S22 Ultra 5G 128GB</h5>
                          <span class="badge badge-danger mb-2 ml-3">GIẢM 15%</span>
                          <div class="row" style="width: 100%;">
                            <div class="col-sm-7 gia gia-dt" >
                              <p>29.990.000đ</p>
                            </div>
                            <div class="col-sm-5 gia giagoc-dt">
                              <p><del>30.990.000đ</del></p>
                            </div>
                          </div>
                              <ul class="rating" style="margin-left: 15px;">
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star grey-text"></i></li>
                              </ul>                                 
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-12 mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                    <div class="dienthoai02">
                      <img src="./Images/AnhDT/Galaxy-S22-Ultra-Burgundy-600x600.jpg" style="padding: 10px">
                      <a>
                        <div class="mask rgba-white-slight"></div>
                      </a>
                      <h5 style="margin-left: 10px;font-size: 18px;font-weight: bold;">Samsung Galaxy S22 Ultra 5G 128GB</h5>
                      <span class="badge badge-danger mb-2 ml-3">GIẢM 15%</span>
                      <div class="row" style="width: 100%;">
                        <div class="col-sm-7 gia gia-dt" >
                          <p>29.990.000đ</p>
                        </div>
                        <div class="col-sm-5 gia giagoc-dt">
                          <p><del>30.990.000đ</del></p>
                        </div>
                      </div>
                          <ul class="rating" style="margin-left: 15px;">
                            <li><i class="fas fa-star yellow-text"></i></li>
                            <li><i class="fas fa-star yellow-text"></i></li>
                            <li><i class="fas fa-star yellow-text"></i></li>
                            <li><i class="fas fa-star yellow-text"></i></li>
                            <li><i class="fas fa-star grey-text"></i></li>
                          </ul>                                 
                    </div>
                  </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-12 mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                    <div class="dienthoai02">
                      <img src="./Images/AnhDT/Galaxy-S22-Ultra-Burgundy-600x600.jpg" style="padding: 10px">
                      <a>
                        <div class="mask rgba-white-slight"></div>
                      </a>
                      <h5 style="margin-left: 10px;font-size: 18px;font-weight: bold;">Samsung Galaxy S22 Ultra 5G 128GB</h5>
                      <span class="badge badge-danger mb-2 ml-3">GIẢM 15%</span>
                      <div class="row" style="width: 100%;">
                        <div class="col-sm-7 gia gia-dt" >
                          <p>29.990.000đ</p>
                        </div>
                        <div class="col-sm-5 gia giagoc-dt">
                          <p><del>30.990.000đ</del></p>
                        </div>
                      </div>
                          <ul class="rating" style="margin-left: 15px;">
                            <li><i class="fas fa-star yellow-text"></i></li>
                            <li><i class="fas fa-star yellow-text"></i></li>
                            <li><i class="fas fa-star yellow-text"></i></li>
                            <li><i class="fas fa-star yellow-text"></i></li>
                            <li><i class="fas fa-star grey-text"></i></li>
                          </ul>                                 
                    </div>
                  </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-12 mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                    <div class="dienthoai02">
                      <img src="./Images/AnhDT/Galaxy-S22-Ultra-Burgundy-600x600.jpg" style="padding: 10px">
                      <a>
                        <div class="mask rgba-white-slight"></div>
                      </a>
                      <h5 style="margin-left: 10px;font-size: 18px;font-weight: bold;">Samsung Galaxy S22 Ultra 5G 128GB</h5>
                      <span class="badge badge-danger mb-2 ml-3">GIẢM 15%</span>
                      <div class="row" style="width: 100%;">
                        <div class="col-sm-7 gia gia-dt" >
                          <p>29.990.000đ</p>
                        </div>
                        <div class="col-sm-5 gia giagoc-dt">
                          <p><del>30.990.000đ</del></p>
                        </div>
                      </div>
                          <ul class="rating" style="margin-left: 15px;">
                            <li><i class="fas fa-star yellow-text"></i></li>
                            <li><i class="fas fa-star yellow-text"></i></li>
                            <li><i class="fas fa-star yellow-text"></i></li>
                            <li><i class="fas fa-star yellow-text"></i></li>
                            <li><i class="fas fa-star grey-text"></i></li>
                          </ul>                                 
                    </div>
                  </div>
                    </div>
                </div>
              </div>
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                  <div class="row p-3">
                  <!-- Điện thoại 1 -->
                  <div class="col-lg-3 col-md-12 mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                        <div class="dienthoai02">
                          <img src="./Images/AnhDT/Galaxy-S22-Ultra-Burgundy-600x600.jpg" style="padding: 10px">
                          <a>
                            <div class="mask rgba-white-slight"></div>
                          </a>
                          <h5 style="margin-left: 10px;font-size: 18px;font-weight: bold;">Samsung Galaxy S22 Ultra 5G 128GB</h5>
                          <span class="badge badge-danger mb-2 ml-3">GIẢM 15%</span>
                          <div class="row" style="width: 100%;">
                            <div class="col-sm-7 gia gia-dt" >
                              <p>29.990.000đ</p>
                            </div>
                            <div class="col-sm-5 gia giagoc-dt">
                              <p><del>30.990.000đ</del></p>
                            </div>
                          </div>
                              <ul class="rating" style="margin-left: 15px;">
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star grey-text"></i></li>
                              </ul>                                 
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Hết điện thoại 1 -->
                  <!-- Điện thoại 2 -->
                  <div class="col-lg-3 col-md-12 mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                        <div class="dienthoai02">
                          <img src="./Images/AnhDT/Galaxy-S22-Ultra-Burgundy-600x600.jpg" style="padding: 10px">
                          <a>
                            <div class="mask rgba-white-slight"></div>
                          </a>
                          <h5 style="margin-left: 10px;font-size: 18px;font-weight: bold;">Samsung Galaxy S22 Ultra 5G 128GB</h5>
                          <span class="badge badge-danger mb-2 ml-3">GIẢM 15%</span>
                          <div class="row" style="width: 100%;">
                            <div class="col-sm-7 gia gia-dt" >
                              <p>29.990.000đ</p>
                            </div>
                            <div class="col-sm-5 gia giagoc-dt">
                              <p><del>30.990.000đ</del></p>
                            </div>
                          </div>
                              <ul class="rating" style="margin-left: 15px;">
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star grey-text"></i></li>
                              </ul>                                 
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Hết điện thoại 2 -->
                  <!-- Điện thoại 3 -->
                  <div class="col-lg-3 col-md-12 mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                        <div class="dienthoai02">
                          <img src="./Images/AnhDT/Galaxy-S22-Ultra-Burgundy-600x600.jpg" style="padding: 10px">
                          <a>
                            <div class="mask rgba-white-slight"></div>
                          </a>
                          <h5 style="margin-left: 10px;font-size: 18px;font-weight: bold;">Samsung Galaxy S22 Ultra 5G 128GB</h5>
                          <span class="badge badge-danger mb-2 ml-3">GIẢM 15%</span>
                          <div class="row" style="width: 100%;">
                            <div class="col-sm-7 gia gia-dt" >
                              <p>29.990.000đ</p>
                            </div>
                            <div class="col-sm-5 gia giagoc-dt">
                              <p><del>30.990.000đ</del></p>
                            </div>
                          </div>
                              <ul class="rating" style="margin-left: 15px;">
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star grey-text"></i></li>
                              </ul>                                 
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Hết điện thoại 3 -->
                  <div class="col-lg-3 col-md-12 mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                        <div class="dienthoai02">
                          <img src="./Images/AnhDT/Galaxy-S22-Ultra-Burgundy-600x600.jpg" style="padding: 10px">
                          <a>
                            <div class="mask rgba-white-slight"></div>
                          </a>
                          <h5 style="margin-left: 10px;font-size: 18px;font-weight: bold;">Samsung Galaxy S22 Ultra 5G 128GB</h5>
                          <span class="badge badge-danger mb-2 ml-3">GIẢM 15%</span>
                          <div class="row" style="width: 100%;">
                            <div class="col-sm-7 gia gia-dt" >
                              <p>29.990.000đ</p>
                            </div>
                            <div class="col-sm-5 gia giagoc-dt">
                              <p><del>30.990.000đ</del></p>
                            </div>
                          </div>
                              <ul class="rating" style="margin-left: 15px;">
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star grey-text"></i></li>
                              </ul>                                 
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item">
                  <div class="row p-3">
                  <!-- Điện thoại 1 -->
                  <div class="col-lg-3 col-md-12 mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                        <div class="dienthoai02">
                          <img src="./Images/AnhDT/Galaxy-S22-Ultra-Burgundy-600x600.jpg" style="padding: 10px">
                          <a>
                            <div class="mask rgba-white-slight"></div>
                          </a>
                          <h5 style="margin-left: 10px;font-size: 18px;font-weight: bold;">Samsung Galaxy S22 Ultra 5G 128GB</h5>
                          <span class="badge badge-danger mb-2 ml-3">GIẢM 15%</span>
                          <div class="row" style="width: 100%;">
                            <div class="col-sm-7 gia gia-dt" >
                              <p>29.990.000đ</p>
                            </div>
                            <div class="col-sm-5 gia giagoc-dt">
                              <p><del>30.990.000đ</del></p>
                            </div>
                          </div>
                              <ul class="rating" style="margin-left: 15px;">
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star grey-text"></i></li>
                              </ul>                                 
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Hết điện thoại 1 -->
                  <!-- Điện thoại 2 -->
                  <div class="col-lg-3 col-md-12 mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                        <div class="dienthoai02">
                          <img src="./Images/AnhDT/Galaxy-S22-Ultra-Burgundy-600x600.jpg" style="padding: 10px">
                          <a>
                            <div class="mask rgba-white-slight"></div>
                          </a>
                          <h5 style="margin-left: 10px;font-size: 18px;font-weight: bold;">Samsung Galaxy S22 Ultra 5G 128GB</h5>
                          <span class="badge badge-danger mb-2 ml-3">GIẢM 15%</span>
                          <div class="row" style="width: 100%;">
                            <div class="col-sm-7 gia gia-dt" >
                              <p>29.990.000đ</p>
                            </div>
                            <div class="col-sm-5 gia giagoc-dt">
                              <p><del>30.990.000đ</del></p>
                            </div>
                          </div>
                              <ul class="rating" style="margin-left: 15px;">
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star grey-text"></i></li>
                              </ul>                                 
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Hết điện thoại 2 -->
                  <!-- Điện thoại 3 -->
                  <div class="col-lg-3 col-md-12 mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                        <div class="dienthoai02">
                          <img src="./Images/AnhDT/Galaxy-S22-Ultra-Burgundy-600x600.jpg" style="padding: 10px">
                          <a>
                            <div class="mask rgba-white-slight"></div>
                          </a>
                          <h5 style="margin-left: 10px;font-size: 18px;font-weight: bold;">Samsung Galaxy S22 Ultra 5G 128GB</h5>
                          <span class="badge badge-danger mb-2 ml-3">GIẢM 15%</span>
                          <div class="row" style="width: 100%;">
                            <div class="col-sm-7 gia gia-dt" >
                              <p>29.990.000đ</p>
                            </div>
                            <div class="col-sm-5 gia giagoc-dt">
                              <p><del>30.990.000đ</del></p>
                            </div>
                          </div>
                              <ul class="rating" style="margin-left: 15px;">
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star grey-text"></i></li>
                              </ul>                                 
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Hết điện thoại 3 -->
                  <div class="col-lg-3 col-md-12 mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                        <div class="dienthoai02">
                          <img src="./Images/AnhDT/Galaxy-S22-Ultra-Burgundy-600x600.jpg" style="padding: 10px">
                          <a>
                            <div class="mask rgba-white-slight"></div>
                          </a>
                          <h5 style="margin-left: 10px;font-size: 18px;font-weight: bold;">Samsung Galaxy S22 Ultra 5G 128GB</h5>
                          <span class="badge badge-danger mb-2 ml-3">GIẢM 15%</span>
                          <div class="row" style="width: 100%;">
                            <div class="col-sm-7 gia gia-dt" >
                              <p>29.990.000đ</p>
                            </div>
                            <div class="col-sm-5 gia giagoc-dt">
                              <p><del>30.990.000đ</del></p>
                            </div>
                          </div>
                              <ul class="rating" style="margin-left: 15px;">
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star yellow-text"></i></li>
                                <li><i class="fas fa-star grey-text"></i></li>
                              </ul>                                 
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
              
            </div>
            <br>
          </div>
            


              
              <!-- <div class="container-fluid d-flex justify-content-start flex-wrap align-item-start">
                <div class="dienthoai">
                  <img src="./Images/AnhDT/Galaxy-S22-Ultra-Burgundy-600x600.jpg" style="padding: 10px">
                  <a href="#">Samsung Galaxy S22 Ultra 5G 128GB</a>
                  <div class="row" style="width: 100%;">
                    <div class="col-sm-7 gia gia-dt">
                      <p>29.990.000đ</p>
                    </div>
                    <div class="col-sm-5 gia giagoc-dt">
                      <p><del>30.990.000đ</del></p>
                    </div>
                  </div>
                </div>
              </div>  -->   
        </section>

        <div class="khuyenmai">
          <img src="./Images/khuyenmai/720-220-720x220-39.png" alt="khuyenmai2">
        </div>
        <br>
      
        <section>
          <div class="dienthoai-hot">
            <div style="margin: 20px 0 0 20px;padding: 3px;position:relative" class="p-nho">
              <p >GỢI Ý HÔM NAY</p>
              <a href="?route=tatca" style="position: absolute; top: 30px; right: 40px;color:black">XEM TẤT CẢ <i class="fas fa-angle-right right"></i></a>
            </div>

            <div class="row p-3">
            <?php
                $sql_tt = "SELECT * FROM dienthoai, hinhanh WHERE dienthoai.MaDT = hinhanh.MaDT AND hinhanh.Hinh_index = 1 LIMIT 16";
                $query_tt = mysqli_query($mysqli, $sql_tt);
                while ($row_tt = mysqli_fetch_array($query_tt)) {
                    ?>           
                      <div class="col-lg-3 col-md-12 mb-4">
                          <div class="card card-ecommerce">
                              <div class="view overlay">
                                  <div class="dienthoai02">
                                    <div class="tab-pane fade show in active" id="panel31" role="tabpanel">
                                  <!-- MDB-Portfolio-Templates-Pack_4.8.11/html/culinary.html -->
                                    <div class="view view-cascade overlay zoom">
                                      <img src="./Images/AnhDT/<?php echo $row_tt['TenHinh'] ?>" style="padding: 10px" class="card-img-top">
                                    </div>
                                      <a href="?route=chitiet&id=<?php echo $row_tt['MaDT'] ?>">
                                          <div class="mask rgba-white-slight"></div>
                                      </a>
                                      <h5 style="margin-left: 10px;font-size: 18px;font-weight: bold;margin-top: -30px"><?php echo $row_tt['TenDT'] ?></h5>
                                      <?php
                                          $sql_ttkm = "SELECT * FROM dienthoai WHERE MaDT = ".' '.$row_tt['MaDT'];
                                          $query_ttkm = mysqli_query($mysqli, $sql_ttkm);
                                          $row_ttkm = mysqli_fetch_array($query_ttkm);
                                          if ($row_ttkm['TrangThaiKM'] == 1) {
                                              ?>
                                              <span class="badge badge-danger mb-2 ml-3"><?php echo $row_tt['TenTTKM'] ?></span>
                                          <?php
                                          }
                                          else if ($row_ttkm['TrangThaiKM'] == 2) {
                                              ?>
                                              <span class="badge badge-info mb-2 ml-3"><?php echo $row_tt['TenTTKM'] ?></span>
                                              <?php
                                          }
                                          else if ($row_ttkm['TrangThaiKM'] == 3) {
                                              ?>
                                              <span class="badge badge-warning mb-2 ml-3"><?php echo $row_tt['TenTTKM'] ?></span>
                                              <?php
                                          }
                                      ?>
                                      
                                      <div class="row" style="width: 100%;">
                                          <div class="col-sm-7 gia gia-dt" >
                                          <p>&nbsp;&nbsp;<?php echo $row_tt['GiaKhuyenMai'] ?>đ</p>
                                          </div>
                                          <?php
                                              $sql_ttkm02 = "SELECT * FROM dienthoai WHERE MaDT = ".' '.$row_tt['MaDT'];
                                              $query_ttkm02 = mysqli_query($mysqli, $sql_ttkm02);
                                              $row_ttkm02 = mysqli_fetch_array($query_ttkm02);
                                              if ($row_ttkm02['TrangThaiKM'] == 1 || $row_ttkm02['TrangThaiKM'] == 3) {
                                                  ?>
                                                      <div class="col-sm-5 gia giagoc-dt">
                                                      <p class=""><del><?php echo $row_tt['GiaGoc'] ?>đ</del></p>
                                                      </div>
                                                  <?php
                                              }
                                          ?>
                                          
                                      </div>
                                      <div style="position:relative">
                                          <ul class="rating" style="margin-left: 15px;">
                                          <?php
                                              $sql_diemdg = "SELECT ROUND(AVG(DiemDG)) diem FROM danhgia WHERE MaDT = ".' '.$row_tt['MaDT'];
                                              $query_diemdg = mysqli_query($mysqli, $sql_diemdg);
                                              $row_diemdg = mysqli_fetch_array($query_diemdg);
                                              // echo '<p> '.$row_diemdg['diem'].' </p>';
                                              for ($i = 1; $i <= $row_diemdg['diem']; $i++) {
                                                  ?>
                                                      <li><i class="fas fa-star yellow-text"></i></li>
                                                  <?php
                                                  }
                                                    $khongdg = 5 - $row_diemdg['diem'];
                                                  for ($i = 1; $i <= $khongdg; $i++) {
                                                  ?>
                                                        <li><i class="fas fa-star grey-text"></i></li>
                                                    <?php
                                              }
                                                  ?>
                                                          <p style="position:absolute; right: 100px; bottom: -10px;font-size: 14px; color: black">(<?php
                                                              $sql_luotdg = "SELECT COUNT(MaDG) luotdg FROM danhgia WHERE MaDT = ".' '.$row_tt['MaDT'];
                                                              $query_luotdg = mysqli_query($mysqli, $sql_luotdg);
                                                              $row_luotdg = mysqli_fetch_array($query_luotdg);
                                                              echo $row_luotdg['luotdg'];
                                                          ?>)</p>
                                                  <?php
                                          ?>
                                          </ul>
                                          <p style="position:absolute; right: 15px; bottom: -10px; font-size: 14px; color: black">Đã bán: <b style="color: red">
                                              <?php echo $row_tt['DaBan'] ?>
                                          </b></p> 
                                      </div>
                                  </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                        
                    <?php
                }
            ?>
            </div>

        </section>

        </div>
      <div class="col-sm-1"></div>
        </div>
        
    </div>