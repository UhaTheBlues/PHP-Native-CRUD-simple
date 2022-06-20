<?php
  include('db.php');
  $upload_dir = 'uploads/';

  if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		$sql = "SELECT * FROM contacts WHERE id = ".$id;
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			$image = $row['image'];
			unlink($upload_dir.$image);
			$sql = "DELETE from contacts WHERE id=".$id;
			if(mysqli_query($conn, $sql)){
				header('location:index.php');
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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" charset="utf-8"></script>
  </head>
  <body>
      <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
          <a class="navbar-brand" href="index.php"><i class="fa fa-archive">   Tes Praktek Web Programmer</i></a>
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
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                      <div class="container">
                        <div class="row">
                          <div class="col-auto">
                              <form action="" method="get">
                              <input class="form-control" type="text" name="term"  placeholder="Masukan Nama Barang" aria-label="Masukan Nama Barang" aria-describedby="button-addon2">
                          </div>
                          <div class="col">
                          <button class="btn btn-primary" type="submit" id="button-addon2">Cari Barang</button>
                          </div>
                          <div class="col">
                            <a class="btn btn-primary float-right" href="create.php"><i class="fa fa-plus">   Tambah Barang</i></a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card-body">
                      <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                
                                <th>Foto Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                          <?php
                          $batas   = 5;
                          $halaman = @$_GET['halaman'];
                              if(empty($halaman)){
                                  $posisi  = 0;
                                  $halaman = 1;
                              }
                              else{
                                  $posisi  = ($halaman-1) * $batas;
                              }

                          $id = $posisi+1;
                          
                          if(isset($_GET['term'])){
                            $term = $_GET['term'];
                            $term = mysqli_real_escape_string($conn,$_GET['term']);     
                            $sql = "SELECT * FROM contacts WHERE name LIKE '%".$term."%'"; 
                            $hasil = mysqli_query($conn,$sql); 				
                          }else{
                            $sql="select * from contacts order by id asc limit $posisi,$batas";
                            $hasil=mysqli_query($conn,$sql);	
                          }

                          while ($data = mysqli_fetch_array($hasil)) {
                              ?>
                        <tbody>
                          <tr>
                            
                            <td><img src="<?php echo $upload_dir.$data['image'] ?>" height="40"></td>
                            <td><?php echo $data["name"];   ?></td>
                            <td><?php echo $data["hargabeli"];   ?></td>
                            <td><?php echo $data["hargajual"];   ?></td>
                            <td><?php echo $data["stok"];   ?></td>
                            <td class="text-center">
                                <a href="show.php?id=<?php echo $data['id'] ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                <a href="edit.php?id=<?php echo $data['id'] ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                <a href="index.php?delete=<?php echo $data['id'] ?>" class="btn btn-danger" onclick="return confirm('Delete barang ini?')"><i class="fa fa-trash-alt"></i></a>
                              </td>
                          </tr>
                        </tbody>
                        <?php
                            $id++;
                        }
                        ?>
                      </table>
                      <hr>
                      <?php
                        $query2     = mysqli_query($conn, "select * from contacts");
                        $jmldata    = mysqli_num_rows($query2);
                        $jmlhalaman = ceil($jmldata/$batas);
                        ?>
                        <div class="text-center">
                            <ul class="pagination">
                                <?php
                                for($i=1;$i<=$jmlhalaman;$i++) {
                                    if ($i != $halaman) {
                                        echo "<li class='page-item'><a class='page-link' href='index.php?halaman=$i'>$i</a></li>";
                                    } else {
                                        echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

    <script src="js/bootstrap.min.js" charset="utf-8"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" charset="utf-8"></script>
    
    
    <!-- <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
      } );
    </script> -->
  </body>
</html>
