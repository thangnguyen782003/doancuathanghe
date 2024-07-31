<!DOCTYPE html>
<html>
    <head>
        <title>Đổi thông tin thành viên</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .box-content {
                margin: 0 auto;
                width: 800px;
                border: 1px solid #ccc;
                text-align: center;
                padding: 20px;
            }
            #edit_user form {
                width: 200px;
                margin: 40px auto;
            }
            #edit_user form input {
                margin: 5px 0;
            }
        </style>
    </head>
    <body>
        <?php
        session_start();
        include './config.php';

        $error = false;

        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            if (isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['old_password']) && !empty($_POST['old_password']) && isset($_POST['new_password']) && !empty($_POST['new_password'])) {
                $userResult = mysqli_query($connect, "SELECT * FROM `users` WHERE (`id` = " . $_POST['user_id'] . " AND `password` = '" . md5($_POST['old_password']) . "')");
                if ($userResult->num_rows > 0) {
                    $result = mysqli_query($connect, "UPDATE `users` SET `password` = MD5('" . $_POST['new_password'] . "'), `last_updated`=" . time() . " WHERE (`id` = " . $_POST['user_id'] . " AND `password` = '" . md5($_POST['old_password']) . "')");
                    if (!$result) {
                        $error = "Không thể cập nhật tài khoản";
                    }
                } else {
                    $error = "Mật khẩu cũ không đúng.";
                }
                mysqli_close($connect);
                if ($error !== false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h1>Thông báo</h1>
                        <h4><?= $error ?></h4>
                        <a href="./editpassword.php">Đổi lại mật khẩu</a>
                    </div>
                <?php } else { ?>
                    <div id="edit-notify" class="box-content">
                        <h1><?= ($error !== false) ? $error : "Sửa tài khoản thành công" ?></h1>
                        <a href="./login.php">Quay lại tài khoản</a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div id="edit-notify" class="box-content">
                    <h1>Vui lòng nhập đủ thông tin để sửa tài khoản</h1>
                    <a href="./editpassword.php">Quay lại sửa tài khoản</a>
                </div>
                <?php
            }
        } else {
            if (isset($_SESSION['current_user']) && !empty($_SESSION['current_user'])) {
                $user = $_SESSION['current_user'];
                ?>
                <div id="edit_user" class="box-content">
                    <h1>Xin chào "<?= $user['fullname'] ?>". Bạn đang thay đổi mật khẩu</h1>
                    <form action="./editpassword.php?action=edit" method="post" autocomplete="off">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <label>Password cũ</label><br>
                        <input type="password" name="old_password" value=""><br>
                        <label>Password mới</label><br>
                        <input type="password" name="new_password" value=""><br>
                        <br><br>
                        <input type="submit" value="Edit">
                    </form>
                </div>
                <?php
            } else {
                ?>
                <div id="error-notify" class="box-content">
                    <h1>Người dùng chưa đăng nhập</h1>
                    <a href="./login.php">Đăng nhập</a>
                </div>
                <?php
            }
        }
        ?>
    </body>
</html>
