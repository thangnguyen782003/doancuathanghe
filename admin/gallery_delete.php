<?php include 'header.php'; ?>
<div class="main-content">
    <h1>Xóa sản phẩm</h1>
    <div id="content-box">
    <?php
    $error = false;
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        include './connect.php';
        $result = mysqli_query($connect, "DELETE FROM `image_library` WHERE `id` = ".$_GET['id']);
        if (!$result) {
            $error = "Không thể xóa ảnh trong thư viện.";
        }
        mysqli_close($connect);
        if ($error !== false) {
            ?>
            <div id="error-notify" class="box-content">
                <h2>Thông báo</h2>
                <h4><?= $error ?></h4>
                <a href="javascript:window.history.go(-1)">Quay lại</a>
            </div>
        <?php } else { ?>
            <div id="success-notify" class="box-content">
                <h2>Xóa thư viện ảnh của sản phẩm thành công</h2>
                <a href="javascript:window.history.go(-1)">Quay lại</a>
            </div>
        <?php } ?>
    <?php } ?>
    </div>
</div>
<?php include 'footer.php'; ?>