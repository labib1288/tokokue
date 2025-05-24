<?php include('session.php'); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <link rel="stylesheet" type="text/css" href="../css/styleadmin.css">

</head>
<body>
    <div class="wrapper">
        <div class="header"></div>

        <div class="sidebar">
            <div class="sidebar-title">Petit Luxe Cakes</div>
            <ul>
                <?php include 'sidebar.php'; ?>
            </ul>
        </div>

        <div class="section">
            <h2 class="card-title">Produk</h2>
            <p><a href="produk_tambah.php">+</a></p>
            <table class="table1">
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Nama Produk</th>
                    <th>Detail Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $no = 1;
                $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
                if(mysqli_num_rows($produk) > 0){
                while($row = mysqli_fetch_array($produk)){
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['category_name'] ?></td>
                    <td><?php echo $row['product_name'] ?></td>
                    <td><?php echo $row['product_description'] ?></td>
                    <td>Rp. <?php echo number_format ($row['product_price']) ?></td>
                    <td><?php echo $row['stok'] ?></td>

                        <td><a href="produk/<?php echo $row['product_image'] ?>" target="_blank"> <img src="../produk/<?php echo $row ['product_image'] ?>" width="50px"> </a></td>

                        <td><?php echo ($row['product_status'] == 2) ? 'tidak aktif' : 'aktif'; ?></td>
                        
                            
                <td>
                 <a href="produk_edit.php?id=<?php echo $row['product_id'] ?>">Edit</a>
                 <a href="hapus_proses.php?idp=<?php echo $row['product_id'] ?>" onclick="return confirm('Yakin Ingin Hapus ?')">Hapus</a>
                </td>
                </tr>
                <?php }
            }else{ ?>
                    <tr>
                    <td colspan=""> Tidak Ada Data</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>