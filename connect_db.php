<?php  
$host = "localhost";
$user = "root";
$password ="";
$database ="test";
$connect = mysqli_connect($host, $user, $password,$database);
                if (!$connect) {
                    die("Kết nối không thành công: " . mysqli_connect_error());
                }
                mysqli_select_db($connect, "test");

?>