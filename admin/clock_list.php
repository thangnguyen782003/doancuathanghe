
<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){
        $_SESSION['clock_filter'] = $_POST;
        header('Location: clock_list.php');exit;
    }
    if(!empty($_SESSION['clock_filter'])){
        $where = "";
        foreach ($_SESSION['clock_filter'] as $field => $value) {
            if(!empty($value)){
                switch ($field) {
                    case 'name':
                    $where .= (!empty($where))? " AND "."`".$field."` LIKE '%".$value."%'" : "`".$field."` LIKE '%".$value."%'";
                    break;
                    default:
                    $where .= (!empty($where))? " AND "."`".$field."` = ".$value."": "`".$field."` = ".$value."";
                    break;
                }
            }
        }
        extract($_SESSION['clock_filter']);
    }
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if(!empty($where)){
        $totalRecords = mysqli_query($connect, "SELECT * FROM `clock_admin` where (".$where.")");
    }else{
        $totalRecords = mysqli_query($connect, "SELECT * FROM `clock_admin`");
    }
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(!empty($where)){
        $clock_admin = mysqli_query($connect, "SELECT * FROM `clock_admin` where (".$where.") ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }else{
        $clock_admin = mysqli_query($connect, "SELECT * FROM `clock_admin` ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($connect);
    ?>
    <div class="main-content">
        <h1>Danh sách đồng hồ</h1>
        <div class="product-items">
            <div class="buttons">
                <a href="./clock_edit.php">Thêm đồng hồ</a>
            </div>
            <div class="product-search">
                <form id="product-search-form" action="clock_list.php?action=search" method="POST">
                    <fieldset>
                        <legend>Tìm kiếm đồng</legend>
                        <!-- <input type="text" name="id" value="<?=!empty($id)?$id:""?>" />  -->
                        Tên đồng hồ: <input type="text" name="name" value="<?=!empty($name)?$name:""?>" />
                        <input type="submit" value="Tìm" />
                    </fieldset>
                </form> 
            </div>
            <div class="total-products">
                <span>Có tất cả <strong><?=$totalRecords?></strong> đồng hồ trên <strong><?=$totalPages?></strong> trang</span>
            </div>
            <ul>
                <li class="product-item-heading">
                <div class="product-prop product-stt">STT</div>

                    <div class="product-prop product-img">Ảnh</div>

                    <div class="product-prop product-name">Tên</div>

                    <div class="product-prop product-name">Loại</div>

                    <div class="product-prop product-name">Dòng</div>

                    <div class="product-prop product-price">Giá</div>

                    <div class="product-prop product-price">Giá_sale</div>
                    <div class="product-prop product-button">
                        Xóa
                    </div>
                    <div class="product-prop product-button">
                        Sửa
                    </div>
                   
                    <div class="product-prop product-time">Ngày tạo</div>

                    <div class="product-prop product-time">Ngày cập nhật</div>

                    <div class="product-prop product-name"> Mã</div>

                    <div class="product-prop product-price">SL</div>

                    <div class="product-prop product-price">SL tồn</div>
                    <div class="clear-both"></div>
                </li>
                <?php
                  $num = 1;
                while ($row = mysqli_fetch_array($clock_admin)) {
                    ?>
                    <li>
                    <div class="product-prop product-stt"><?= $num++; ?></div>
                        <div class="product-prop product-img"><img src="../<?= $row['image'] ?>" alt="<?= $row['name'] ?>" title="<?= $row['name'] ?>" /></div>
                        <div class="product-prop product-name"><?= $row['name'] ?></div>

                        <div class="product-prop product-name"><?= $row['type'] ?></div>

                        <div class="product-prop product-name"><?= $row['current'] ?></div>

                        <div class="product-prop product-price"><?= $row['price'] ?></div>

                        <div class="product-prop product-price"><?= $row['price_sale'] ?></div>

                        <div class="product-prop product-button">
                            <a href="./clock_delete.php?id=<?= $row['id'] ?>">Xóa</a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="./clock_edit.php?id=<?= $row['id'] ?>">Sửa</a>
                        </div>
  
                        <div class="product-prop product-time"><?= date('d/m/Y H:i', $row['created_time']) ?></div>

                         <div class="product-prop product-time"><?= date('d/m/Y H:i', $row['last_updated']) ?></div>
                         <div class="product-prop product-price"><?= $row['code_clock'] ?></div>
                        <div class="product-prop product-price"><?= $row['quantity_p'] ?></div>

                        <div class="product-prop product-price"><?= $row['quantity_stock'] ?></div>
                        
                  
                   
                       
                      
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
}
include './footer.php';
?>
