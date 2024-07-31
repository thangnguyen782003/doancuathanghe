<!DOCTYPE html>

<html>
    <head>
        <title>Đăng xuất tài khoản</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/login.css">
        <style>
            .box-content{
                margin: 0 auto;
                width: 800px;
                border: 1px solid #ccc;
                text-align: center;
                padding: 20px;
            }
            #user_logout form{
                width: 200px;
                margin: 40px auto;
            }
            #user_logout form input{
                margin: 5px 0;
            }
        </style>
    </head>
    <body>
        <?php
        session_start();
        unset($_SESSION['current_user']);
        ?>
        <div class = "header"> 
        <header >
    <nav class ="nav">
        <a href ="#" > Trang chủ </a>
        <a href ="#" > Dịch vụ</a>
        <a href ="#" > Liên hệ</a>
      
        </nav>

        </header>
        </div>
        <div class ="background">
            <img src="../images/login.jpeg" alt="">
        </div>
        <div class = "home" >  
    <div class = "content">
        <h2><i class="fa-solid fa-house"></i></h2>
        <img src="../images/login.jpeg" alt="" class = "imghome">
    </div> 
        <div id="user_logout" class="box-content-out">
            <h1>Đăng xuất tài khoản thành công</h1>
            <a href="./login.php">Đăng nhập lại</a>
        </div>
        </div>
    </body>
</html>
