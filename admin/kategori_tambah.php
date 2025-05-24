<?php include ('session.php');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 	<title>Petit Luxe Cakes STORE | Tambah Data</title>
    <link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
</head>
<body>
	<div class="wrapper">
		<div class="header"></div>
		<div class="sidebar">
			<div class="sidebar-title"><b>Petit Luxe Cakes Mart</b></div>
			<ul>
				<?php include'sidebar.php' ?>
			</ul>
		</div>
  		<div class="section">
			<div class="container"> 
				<?php 
					$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id_login']."' ");
					$d = mysqli_fetch_object($query);
				?>
				<form  action="" method="post" >
					<h3>+Tambah Data Kategori</h3>
					<fieldset>
					<input type="text" name="nama" placeholder="Nama Kategori" class="form-control"  required>
					</fieldset>
					<fieldset>
					<button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Tambah</button>
					</fieldset>
				</form>
				<?php
					if(isset($_POST['submit'])){
						$nama = $_POST['nama'];
						//menginput data ke database
						$insert = mysqli_query($conn, "INSERT INTO tb_category (category_name) VALUES('$nama')");

						if($insert){
							echo '<script>alert("Tambah data berhasil")</script>';
							echo '<script>window.location="kategori_data.php"</script>';
						}else{
							echo 'gagal '.mysqli_error($conn);
						}								
					}
				?>
			</div>
   		</div>
  	</div>
</body>
</html>