<div id="demo" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>

    </div>
    
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://i.pinimg.com/originals/e6/84/38/e68438493aaae20e16b3b7a6c4149097.png" alt="Los Angeles" class="d-block" style="display:block; width:100%; height: 300px">
      </div>
      <div class="carousel-item">
        <img src="https://i.pinimg.com/originals/84/bb/80/84bb80a5e0ce779fca4c1f6a4d444987.jpg" alt="Chicago" class="d-block" style="width:100%; height: 300px">
      </div>
      <div class="carousel-item">
        <img src="https://i.pinimg.com/originals/d7/85/21/d785210502ea6cafd272579506f56b48.jpg" alt="New York" class="d-block" style="width:100%; height: 300px">
      </div>
      <div class="carousel-item">
        <img src="https://i.pinimg.com/originals/d7/85/21/d785210502ea6cafd272579506f56b48.jpg" alt="New York 2" class="d-block" style="width:100%; height: 300px">
      </div>
    </div>
    
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
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
                <div class="carousel-item active ">
                  <!-- Điện thoại 1 -->
                  <div class="col-md-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                        <div class="dienthoai">
                          <img src="./Images/AnhDT/Galaxy-S22-Ultra-Burgundy-600x600.jpg" style="padding: 10px">
                          <a href="#">
                            Samsung Galaxy S22 Ultra 5G 128GB</a>
                          <div class="row" style="width: 100%;">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-6 gia gia-dt" >
                              <p>29.990.000đ</p>
                            </div>
                            <div class="col-sm-4 gia giagoc-dt">
                              <p><del>30.990.000đ</del></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <!-- Hết điện thoại 1 -->
                  <!-- Điện thoại 2 -->
                  <div class="col-md-4 clearfix d-none d-md-block mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                        <div class="dienthoai">
                          <img src="./Images/AnhDT/Galaxy-S22-Ultra-Burgundy-600x600.jpg" style="padding: 10px">
                          <a href="#">Samsung Galaxy S22 Ultra 5G 128GB</a>
                          <div class="row" style="width: 100%;">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-6 gia gia-dt" >
                              <p>29.990.000đ</p>
                            </div>
                            <div class="col-sm-4 gia giagoc-dt">
                              <p><del>30.990.000đ</del></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Hết điện thoại 2 -->
                  <!-- Điện thoại 3 -->
                  <div class="col-md-4 clearfix d-none d-md-block mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                        <div class="dienthoai">
                          <img src="./Images/AnhDT/Galaxy-S22-Ultra-Burgundy-600x600.jpg" style="padding: 10px">
                          <a href="#">Samsung Galaxy S22 Ultra 5G 128GB</a>
                          <div class="row" style="width: 100%;">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-6 gia gia-dt" >
                              <p>29.990.000đ</p>
                            </div>
                            <div class="col-sm-4 gia giagoc-dt">
                              <p><del>30.990.000đ</del></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Hết điện thoại 3 -->
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                  <!-- Điện thoại 1 -->
                  <div class="col-md-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                        <div class="dienthoai">
                          <img src="./Images/AnhDT/samsung-galaxy-s22-ultra-7-1.jpg" style="padding: 10px">
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
                      </div>
                    </div>
                    
                  </div>
                  <!-- Hết điện thoại 1 -->
                  <!-- Điện thoại 2 -->
                  <div class="col-md-4 clearfix d-none d-md-block mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
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
                      </div>
                    </div>
                  </div>
                  <!-- Hết điện thoại 2 -->
                  <!-- Điện thoại 3 -->
                  <div class="col-md-4 clearfix d-none d-md-block mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
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
                      </div>
                    </div>
                  </div>
                  <!-- Hết điện thoại 3 -->
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item">
                  <!-- Điện thoại 1 -->
                  <div class="col-md-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
                        <div class="dienthoai">
                          <img src="./Images/AnhDT/samsung-galaxy-s22-ultra-7-1.jpg" style="padding: 10px">
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
                      </div>
                    </div>
                    
                  </div>
                  <!-- Hết điện thoại 1 -->
                  <!-- Điện thoại 2 -->
                  <div class="col-md-4 clearfix d-none d-md-block mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
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
                      </div>
                    </div>
                  </div>
                  <!-- Hết điện thoại 2 -->
                  <!-- Điện thoại 3 -->
                  <div class="col-md-4 clearfix d-none d-md-block mb-4">
                    <div class="card card-ecommerce">
                      <div class="view overlay">
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
                      </div>
                    </div>
                  </div>
                  <!-- Hết điện thoại 3 -->
                </div>
              </div>
              
            </div>
            <br>


              
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
          </div>
        </section>

        <div class="khuyenmai">
          <img src="./Images/khuyenmai/720-220-720x220-39.png" alt="khuyenmai2">
        </div>
        <br>
      
        <section>
          <div class="dienthoai-hot">
            <div style="margin: 20px 0 0 20px;padding: 3px;position:relative" class="p-nho">
              <p >GỢI Ý HÔM NAY</p>
              <a style="position: absolute; top: 30px; right: 40px;">XEM TẤT CẢ ></a>
            </div>
            <div class="row p-3">
              <!-- DT1 -->
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
                      <span class="badge badge-info mb-2 ml-3">MỚI</span>
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
                            <li><i class="fas fa-star grey-text"></i></li>
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
                      <span class="badge badge-warning mb-2 ml-3">GIẢM 500K</span>
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
        </section>

        </div>
      <div class="col-sm-1"></div>
        </div>
        
    </div>



  </div>