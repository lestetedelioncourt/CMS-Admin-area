<?php session_start();
	include '../includes1/db.php';
	if((isset($_SESSION['user'])) && (isset($_SESSION['pass']))){
		$sel_sql = "SELECT * FROM users1 WHERE user_email = '$_SESSION[user]' AND user_password = '$_SESSION[pass]'";
		if($run_sql = mysqli_query($conn, $sel_sql)){
			while($rows = mysqli_fetch_assoc($run_sql)){
				if(mysqli_num_rows($run_sql) == 1){
					if($rows['role'] == 'Site Admin'){
						
					}else{
						header('Location:../admin/index.php');
					}
				}else{
					header('Location:../admin/index.php');
				}
			}	
		} else{
			header('Location:../admin/index.php');
		}
	} else{
		header('Location:../admin/index.php');
	}
	
	$result = '';
	$result1 = '';
	if(isset($_GET['edit_id'])){
		$sel_sql = "SELECT * FROM users1 WHERE user_id = '$_GET[edit_id]'";
		$run = mysqli_query($conn, $sel_sql);
		while ($rows = mysqli_fetch_assoc($run)){
			if ($rows['role'] == 'Admin'){
				$sql = "UPDATE users1 SET role = 'Subscriber' WHERE user_id = '$_GET[edit_id]'";
				if(mysqli_query($conn, $sql)){
					$result = '<div class="alert alert-success">User '.$rows['user_email'].' has been updated to '.$rows['role'].'</div>';
				}
			}
			else if ($rows['role'] == 'Subscriber'){
				$sql = "UPDATE users1 SET role = 'Admin' WHERE user_id = '$_GET[edit_id]'";
				if(mysqli_query($conn, $sql)){
					$result = '<div class="alert alert-success">User '.$rows['user_email'].' has been updated to '.$rows['role'].'</div>';
				}
			}
				
		}
	}
	
	if(isset($_GET['del_id'])){
		$sel_sql = "SELECT * FROM users1 WHERE user_id = '$_GET[del_id]'";
		$run = mysqli_query($conn, $sel_sql);
		while ($rows = mysqli_fetch_assoc($run)){
			$sql = "DELETE FROM users1 WHERE user_id = '$_GET[del_id]'";
			$user = $rows['user_email'];
			if(mysqli_query($conn, $sql)){
				$result1 = '<div class="alert alert-danger">User '.$user.' has been deleted from the database</div>';
			}
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
			<?php echo $result; echo $result1; ?>
			<div class="col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-heading"><h3>New User List</h3></div>
				<div class="panel-body">
					<table class="table"> <!--"table" class formats view-->
						<thead>
						<tr>
							<th>S. No</th>
							<th>Name</th>
							<th>Role</th>							
							<th>Change Role</th>
							<th>Delete</th>
						</tr>
						</thead>
						<tbody>
						<tr>
						<?php
				$sql = "SELECT * FROM users1";
				$run = mysqli_query($conn, $sql);
				while ($rows = mysqli_fetch_assoc($run)){
					echo '
						<td>'.$rows['user_id'].'</td>
						<td>'.$rows['user_f_name'].' '.$rows['user_l_name'].'</td>
						 <td>'.$rows['role'].'</td>';
					if ($rows['role'] == 'Admin'){
					echo'
					<td><a href ="user_list.php?edit_id='.$rows['user_id'].'" class="btn btn-info">Make Subscriber</a></td>';}
					else if ($rows['role'] == 'Subscriber'){
					echo '
					<td><a href ="user_list.php?edit_id='.$rows['user_id'].'" class="btn btn-primary">Make Admin</a></td>';
					}
					else{
						echo '<td>N/A</td>';
					}
					if ($rows['role'] == 'Site Admin'){
						echo '<td>N/A</td>';
					}
					else{
					echo'
					<td><a href = "user_list.php?del_id='.$rows['user_id'].'" class="btn btn-danger">Delete Account</a></td>';}						
				echo '</tr>'; }
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