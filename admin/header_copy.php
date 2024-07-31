<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Bài 27: Hướng dẫn quản trị thành viên và phân quyền thành viên</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          
        <link rel="stylesheet" type="text/css" href="../css/123.css" >
        <link rel="stylesheet" type="text/css" href="../css/style.css" >
    </head>
    <body>
        <?php
        session_start();
        include './connect.php';
        include '../function.php';
        $regexResult = checkPrivilege(); //Kiểm tra quyền thành viên
        if(!$regexResult){
            echo "Bạn không có quyền truy cập chức năng này";exit;
        }
        if (!empty($_SESSION['current_user'])) { //Kiểm tra xem đã đăng nhập chưa?
            ?>
            <div id="admin-heading-panel">
                <div class="container">
                    <div class="left-panel">
                        Xin chào <span>Admin</span>
                    </div>
                    <div class="right-panel">
                        <img height="24" src="../images/home.png" />
                        <a href="../index.php">Trang chủ</a>
                        <img height="24" src="../images/logout.png" />
                        <a href="logout.php">Đăng xuất</a>
                    </div>
                </div>
            </div>

                <?php } ?>