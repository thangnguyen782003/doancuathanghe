<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
  
    <p> <a href="home.php">home</a> / about </p>
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="images/SH8.jpg" alt="">
        </div>

        <div class="content">
            <h3>Tại sao chọn chúng tôi?</h3>
            <p>Chúng tôi luôn cung cấp những mẫu mã sản phẩm đẹp nhất, hợp xu hướng thời gian, phù hợp tiêu chí người dùng.</p>
            <a href="shop.php" class="btn">Mua ngay</a>
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>Những gì chúng tôi cung cấp?</h3>
            <p>Chúng tôi cung cấp những sản phẩm chất lượng, sắc sảo, những sản phẩm phù hợp yêu cầu người dùng</p>
            <a href="contact.php" class="btn">Liên lạc</a>
        </div>

        <div class="image">
            <img src="images/BB5.jpg" alt="">
        </div>

    </div>

    
</section>

<section class="reviews" id="reviews">

    <h1 class="title">Đánh giá về chúng tôi</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/pic-1.png" alt="">
            <p>Tôi đã mua sản phẩm ở đây, sản phẩm ở đây rất đẹp tôi rất thích, phục vụ rất tận tình </p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Tèo</h3>
        </div>

        <div class="box">
            <img src="images/pic-2.png" alt="">
            <p>Sản phẩm ở đây rất chất lượng, tôi thấy hài lòng</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Tí</h3>
        </div>

        <div class="box">
            <img src="images/pic-3.png" alt="">
            <p>Sản phẩm của web rất ok, giao hàng nhanh chòng, tôi thấy hài lòng</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Tũn</h3>
        </div>

    

    </div>

</section>











<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>