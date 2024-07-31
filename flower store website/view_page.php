<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_wishlist'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    
    $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_wishlist_numbers) > 0){
        $message[] = 'already added to wishlist';
    }elseif(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{
        mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
        $message[] = 'product added to wishlist';
    }

}

if(isset($_POST['add_to_cart'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($check_wishlist_numbers) > 0){
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }

        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added to cart';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>quick view</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="quick-view">

    <h1 class="title">Chi Tiết </h1>

    <?php  
         if(isset($_GET['pid'])){
            $pid = $_GET['pid'];
            // $select_products = mysqli_query($con, " SELECT * FROM `clock_admin` c WHERE c.id = '$pid'") or die('query failed');

            $result = mysqli_query($conn, "SELECT * FROM `clock_admin` WHERE id = '$pid'");
            $fetch_products = mysqli_fetch_assoc($result);
        $imgLibrary = mysqli_query($conn, "SELECT * FROM `image_library` WHERE `clock_id` =  '$pid'");
        $fetch_products['images'] = mysqli_fetch_all($imgLibrary, MYSQLI_ASSOC);
        //  if(mysqli_num_rows($select_products) > 0){
            // while($fetch_products = mysqli_fetch_assoc($select_products)){
    ?>
    <form action="" method="POST">
      
         
         <div class = "row">  
         <img src="../quantri_dongho./<?php echo $fetch_products['image']; ?>" alt="" class="image">
       
         <div class = "content">
         <div class="price">Thông tin sản phẩm</div>
         <div class="price"><?php echo $fetch_products['name']; ?></div>
            <div class="price">Giá:<?= number_format($fetch_products['price'], 0, ",", ".") ?> Đ</div>
         <div class="price">Mã đồng hồ: <?php echo $fetch_products['code_clock']; ?></div>
         <div class="price">Loại: <?php echo $fetch_products['type']; ?></div>
         <div class="price">Dòng: <?php echo $fetch_products['current']; ?></div>
         <div class="price">Số lượng: <?php echo $fetch_products['quantity_p']; ?></div>
         <div class = "flex">
         <div class="price">Giá sale:<?= number_format($fetch_products['price_sale'], 0, ",", ".") ?> Đ</div>
     
       
         
         </div>
         <div class="price">Hình ảnh</div>
         <div class="content-body-switch-1 js-content-body-switch-1"> 
                    <?php if(!empty( $fetch_products ['images'])){ ?>
                    <div id="gallery">
                        <ul>
                            <?php foreach( $fetch_products ['images'] as $img) { ?>
                                <li><img src="../quantri_dongho./<?=$img['path']?>" ></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
                            </div>
         </div>
         <div class= "flex-btn">
         <input type="number" name="product_quantity" value="1" min="0" max = "<?php echo $fetch_products['quantity_p']; ?>" class="qty">   
         <input type="submit" value=" Thêm vào yêu thích" name="add_to_wishlist" class="option-btn">
         <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">
         </div>
        </div>

       
         <!-- <div class="details"><?php echo $fetch_products['details']; ?></div> -->
        
         <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_products['price_sale']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>"> 
        
     
      </form>
    <?php
            // }
            
            
        // }else{
        // echo '<p class="empty">no products details available!</p>';
        // }
    }
    ?>

    <div class="more-btn">
        <a href="home.php" class="option-btn">Về Trang Chủ</a>
    </div>

</section>






<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>