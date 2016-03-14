<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="img/favicon.png">
		<title>QBnB - Log In</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
	</head>
	<body>
	  	<?php
		 session_start();
		?>
		<?php
		if(isset($_GET['logout'])) {
			$_SESSION['Member_ID'] = null;
			session_destroy();
		}
		?>	 
		<?php
		if(isset($_SESSION['Member_ID'])) {
			header("Location: userdash.php");
			die();
		}
		?>
		<?php 
		if(isset($_POST['signin'])) {
		    include_once 'config/connection.php'; 
	        $query = "SELECT Member_ID,Email,Password FROM Member WHERE Email=? AND Password=?";
	        if($stmt = $con->prepare($query)) {
		        $stmt->bind_Param("ss", $_POST['Email'], $_POST['Password']);
				$stmt->execute();
				$result = $stmt->get_result();
				$num = $result->num_rows;	
				if($num>0){
					$myrow = $result->fetch_assoc();
					$_SESSION['Member_ID'] = $myrow['Member_ID'];
					header("Location:userdash.php");
					die();
				} else {
					echo "Failed to login";
					header("location:login.php?msg=failed");
				}
			} else {
				echo "failed to prepare the SQL";
			}
		}
		?>
	    <div class="navbar navbar-default navbar-fixed-top">
	     	<div class="container">
	        	<div class="navbar-header">
	          		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            	<span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		         	</button>
	         		<a class="navbar-brand" href="index.php"><b>QBnB</b></a>
	       		</div>
				<div class="navbar-collapse collapse">
	         		<ul class="nav navbar-nav navbar-right">
	            		<li><a href="signup.php">Not a member?</a></li>
	         		</ul>
	        	</div>
	      	</div>
	    </div>
		<div id="headerwrap" style="padding-top: 100px; min-height: 590px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<h1 style="text-align:center">Welcome back.</h1>
						<form name='login' id='login' action='login.php' method='POST'>
						 	<div class="form-group">
						    	<input style="width: 100%;" name="Email" type="email" class="form-control" id="Email" placeholder="youremail@address.ca">
						  	</div>
						 	<div class="form-group">
						    	<input style="width: 100%;" name="Password" type="password" class="form-control" id="Password" placeholder="Password">
						 	</div>
						 	<div style="text-align: center">
								<button type="submit" class="btn btn-default" name="signin">Sign In</button>
							</div>	
						</form>
						<?php
						if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
						echo "<br><div align='center'><span class='label label-danger'>Wrong Email or Password :(</span></div>";
						}
						?>
					</div>				
				</div>
			</div>
		</div>	
		<div class="container">
			<hr>
			<p class="centered">Created by BH &amp; Associates</p>
		</div>
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	    <script src="js/bootstrap.min.js"></script>
	</body>
</html>
