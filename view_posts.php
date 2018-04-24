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
	if(isset($_GET['new_status'])){
		$new_status = $_GET['new_status'];
		$sql = "UPDATE posts SET status='$new_status' WHERE id = '$_GET[id]'";
		if($run = mysqli_query($conn, $sql)){
			$result = '<div class="alert alert-success">We just updated the status</div>';
		}
	}
	
	if(isset($_GET['del_id'])){
		$del_id = $_GET['del_id'];
		$sql = "DELETE FROM posts WHERE id = '$del_id'";
		if($run = mysqli_query($conn, $sql)){
			$result = '<div class="alert alert-danger">You have deleted row #'.$del_id.' from the database.</div>';
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
		<?php echo $result; ?>	
			<!------------ Top Block Ends--------------->
			<!------------ Post list Starts--------------->
			
			<div class="clearfix"></div> 
			<div class="panel panel-primary">
				<div class="panel-heading"><h3>Posts</h3></div>
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
							<th>Status</th>
							<th>Action</th>
							<th>Edit post</th>
							<th>View post</th>
							<th>Delete post</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$sql = "SELECT * FROM posts p
							JOIN users1 u
							ON p.author = u.user_email	
							ORDER BY id DESC";
							$run = mysqli_query($conn, $sql);
							while($rows = mysqli_fetch_assoc($run)){
								echo'
									<tr>
						 <td>'.$rows['id'].'</td>
						 <td>'.$rows['date'].'</td>
						 <td>'.($rows['image'] == '' ? 'No Image' : '<img src="../'.$rows['image'].'" width="100px;">').'</td>
						 <td width="20%;">'.$rows['title'].'</td>
						 <td>'.substr($rows['description'], 0, 100).'</td>
						 <td>'.$rows['category'].'</td>
						 <td>'.$rows['user_f_name'].' '.$rows['user_l_name'].'</td>
						 <td>'.$rows['status'].'</td>';
						 if ($rows['status'] == 'Published'){
							echo '
						 <td style="text-align:center;"><a href="view_posts.php?new_status=Draft&id='.$rows['id'].'" class="btn btn-info btn-sm col-xs-11">Draft</a></td>'; } else{
						 echo '
						 <td style="text-align:center;"><a href="view_posts.php?new_status=Published&id='.$rows['id'].'" class="btn btn-primary btn-sm col-xs-11">Publish</a></td>'; }
						 echo'
						 <td style="text-align:center;"><a href="edit_post.php?edit_id='.$rows['id'].'" class="btn btn-warning btn-sm col-xs-11">Edit</a></td>
						 <td style="text-align:center;"><a href="../post.php?post_id='.$rows['id'].'" class="btn btn-success btn-sm col-xs-11">View<a></td>
						 <td style="text-align:center;"><a href="view_posts.php?del_id='.$rows['id'].'" class="btn btn-danger btn-sm col-xs-11">Delete</a></td>
						 </tr>
								';
							}
						?>
						

						</tbody>
					</table>
				</div>
			</div>
			<div class="col-lg-9 navbar nav" style="float: right;">
			<ul class="pagination-lg">
				<li style="list-style-type:none; margin-right:2cm; float: left;"><a href="#">1</a></li>
				<li style="list-style-type:none; margin-right:2cm; float: left;"><a href="#">2</a></li>
				<li style="list-style-type:none; margin-right:2cm; float: left;"><a href="#">3</a></li>
				<li style="list-style-type:none; margin-right:2cm; float: left;"><a href="#">4</a></li>
				<li style="list-style-type:none; margin-right:2cm; float: left;"><a href="#">5</a></li>
				<li style="list-style-type:none;margin-right:2cm; float: left;"><a href="#">6</a></li>
			</ul>
			</div>
		</div>
		<footer></footer>
	</body>
</html>