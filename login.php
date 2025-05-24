<html lang="en">
  //davabau67
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Petit Luxe Cakes </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<form action="" method="post">
<body id="bg-login">
  <div class="main-wrapper">
    <!-- Box Login -->
    <div class="login-container">
      <h2>Login</h2>
      <div class="input-group">
        <i class="fa fa-user"></i>
        <input type="text" name="user" placeholder="Type your username……">
      </div>
      <div class="input-group">
        <i class="fa fa-lock"></i>
        <input type="password" name="pass" placeholder="Type your password……">
        <i class="fa fa-eye"></i>
      </div>
      <div class="options">
        <label><input type="checkbox"> stay signed</label>
        <a href="#">Lupa Password?</a>
      </div>
      <button class="login-btn" name="submit">Login</button>
      <p>
        <label>Don't have an account yet?</label>
        <a href="register.php"><strong>Click Here To Register</strong></a>
      </p>
      <div class="social-login">
        <p>atau</p>
        <div class="social-icons">
          <img src="images-removebg-preview.png" alt="Google">
          <img src="Facebook_Logo_2023.png" alt="Facebook">
          <img src="images__1_-removebg-preview.png" alt="X">
        </div>
      </div>
    </div>

    <!-- Box Gambar Samping -->
    <div class="info-section">
      <img src="petit luxe cakes.png" alt="Info Gambar">
    </div>
  </div>





        </form>

        <?php
        include('db.php');
        if (isset($_POST['submit'])) {
            $username = $_POST['user'];
            $password = $_POST['pass'];
            
            $sql = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username='$username' AND password='$password'")
            or die(mysqli_error($conn));
            
            if (mysqli_num_rows($sql) == 0) {
                echo "<script>alert('Username atau Password Anda salah');</script>";
                echo '<script type="text/javascript">window.location="login.php";</script>';
            } else {
                session_start();
                $row = mysqli_fetch_assoc($sql);
                $_SESSION['id_login'] = $row['admin_id'];
                $_SESSION['level'] = $row['level'];
                $_SESSION['status_login'] = true;
                
                if ($row['level'] == 'admin') {
                    echo "<script>alert('Login Sukses');</script>";
                    echo '<script type="text/javascript">window.location="admin/dashboard.php";</script>';
                } elseif ($row['level'] == 'pelanggan') {
                    echo "<script>alert('Login Sukses');</script>";
                    echo '<script type="text/javascript">window.location="user/dashboard_user.php";</script>';
                } else {
                    header('location:dashboard_user.php');
                }
            }
        }
        ?>
    </div>
</body>
</html>
