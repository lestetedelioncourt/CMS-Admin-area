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
?>

<!DOCTYPE html>
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
			<div class="col-md-3">
			<?php
				$sql = "SELECT * FROM posts WHERE status = 'Published'";
				$run = mysqli_query($conn, $sql);
				$total_posts = mysqli_num_rows($run);
			?>
			<div class="panel panel-danger">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="glyphicon glyphicon-signal" style="font-size:3.5cm;"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div style="font-size:2.0cm;"><?php echo $total_posts; ?></div>
							<div style="font-size:0.5cm;">Posts</div>
						</div>
					</div>
				</div>
				<a href="view_posts.php"><div class="panel-footer">
				<div class="pull-left">View Posts</div>
				<div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
				<div class="clearfix"></div> <!--prevents "floating"-->
				</div></a>
				
				</div>
			</div>
			<?php
				$sql = "SELECT * FROM category WHERE NOT c_id = 1 AND NOT c_id = 4";
				$run = mysqli_query($conn, $sql);
				$total_categories = mysqli_num_rows($run);
			?>
			<div class="col-md-3">
			<div class="panel panel-success">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="glyphicon glyphicon-th-list" style="font-size:3.5cm;"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div style="font-size:2.0cm;"><?php echo $total_categories; ?></div>
							<div style="font-size:0.5cm;">Categories</div>
						</div>
					</div>
				</div>
				<a href="category_list.php"><div class="panel-footer">
				<div class="pull-left">View Categories</div>
				<div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
				<div class="clearfix"></div> <!--prevents "floating"-->
				</div></a>
				
				</div>
			</div>
			<?php
				$sql = "SELECT * FROM users1";
				$run = mysqli_query($conn, $sql);
				$total_users = mysqli_num_rows($run);
			?>
			<div class="col-md-3">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="glyphicon glyphicon-user" style="font-size:3.5cm;"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div style="font-size:2.0cm;"><?php echo $total_users; ?></div>
							<div style="font-size:0.5cm;">Users</div>
						</div>
					</div>
				</div>
				<a href="user_list.php"><div class="panel-footer">
				<div class="pull-left">View Users</div>
				<div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
				<div class="clearfix"></div> <!--prevents "floating"-->
				</div></a>
				
				</div>
			</div>
			<?php
				$sql = "SELECT * FROM comments";
				$run = mysqli_query($conn, $sql);
				$total_comments = mysqli_num_rows($run);
			?>
			<div class="col-md-3">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="glyphicon glyphicon-comment" style="font-size:3.5cm;"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div style="font-size:2.0cm;"><?php echo $total_comments; ?></div>
							<div style="font-size:0.5cm;">Comments</div>
						</div>
					</div>
				</div>
				<a href="view_comments.php"><div class="panel-footer">
				<div class="pull-left">View Comments</div>
				<div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
				<div class="clearfix"></div> <!--prevents "floating"-->
				</div></a>
				
				</div>
			</div>
			<!------------ Top Block Ends--------------->
			<!------------ Post list Starts--------------->
			
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
						<td>'.$rows['user_f_name'].' '.$rows['user_l_name'].'
						 <td>'.$rows['role'].'</td>
						 </tr>
				';} ?>
						</tbody>
					</table>
				</div>
			</div>	
			</div>
			<div class="col-lg-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
				<div class="col-md-7">
				<div class="page-header" style="margin-top:2cm;"><h3>
				<?php
						$sql = "SELECT * FROM users1 WHERE user_email = '$_SESSION[user]'";
						$run = mysqli_query($conn, $sql);
						while($rows = mysqli_fetch_assoc($run)){ 
							echo $rows['user_f_name'].' '.$rows['user_l_name'];
						?></h3></div>
				</div>
				<div class="col-md8">
					<img src="../images/me.jpg" width="30%" class="img-circle">
				</div>
					<div class="panel-body">
					<table class="table" style="color:white;"> <!--"table" class formats view-->
						<tbody>
						
						<?php echo'<tr>
						 <th>Job</th>
						 <td>'.$rows['user_profession'].'</td>
						 </tr>
						<tr>
						 <th>Role</th>
						 <td>'.$rows['role'].'</td>
						 </tr>
						 <tr>
						 <th>Email</th>
						 <td>'.$rows['user_email'].'</td>
						 </tr>
						  <tr>
						 <th>Contact No</th>
						 <td>'.$rows['user_phone_no'].'</td>
						</tr>';}
						 ?>
						</tbody>
					</table>
				</div>
			</div>	
			</div>
			</div>
			<div class="clearfix"></div> 
			<div class="panel panel-primary">
				<div class="panel-heading"><h3>Latest Posts</h3></div>
				<div class="panel-body">
					<table class="table"> <!--"table" class formats view-->
						<thead>
						<tr>
							<th>S. No</th>
							<th>Date</th>
							<th>Image</th>
							<th>Title</th>
							<th>Description</th>
							<th>Category</th>
							<th>Author</th>
						</tr>
						</thead>
						<tbody>
						<tr>
						<?php
						$sql = "SELECT * FROM posts p
						JOIN users1 u 
						ON p.author = u.user_email
						ORDER BY p.id DESC";
						$run = mysqli_query($conn, $sql);
						while($rows = mysqli_fetch_assoc($run)){ 
						echo '<td>'.$rows['id'].'</td>
						 <td>'.$rows['date'].'</td>
						 <td><img src="../'.$rows['image'].'" width="100px;"></td>
						 <td>'.$rows['title'].'</td>
						 <td>'.substr($rows['description'], 0, 150).'</td>
						 <td>'.$rows['category'].'</td>
						 <td>'.$rows['user_f_name'].' '.$rows['user_l_name'].'</td>
						 </tr>'
						;}
						 ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading"><h3>Latest Comments</h3></div>
				<div class="panel-body">
					<table class="table"> <!--"table" class formats view-->
						<thead>
						<tr>
							<th>S. No</th>
							<th>Name</th>
							<th>Email</th>
							<th>Subject</th>
							<th>Comment</th>
							<th>Date</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$sql = "SELECT * FROM comments";
						$run = mysqli_query($conn, $sql);
						while($rows = mysqli_fetch_assoc($run)){ 
						echo '<tr>
						 <td>'.$rows['comment_id'].'</td>
						 <td>'.$rows['name'].'</td>
						 <td>'.$rows['email'].'</td>
						 <td>'.$rows['subject'].'</td>
						 <td>'.$rows['comment'].'</td>
						 <td>'.$rows['date'].'</td>
						 </tr>
						'; }
						 ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<footer></footer>
	</body>
</html>