
<?php

include 'header.php';
if (!empty($_SESSION['current_user'])) {
    ?>
    <div class="main-content">
        <h1><?= !empty($_GET['id']) ? ((!empty($_GET['task']) && $_GET['task'] == "copy") ? "Copy sản phẩm" : "Sửa tour") : "Thêm tour" ?></h1>
        <div id="content-box">
            <?php
            if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) {
                if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['price']) && !empty($_POST['price'])) {
                    $galleryImages = array();
                    if (empty($_POST['name'])) {
                        $error = "Bạn phải nhập tên sản phẩm";
                    } elseif (empty($_POST['price'])) {
                        $error = "Bạn phải nhập giá sản phẩm";
                    } elseif (!empty($_POST['price']) && is_numeric(str_replace('.', '', $_POST['price'])) == false) {
                        $error = "Giá nhập không hợp lệ";
                    }
                    if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
                        $uploadedFiles = $_FILES['image'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $image = $result['path'];
                        }
                    }
                    if (!isset($image) && !empty($_POST['image'])) {
                        $image = $_POST['image'];
                    }
                    if (isset($_FILES['gallery']) && !empty($_FILES['gallery']['name'][0])) {
                        $uploadedFiles = $_FILES['gallery'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $galleryImages = $result['uploaded_files'];
                        }
                    }
                    if (!empty($_POST['gallery_image'])) {
                        $galleryImages = array_merge($galleryImages, $_POST['gallery_image']);
                    }
                    if (!isset($error)) {
                        if ($_GET['action'] == 'edit' && !empty($_GET['id'])) { //Cập nhật lại sản phẩm
                            $result = mysqli_query($connect, "UPDATE `product` SET `name` = '"  . $_POST['name'] . "',`image` =  '" . $image . "', `price` = " . str_replace('.', '', $_POST['price']) . ", `content` = '" . $_POST['content'] . "', `last_updated` = " . time() . ",`destination` = '" . $_POST['destination'] . "' WHERE `product`.`id` = " . $_GET['id']);
                        } else { //Thêm sản phẩm
                            $result = mysqli_query($connect, "INSERT INTO `clock_admin`(`id`, `name`, `image`, `price`, `created_time`, `last_updated`, `code_clock`, `type`, `current`, `price_sale`, `quantity`, `quantity _in_stock`) VALUES ('" . $_POST['name'] . "', '" . $image . "', " . str_replace('.', '', $_POST['price']) . ", " . time() . ", " . time() . ", '" . $_POST['code_clock'] . "','" . $_POST['type'] . "','" . $_POST['current'] . "','" . $_POST['price_sale'] . "','" . $_POST['quantity'] . "','" . $_POST['quantity _in_stock'] . "' );");

                        }
                        if (!$result) { //Nếu có lỗi xảy ra
                            $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        } else { //Nếu thành công
                            if (!empty($galleryImages)) {
                                $product_id = ($_GET['action'] == 'edit' && !empty($_GET['id'])) ? $_GET['id'] : $connect->insert_id;
                                $insertValues = "";
                                foreach ($galleryImages as $path) {
                                    if (empty($insertValues)) {
                                        $insertValues = "(NULL, " . $clock_id . ", '" . $path . "', " . time() . ", " . time() . ")";
                                    } else {
                                        $insertValues .= ", (NULL, " . $clock_id . ", '" . $path . "', " . time() . ", " . time() . ")";
                                    }
                                }
                                $result = mysqli_query($connect, "INSERT INTO `image_library` (`id`, `clock_id`, `path`, `created_time`, `last_updated`) VALUES " . $insertValues . ";");
                            }
                            
                        }
                    }
                } else {
                    $error = "Bạn chưa nhập thông tin sản phẩm.";
                }
                ?>
                <div class = "container">
                    <div class = "error"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                    <a href = "clock_list.php">Quay lại danh sách sản phẩm</a>
                </div>
                <?php
            } else {
                if (!empty($_GET['id'])) {
                    $result = mysqli_query($connect, "SELECT * FROM `clock_admin` WHERE `id` = " . $_GET['id']);
                    $clock = $result->fetch_assoc();
                    $gallery = mysqli_query($connect, "SELECT * FROM `image_library` WHERE `clock_id` = " . $_GET['id']);
                    if (!empty($gallery) && !empty($gallery->num_rows)) {
                        while ($row = mysqli_fetch_array($gallery)) {
                            $product['gallery'][] = array(
                                'id' => $row['id'],
                                'path' => $row['path']
                            );
                        }
                    }
                }
                ?>
                <form id="product-form" method="POST" action="<?= (!empty($clock) && !isset($_GET['task'])) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>"  enctype="multipart/form-data">
                    <input type="submit" title="Lưu sản phẩm" value="" />
                    <div class="clear-both"></div>
                    <div class="wrap-field">
                        <label>Tên : </label>
                        <input type="text" name="name" value="<?= (!empty($clock) ? $clock['name'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Mã: </label>
                        <input type="text" name="code_clock" value="<?= (!empty($clock) ? $clock['code_clock'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Giá  </label>
                        <input type="text" name="price" value="<?= (!empty($clock) ? number_format($clock['price'], 0, ",", ".") : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Giá sale </label>
                        <input type="text" name="price_sale" value="<?= (!empty($clock) ? number_format($clock['price_sale'], 0, ",", ".") : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Dòng : </label>
                        <input type="text" name="type" value="<?= (!empty($clock) ? $clock['type'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Loại: </label>
                        <input type="text" name="current" value="<?= (!empty($clock) ? $clock['current'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>

                        <div class="wrap-field">
                        <label>Số lượng: </label>
                        <input type="text" name="quantity" value="<?= (!empty($clock) ? $clock['quantity'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                        <div class="wrap-field">
                        <label>Số lượng tồn: </label>
                        <input type="text" name="quantity _in_stock" value="<?= (!empty($clock) ? $clock['quantity _in_stock'] : "") ?>" />

                        <div class="clear-both"></div>
                    </div>


                    <div class="wrap-field">
                        <label>Ảnh: </label>
                        <div class="right-wrap-field">
        <?php if (!empty($clock['image'])) { ?>
                                <img src="../<?= $clock['image'] ?>" /><br/>
                                <input type="hidden" name="image" value="<?= $clock['image'] ?>" />
        <?php } ?>
                            <input type="file" name="image" />
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label> Ảnh minh họa: </label>
                        <div class="right-wrap-field">
                                <?php if (!empty($clock['gallery'])) { ?>
                                <ul>
            <?php foreach ($clock['gallery'] as $image) { ?>
                                        <li>
                                            <img src="../<?= $image['path'] ?>" />
                                            <a href="gallery_delete.php?id=<?= $image['id'] ?>">Xóa</a>
                                        </li>
                                <?php } ?>
                                </ul>
                            <?php } ?>
                            <?php if (isset($_GET['task']) && !empty($product['gallery'])) { ?>
                                <?php foreach ($product['gallery'] as $image) { ?>
                                    <input type="hidden" name="gallery_image[]" value="<?= $image['path'] ?>" />
                                <?php } ?>
        <?php } ?>
                            <input multiple="" type="file" name="gallery[]" />
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <!-- <div class="wrap-field">
                        <label>Chi tiết của tour: </label>
                        <textarea name="content" id="product-content"><?= (!empty($product) ? $product['content'] : "") ?></textarea>
                        <div class="clear-both"></div>
                    </div> -->
                
                </form>
                <div class="clear-both"></div>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('product-content');
                </script>
    <?php } ?>
        </div>
    </div>

    <?php
}
include './footer.php';
?>