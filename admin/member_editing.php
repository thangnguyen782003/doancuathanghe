<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
	?>
	<div class="main-content">
		<h1><?= !empty($_GET['id']) ? ((!empty($_GET['task']) && $_GET['task'] == "copy") ? "Copy thành viên" : "Sửa thành viên") : "Thêm thành viên" ?></h1>
		<div id="content-box">
			<?php
			if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) {
				if (isset($_POST['email']) && !empty($_POST['email']) 
					&& isset($_POST['password']) && !empty($_POST['password'])
					&& isset($_POST['re_password']) && !empty($_POST['re_password'])) {
					if (empty($_POST['email'])) {
						$error = "Bạn phải nhập tên đăng nhập";
					} elseif (empty($_POST['password'])) {
						$error = "Bạn phải nhập mật khẩu";
					} elseif (empty($_POST['re_password'])) {
						$error = "Bạn phải nhập xác nhận mật khẩu";
					} elseif ($_POST['password'] != $_POST['re_password']) {
						$error = "Mật khẩu xác nhận không khớp";
					}
                    if (!isset($error)) {
                        
                            $escapedUsername = mysqli_real_escape_string($connect, $_POST['email']);
                            
                            $checkExistUser = mysqli_query($connect, "SELECT * FROM `user_admin` WHERE `email` = '$escapedUsername'");
                          
                            if($checkExistUser->num_rows != 0){ //tồn tại user rồi
                                $error = "Email đã tồn tại. Bạn vui lòng chọn username khác";
                          
                            }
                        
                        else{
                    		if ($_GET['action'] == 'edit' && !empty($_GET['id'])) { //Cập nhật lại thành viên

                                $result = mysqli_query($connect, "UPDATE `user_admin` SET `email` = '".$_POST['email']."',`name` = '".$_POST['name']."' , `password` = MD5('".$_POST['password']."') WHERE `user_admin`.`id` = ".$_GET['id'].";");
	                        } else { //Thêm thành viên
                                $result = mysqli_query($connect, "INSERT INTO `user_admin` (`id`, `email`, `password`,`name` ) VALUES (NULL, '".$_POST['email']."',MD5('".$_POST['password']."'),'".$_POST['name']."');");                        
	                        }
                    	}
                        
                        if (isset($result) && empty($result)) { //Nếu có lỗi xảy ra
                        	$error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        } else { //Nếu thành công
                        	if (!empty($galleryImages)) {
                        		$user_id = ($_GET['action'] == 'edit' && !empty($_GET['id'])) ? $_GET['id'] : $con->insert_id;
                        		$insertValues = "";
                        		foreach ($galleryImages as $path) {
                        			if (empty($insertValues)) {
                        				$insertValues = "(NULL, " . $user_id . ", '" . $path . "', " . time() . ", " . time() . ")";
                        			} else {
                        				$insertValues .= ",(NULL, " . $user_id . ", '" . $path . "', " . time() . ", " . time() . ")";
                        			}
                        		}
                        		$result = mysqli_query($con, "INSERT INTO `image_library` (`id`, `product_id`, `path`, `created_time`, `last_updated`) VALUES " . $insertValues . ";");
                        	}
                        }
                    }
                } else {
                	$error = "Bạn chưa nhập thông tin thành viên.";
                }
                ?>
                <div class = "container">
                	<div class = "error"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                	<a href = "member_listing.php">Quay lại danh sách thành viên</a>
                </div>
                <?php
            } else {
                if (!empty($_GET['id'])) {
                    $result = mysqli_query($connect, "SELECT * FROM `user_admin` WHERE `id` = " . $_GET['id']);
                    $clock = $result->fetch_assoc();
                }
                ?>
                <form id="product-form" method="POST" action="<?= isset($clock) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>" enctype="multipart/form-data">
                    <input type="submit" title="Lưu thành viên" value="" />
                    <div class="clear-both"></div>
                    <div class="wrap-field">
                        <label>Tài khoản   :</label>
                        <input type="text" name="email" value="<?= !empty($clock) ? $clock['email'] : "" ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Tên   :</label>
                        <input type="text" name="name" value="<?= !empty($clock) ? $clock['name'] : "" ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Mật khẩu: </label>
                        <input type="password" name="password" value="" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Xác nhận mật khẩu: </label>
                        <input type="password" name="re_password" value="" />
                        <div class="clear-both"></div>
                    </div>
                 
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