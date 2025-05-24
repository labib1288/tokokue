<?php
include('session.php');
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type+"text/css" href="../css/styleadmin.css">
    <title>Petit Luxe Cakes DASHBOARD</title>
</head>
<body>
    <div class="wrapper">
        <div class="header"></div>
        
        <div class="sidebar">
            <div class="sidebar-title"><b>Petit Luxe Cakes Store</b></div>
            <ul>
                <?php include'sidebar.php' ?>
            </ul>
        </div>
        <div class="section">
            <h1>Welcome :] <?php echo $user_row["admin_name"]?></h1>
        </div>
    </div>
</body>
</html>