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

  if(isset($_POST['Submit'])){
		$name = $_POST['name'];
    $hargabeli = $_POST['hargabeli'];
	  $hargajual = $_POST['hargajual'];
	  $stok = $_POST['stok'];


		$imgName = $_FILES['image']['name'];
		$imgTmp = $_FILES['image']['tmp_name'];
		$imgSize = $_FILES['image']['size'];

		if($imgName){

			$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

			$allowExt  = array('jpeg', 'jpg', 'png');

			$userPic = time().'_'.rand(1000,9999).'.'.$imgExt;

			if(in_array($imgExt, $allowExt)){

				if($imgSize < 100000){
					unlink($upload_dir.$row['image']);
					move_uploaded_file($imgTmp ,$upload_dir.$userPic);
				}else{
					$errorMsg = 'Gambar harus dibawah 100kb';
					echo "<script type='text/javascript'>alert('$errorMsg');</script>";
				}
			}else{
        $errorMsg = 'Hanya ektensi | .jpeg | .jpg | .png | diperbolehkan';
        echo "<script type='text/javascript'>alert('$errorMsg');</script>";
			}
		}else{

			$userPic = $row['image'];
		}

		if(!isset($errorMsg)){
			$sql = "update contacts
									  set name = '".$name."',
										hargabeli = '".$hargabeli."',
                    hargajual = '".$hargajual."',
                    stok = '".$stok."',
										image = '".$userPic."'
					where id=".$id;
			$result = mysqli_query($conn, $sql);
			if($result){
				$successMsg = 'New record updated successfully';
				header('Location:index.php');
			}else{
				$errorMsg = 'Error '.mysqli_error($conn);
			}
		}

	}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tes</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav ml-auto">
              
            </ul>
        </div>
      </div>
    </nav>

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <div class="font-weight-bold float-left">Edit Barang</div>
                <a class="btn btn-outline-danger float-right" href="index.php"><i class="fa fa-sign-out-alt">   Kembali</i></a>
              </div>
              <div class="card-body">
                <form class="" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Nama Barang</label>
                      <input type="text" class="form-control" name="name"  placeholder="Masukan Nama Barang" value="<?php echo $row['name']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="hargabeli">Harga Beli</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                          </div>
                          <input type="number" class="form-control" name="hargabeli" placeholder="Masukan Harga Beli" value="<?php echo $row['hargabeli']; ?>">
                          <div class="input-group-append">
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="hargajual">Harga Jual</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                          </div>
                          <input type="number" class="form-control" name="hargajual" placeholder="Masukan Harga Jual" value="<?php echo $row['hargajual']; ?>">
                          <div class="input-group-append">
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="stok">Stok</label>
                      <input type="number" class="form-control" name="stok" placeholder="Masukan Jumlah Stok" value="<?php echo $row['stok']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="image">Pilih Foto Barang</label>
                      <div class="container">
                        <img src="<?php echo $upload_dir.$row['image'] ?>" width="150">
                        <input type="file" class="form-control" name="image" value="">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <button type="submit" name="Submit" class="btn btn-primary waves">Submit</button>
                      
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <script src="js/bootstrap.min.js" charset="utf-8"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" charset="utf-8"></script>
  </body>
</html>
