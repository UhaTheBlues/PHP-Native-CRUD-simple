<?php
  require_once('db.php');
  $upload_dir = 'uploads/';

  if (isset($_POST['Submit'])) {
	 
    $name = $_POST['name'];
	$hargabeli = $_POST['hargabeli'];
	$hargajual = $_POST['hargajual'];
	$stok = $_POST['stok'];

    $imgName = $_FILES['image']['name'];
	$imgTmp = $_FILES['image']['tmp_name'];
	$imgSize = $_FILES['image']['size'];

    if(empty($name)){
			$errorMsg = 'Please input name';
		}elseif(empty($hargabeli)){
			$errorMsg = 'Please input hargabeli';
		}elseif(empty($hargajual)){
			$errorMsg = 'Please input hargajual';
		}elseif(empty($stok)){
			$errorMsg = 'Please input stok';
		}
		else{

			$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

			$allowExt  = array('jpeg', 'jpg', 'png');

			$userPic = time().'_'.rand(1000,9999).'.'.$imgExt;

			if(in_array($imgExt, $allowExt)){

				if($imgSize < 100000){
					move_uploaded_file($imgTmp ,$upload_dir.$userPic);
				}else{
					$errorMsg = 'Image too large';
					
				}
				}else{
				$errorMsg = 'Please select a valid image';
			}
		}


		if(!isset($errorMsg)){
			$sql = "insert into contacts(name, hargabeli, hargajual, stok, image)
					values('".$name."', '".$hargabeli."', '".$hargajual."','".$stok."', '".$userPic."')";
			$result = mysqli_query($conn, $sql);
			if($result){
				
				
				$successMsg = 'New record added successfully';
				header('Location: index.php');
			}else{
				$errorMsg = 'Error '.mysqli_error($conn);
				
			}
		}
  }
?>
