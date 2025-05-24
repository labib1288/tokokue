<?php
include '../db.php';
if (isset($_POST['submit'])) {
   $jml                = $_POST['jml'];
   $product_id         = $_POST['product_id'];
   $admin_id           = $_POST['admin_id'];
   $stok               = $_POST['stok'];

   if($stok < $jml){
    echo '<script>alert("Stok tidak mencukupi")</script>';
    echo '<script>window.location="Produk_user.php"</script>';
   }elseif($stok=='0'){
    echo '<script>alert("Stok kosong")</script>';
    echo '<script>window.location="Produk_user.php"</script>';
   }else{

    $insert = mysqli_query($conn, "INSERT INTO tb_chart VALUES (
    null,
    '" . $product_id . "',
      '" . $jml . "',
    '" . $admin_id . "'
        ) ");
    if ($insert) {
        echo '<script>alert("Add Cart Successful")</script>';
        echo '<script>window.location="Produk_user.php"</script>';
    } else {
        echo 'gagal ' . mysqli_error($conn);
    }}
    }
   ?>