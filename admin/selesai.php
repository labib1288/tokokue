<?php 
include('session.php');
include 'fungsi_indotgl.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>F1 Store</title>
    <link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
</head>
<body>

<div class="wrapper">
    <div class="header"></div>

    <div class="sidebar">
        <div class="sidebar-title"><b>Petit Luxe Cakes</b></div>
        <ul>
            <?php include 'sidebar.php'; ?>
        </ul>
    </div>

    <div class="section">
        <h5 class="card-title">Data Check Out Selesai</h5>
        <table class="tablel">
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Date</th>
                <th>Evidence</th>
                <th>Customer</th>
                <th>Address</th>
                <th>Phone</th>
            </tr>

            <?php
            $no = 1;
            $admin_id = $_SESSION['id_login'];
            $produk = mysqli_query($conn, "SELECT admin_name, admin_telp, admin_address, (jml*product_price) AS total, tgl, ck_id, product_name, product_price, product_image, jml, bukti, validasi, status 
                                           FROM tb_product, tb_checkout, tb_admin 
                                           WHERE tb_admin.admin_id = tb_checkout.admin_id 
                                           AND tb_checkout.product_id = tb_product.product_id 
                                           AND status = 'Selesai'");

            while ($row = mysqli_fetch_array($produk)) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td>Rp. <?php echo number_format($row['product_price']); ?></td>
                    <td>
                        <a href="../produk/<?php echo $row['product_image']; ?>" target="_blank">
                            <img src="../produk/<?php echo $row['product_image']; ?>" width="50px">
                        </a>
                    </td>
                    <td><?php echo $row['jml']; ?></td>
                    <td>Rp. <?php echo number_format($row['total']); ?></td>
                    <td><?php echo tgl_indo($row['tgl']); ?></td>
                    <td>
                        <a href="../bukti_transfer/<?php echo $row['bukti']; ?>" target="_blank">
                            <img src="../bukti_transfer/<?php echo $row['bukti']; ?>" width="50px">
                        </a>
                    </td>
                    <td><?php echo $row['admin_name']; ?></td>
                    <td><?php echo $row['admin_address']; ?></td>
                    <td><?php echo $row['admin_telp']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>