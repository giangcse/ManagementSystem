<!doctype html>
<?php session_start(); 
header('Content-Type: text/html; charset=UTF-8');
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
        <!-- SweetAlert2 -->
    <script src="assets/js/sweetalert2.all.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
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
            <li class="nav-item">
              <a class="nav-link" href="index.php">Đặt hàng</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">Thống kê</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="product.php">Sản phẩm <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
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
                          if ($row['E_USERGROUP']=="admin") {
                            echo "Xin chào ".$row['E_FULLNAME'];
                          } else {
                            header('Location: index.php');
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
          <div class="card card-nav-tabs card-plain">
            <div class="card-header card-header-danger">
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#employee" data-toggle="tab"><i class="material-icons">face</i>Nhân viên</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#shift" data-toggle="tab"><i class="material-icons">assignment</i>Lịch trực</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#salary" data-toggle="tab"><i class="material-icons">attach_money</i>Lương</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><div class="card-body ">
                <div class="tab-content text-center">
                    <div class="tab-pane active" id="employee">
                        <section name="addEmployee">
                          <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#">Nhân viên</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Thên nhân viên</li>
                            </ol>
                          </nav>
                          <form method="get" action="add_emp.php" onsubmit="return validateEmp()">
                            <div class="form-row">
                              <div class="col-4">
                                <label class="bmd-label-static">Họ tên*</label>
                                <input type="text" name="fullname" id="fullname" class="form-control" >
                              </div>
                              <div class="col-2">
                                <label class="bmd-label-static">Số điện thoại*</label>
                                <input type="text" name="phone" id="phone" class="form-control" pattern="\d{10,10}">
                              </div>
                              <div class="col">
                              	<label class="bmd-label-static">Số CMND*</label>
                              	<input type="text" name="id_num" id="id_num" class="form-control" pattern="\d{9,12}">
                              </div>
                              <div class="col">
                                <label class="bmd-label-static">Địa chỉ*</label>
                                <input type="text" name="address" id="address" class="form-control" >
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="col-2">
                              	<label class="bmd-label-static">Tài khoản*</label>
                              	<input type="text" name="account" id="account" class="form-control" pattern="^[a-z0-9_-]{3,15}$">
                              </div>
                              <div class="col-2">
                              	<label class="bmd-label-static">Mật khẩu*</label>
                              	<input type="password" name="password" id="password" class="form-control">
                              </div>
                              <div class="col-3">
                                <select class="selectpicker show-tick" data-style="select-with-transition" name="job" id="job">
                                  <option disabled selected>Công việc*</option>
                                  <option value="Phục vụ">Phục vụ</option>
                                  <option value="Chế biến">Chế biến</option>
                                  <option value="Order">Order</option>
                                </select>
                              </div>
                              <div class="col">
                                <label class="bmd-label-static">Năm vào làm*</label>
                                <input type="text" name="start" id="start" class="form-control" pattern="\d{4,4}">
                              </div>
                            </div>
                              <div class="row">
                                <div class="col-auto mr-auto"> </div>
                                <div class="col-auto">
                                <button class="btn btn-success" type="submit"><i class="material-icons">add</i> THÊM NHÂN VIÊN</button>
                                </div>
                              </div>
                          </form>
<script type="text/javascript">
  function validateEmp(){
    var fullname = document.getElementById('fullname').value;
    var account = document.getElementById('account').value;
    var password = document.getElementById('password').value;
    var id_num = document.getElementById('id_num').value;
    var address = document.getElementById('address').value;
    var phone = document.getElementById('phone').value;
    var job = document.getElementById('job').value;
    var start = document.getElementById('start').value;

    if (fullname!="" && account!="" && password!="" && id_num!="" && address!="" && phone!="" && job!="" && start!="") {
      Swal.fire({
        type: 'success',
        title: 'Đã thêm nhân viên',
        showConfirmButton: false,
        timer: 1500
      });
      return true;
    }else{
      alert("Vui lòng điền đủ thông tin có dấu *");
      return false;
    }
    return false;
  }
</script>
                          <hr>
                        </section>
                        <section name="listEmployee">
                          <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#">Nhân viên</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Danh sách nhân viên</li>
                            </ol>
                          </nav>
                          <div class="row">
                            <div class="col-auto mr-auto" id="numberOfEmployee">
                              <?php
                                include('sql_conn.php');
                                $numberOfEmployee = "SELECT COUNT(E_ID) as total FROM employees";
                                $sqlCount = mysqli_query($conn, $numberOfEmployee); //Thực hiện truy vấn đếm dựa vào id
                                $data = mysqli_fetch_assoc($sqlCount); //Đưa tất cả dữ liệu select được vào mảng
                                echo "<h4>Có tất cả ".$data['total']." nhân viên</h4>";
                              ?>
                            </div>
                            
                            <!-- Bảng hiển thị danh sách nhân viên -->
                            <table class="table table-hover table-bordered" name="employeeTable">
                              <thead>
                                <tr>
                                  <th>Mã</th>
                                  <th class="text-left">Tên nhân viên</th>
                                  <th>Tài khoản</th>
                                  <th>Số điện thoại</th>
                                  <th>Số CMND</th>
                                  <th>Địa chỉ</th>
                                  <th>Công việc</th>
                                  <th>Năm vào</th>
                                  <th>Thao tác</th>
                                </tr>
                              </thead>
                              <tbody>
  <?php 
    $select_emp = "SELECT * FROM employees";
    $result_emp = mysqli_query($conn, $select_emp);
    if ($result_emp->num_rows > 0) {
      while ($row = mysqli_fetch_assoc($result_emp)) {
  ?>
    <tr>
      <td><?php echo $row['E_ID']; ?></td>
      <th class="text-left"><?php echo $row['E_FULLNAME']; ?></th>
      <td><?php echo $row['E_ACCOUNT']; ?></td>
      <td><?php echo $row['E_PHONE']; ?></td>
      <td><?php echo $row['E_ID_NUM']; ?></td>
      <td class="text-left"><?php echo $row['E_ADDRESS']; ?></td>
      <td><?php echo $row['E_JOB']; ?></td>
      <td><?php echo $row['E_START']; ?></td>
      <td>
        <?php 
          if ($row['E_USERGROUP']=="admin") {
            echo "<i class='material-icons' style='color: green;'>verified_user</i>";
          }else{
        ?>
         <form method="get" action="delete_emp.php">
          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit<?php echo $row['E_ID']; ?>"><i class="material-icons">edit</i></button>
          <button type="submit" class="btn btn-sm btn-danger" name="delete" value="<?php echo $row['E_ID']; ?>" onclick="return del()"><i class="material-icons">delete</i></button>
         </form>
        <?php
          }
        ?>
      </td>
    </tr>
    <script type="text/javascript">
      function del(){
        var del = confirm("Bạn có thực sự muốn xóa nhân viên này?");
        if (del) {
          return true
        }else{
          return false
        }
        return false
      }
    </script>
    <!-- modal sua thong tin nhan vien -->
    <div class="modal fade" id="edit<?php echo $row['E_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
         <form method="get" action="update_emp.php">
          <div class="modal-header">
            <h3 class="modal-title" id="editModal"><?php echo $row['E_FULLNAME']; ?></h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-left">
            <div class="form-group">
              <label for="ephone">Số điện thoại</label>
              <input type="text" name="ephone" id="ephone" pattern="\d{10,10}" class="form-control">
            </div>
            <div class="form-group">
              <label for="eaddress">Địa chỉ</label>
              <input type="text" name="eaddress" id="eaddress" class="form-control">
            </div>
            <div class="form-group">
              <label for="ejob">Công việc</label>
              <select class="form-control" data-style="btn btn-link" id="ejob" name="ejob">
                <option disabled selected value="">Công việc*</option>
                <option value="Phục vụ">Phục vụ</option>
                <option value="Chế biến">Chế biến</option>
                <option value="Order">Order</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="update" value="<?php echo $row['E_ID']; ?>" class="btn btn-primary">Lưu</button>
          </div>
         </form>
        </div>
      </div>
    </div>
  <?php
      }
    }
  ?>
        </tbody>
      </table>
    </div>
  </section>
</div>
                    <div class="tab-pane" id="shift">
                      <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Lịch trực</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Ca trực</li>
                        </ol>
                      </nav>
                      <hr>
                      <p class="text-left"><strong>Chú thích: </strong><strong style="color: red;">Nhân viên chế biến</strong> /
                      <strong style="color: green;">Nhân viên order</strong> / 
                      <strong style="color: blue;">Nhân viên phục vụ</strong></p>
<table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Thứ 2</th>
            <th scope="col">Thứ 3</th>
            <th scope="col">Thứ 4</th>
            <th scope="col">Thứ 5</th>
            <th scope="col">Thứ 6</th>
            <th scope="col">Thứ 7</th>
            <th scope="col">Chủ nhật</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $select_ca = "SELECT DISTINCT DS_SHIFTNAME FROM detail_shift";
            $query_ca = mysqli_query($conn, $select_ca);
            if ($query_ca->num_rows > 0) {
              while ($row=mysqli_fetch_assoc($query_ca)) {
              ?>
              <tr>
                <th>Ca <?php echo $row['DS_SHIFTNAME']; ?></th>
                <?php 
                  for ($i=2; $i < 9 ; $i++) { 
                ?>
                <td>
                  <?php 
                    $select_ngay = "SELECT * FROM detail_shift INNER JOIN employees ON employees.E_ID = detail_shift.E_ID WHERE DS_SHIFTNAME= '".$row['DS_SHIFTNAME']."'";
                    $query_ngay = mysqli_query($conn, $select_ngay);
                    if ($query_ngay->num_rows > 0) {
                      while ($rows = mysqli_fetch_assoc($query_ngay)) {
                        if ($rows['DS_DAYOFSHIFT']==$i)
                          switch ($rows['E_JOB']) {
                            case 'Chế biến':
                              echo '<p style="color: red;">'.$rows['E_FULLNAME'].'</p>';
                              break;
                            case 'Order':
                              echo '<p style="color: green;">'.$rows['E_FULLNAME'].'</p>';
                              break;
                            case 'Phục vụ':
                              echo '<p style="color: blue;">'.$rows['E_FULLNAME'].'</p>';
                              break;
                          }
                          
                        else
                          echo "";
                      }
                    }
                  ?>
                </td>
                <?php
                  }
                 ?>
              </tr>
              <?php
              }
            }
           ?>
        </tbody>
      </table>
      <hr>
      <form method="post" onsubmit="return confirm('Toàn bộ lịch trực sẽ bị xóa!');">
        <button type="submit" class="btn btn-block btn-danger" name="resetBtn">Đặt lại lịch trực</button>
      </form>
      <?php
        if (isset($_POST['resetBtn'])) {
          $reset_detail_shift = "DELETE FROM detail_shift";
          mysqli_query($conn, $reset_detail_shift);
          $reset_shift = "DELETE FROM shift";
          mysqli_query($conn, $reset_shift);
        }
      ?>
</div>
                    <div class="tab-pane" id="salary">
                      <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Lương</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Lương nhân viên</li>
                        </ol>
                      </nav>
                      <hr>
                      <?php
                        include 'sql_conn.php';
                        error_reporting(E_PARSE);

                        $select = "SELECT * FROM employees";
                        $select_query = mysqli_query($conn, $select);
                        $account = array(); 
                        if ($select_query->num_rows > 0) {
                          while ($row = mysqli_fetch_assoc($select_query)) {
                            array_push($account, $row['E_ID']);
                          }
                        }
                        echo '<table class="table table-hover table-bordered">
                              <thead>
                                <tr>
                                  <th scope="col">STT</th>
                                  <th scope="col">Họ tên</th>
                                  <th scope="col">Công việc</th>
                                  <th scope="col">Số ca trực/Tháng</th>
                                  <th scope="col">Tổng tiền lương</th>
                                </tr>
                              </thead>
                              <tbody>';
                        foreach ($account as $key) {
                          $create = "CREATE VIEW tam".$key." AS SELECT S_ID, employees.E_FULLNAME as E_FULLNAME, employees.E_ID as E_ID, employees.E_JOB as E_JOB,COUNT(DS_SHIFTNAME) as sumOfShifts, COUNT(DS_SHIFTNAME)*DS_SALARYOFSHIFT as sumOfSalary
                          FROM detail_shift INNER JOIN employees ON employees.E_ID = detail_shift.E_ID
                          WHERE employees.E_ID  = '".$key."'";
                          $create_query = mysqli_query($conn, $create);
                          $sel = "SELECT DISTINCT * FROM tam".$key."";
                          $sel_query = mysqli_query($conn, $sel);
                          if ($sel_query->num_rows > 0) {
                            while ($row = mysqli_fetch_assoc($sel_query)) { 
                              if ($row['sumOfSalary'] > 0) {
                                $i+= 1;
                              ?>
                              <tr>
                                <th><?php echo $row['E_ID']; ?></th>
                                <td><?php echo $row['E_FULLNAME']; ?></td>
                                <td><?php echo $row['E_JOB']; ?></td>
                                <td class="text-right"><?php echo $row['sumOfShifts']; ?></td>
                                <td class="text-right"><?php echo number_format($row['sumOfSalary'], 0); ?> VNĐ</td>
                              </tr>
                            <?php
                              }
                            }
                          } 
                          $dropView = "DROP VIEW tam".$key."";
                          $dropView_query = mysqli_query($conn, $dropView);
                        }
                        echo  '</tbody>
                            </table>';
                      ?>
                    </div>
                </div>
            </div>
          </div>
          
        </div>
      </main>
  </body>
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
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Google Maps Plugin  -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="assets/js/plugins/jasny-bootstrap.min.js" type="text/javascript"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="assets/js/material-kit.js?v=2.1.1" type="text/javascript"></script></body>
</html>