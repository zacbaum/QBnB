<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="img/favicon.png">
		<title>QBnB - Sign Up</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<?php
		 session_start();
		?>
		<?php
		if(!(isset($_SESSION['Member_ID']))) {
			header("Location: index.php");
			die();
		}
		?>
		<?php 
		if(isset($_POST['list_property'])) {	 
		    include_once 'config/connection.php';
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
	            		<li><a href="supplierdash.php">Go Back</a></li>
	         		</ul>
	        	</div>
	 	    </div>
	    </div>
		<div id="headerwrap" style="padding-top: 50px; min-height: 590px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
						<h1 style="text-align: center">Enter your property info:</h1>
					</div>
					<div class="col-lg-6 col-lg-offset-3">
						<form name='list' id='list' action='createproperty.php' method='POST'>
							<div class="row" style="padding-bottom: 15px;">
								<div class="form-group">
									<div class="col-md-3">
							    		<input style="width: 100%;" type="text" class="form-control" name="Street_No" id="Street_No" placeholder="Street #">
							    	</div>
							    	<div class="col-md-9">
							    		<input style="width: 100%;" type="text" class="form-control" name="Street_Name" id="Street_Name" placeholder="Street Name">
							    	</div>
								</div>
							</div>
							<div class="row" style="padding-bottom: 15px;">
							 	<div class="form-group">
							 		<div class="col-md-4">
							    		<input style="width: 100%;" type="text" class="form-control" name="Postal_Code" id="Postal_Code" placeholder="Postal Code">
							    	</div>
							 		<div class="col-md-4">
							    		<input style="width: 100%;" type="text" class="form-control" name="City" id="City" placeholder="City">
							    	</div>
							 		<div class="col-md-4">
							    		<input style="width: 100%;" type="text" class="form-control" name="Country" id="Country" placeholder="Country">
							    	</div>
							    </div>
							</div>
							<div class="row" style="padding-bottom: 15px;">
								<div class="form-group">
									<div class="col-md-6">
							    		<select style="width: 100%;" type="text" class="form-control" name="Type" id="Type">		    	
										    <option value="" selected disabled>Listing Type</option>
										    <option>Apartment</option>
										    <option>Basement</option>
										    <option>Condo</option>
										    <option>Flat</option>
										    <option>House</option>
										    <option>Townhouse</option>
										</select>
							    	</div>
							    	<div class="col-md-6">
							    		<select style="width: 100%;" type="text" class="form-control" name="District_Name" id="District_Name">
											<option value="" selected disabled>District Name</option>
										    <?php
							            	include_once 'config/connection.php';
							            	// Query for district list.
							            	$queryDistrictNames = "SELECT DISTINCT District_Name
							            			  			   FROM District";
							            	$queryDistrictNames = mysqli_query($con, $queryDistrictNames);

							            	while ($rowDName = mysqli_fetch_array($queryDistrictNames)) {
							            		echo "<option";
							            		echo (isset($_POST['district']) && $_POST['district'] == $rowDName['District_Name'])?' selected':'';
												echo ">".$rowDName['District_Name']."</option>";
							            	}
							            	?>
										</select>
							    		</select>
							    	</div>
								</div>
							</div>
						 	<div style="text-align: center">
								<button type="submit" name='sign_up' class="btn btn-default">Sign Up</button>
							</div>
						</form>
						<?php
						if (isset($_GET["msg"]) && $_GET["msg"] == 'bademail') {
						echo "<br><div align='center'><span class='label label-danger'>Email already in use :(</span></div>";
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
