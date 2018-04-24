<?php session_start();
	include '../includes1/db.php';
	if((isset($_SESSION['user'])) && (isset($_SESSION['pass']))){
		$sel_sql = "SELECT * FROM users1 WHERE user_email = '$_SESSION[user]' AND user_password = '$_SESSION[pass]'";
		if($run_sql = mysqli_query($conn, $sel_sql)){
			while($rows = mysqli_fetch_assoc($run_sql)){
				if(mysqli_num_rows($run_sql) == 1){
					if(($rows['role'] == 'Admin')||($rows['role'] == 'Site Admin')){
						
					}else{
						header('Location:../index.php?login=successful');
					}
				}else{
					header('Location:../index.php');
				}
			}	
		} else{
			header('Location:../index.php');
		}
	} else{
		header('Location:../index.php');
	}
	
	$result = '';
	if(isset($_POST['submit_cat'])){
		$ins_sql = "INSERT INTO category (category_name) VALUES ('$_POST[category]')";
		$run_sql = mysqli_query($conn, $ins_sql);
		$result = '<div class="alert alert-success">Category was successfully inserted into the database</div>';
	}
?>

<html>
	<head>
		<title>Admin Panel</title>
		<link rel="stylesheet" href="../../bootstrap-3.3.5-dist/css/bootstrap.css">
		<script src="../../js/jquery.js"></script>
		<script src="../../bootstrap-3.3.5-dist/js/bootstrap.js"></script> 
		<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
		<script>tinymce.init({ selector:'textarea' });</script>
	</head>
	<body>
		<?php include 'includes1/header.php' ?>
		<div style="width:50px; height:50px;"></div>
		<?php include 'includes1/sidebar.php' ?>
		<div class="col-lg-10">
			<?php echo $result; ?>
			<div class="page-header"><h1>New Category</h1></div>
			<div class="container-fluid">
			<form class="form-horizontal col-lg-5" action="new_category.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="category">Category</label>
					<input id="category" type="text" name="category" class="form-control">
				</div>
				<div class="form-group">
					<input id="submit_cat" type="submit" name="submit_cat" class="btn btn-danger">
				</div>
			</form>
			</div>
		</div>
		<footer></footer>
	</body>
</html>