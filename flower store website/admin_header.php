<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">TB</span></a>

      <nav class="navbar">
         <a href="admin_page.php">TRANG CHỦ</a>
         <!-- <a href="admin_products.php">products</a> -->
         <a href="admin_orders.php">ĐƠN HÀNG</a>
         <a href="admin_users.php">USERS</a>
         <a href="admin_contacts.php">TIN NHẮN</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout_admin.php" class="delete-btn">logout</a>
   
      </div>

   </div>

</header>