<?php session_start();
	include '../includes1/db.php';
	if((isset($_SESSION['user'])) && (isset($_SESSION['pass']))){
		$sel_sql = "SELECT * FROM users1 WHERE user_email = '$_SESSION[user]' AND user_password = '$_SESSION[pass]'";
		if($run_sql = mysqli_query($conn, $sel_sql)){
			while($rows = mysqli_fetch_assoc($run_sql)){
				$user_f_name = $rows['user_f_name'];
				$user_l_name = $rows['user_l_name'];
				$user_email = $rows['user_email'];
				$user_gender = $rows['user_gender'];
				$user_marital_status = $rows['user_marital_status'];
				$user_phone_no = $rows['user_phone_no'];
				$user_profession = $rows['user_profession'];
				$user_website = $rows['user_website'];
				$user_address = $rows['user_address'];
				$user_about_me = $rows['user_about_me'];
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
			<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
				<div class="col-md-4">
					<img src="../images/me.jpg" width="50%" class="img-thumbnail">
				</div>
				<div class="col-md-7">
				<h2><?php echo $user_f_name.' '.$user_l_name ?></h2>
				<div style="font-size:0.5cm;"><p><br><i class="glyphicon glyphicon-star"></i><?php echo $user_profession; ?></p>
				<p><i class="glyphicon glyphicon-road"></i> <?php echo $user_address; ?></p>
				<p><i class="glyphicon glyphicon-phone"></i> <?php echo $user_phone_no; ?></p>
				<p><i class="glyphicon glyphicon-envelope"></i> <?php echo $user_email; ?></p></div>
				</div>
				<div class="clearfix"></div>
				
					
			</div>	
			</div>
			</div>
			<div class="clearfix"></div> 
			<div class="col-md-4">
				<div>
					<div>
						<table>
							<tbody>
								<tr>
									<th height="30px;" >Gender</th>
									<td><?php echo $user_gender; ?> </td>
								</tr>
								<tr>
									<th height="30px;">Marital Status</th>
									<td><?php echo $user_marital_status; ?> </td>
								</tr> 
								<tr>
									<th height="30px;" width="200px;">Official Website</th>
									<td><?php echo $user_website; ?>  </td>
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div>
					<div>
						<table>
							<tbody>
								<tr>
									<td height="30px;" width="20px;">1 </td>
									<td><a href="#">Fantasie Tableaux</a> </td>
								</tr>
								<tr>
									<td height="30px;" width="20px;">2 </td>
									<td><a href="#">Fantasie</a> </td>
								</tr>
								<tr>
									<td height="30px;" width="20px;">3 </td>
									<td><a href="#">Black is the Color</a> </td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div>
					<div>
						<h4>About me</h4>
						<p>I am a graduate currently holding a Master’s degree in Biochemical Engineering (MEng). I am a member of British Mensa and have previously placed multiple times in the top 1000 students for the UK Mathematical Olympiad. I know several languages including via professional development courses such as C++, C, Java, HTML/CSS, PL/SQL, Excel/VBA, MATLAB, and PHP https://github.com/lestetedelioncourt. I have worked as a department head at an independent school, and taught for around 1 and a half years gaining invaluable experience in public speaking and planning, resource management, MS Powerpoint, MS Word.  I am also proficient in the use of CRM databases from my time as a Business Developer, and have organized, funded and run my own events, including ticketing and flyers. </p>
					</div>
				</div>
			</div>
		</div>
		<footer></footer>
	</body>
</html>