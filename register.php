<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register | Petit Luxe Cakes</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body id="bg-login">
<div class="box-login">
<h2>Isi Data Anda</h2>
<form action="" method="POST">
    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" required>
    <input type="text" name="alamat" placeholder="Alamat" class="input-control" required>
    <input type="text" name="telpon" placeholder="Telpon" class="input-control" required>
    <input type="text" name="email" placeholder="Email" class="input-control" required>
    <hr><br>
    <input type="text" name="user" placeholder="Username" class="input-control" required>
    <input type="password" name="pass" placeholder="Password" class="input-control" required>
    <input type="submit" name="submit" value="Register" class="btn">
</form>
<?php
include('db.php');
if(isset($_POST['submit'])){
    $nama = htmlspecialchars($_POST['nama']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $telpon = htmlspecialchars($_POST['telpon']);
    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['user']);
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    $insert = mysqli_query($conn, "INSERT INTO labib1289 (admin_name, username, password, admin_telp, admin_email, admin_address, level) VALUES ('$nama', '$username', '$password', '$telpon', '$email', '$alamat', 'pelanggan')");
    if($insert){
        echo "<script>alert('Berhasil, silakan login')</script>";
        echo '<script type="text/javascript">window.location="login.php"</script>';
    } else {
        echo "<script>alert('Gagal')</script>";
        echo '<script type="text/javascript">window.location="register.php"</script>';
    }
}
?>
</div>
</body>
</html>