<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    ?>
    <div class="main-content">
        <h1>Xóa thành viên</h1>
        <div id="content-box">
            <?php
            $error = false;
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                include './connect.php';
                $result = mysqli_query($connect, "DELETE FROM `user_admin` WHERE `id` = " . $_GET['id']);
                if (!$result) {
                    $error = "Không thể xóa thành viên.";
                }
                mysqli_close($connect);
                if ($error !== false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h2>Thông báo</h2>
                        <h4><?= $error ?></h4>
                        <a href="./member_listing.php">Danh sách thành viên</a>
                    </div>
        <?php } else { ?>
                    <div id="success-notify" class="box-content">
                        <h2>Xóa thành viên thành công</h2>
                        <a href="./member_listing.php">Danh sách thành viên</a>
                    </div>
                <?php } ?>
    <?php } ?>
        </div>
    </div>
    <?php
}
include 'footer.php';
?>