<?php	include 'session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA KUE</title>
    <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>
    <div class="wrapper">
        <div class="header"></div>
        <div class="sidebar">
            <div class="sidebar-title"><b>OPEN STORE</b></div>
            <ul>
                <?php	include 'sidebar.php'; ?>
            </ul>
        </div>
        <div class="section">
            <div class="container">
                <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_id = '".$_GET['id']."'");
                    if(mysqli_num_rows($kategori) == 0){
                        echo "
                        <script>
                            window.location = 'admin/kategori_data.php'
                        </script>";
                    }
                    $k = mysqli_fetch_object($kategori);
                ?>
                <form action="" method="post">
                    <h3>Edit Data Kategori</h3>
                    <fieldset>
                        <label for="">Nama Kategori</label>
                        <input type="text" name="nama" value="<?php	echo $k->category_name ?>" class="form-control" required>
                    </fieldset>
                    <fieldset>
                        <button name="submit" type="submit" id="contact-submit" data-submit="...sending">Edit</button>
                    </fieldset>
                </form>
                <?php
                    if(isset($_POST["submit"])){
                        $nama = $_POST['nama'];
                        $update = mysqli_query($conn, "UPDATE tb_category SET category_name ='".$nama."' WHERE category_id = '".$k->category_id."'");
                        if($update){
                            echo "
                        <script>
                            alert('Edit Data Berhasil');
                            window.location = 'kategori_data.php';
                        </script>";
                        }else{
                            echo 'gagal'.mysqli_error($conn);
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>