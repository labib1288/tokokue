<?php
error_reporting(0);
include 'session.php'; // menangkap session pengguna
include '../db.php'; // koneksi ke db.php
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak); // menampilkan data admin yang di tampilkan di footer nanti
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Open Store</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="../index.php">Petit Luxe Cakes^-^</a></h1>
            <ul>
                <?php include 'navbar.php' ?> <!-- memanggil file navbar-->
            </ul>
        </div>
    </header>

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="produk_user.php">
                <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <h3>Category</h3>
            <div class="box">
                <?php
                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                if(mysqli_num_rows($kategori) > 0){
                    while($k = mysqli_fetch_array($kategori)){
                ?>
                  <a href="produk_cari_kategori.php?kat<?php echo $k ['category_id'] ?>">
                  <div class="col-5">
                        <img src="../img/menukategori.png" width="50px" style="margin-bottom:5px;">
                        <p><?php echo $k['category_name'] ?></p>
                    </div>
                  </a>
                <?php }}else{ ?>
                    <p>Category Does Not Exist</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- produk -->
    <div class="container">
        <div class="section">
            <div class="container">
                <h3>Product</h3>
                <div class="box">
                    <?php
                    if ($_GET['search'] != "" || $_GET['kat'] != '') {
                        $where = "AND product_name LIKE '%" . $_GET['search'] . "%' AND category_id LIKE '%" . $_GET['kat'] . "%' ";
                    }
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 $where ORDER BY product_id DESC");
                    if (mysqli_num_rows($produk) > 0) {
                        while ($p = mysqli_fetch_array($produk)) {
                    ?>
                    <div class="col-4">
                        <a href="detail_produk_user.php?id=<?php echo $p['product_id'] ?>" title="Detail Produk">
                            <img src="../produk/<?php echo $p['product_image'] ?>">
                            <p class="nama"><?php echo substr($p['product_name'], 0, 30) ?></p>
                            <p class="harga">Rp. <?php echo number_format($p['product_price']) ?> (Stok <?php echo $p['stok'] ?>)</p>
                        </a>
                        <form action="chart_proses.php" method="POST">
                            <input type="hidden" name="product_id" class="form-control" value="<?php echo $p['product_id']; ?>">
                            <input type="hidden" name="stok" class="form-control" value="<?php echo $p['stok']; ?>">
                            <input type="hidden" name="admin_id" class="form-control" value="<?php echo $_SESSION['id_login']; ?>">
                            <input type="number" name="jml" style="width: 40px;" autofocus required min="1">
                            <button type="submit" name="submit" title="tambahkan">+</button>
                        </form>
                    </div>
                    <?php
                        }
                    } else {
                    ?>
                    <p>Product Does Not Exist</p>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="footer">
        <div class="container">
            <h4>Address</h4>
            <p><?php echo $a->admin_address ?></p>
            <h4>Email</h4>
            <p><?php echo $a->admin_email ?></p>
            <h4>No. Hp</h4>
            <p><?php echo $a->admin_telp ?></p>
            <small>Copyright &copy; 2020 - Petit Luxe Cake</small>
        </div>
    </div>
</body>
</html>