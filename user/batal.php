<?php
    include 'session.php';
    include '../db.php';
    include 'fungsi_indotgl.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Bukamurang</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php"> Open Store</h1>
            <ul>
                <?php include 'navbar.php' ?>
            </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Data checkout dibatalkan</h3>
            <div class="box">
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Kategori</th>
                            <th>Nama Produk</th>
                            <th>Gambar</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Validasi</th>
                            <th>Status</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $admin_id = $_SESSION['id_login'];
                            $produk = mysqli_query($conn, "SELECT (jml*product_price) AS total,tgl, ck_id, category_name, product_name, 
                                product_price, product_image, jml, bukti, validasi, status 
                                FROM tb_product, tb_category, tb_checkout 
                                WHERE tb_category.category_id = tb_product.category_id AND
                                tb_checkout.product_id = tb_product.product_id AND
                                status = 'Batal' AND 
                                admin_id = $admin_id
                                ");
                                while($row = mysqli_fetch_array($produk)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td><?php echo $row['product_name'] ?></td>
                            <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                            <td><a href="../produk/<?php echo $row ['product_image'] ?>" target="_blank" <img src="../produk/<?php echo $row['product_image'] ?>" width="50px"> </a></td>
                            <td><?php echo $row['jml'] ?></td>
                            <td>Rp. <?php echo number_format($row['total']) ?></td>
                            <td>Transfer</td>
                            <td><?php echo tgl_indo($row['tgl']) ?></td>
                            <td><a href="../bukti_transfer/<?php echo $row['bukti'] ?>" target="_blank"> <img src="../bukti_transfer/<?php echo $row['bukti'] ?>" width="50px"> </a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2025 - Petit Luxe Cakes.</small>
        </div>
    </footer>
</body>
</html>
