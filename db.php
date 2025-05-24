<?php
$conn = mysqli_connect("localhost","root","","tokokue");

if (mysqli_connect_errno()) {
    echo "koneksi database gagal : " . mysqli_conect_error();
}
?>