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
	if(isset($_GET['del_id'])){
		$del_sql = "DELETE FROM category WHERE c_id = '$_GET[del_id]'";
		if (mysqli_query($conn, $del_sql)){
			$result = '<div class="alert alert-danger">You have deleted the Category '.$_GET['del_id'].'</div>';
		}
	}
?>

<html>
	<head>
		<title>Admin Panel</title>
		<link rel="stylesheet" href="../../bootstrap-3.3.5-dist/css/bootstrap.css">
		<script src="../../js/jquery.js"></script>
		<script src="../../bootstrap-3.3.5-dist/js/bootstrap.js"></script> 
	</head>
	<body>
		<?php include 'includes1/header.php' ?>
		<div style="width:50px; height:50px;"></div>
		<?php include 'includes1/sidebar.php' ?>
		<div class="col-lg-10">
			
			<!------------ Top Block Ends--------------->
			<!------------ Post list Starts--------------->
			
			<div class="clearfix"></div> 
			<div class="col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-heading"><h3>Category List</h3></div>
				<div class="panel-body">
					<table class="table"> <!--"table" class formats view-->
						<thead>
						<tr>
							<th>S. No</th>
							<th>Category Name</th>
							<th>Edit Category</th>
							<th>Delete Category</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$sql = "SELECT * FROM category WHERE NOT c_id = 1 AND NOT c_id = 4";
							$run = mysqli_query($conn, $sql);
							while($rows = mysqli_fetch_assoc($run)){
								echo'
								<tr>
									<td>'.$rows['c_id'].'</td>
									<td>'.$rows['category_name'].'</td>
									<td><a href="edit_category.php?edit_id='.$rows['c_id'].'" class="btn btn-warning">Edit</a></td>
									<td><a href="category_list.php?del_id='.$rows['c_id'].'" class="btn btn-danger">Delete</a></td>
								</tr>
								';
							}
						?>
						</tbody>
					</table>
				</div>
			</div>	
			</div>
		</div>
		<footer></footer>
	</body>
</html>