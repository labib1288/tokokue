<?php
    include 'db.php';
    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petit Luxe Cakes</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="container-home">

    <!-- Header -->
    <header class="header">
        <div class="container">
            <h1><a href="index.php" class="brand">Petit Luxe Cakes</a></h1>
            <nav>
                <ul class="nav-links">
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="produk.php">Produk</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Search -->
    <section class="search-bar">
        <div class="container">
            <form action="produk_cari.php" method="POST">
                <input type="text" name="search" placeholder="Cari Produk">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </section>

    <!-- Info Login -->
    <section class="info-login">
        <div class="container">
            <p>Silahkan Login Untuk Berbelanja <a href="login.php"><strong>Klik Disini</strong></a></p>
        </div>
    </section>

    <!-- Kategori -->
    <section class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box">
                <?php
                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                if(mysqli_num_rows($kategori) > 0){
                    while($k = mysqli_fetch_array($kategori)){
                ?>
                <a href="index.php?kat=<?php echo $k['category_id'] ?>">
                    <div class="col-5">
                        <img src="img/icon-kategori.png" width="50px" style="margin-bottom:5px;">
                        <p><?php echo $k['category_name'] ?></p>
                    </div>
                </a>
                <?php }} else { ?>
                    <p>Kategori tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- Produk Terbaru -->
    <section class="section">
        <div class="container">
            <h3>Produk Terbaru</h3>
            <div class="box">
                <?php
                    ini_set('error_reporting',0);
                    if($_GET['kat'] == ''){
                        $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status =1 ORDER BY product_id DESC LIMIT 8");
                    } else {
                        $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE category_id =$_GET[kat] AND product_status = 1 ORDER BY product_id DESC LIMIT 8");
                    }
                    if (mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                ?>
                <a href="detail_produk.php?id=<?php echo $p['product_id'] ?>">
                    <div class="col-4">
                        <img src="produk/<?php echo $p['product_image'] ?>">
                        <p class="nama"><?php echo substr($p['product_name'], 0, 30) ?></p>
                        <table width="100%">
                            <tr>
                                <td align="left">
                                    <p class="nama"><strong>Stok <?php echo $p['stok'] ?></strong></p>
                                </td>
                                <td align="right">
                                    <p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </a>
                <?php }} else { ?>
                    <p>Produk tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p><?php echo $a->admin_address ?></p>

            <h4>Email</h4>
            <p><?php echo $a->admin_email ?></p>

            <h4>No. Hp</h4>
            <p><?php echo $a->admin_telp ?></p>

            <small>Copyright &copy; 2023 - Petit Luxe Cake</small>
        </div>
    </footer>

</div>

</body>
</html>