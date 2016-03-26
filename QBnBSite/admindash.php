<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="ZB&amp;VH">
		<link rel="shortcut icon" href="img/favicon.png">
		<title>QBnB - Settings</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
	</head>
 	<body>
	  	<?php
	 	session_start();
	 	?>
	 	 <?php
		 #Check if person accessing page is a verified admin, if not redirect them to userdash
		if(isset($_SESSION['Member_ID'])){
			if ($myrow['Member_ID'] > 5){
				header("Location: userdash.php");
				die();
			}
		} else {
			if ($myrow['Member_ID'] > 5){
				header("Location: userdash.php");
				die();
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
		         	<a class="navbar-brand" href="userdash.php"><b>QBnB</b></a>
		        </div>
		        <div class="navbar-collapse collapse">
	         		<ul class="nav navbar-nav navbar-right">
	         			<li class="active dropdown">
							<li>
								<a href="userdash.php">Go Back</a>
							</li>
						</li>
	         		</ul>
	        	</div>
		    </div>
	    </div>
	    <div class="navbar navbar-default navbar-fixed-top">
	     	<div class="container">
	        	<div class="navbar-header">
	          		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            	<span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
			        </button>
		         	<a class="navbar-brand" href="userdash.php"><b>QBnB</b></a>
		        </div>
		        <div class="navbar-collapse collapse">
	         		<ul class="nav navbar-nav navbar-right">
	         			<li class="active dropdown">
							<li>
								<a href="userdash.php">Go Back</a>
							</li>
						</li>
	         		</ul>
	        	</div>
		    </div>
	    </div>

		<div id="headerwrap" style="padding-top: 50px; min-height: 590px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
						<h1 style="text-align: center">Admin Panel</h1>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6">
							<h2 style="color: #dddddd;">Member Information:</h2>
							<div style="height: 400px !important; overflow: scroll;">
								<table class="table table-bordered table-hover"> <!-- Member table -->
						            <thead style="background-color: #dddddd">
						                <th>Member ID</th>
						                <th>Name</th>
						                <th>Property Owner?</th>
						                <th>Delete Member</th>
						            </thead>
								</table> <!-- Member table -->
							</div><!-- scroll -->
					</div><!-- col-lg-3 -->
				</div><!-- row -->


				<div class="row">
					<div class="col-lg-6">
							<h2 style="color: #dddddd">Property Information:</h2>
							<div style="height: 400px !important; overflow: scroll; width: 800px;">
								<table class="table table-bordered table-hover"> <!-- Property table -->
						            <thead style="background-color: #dddddd">
						                <th>Property ID</th>
						                <th>Address </th>
						                <th>District</th>
						                <th>City</th>
														<th>Type</th>
						                <th>Price</th>
						                <th>Delete Property</th>
						            </thead>
								</table> <!-- Member table -->
							</div><!-- scroll -->
					</div><!-- col-lg-3 -->
				</div><!-- row -->


				</div>
			</div>
		</div>
		<hr>
		</div>
		<div class="container">
			<p class="centered">Created by BH &amp; Associates</p>
		</div>
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	    <script src="js/bootstrap.min.js"></script>
	</body>
</html>