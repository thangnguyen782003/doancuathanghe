<?php
include "class.database.php";
if(!$_SESSION['login']) {
    header("Location:login.php");
}
if($_SESSION['login'] && $_SESSION['login']!='admin') {
    header("Location:index.php");
}

global $conn;
$result = mysqli_query($conn,"SELECT * FROM Customers");
//var_dump(mysqli_fetch_assoc($result));
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Customers - Danh sách khách hàng </title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
     <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Customer ID</th>
						<th>Customer Name</th>
						<th>Phone</th>
						<th>Address</th>                                           
						<th>City</th>  
						<th>Email</th>    						
					</tr>
				</thead>
			   
				<tbody>
				<?php while($row=mysqli_fetch_assoc($result)):?>
					<tr>
						<td><?=$row['CustomerID']?></td>
						<td><?=$row['CustomerName']?></td>
						 <td><?=$row['Phone']?></td>
						<td><?=$row['Address']?></td>
						<td><?=$row['City']?></td>   
						<td><?=$row['email']?></td>  						
					</tr>
					<?php endwhile; ?>
				  
				</tbody>
			</table>
            <a href="logout.php">Logout</a>
		</div>
	</div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>