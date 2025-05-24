<?php 
include('session.php'); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Edit Profil</title>
<link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
</head>
<body>
<div class="wrapper">
<div class="header">
</div>
<div class="sidebar">
<div class="sidebar-title"><b>Edit Profil</b></div>
<ul>
<?php include 'sidebar.php'; ?>
</ul>
</div>
<div class="section">
<div class="container">
<?php
$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '" . $_SESSION['id_login'] . "' ");
$d = mysqli_fetch_object($query);
?>

<form id="contact" action="" method="post">
<h3>Profil</h3>
<fieldset class="small-fieldset">
<input type="text" name="nama" placeholder="Nama Lengkap" class="form-control" value="<?php echo $d->admin_name; ?>" required>
<br>
<br>
<input type="text" name="user" placeholder="Username" class="form-control" value="<?php echo $d->username; ?>" required>
<br>
<br>
<input type="text" name="hp" placeholder="No Hp" class="form-control" value="<?php echo $d->admin_telp; ?>" required>
<br>
<br>
<input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo $d->admin_email; ?>" required>
<br>
<br>
<input type="text" name="alamat" placeholder="Alamat" class="form-control" value="<?php echo $d->admin_address; ?>" required>
<br>
<br>
<button name="submit" type="submit" id="contact-submit" data-submit="... Sending">Ubah Profil</button>
</fieldset>

</form>

<?php
if (isset($_POST['submit'])) {
    // Get the form values
    $nama = $_POST['nama'];
    $user = $_POST['user'];
    $hp = $_POST['hp'];
    $email = $_POST['email'];
    $alamat = ucwords($_POST['alamat']);

    // Update query
    $update = mysqli_query($conn, "UPDATE tb_admin SET admin_name = '" . $nama . "', username = '" . $user . "', admin_telp = '" . $hp . "', admin_email = '" . $email . "', admin_address = '" . $alamat . "' WHERE admin_id = '" . $d->admin_id . "' ");
    
    if ($update) {
        echo '<script>alert("Ubah data berhasil")</script>';
        echo '<script>window.location="profil.php"</script>';
    } else {
        echo 'Gagal: ' . mysqli_error($conn);
    }
}
?>

<form id="contact" action="" method="post">
<h3>Ubah Password</h3>
<fieldset class="small-fieldset">
<input type="password" name="pass1" placeholder="Password Baru" class="form-control" required>
<br>
<br>
<input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="form-control" required>
<br>
<br>
<button name="ubah_password" type="submit" id="contact-submit" data-submit="... Sending">Ubah Password</button>
</fieldset>

</form>

<?php
if (isset($_POST['ubah_password'])) {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if ($pass1 != $pass2) {
        echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
    } else {
        // Update password
        $update_pass = mysqli_query($conn, "UPDATE tb_admin SET password = '" . password_hash($pass1, PASSWORD_DEFAULT) . "' WHERE admin_id = '" . $d->admin_id . "' ");

        if ($update_pass) {
            echo '<script>alert("Ubah password berhasil")</script>';
            echo '<script>window.location="profil.php"</script>';
        } else {
            echo 'Gagal: ' . mysqli_error($conn);
        }
    }
}
?>
</div>
</div>
</div>
</body>
</html>