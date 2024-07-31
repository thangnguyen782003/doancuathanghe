<!DOCTYPE html>

<html>
    <head>
        <title>.</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" >
    <link rel="stylesheet" type="text/css" href="../css/login.css">
        <style>
         
        </style>
    </head>
    <body>

        <?php
        session_start();
        include '../connect_db.php';
        $error = false;
        if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $result = mysqli_query($connect, "Select `id`,`username`,`fullname`,`birthday` from `quanly1` WHERE (`username` ='" . $_POST['username'] . "' AND `password` = md5('" . $_POST['password'] . "'))");
            if (!$result) {
                $error = mysqli_error($connect);
            } else {
                $quanly1 = mysqli_fetch_assoc($result);
                $_SESSION['current_user'] = $quanly1;
            }
            mysqli_close($connect);
            if ($error !== false || $result->num_rows == 0) {
                ?>
                <div id="login-notify">
                 
                    <h4 class = "notify"><?= !empty($error) ? $error : "Thông tin đăng nhập không hợp lệ vui lòng đăng nhập lại" ?></h4>
                    <!-- <a href="./login.php">Quay lại</a> -->
                </div>
                <?php
             
            }
            ?>
        <?php } ?>
        <?php if (empty($_SESSION['current_user'])) { ?>
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


     <div id="user_login" class="box-content">
                <h1 class ="login">Đăng nhập</h1>
                <form action="./login.php" method="Post" autocomplete="off">
                  <label>Tên tài khoản </label>
                    <input type="text" name="username" value="" class="input1" placeholder ="" /><br/>
                    <label>Mật khẩu</label>
                    <input type="password" name="password" id="ipnPassword"  value="" class="input1"/>
          
                   <button  type="button" id="btnPassword"> <span class="fas fa-eye"></span>  </button>
                    <br>
                 <input type="submit"id ="submit" value ="Đăng nhập" onclick = "onclickfn()" ></input>
                </form>
            </div>
        </div>
            <?php
        } else {
            $currentUser = $_SESSION['current_user'];
            ?>
            <div>
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
            <div id="login-notify" class="box-content" class ="background"> 
                
               <p id="login-user" > <h1>  <?= $currentUser['username'] ?>  đăng nhập thành công</h1><br/></p>
                <!-- <a href="./editpassword.php">Đổi mật khẩu</a><br/> -->
               <p id ="login-product"> <a href="./clock_list.php">Quản lý  đồng hồ</a><br/></p>
                <p id ="login-product"> <a href="./member_listing.php">Quản lý nhân viên</a><br/></p>
           
                <!-- <a       href="./logout.php">Đăng xuất</a>  -->
        </div>
        </div>
        <?php } ?>
        <script src = "main.js">
           
        </script>
    </body>

</html>
