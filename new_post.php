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
	$error = '';
	if(isset($_POST['submit_post'])){
		//$date = date('Y-m-d h:i:s'); - current date timestamp
		$title = strip_tags($_POST['title']);
		$category = mysqli_real_escape_string($conn, strip_tags(trim(htmlspecialchars($_POST['category']))));
		/*$_FILES is a super global array created when a file is uploaded, has certain properties such as 'name' 'tmp_name' and 'size' which can be accessed through array. pathinfo can be used to return the path information including the file extension*/
		if(($_FILES['image']['name'] != '')){
			$image_name = $_FILES['image']['name'];
			$image_tmp = $_FILES['image']['tmp_name'];
			$image_size = $_FILES['image']['size'];
			$image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
			$image_path = '../images/'.$image_name;
			$image_db_path = 'images/'.$image_name;
			
			if($image_size < 1000000){
				if(($image_ext == 'jpg') || ($image_ext == 'png') || ($image_ext == 'gif')){
					if(move_uploaded_file($image_tmp, $image_path)){
						$ins_sql = "INSERT INTO posts (title, description, image, category, author, status) VALUES ('$title', '$_POST[description]', '$image_db_path', '$category', '$_SESSION[user]' '$_POST[status]')";
						if(mysqli_query($conn, $ins_sql)){
							header('view_posts.php');
						}
						else{
							$error = '<div class="alert alert-danger">Error in processing query. Please check syntax.</div>';
						}
					}
					else{
						$error = '<div class="alert alert-danger">Your image is not in the folder specified &apos;cms/images/&apos;. Please try again.</div>';
					}
				} else{
					$error = '<div class="alert alert-danger">Image format is incorrect. Please try again.</div>';
				}
			} else{
				$error = '<div class="alert alert-danger">Image file size is too large. Please resize and try again.</div>';
			}
		} else{
			$ins_sql = "INSERT INTO posts (title, description, category, author, status) VALUES ('$title', '$_POST[description]', '$_POST[category]', '$_SESSION[user]', '$_POST[status]')";
			if(mysqli_query($conn, $ins_sql)){
				header('post_list.php');
			}
			else{
				$error = '<div class="alert alert-danger">Error in processing query. Please check syntax.</div>';
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
		<script src="../../js/tinymce/tinymce.min.js"></script>
		<script>tinymce.init({ selector:'textarea' });</script>
	</head>
	<body>
		<?php include 'includes1/header.php' ?>
		<div style="width:50px; height:50px;"></div>
		<?php echo $error ?>
		<?php include 'includes1/sidebar.php' ?>
		<div class="col-lg-10">
			<div class="page-header"><h1>New post</h1></div>
			<div class="container-fluid">
			<form class="form-horizontal" action="new_post.php" method="post" enctype="multipart/form-data">
<!--Because form uploading file encryption type must be added-->
				<div class="form-group">
					<label for="image">Upload an Image</label>
					<input id="image" name="image" type="file" class="form-control">
				</div>
				<div class="form-group">
					<label for="title">Title</label>
					<input id="title" name="title" type="text" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="category">Category</label>
					<select id="category" name="category" class="form-control" required>
						<?php
							$sel_sql = "SELECT * FROM category WHERE NOT c_id = 1 AND NOT c_id = 4";
							$run_sql = mysqli_query($conn, $sel_sql);
							echo '<option>Select your Category</option>';
							while($rows = mysqli_fetch_assoc($run_sql)){
								echo '<option value="'.strtolower($rows['c_id']).'">'.$rows['category_name'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<textarea id="description" name="description" rows="30"></textarea>
				</div>
				<div class="form-group">
					<label for="status">Status</label>
					<select id="status" name="status" class="form-control">
						<option value="Draft">Draft</option>
						<option value="Published">Publish</option>
					</select>
				</div>
				<div class="form-group">
					<label for="submit_post" class="control-label"></label>
					<input id="submit_post" value="Submit a New Post" name="submit_post" type="submit" class="btn btn-danger">
				</div>
			</form>
			</div>
		</div>
		<footer></footer>
	</body>
</html>