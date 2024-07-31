<!DOCTYPE html>

<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/style.css" >
      
    </head>
    <body>
        <?php
        session_start();
        include '../connect.php';
        
        include '../function.php';
        if (!empty($_SESSION['current_user'])) { //Kiểm tra xem đã đăng nhập chưa?
            ?>
            <div id="admin-heading-panel">
                <div class="container">
                    <div class="left-panel">
                        <!-- Xin chào <span>Admin</span> -->
                    </div>
                    <div class="right-panel">
                       <!-- <img height="24" src="../images/images.png" />  -->
                        <!-- <a href="../index.php">Trang chủ</a> -->
                        <!-- <img height="24" src="../images/logout.png" /> -->
                        <header >
                            <ul  class= "menu">
                                <li>
                                    <a href="">Trang Chủ</a>
                                    <div class = "dropdown">
                                   <a href="../index_hotel.php">Sản phẩm</a>
                                    </div>
                                </li>
                                <li>
                                    <a href="">Dịch Vụ</a>
                                </li>
                                <li>
                                    <a href="">Liên hệ</a>
                                </li>
                            </ul>
                        </header>

                        <a class= "logout" href="logout.php">Đăng xuất</a>
                    </div>
                </div>
              
            </div>
            <div class  ="images-login">
                     <img height="24" src="../images/images.png" />  
                </div>
           
                    </div>
                <?php } ?>
        </body>
        </html>