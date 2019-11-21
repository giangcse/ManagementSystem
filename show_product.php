<?php
  if (!isset($_SESSION))
    session_start();
  else
    if (!isset($_SESSION['account']))
      header('Location: index.php');


  function show(){
    include 'sql_conn.php';

    $show = "SELECT * FROM product";
    $show_query = mysqli_query($conn, $show);
    if($show_query->num_rows > 0)
      while($row = mysqli_fetch_assoc($show_query)){
        $gia = number_format($row['P_PRICE'], 0); 
        $ten = substr($row['P_NAME'], 0, 15).'...';
?>
      <!-- Hien thi the san pham -->
      <div class="col-md-3">
        <a data-toggle="modal" data-target="#<?php echo $row['P_ID']; ?>" class="custom-card">
          <div class="card mb-4 shadow-sm" style="display: inline-block">
            <img class="card-img-top" src="<?php echo $row['P_THUMB_IMG']; ?>">
            <div class="card-body">
              <h6 style="font-family: 'Roboto Slab', serif; font-size: 15px;"><?php echo $ten; ?></h6>
              <h4 class="card-text" id="currency" style="color: green;"><?php echo $gia; ?> đ</h4>
              <div class="d-flex justify-content-between align-items-center">
                <p class="text-mute" style="color: red;"><?php echo $row['P_SPECIES']; ?></p>
              </div>
            </div>
          </div>
        </a>
      </div>
      <!-- modal hiển thị thông tin sản phẩm -->
      <div class="modal fade" id="<?php echo $row['P_ID']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <form method="POST" action="add_to_cart.php">
                  <div class="row">
                    <div class="col-md-6">
                      <img src="<?php echo $row['P_THUMB_IMG']; ?>" alt="<?php echo $row['P_ID']; ?>" width="500" class="img-fluid" alt="Responsive image">
                    </div>
                    <div class="col-md-6">
                      <h3><?php echo $row['P_NAME']; ?></h3>
                      <h5 style="color: green;"><?php echo $gia; ?> đ</h5>
                      <p><?php echo $row['P_SPECIES']; ?></p>  
                      <div class="def-number-input number-input safari_only">
                        <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus" type="button" ></button>
                        <input class="quantity" min="0" name="quantity" value="1" type="number">
                        <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus" type="button" ></button>
                      </div>
                      <div class="form-inline">
                        <button type="submit" class="btn btn-primary" name="addToCart" value="<?php echo $row['P_ID']; ?>">Thêm vào giỏ</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php
      }      
  }
?>