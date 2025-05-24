<?php
    include '../db.php';

    if(isset($_GET['ck.id'])){
        $delete = mysqli_query($conn, "UPDATE tb_checkout SET status='Finished' WHERE ck.id = '" .$_GET['ck.id']."' ");
        echo '<script>window.location="selesai.php"</script>';
    }