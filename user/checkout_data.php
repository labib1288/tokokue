<?php
include 'session.php';
include '../db.php';
include 'indo_tgl.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Store</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">Patit Luxe Cakes</a></h1>
            <ul>
                <?php include 'navbar.php' ?>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th width="60px">No</th>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Picture</th>
                        <th>Amount</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Date</th>
                        <th>Proof</th>
                        <th>Status</th>
                        <th>Delivery</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    $admin_id = $_SESSION['id_login']; 
                    $produk = mysqli_query($conn, "SELECT (jml * product_price) AS total, tgl, ck_id, category_name, product_name,
                        product_price, product_image, jml, bukti, validasi, status
                        FROM tb_product 
                        JOIN tb_category ON tb_category.category_id = tb_product.category_id
                        JOIN tb_checkout ON tb_checkout.product_id = tb_product.product_id
                        WHERE status != 'Finished' AND status != 'Batal' AND admin_id = $admin_id");

                    while ($row = mysqli_fetch_array($produk)) { 
                    ?>
                        <tr>
                            <td><?php echo $no++ ?></td> 
                            <td><?php echo htmlspecialchars($row['category_name']) ?></td> 
                            <td><?php echo htmlspecialchars($row['product_name']) ?></td> 
                            <td>Rp. <?php echo number_format($row['product_price'], 0, ',', '.') ?></td> 
                            <td>
                                <a href="../produk/<?php echo htmlspecialchars($row['product_image']) ?>" target="_blank">
                                    <img src="../produk/<?php echo htmlspecialchars($row['product_image']) ?>" width="50px">
                                </a>
                            </td> 
                            <td><?php echo (int)$row['jml'] ?></td> 
                            <td>Rp. <?php echo number_format($row['total'], 0, ',', '.') ?></td> 
                            <td>Transfer</td> 
                            <td><?php echo indo_tgl($row['tgl']) ?></td> 
                            <td>
                                <a href="../bukti_transfer/<?php echo htmlspecialchars($row['bukti']) ?>" target="_blank">
                                    <img src="../bukti_transfer/<?php echo htmlspecialchars($row['bukti']) ?>" width="50px">
                                </a>
                            </td> 
                            <td><?php echo htmlspecialchars($row['validasi']) ?></td> 
                            <?php if ($row['status'] == 'Proses') { ?>  
                                <td>
                                    <mark><?php echo $row['status'] ?></mark><br> 
                                    <a class="text-white" href="proses.php?ck_id=<?php echo $row['ck_id'] ?>" 
                                       onclick="return confirm('Are You Sure The Product Has Arrived?')"> 
                                        <strong>Until?</strong> 
                                    </a> 
                                </td> 
                            <?php } else { ?> 
                                <td><mark><?php echo $row['status'] ?></mark></td> 
                            <?php } ?> 
                        </tr> 
                    <?php } ?> 
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <div class="container">
            <small>Copyright &copy; 2023 - Open Store.</small>
        </div>
    </footer>
</body>
</html>
