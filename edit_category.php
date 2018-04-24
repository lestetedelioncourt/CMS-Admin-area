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
	if(isset($_POST['update_cat'])){
		$sql = "UPDATE category SET category_name = '$_POST[category]' 
		WHERE c_id = '$_POST[e_id]'";
		if(mysqli_query($conn, $sql)){
		$result = '<div class="alert alert-success">The category has successfully been edited</div>';}
	}
	
	
	
	//$ins_sql = "UPDATE posts SET title = '$title' WHERE posts id = '$_GET[edit_id]'";
	
	
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
			<div class="page-header"><h1>Edit Category</h1></div>
			<div class="container-fluid">
			<form class="form-horizontal col-lg-5" action="edit_category.php" method="post" enctype="multipart/form-data">
				<div class="form-group" width = "100%">
					<input type="hidden" value="<?php echo $_GET['edit_id'] ?>" name="e_id" id="e_id" class ="form-control">
					<label for="category">Category</label>
					<input id="category" type="text" name="category" value="<?php
					if(isset($_GET['edit_id'])){
					$sel_sql = "SELECT * FROM category WHERE c_id = '$_GET[edit_id]'";
					$run_sql = mysqli_query($conn, $sel_sql);
					while ($rows = mysqli_fetch_assoc($run_sql)){
						echo $rows['category_name'];
					}}
					  ?>" class="form-control" width="100%">
				</div>
				<div class="form-group">
					<input id="update_cat" type="submit" name="update_cat" class="btn btn-danger">
				</div>
			</form>
			</div>
		</div>
		<footer></footer>
	</body>
</html>