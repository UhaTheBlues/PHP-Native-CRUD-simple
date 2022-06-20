<?php
  require_once('db.php');
  $upload_dir = 'uploads/';

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from contacts where id=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
    }else {
      $errorMsg = 'Could not Find Any Record';
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP CRUD</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" charset="utf-8"></script>
  </head>
  <body>

      <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
          
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto"></ul>

          </div>
        </div>
      </nav>

      <div class="container">
        <div class="row justify-content-center">
          <div class="card">
            <div class="card-header">
              <div class="font-weight-bold float-left">Detail Barang</div>
              <a class="btn btn-outline-danger float-right" href="index.php"><i class="fa fa-sign-out-alt">   Kembali</i></a>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md">
                    <img src="<?php echo $upload_dir.$row['image'] ?>" height="200">
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-archive"> Nama Barang</i></span>
                          </div>
                          <h5 class="form-control">
                            <span span><?php echo $row['name'] ?></span>
                          </h5>
                          <div class="input-group-append">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-wallet"> Harga Beli</i></span>
                          </div>
                          <h5 class="form-control">
                            <span span><?php echo $row['hargabeli'] ?></span>
                          </h5>
                          <div class="input-group-append">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-wallet"> Harga Jual</i></span>
                          </div>
                          <h5 class="form-control">
                            <span span><?php echo $row['hargajual'] ?></span>
                          </h5>
                          <div class="input-group-append">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-shopping-cart"> Stok</i></span>
                          </div>
                          <h5 class="form-control">
                            <span span><?php echo $row['stok'] ?></span>
                          </h5>
                          <div class="input-group-append">
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>


      <script src="js/bootstrap.min.js" charset="utf-8"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js" charset="utf-8"></script>
      <script type="text/javascript">
      $(document).ready(function() {
          $('#example').DataTable();
        } );
      </script>
    </body>
  </html>
