<!doctype html>
<?php session_start(); 
  if(!isset($_SESSION['account']))
    header('Location: login.php');
?>
<html lang="en">
  <head>
    <title>Hệ thống quản lý</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Material Kit CSS -->
    <link href="assets/css/material-kit.css?v=2.1.1" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/plus_minus.css">
    <!-- SweetAlert2 -->
    <script src="assets/js/sweetalert2.all.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <!-- Card a href style -->
    <style type="text/css">
      @import url('https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap');
      a.custom-card,
      a.custom-card:hover {
          color: inherit;
      }

      #myBtn {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 30px;
      z-index: 50;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 15px;
      border-radius: 4px;
      }

      #myBtn:hover {
      background-color: red;
      }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-primary sticky-top">
    <div class="container">
      <a class="navbar-brand">HỆ THỐNG QUẢN LÝ</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav col-auto mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Đặt hàng</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">Thống kê</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="product.php">Sản phẩm <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="employee.php">Nhân viên</a>
          </li>
        </ul>
        <ul class="navbar-nav col-auto">
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <?php 
                include ('sql_conn.php');
                if (isset($_SESSION['account']) && $_SESSION['account']){ //Kiểm tra session
                       $name = "SELECT * FROM employees WHERE E_ACCOUNT = '".$_SESSION['account']."'";
                       $queryName = mysqli_query($conn, $name); //Thực hiện câu truy vấn
                        if ($queryName->num_rows > 0) { //Kiểm tra số dòng
                         while ($row = mysqli_fetch_assoc($queryName)) { //Nếu có kết quả thì đưa tất cả vào bảng
                          if ($row['E_USERGROUP']=="admin" || $row['E_USERGROUP']=="order") {
                            echo "Xin chào ".$row['E_FULLNAME'];
                          } else {
                            header('Location: login.php');
                          }
                        }
                       }        
                     }else{
                    header('Location: login.php'); 
                }
                ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="emp.php">Trang cá nhân</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Đăng xuất</a>
              </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <main role="main" class="container md">                                  
    <div class="my-3 p-3 bg-white rounded shadow-sm">
      <div class="row">
        <div class="col-10"></div>
        <div class="col">
          <button type="button" data-toggle="modal" data-target="#paymentModal" class="btn btn-success"><i class="material-icons">shopping_cart</i> Giỏ hàng</button>
        </div>
      </div>
      <hr>
      <div class="row">
        <?php
          include 'show_product.php';
          show();
        ?>
      </div>
    </div>
  <button type="button" id="myBtn" data-toggle="modal" data-target="#paymentModal" class="btn btn-success"><i class="material-icons">shopping_cart</i></button> 
  <!-- Script nút thanh toán  -->                          
  <script>
  //Get the button
  var mybutton = document.getElementById("myBtn");

  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop >= 0 || document.documentElement.scrollTop >= 0) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "block";
    }
  }
  </script>
  <!-- Modal thanh toán -->
  <div class="modal fade bd-example-modal-lg" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="paymentModal">Thông tin giỏ hàng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Hình</th>
                  <th scope="col">Tên</th>
                  <th scope="col" class="text-center">Giá</th>
                  <th scope="col" class="text-center">Số lượng</th>
                  <th scope="col" class="text-center">Thành tiền</th>
                  <th scope="col" class="text-right">Xóa</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $tongtien = 0;

                  if (isset($_SESSION['CART'])) {
                    foreach ($_SESSION['CART'] as $key => $value) {
                      $findProCmd = "SELECT * FROM product WHERE P_ID = '".$key."'";
                      $findPro = mysqli_query($conn, $findProCmd);

                      if ($findPro->num_rows > 0) {
                        while ($Pro = mysqli_fetch_assoc($findPro)) {
                          $tongtien += $_SESSION['CART'][$key]*$Pro['P_PRICE'];
                        ?>
                        <tr>
                          <td><img src="<?php echo $Pro['P_THUMB_IMG'] ?>" width="50px"></td>
                          <th><?php echo $Pro['P_NAME']; ?></th>
                          <td class="text-center"><?php echo number_format($Pro['P_PRICE'], 0); ?>đ</td>
                          <td class="text-center"><?php echo $_SESSION['CART'][$key]; ?></td>
                          <td class="text-center"><?php echo number_format($_SESSION['CART'][$key]*$Pro['P_PRICE'], 0); ?>đ</td>
                          <td class="text-center"><form method="post" action="delete_from_cart.php"><button type="submit" class="close" name="deleteCart" value="<?php echo $key; ?>"><span aria-hidden="true">&times;</span></button></form></td>
                        </tr>
                        <?php
                        }
                      }
                    }
                  }
                  $_SESSION['CART']['TOTAL'] = $tongtien;
                ?>
              </tbody>
            </table>
            <h3 style="color: red;" class="text-right">Tổng tiền: <?php echo number_format($tongtien, 0) ?>đ</h3>
          </div>
          <div class="modal-footer">
            
            <form action="pay.php" method="post">
              <button type="submit" class="btn btn-success" name="payBtn">Thanh toán</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  <!-- Ket thuc modal -->
  </main>

<?php 
  if (isset($_SESSION['paid'])) {
    if ($_SESSION['paid']=='yes') {
    ?>
      <script type="text/javascript">
        Swal.fire({
        type: 'success',
        title: 'Thanh toán thành công!',
        showConfirmButton: false,
        timer: 1500
      })
      </script>
    <?php
    }else{
      ?>
      <script type="text/javascript">
        Swal.fire({
          type: 'error',
          title: 'Thanh toán thất bại!',
          showConfirmButton: false,
          timer: 1500
        })
      </script>
      <?php
    }
    unset($_SESSION['paid']);
  }
 ?>

  <footer class="footer footer-default" >
    <div class="container">
      <div class="copyright float-left">
          &copy;
          <script>
              document.write(new Date().getFullYear())
          </script>
      </div>
      <div class="copyright float-right">
          Made with <i class="material-icons">all_inclusive</i> love by
          <a href="https://www.facebook.com/giangpt2808">Giang</a>
      </div>
    </div>
</footer>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="assets/js/plugins/moment.min.js"></script>
<!--  Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Google Maps Plugin  -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
<!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
<!--  Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="assets/js/plugins/jasny-bootstrap.min.js" type="text/javascript"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="assets/js/material-kit.js?v=2.1.1" type="text/javascript"></script>
</body>
</html>