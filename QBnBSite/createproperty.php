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
		if(isset($_POST['list'])) {	 
		    include_once 'config/connection.php';
		    $queryListMe = "INSERT INTO Property (Street_No,Street_Name,Postal_Code,City,Country,District_Name,Type,Price,Owner_ID) 
		        	        VALUES ('$_POST[Street_No]','$_POST[Street_Name]','$_POST[Postal_Code]','$_POST[City]','$_POST[Country]','$_POST[District_Name]','$_POST[Type]','$_POST[Price]','$_SESSION[Member_ID]')";
	        $queryListMe = mysqli_query($con,$queryListMe);
	        $Property_ID = mysqli_insert_id($con);
	        // Bedrooms
	        if (isset($_POST['FeatureBedroom'])) {
		        $queryAddAFeature = "INSERT INTO Feature (Property_ID, Feature_Name) 
			        	        	 VALUES ('$Property_ID','$_POST[FeatureBedroom]')";
			    $queryAddAFeature = mysqli_query($con,$queryAddAFeature);
			}
			// Bathrooms
	        if (isset($_POST['FeatureBathroom'])) {
		        $queryAddAFeature = "INSERT INTO Feature (Property_ID, Feature_Name) 
			        	        	 VALUES ('$Property_ID','$_POST[FeatureBathroom]')";
			    $queryAddAFeature = mysqli_query($con,$queryAddAFeature);
			}
			// Kitchens
	        if (isset($_POST['FeatureKitchen'])) {
		        $queryAddAFeature = "INSERT INTO Feature (Property_ID, Feature_Name) 
			        	        	 VALUES ('$Property_ID','$_POST[FeatureKitchen]')";
			    $queryAddAFeature = mysqli_query($con,$queryAddAFeature);
			}
			// Parking
	        if (isset($_POST['FeatureParking'])) {
		        $queryAddAFeature = "INSERT INTO Feature (Property_ID, Feature_Name) 
			        	        	 VALUES ('$Property_ID','$_POST[FeatureParking]')";
			    $queryAddAFeature = mysqli_query($con,$queryAddAFeature);
			}
			// Balcony
	        if (isset($_POST['FeatureBalcony'])) {
		        $queryAddAFeature = "INSERT INTO Feature (Property_ID, Feature_Name) 
			        	        	 VALUES ('$Property_ID','$_POST[FeatureBalcony]')";
			    $queryAddAFeature = mysqli_query($con,$queryAddAFeature);
			}
			// Yard
	        if (isset($_POST['FeatureYard'])) {
		        $queryAddAFeature = "INSERT INTO Feature (Property_ID, Feature_Name) 
			        	        	 VALUES ('$Property_ID','$_POST[FeatureYard]')";
			    $queryAddAFeature = mysqli_query($con,$queryAddAFeature);
			}
			// Pool
	        if (isset($_POST['FeaturePool'])) {
		        $queryAddAFeature = "INSERT INTO Feature (Property_ID, Feature_Name) 
			        	        	 VALUES ('$Property_ID','$_POST[FeaturePool]')";
			    $queryAddAFeature = mysqli_query($con,$queryAddAFeature);
			}
			// Basement
	        if (isset($_POST['FeatureBasement'])) {
		        $queryAddAFeature = "INSERT INTO Feature (Property_ID, Feature_Name) 
			        	        	 VALUES ('$Property_ID','$_POST[FeatureBasement]')";
			    $queryAddAFeature = mysqli_query($con,$queryAddAFeature);
			}
		    header("Location: supplierdash.php");
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
		<div id="headerwrap" style="padding-top: 10px; min-height: 590px;">
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
									<div class="col-md-3">
							    		<select style="width: 100%;" type="text" class="form-control" name="Type" id="Type">		    	
										    <option value="" selected disabled>Type</option>
										    <option>Apartment</option>
										    <option>Basement</option>
										    <option>Condo</option>
										    <option>Flat</option>
										    <option>House</option>
										    <option>Townhouse</option>
										</select>
							    	</div>
							    	<div class="col-md-5">
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
							    	</div>
							    	<div class="col-md-4">
							    		<input style="width: 100%;" type="text" class="form-control" name="Price" id="Price" placeholder="$CAD/Week">
							    	</div>
							    </div>
							</div>
						    <div class="row" style="padding-bottom: 15px;">
								<div class="form-group" align='center'>
							    	<h4 style='color: white;'>
							    	<div class="col-md-4">
							    		<input type="radio" name="FeatureBedroom" value="1 Bedroom"> 1 Bedroom
							    	</div>
							    	<div class="col-md-4">
								    	<input type="radio" name="FeatureBedroom" value="2 Bedrooms"> 2 Bedrooms
								    </div>
								   	<div class="col-md-4">
								    	<input type="radio" name="FeatureBedroom" value="3+ Bedrooms"> 3+ Bedrooms
								    </div>
									</h4>
							    </div>
							</div>
							<div class="row" style="padding-bottom: 15px;">
								<div class="form-group" align='center'>
							    	<h4 style='color: white;'>
							    	<div class="col-md-4">
							    		<input type="radio" name="FeatureBathroom" value="1 Bathroom"> 1 Bathroom
							    	</div>
							    	<div class="col-md-4">
								    	<input type="radio" name="FeatureBathroom" value="2 Bathrooms"> 2 Bathrooms
								    </div>
								   	<div class="col-md-4">
								    	<input type="radio" name="FeatureBathroom" value="3+ Bathrooms"> 3+ Bathrooms
								    </div>
									</h4>
							    </div>
							</div>
							<div class="row" style="padding-bottom: 15px;">
								<div class="form-group" align='center'>
							    	<h4 style='color: white;'>
							    	<div class="col-md-6">
							    		<input type="radio" name="FeatureKitchen" value="1 Kitchen"> 1 Kitchen
							    	</div>
							    	<div class="col-md-6">
								    	<input type="radio" name="FeatureKitchen" value="2 Kitchens"> 2 Kitchens
								    </div>
									</h4>
							    </div>
							</div>
							<div class="row" style="padding-bottom: 15px;">
								<div class="form-group" align='center'>
							    	<h4 style='color: white;'>
							    	<div class="col-md-6">
							    		<input type="radio" name="FeatureParking" value="1 Parking Spot"> 1 Parking Spot
							    	</div>
							    	<div class="col-md-6">
								    	<input type="radio" name="FeatureParking" value="2+ Parking Spots"> 2+ Parking Spots
								    </div>
									</h4>
							    </div>
							</div>								
							<div class="row" style="padding-bottom: 15px;">
								<div class="form-group" align='center'>
							    	<h4 style='color: white;'>
							    	<div class="col-md-3">
							    		<input type="checkbox" name="FeatureBalcony" value="Balcony"> Balcony
							    	</div>
							    	<div class="col-md-3">
								    	<input type="checkbox" name="FeatureYard" value="Yard"> Yard
								    </div>
								   	<div class="col-md-3">
								    	<input type="checkbox" name="FeaturePool" value="Pool"> Pool
								    </div>
								    <div class="col-md-3">
								    	<input type="checkbox" name="FeatureBasement" value="Basement"> Basement
								    </div>
									</h4>
							    </div>
							</div>
						 	<div style="text-align: center">
								<button type="submit" name='list' class="btn btn-default">List Property</button>
							</div>
						</form>
						<br><br>
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
