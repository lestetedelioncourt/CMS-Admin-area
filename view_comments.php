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
							<th>Status</th>
							<th>Delete</th>
						</tr>
						</thead>
						<tbody>
						<tr>
						 <td>1</td>
						 <td>Lonny G</td>
						 <td>g@gmail.com</td>
						 <td>vhviv</td>
						 <td>.p[kmkmpm</td>
						 <td>2018-04-13</td>
						 <td><a href="#" class="btn btn-success">Approve</a></td>
						 <td><a href="#" class="btn btn-danger">Delete</a></td>
						 </tr>
						 <tr>
						 <td>2</td>
						 <td>Gerry</td>
						 <td>Juney@gmail.com</td>
						 <td>N/A</td>
						 <td>Hello</td>
						 <td>2018-04-14</td>
						 <td>&nbsp;&nbsp;Approved</td>
						 <td><a href="#" class="btn btn-danger">Delete</a></td>
						 </tr>
						 <tr>
						 <td>3</td>
						 <td>Rhea</td>
						 <td>Makey@gmail.com</td>
						 <td>vhviv</td>
						 <td>.p[kmkmpm</td>
						 <td>2018-04-13</td>
						 <td><a href="#" class="btn btn-success">Approve</a></td>
						 <td><a href="#" class="btn btn-danger">Delete</a></td>
						 </tr>
						 <tr>
						 <td>4</td>
						 <td>Shione</td>
						 <td>Neap@gmail.com</td>
						 <td>N/A</td>
						 <td>Hello</td>
						 <td>2018-04-14</td>
						 <td>&nbsp;&nbsp;Approved</td>
						 <td><a href="#" class="btn btn-danger">Delete</a></td>
						 </tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<footer></footer>
	</body>
</html>