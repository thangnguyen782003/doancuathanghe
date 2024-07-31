
<?php
include 'header.php';

    if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){
        $_SESSION['product_filter'] = $_POST;
        header('Location: product_list.php');exit;
    }
    
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if(!empty($where)){
        $totalRecords = mysqli_query($connect, "SELECT * FROM `order` where (".$where.")");
    }else{
        $totalRecords = mysqli_query($connect, "SELECT * FROM `order`");
    }
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(!empty($where)){
        $products = mysqli_query($connect, "SELECT * FROM `order` where (".$where.") ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }else{
        $products = mysqli_query($connect, "SELECT * FROM `order` ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($connect);
    ?>
    <div class="main-content">
        <h1>Danh sách tour du lịch</h1>
        <div class="product-items">
           
            <div class="product-search">
                <form id="product-search-form" action="product_list.php?action=search" method="POST">
                    <fieldset>
                        <legend>Tìm kiếm tour du lịch:</legend>
                        <!-- ID: <input type="text" name="id" value="<?=!empty($id)?$id:""?>" /> -->
                        Tên tour: <input type="text" name="name" value="<?=!empty($name)?$name:""?>" />
                        <input type="submit" value="Tìm" />
                    </fieldset>
                </form>
            </div>
            <div class="total-products">
                <span>Có tất cả <strong><?=$totalRecords?></strong> tour trên <strong><?=$totalPages?></strong> trang</span>
            </div>
            <ul>
                <li class="product-item-heading">
                <div class="product-prop product-stt">STT</div>
                <div class="product-prop product-img">Tên tour</div>
                    <div class="product-prop product-img">Số điện thoại</div>
                    <div class="product-prop product-name">Ghi chú</div>
                    <div class="product-prop product-price">Địa chỉ</div>
                    <!-- <div class="product-prop product-destination">Điểm đến</div> -->
                    
                    
                   
                    <!-- <div class="product-prop product-button">
                        Copy
                    </div> -->
                   
                    <div class="clear-both"></div>
                </li>
                <?php
                  $num = 1;
                while ($row = mysqli_fetch_array($products)) {
                    ?>
                    <li>
                    <div class="product-prop product-stt"><?= $num++; ?></div>
                        <div class="product-prop product-img"><?= $row['name'] ?></div>
                        <div class="product-prop product-name"><?= $row['phone'] ?></div>
                        <div class="product-prop product-price"><?= $row['note'] ?></div>
                        <div class="product-prop product-price"><?= $row['address'] ?></div>

                        <!-- <div class="product-prop product-destination"></div> -->
                       
                        <!-- <div class="product-prop product-button">
                            <a href="./product_edit.php?id=<?= $row['id'] ?>&task=copy">Copy</a>
                        </div> -->
                      
                        <div class="clear-both"></div>
                    </li>
                <?php } ?>
            </ul>
            <?php
            include '../pagination.php';
            ?>
            <div class="clear-both"></div>
        </div>
    </div>
    <?php

include './footer.php';
?>
