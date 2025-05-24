<?php 
include('session.php'); 
include '../db.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Store</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    <!--header-->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">Petit Luxe Cakes</a></h1>
            <ul>
                <?php include 'navbar.php' ?>
            </ul>
        </div>
    </header>

    <!--content-->
    <div class="section">
        <div class="container">
            <h3>Your Cart Data</h3>
            <div class="box">
                <form method="post" action="">
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
                            <th width="150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $admin_id = $_SESSION['id_login'];
                        $produk = mysqli_query($conn, "SELECT tb_chart.product_id, (jml*product_price) AS total, chart_id, category_name, product_name, product_price, product_image, jml
                            FROM tb_product, tb_category, tb_chart
                            WHERE tb_category.category_id=tb_product.category_id AND
                            tb_chart.product_id=tb_product.product_id AND
                            admin_id=$admin_id
                            ");
                        while($row = mysqli_fetch_array($produk)) {
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td><?php echo $row['product_name'] ?></td>
                            <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                            <td>
                                <a href="../produk/<?php echo $row['product_image'] ?>" target="_blank">
                                    <img src="../produk/<?php echo $row['product_image'] ?>" width="50px">
                                </a>
                            </td>
                            <td><?php echo $row['jml'] ?></td>
                            <td>Rp. <?php echo number_format($row['total']) ?></td>
                            <td>
                                <input type="checkbox" name="check[<?php echo $row['chart_id'] ?>]" value="1"> Check Out <br>
                                <input type="hidden" name="jml[<?php echo $row['chart_id'] ?>]" value="<?php echo $row['jml'] ?>">
                                <input type="hidden" name="product_id[<?php echo $row['chart_id'] ?>]" value="<?php echo $row['product_id'] ?>">
                                <input type="hidden" name="admin_id[<?php echo $row['chart_id'] ?>]" value="<?php echo $admin_id ?>">
                                || <a href="hapus_proses.php?idc=<?php echo $row['chart_id'] ?>" onclick="return confirm('Are You Sure You Want To Delete It')">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table><br>
                <button type="submit" class="btn" style="width:100%" name="save">Check Out Your Choice</button>
                </form>
            </div>

            <?php
            if (isset($_POST['save'])) {
                if (!empty($_POST['check'])) {
                    foreach ($_POST['check'] as $chart_id => $value) {
                        $jml = $_POST['jml'][$chart_id];
                        $product_id = $_POST['product_id'][$chart_id];
                        $admin_id = $_POST['admin_id'][$chart_id];

                        mysqli_query($conn, "INSERT INTO tb_checkout_temp VALUES (
                            $chart_id,
                            $product_id,
                            $jml,
                            $admin_id
                        )") or die(mysqli_error($conn));

                        mysqli_query($conn, "DELETE FROM tb_chart WHERE chart_id = $chart_id")
                            or die(mysqli_error($conn));
                    }

                    echo '<script>alert("Checkout Was Successful")</script>';
                    echo '<script>window.location="checkout.php"</script>';
                } else {
                    echo '<script>alert("No items were selected for checkout.")</script>';
                }
            }
            ?>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
             <small>Copyright &copy; 2023 - Open Store.</small>
        </div>
    </footer>
</body>
</html>
