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
            <li class="nav-item active">
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
            <div class="card-header card-header-success">
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#product" data-toggle="tab"><i class="material-icons">local_cafe</i> Sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#warehouse" data-toggle="tab"><i class="material-icons">local_convenience_store</i> Kho</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#supplier" data-toggle="tab"><i class="material-icons">local_grocery_store</i> Nhà cung cấp</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><div class="card-body ">
                <div class="tab-content text-center">
                    <div class="tab-pane active" id="product">
                       <section name="listProduct">
                        <nav aria-label="breadcrumb" role="navigation">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách sản phẩm</li>
                          </ol>
                        </nav>
                        <hr>
                        <div class="row">
                          <div class="col-auto mr-auto" id="numberOfProduct">
                            <?php
                              include('sql_conn.php');
                              $numberOfProduct = "SELECT COUNT(P_ID) as total FROM product";
                              $sqlCount = mysqli_query($conn, $numberOfProduct); //Thực hiện truy vấn đếm dựa vào id
                              $data = mysqli_fetch_assoc($sqlCount); //Đưa tất cả dữ liệu select được vào mảng
                              echo "<h4>Có tất cả ".$data['total']." sản phẩm các loại</h4>";
                            ?>
                          </div>
                          <!-- Tạo nút nhấn hiện modal -->
                          <div class="col-auto">
                              <button class="btn btn-round btn-success" data-toggle="modal" data-target="#addModal"><i class="material-icons">add_circle_outline</i> THÊM SẢN PHẨM</button>
                          </div>
                          <!-- Modal -->
                          <div class="modal fade" id="addModal" tabindex="-1" role="">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <form method="get" action="add_product.php" class="needs-validation" onsubmit="return validate_add_product()">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="addModalTitle">Thêm sản phẩm</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group bmd-form-group">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="material-icons">assignment</i></div>
                                         </div>
                                         <input type="text" name="pName" id="pName" class="form-control" placeholder="Tên sản phẩm" required>
                                         </div>
                                      </div>
                                    <div class="form-group bmd-form-group">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="material-icons">add_photo_alternate</i></div>
                                         </div>
                                         <input type="text" name="pPhoto" id="pPhoto" class="form-control" placeholder="Link ảnh" required>
                                         </div>
                                      </div>
                                      <div class="form-group bmd-form-group">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="material-icons">attach_money</i></div>
                                         </div>
                                         <input type="text" name="pPrice" id="pPrice" class="form-control" placeholder="Giá tiền" pattern="\[0-9]{1,11}" required>
                                         </div>
                                      </div>
                                      <div class="form-group bmd-form-group">
                                       <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="material-icons">label</i></div>
                                        </div>
                                        <input class="form-control" type="text" name="pSpecies" id="pSpecies" placeholder="Loại sản phẩm"></input> 
                                       </div>
                                      </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                  <button type="submit" class="btn btn-success">Thêm</button>
                                </div>
                              </form>
                              </div>
                            </div>
                          </div>
<!-- validate add_product form script -->
<script type="text/javascript">
  function validate_add_product(){
    var name = document.getElementById('pName').value;
    var price = document.getElementById('pPrice').value;
    var species = document.getElementById('pSpecies').value;
    var photo = document.getElementById('pPhoto').value;

    if (name!="" && price!="" && species!="" && photo!="")
      if (price >= 0){
        return true;
      }
      else{
        alert('Giá không được nhỏ hơn 0đ');
        return false;
      }
    else{
      alert('Vui lòng điền đầy đủ thông tin.');
      return false;
    }
    return false;
  }
</script>
<?php
  if (isset($_SESSION['addP'])) {
    if ($_SESSION['addP']=="yes") {
    ?>
    <script type="text/javascript">
      Swal.fire({
        type: 'success',
        title: 'Đã thêm sản phẩm!',
        showConfirmButton: false,
        timer: 1500
      })
    </script>
    <?php
    } else {
    ?>
    <script type="text/javascript">
      Swal.fire({
        type: 'error',
        title: 'Chưa thêm sản phẩm!',
        showConfirmButton: false,
        timer: 1500
      })
    </script>
    <?php
    }
    unset($_SESSION['addP']);
  }
?>
<!-- Bảng hiển thị danh sách sản phẩm -->
<table class="table table-hover" name="productTable">
  <thead>
    <tr>
      <th>Mã</th>
      <th>Hình ảnh</th>
      <th class="text-left">Tên sản phẩm</th>
      <th><form method="POST" class="form-inline">
      <select onchange="this.form.submit()" class="selectpicker show-tick" data-style="select-with-transition" id="filter" name="filter"> <!-- onchange="this.form.submit()" để tự submit khi chọn loại cần lọc không cần nhấn nút -->
        <option selected value="">Chọn loại</option>
        <?php 
          $select_sp = "SELECT DISTINCT P_SPECIES FROM product";
          $select_sp_result = mysqli_query($conn, $select_sp);
          if ($select_sp_result->num_rows > 0) 
            while ($row1 = mysqli_fetch_assoc($select_sp_result)) {
              echo '<option value="'.$row1['P_SPECIES'].'">'.$row1['P_SPECIES'].'</option>';
            }
        ?>
      </select> 
      </form></th>
      <th class="text-right">Giá</th>
      <th class="text-right">Thao tác</th>
    </tr>
  </thead>
  <tbody>
  <?php
    include('sql_conn.php');
    error_reporting(E_PARSE); //Ẩn lỗi 
    if ($_POST["filter"] == "") {
      $select_query = "SELECT * FROM product"; //Câu truy vấn khi không lọc
    } else {
      $select_query = "SELECT * FROM product WHERE P_SPECIES='".$_POST["filter"]."'"; //Câu truy vấn khi chọn loại để lọc
    }

    $query0 = mysqli_query($conn, $select_query); //Thực hiện câu truy vấn
    if ($query0->num_rows > 0) { //Kiểm tra số dòng
      while ($row = mysqli_fetch_assoc($query0)) { //Đưa số vòng vào một mảng để hiển thị
        $Gia= number_format($row['P_PRICE'], 0);
  ?>
    <tr>
      <td><?php echo $row["P_ID"]; ?></td>
      <td><img src="<?php echo $row["P_THUMB_IMG"]; ?>" width="120" /></td>
      <th class="text-left"><?php echo $row["P_NAME"]; ?></th>
      <td><?php echo $row["species"]; ?></td>
      <td class="text-right"><?php echo $Gia; ?> VNĐ</td>
      <td class="td-actions text-right">
        <form method="get" action="delete_product.php"> 
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit<?php echo $row['P_ID']; ?>">
            <i class="material-icons">edit</i>
          </button>
          <button type="submit" rel="tooltip" class="btn btn-danger btn-sm" id="delete" name="delete" value="<?php echo $row["P_ID"]; ?>" onsubmit="return verify()">
            <i class="material-icons">delete</i>
          </button>
        </form>
      </td>
    </tr>
<script type="text/javascript">
  function verify(){
    var re = false
    Swal.fire({
      title: 'Bạn có muốn xóa sản phẩm này?',
      text: "Không thể hoàn tác lại được!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        Swal.fire(
          'Đã xóa!',
          '',
          'success'
        )
        re = true
      }else{
        re = false
      }
    })
    return re
  }
</script>
                              <!-- Modal chỉnh sửa -->
                            <div class="modal fade" id="edit<?php echo $row['P_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel"><?php echo $row['P_NAME']; ?></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body text-left">
                                  <form method="get" action="edit_product.php">
                                  <div class="form-group">
                                    <label for="product-price">Giá sản phẩm</label>
                                    <input type="text" name="product-price" pattern="\d{1,9}" class="form-control" id="product-price" placeholder="<?php echo $Gia; ?>đ">
                                  </div>
                                  <div class="form-group">
                                    <label for="product-link">Link hình ảnh</label>
                                    <input type="text" class="form-control" name="product-link" id="product-link" placeholder="<?php echo $row['P_THUMB_IMG']; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="product-specie">Loại sản phẩm</label>
                                    <input type="text" name="product-specie" id="product-specie" class="form-control" placeholder="<?php echo $row['P_SPECIES']; ?>">
                                  </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <button type="submit" name="edit" value="<?php echo $row['P_ID']; ?>" class="btn btn-success">Cập nhật</button>
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
                      </section>
                    </div>
                    <div class="tab-pane" id="warehouse">
                        <nav aria-label="breadcrumb" role="navigation">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Kho</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách mặt hàng</li>
                          </ol>
                        </nav>
                        <table class="table table-hover" name="productTable">
                            <thead>
                              <tr>
                                <th>Mã</th>
                                <th>Nguyên liệu</th>
                                <th>Còn lại</th>
                                <th class="text-right">Thao tác</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                include('sql_conn.php');
                                error_reporting(E_PARSE); //Ẩn lỗi 
                                $select_query = "SELECT * FROM warehouse";
                              
                              $query0 = mysqli_query($conn, $select_query); //Thực hiện câu truy vấn
                              if ($query0->num_rows > 0) { //Kiểm tra số dòng
                                while ($row = mysqli_fetch_assoc($query0)) { //Đưa số vòng vào một mảng để hiển thị
                                  echo '<tr>
                                          <td>'.$row["W_ID"].'</td>
                                          <th>'.$row["W_MATERIAL"].'</th>
                                          <td>'.$row["W_REMAIN"].' '.$row['W_UNIT'].'</td>
                                          <td class="td-actions text-right">
                                            <form method="post">
                                              <button type="button" rel="tooltip" class="btn btn-success"data-toggle="modal" data-target="#editModal'.$row["W_ID"].'">
                                                  <i class="material-icons">edit</i>
                                              </button>
                                              
                                            </form>
                                          </td>
                                        </tr>
                                        <!-- Modal chỉnh sửa -->
                                        <div class="modal fade" id="editModal'.$row["W_ID"].'" tabindex="-1" role="">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <form method="post" class="needs-validation" novalidate>
                                              <div class="modal-header">
                                                <h4 class="modal-title" id="addModalTitle">Cập nhật nguyên liệu <strong>'.$row["W_MATERIAL"].'</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="form-group bmd-form-group">
                                                <div class="input-group">
                                                  <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="material-icons">notification_important</i></div>
                                                   </div>
                                                   <input type="text" name="used" id="used" class="form-control" placeholder="Số lượng đã dùng" pattern="\d{1,9}" required>
                                                   </div>
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                <input type="submit" name="ediBtn'.$row["W_ID"].'" class="btn btn-success" value="Cập nhật">
                                              </div>
                                            </form>
                                            </div>
                                          </div>
                                        </div>
                                        ';
                                        $editBtn = "ediBtn".$row['W_ID'];
                                        if (isset($_POST[$editBtn])){
                                          $remain = $row['W_REMAIN'] - $_POST['used'];
                                          $edi = "UPDATE warehouse SET W_REMAIN = '".$remain."' WHERE W_ID = '".$row['W_ID']."'";
                                          $edi_query = mysqli_query($conn, $edi); //Thuc thi cau lenh update
                                          echo '<script type="text/javascript">
                                                window.location.href = "product.php";
                                                </script>'; //Dùng JS để load lại page sau khi update
                                        }
                                }
                              }
                              ?>
                            </tbody>
                          </table>
                        <hr>
                    </div>
                    <div class="tab-pane" id="supplier">
                      <nav aria-label="breadcrumb" role="navigation">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Nhà cung cấp</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nhập hàng</li>
                          </ol>
                        </nav>
                        <form method="get" action="add_supplier.php" onsubmit="return validateSup()">
                            <div class="form-row">
                              <div class="col-4">
                                <label class="bmd-label-static">Tên nhà cung cấp*</label>
                                <input type="text" name="name" id="name" class="form-control" >
                              </div>
                              <div class="col-2">
                                <label class="bmd-label-static">Số điện thoại*</label>
                                <input type="text" name="phone" id="phone" class="form-control" pattern="\d{10,10}">
                              </div>
                              <div class="col">
                                <label class="bmd-label-static">Địa chỉ*</label>
                                <input type="text" name="address" id="address" class="form-control" >
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="col-4">
                                <label class="bmd-label-static">Tên nguyên liệu</label>
                                <input type="text" name="material" id="material" class="form-control">
                              </div>
                              <div class="col">
                                <label class="bmd-label-static">Số lượng</label>
                                <input type="text" name="quantity" id="quantity" pattern="\d{1,9}" class="form-control">
                              </div>
                              <div class="col">
                                <label class="bmd-label-static">Đơn vị tính</label>
                                <input type="text" name="unit" id="unit" class="form-control">
                              </div>
                              <div class="col">
                                <label class="bmd-label-static">Giá thành</label>
                                <input type="text" name="cost" id="cost" class="form-control" pattern="\[0-9]">
                              </div>
                            </div>
                              <div class="row">
                                <div class="col-auto mr-auto"> </div>
                                <div class="col-auto">
                                <button class="btn btn-success" type="submit"><i class="material-icons">add</i> THÊM</button>
                                </div>
                              </div>
                          </form>
<?php 
  if (isset($_SESSION['sup'])) {
    if ($_SESSION['sup']=="yes") {
     ?>
     <script type="text/javascript">
       Swal.fire({
        type: 'success',
        title: 'Đã thêm nhà cung cấp!',
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
        title: 'Thêm nhà cung cấp thất bại!',
        showConfirmButton: false,
        timer: 1500
      })
    </script>
      <?php
    }
    unset($_SESSION['sup']);
  }
?>
                          <hr>
                        <nav aria-label="breadcrumb" role="navigation">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Nhà cung cấp</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách nhà cung cấp</li>
                          </ol>
                        </nav>
                        <hr>
                        <p class="text-muted">Click vào từng dòng để hiện thông tin</p>
                        <table class="table table-hover table-bordered" name="supplierTable">
                          <thead>
                            <tr>
                              <th>Mã NCC</th>
                              <th>Tên Nhà cung cấp</th>
                              <th>Địa chỉ</th>
                              <th>Số điện thoại</th>
                            </tr>
                          </thead>
                          <tbody>
<?php
  $showSupplier = "SELECT * FROM supplier";
  $showSupplier_query = mysqli_query($conn, $showSupplier);

  if ($showSupplier_query->num_rows > 0)
    while ($rows = mysqli_fetch_assoc($showSupplier_query)) {
    ?>
    <tr data-toggle="modal" data-target="#showMore<?php echo $rows['SU_ID']; ?>">
      <td><?php echo $rows['SU_ID']; ?></td>
      <th><?php echo $rows['SU_NAME']; ?></th>
      <td><?php echo $rows['SU_ADDRESS']; ?></td>
      <td><?php echo $rows['SU_PHONE']; ?></td>
    </tr>
    <!-- Modal Show information -->
    <div class="modal fade" id="showMore<?php echo $rows['SU_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="showMoreModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="showMoreModal">Chi tiết đơn đặt hàng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <?php
            $showInfo = "SELECT * FROM detail_import LEFT JOIN shift ON shift.S_ID = detail_import.S_ID RIGHT JOIN detail_shift ON detail_shift.S_ID = shift.S_ID LEFT JOIN employees ON employees.E_ID = detail_shift.E_ID WHERE detail_import.SU_ID = '".$rows['SU_ID']."'";
            $showInfo_query = mysqli_query($conn, $showInfo);
            if ($showInfo_query->num_rows > 0){
              while ($row1 = mysqli_fetch_assoc($showInfo_query)) {
              ?>
                <ul class="text-left">
                  <li>Mã: <?php echo $row1['W_ID']; ?></li>
                  <li>Số lượng: <?php echo $row1['DI_QUANTITY']." ".$row1['DI_UNIT']; ?></li>
                  <li>Giá nhập: <?php echo number_format($row1['DI_COST'], 0); ?>đ</li>
                  <li>Ngày nhập: <?php echo date('h:i:s d/m/Y', strtotime($row1['DI_DAY'])); ?></li>
                  <li>Nhân viên nhập: <?php echo $row1['E_FULLNAME']; ?></li>
                </ul>
                <hr>
              <?php
              }
            }
          ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>
    <?php
    }
?>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </main>
  </body>
  <footer class="footer footer-default" >
    <div class="container">
      <nav class="float-left">
        <ul>
          <li>
          &copy;
          <script>
              document.write(new Date().getFullYear())
          </script>
          </li>
        </ul>
      </nav>
      <div class="copyright float-right">
          Made with <i class="material-icons">all_inclusive</i> love by
          Giang
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