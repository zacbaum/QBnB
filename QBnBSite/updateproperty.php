<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
	    <meta name="author" content="ZB&amp;VH">
		<link rel="shortcut icon" href="img/favicon.png">
		<title>QBnB - Update Property</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<?php
		 session_start();
		?>
		<?php 
		if(isset($_POST['update'])) {	 
		    include_once 'config/connection.php';
		    $queryListMe = "UPDATE Property SET 
		        	        Street_No = '$_POST[Street_No]',
		        	        Street_Name = '$_POST[Street_Name]',
		        	        Postal_Code = '$_POST[Postal_Code]',
		        	        City = '$_POST[City]',
		        	        Country = '$_POST[Country]',
		        	        District_Name = '$_POST[District_Name]',
		        	        Type = '$_POST[Type]',
		        	        Price = '$_POST[Price]'
		        	        WHERE Property_ID = '$_POST[Property_ID]'";
		    echo var_dump($queryListMe);
	        $queryListMe = mysqli_query($con,$queryListMe);
	        echo var_dump($queryListMe);
	        $queryChuckFeatures = "DELETE FROM Feature
	        					   WHERE Property_ID = '$_POST[Property_ID]'";
	        $queryChuckFeatures = mysqli_query($con,$queryChuckFeatures);
	        // Bedrooms
	        if (isset($_POST['FeatureBedroom'])) {
		        $queryAddAFeature = "INSERT INTO Feature (Property_ID, Feature_Name) 
			        	        	 VALUES ('$_POST[Property_ID]','$_POST[FeatureBedroom]')";
			    $queryAddAFeature = mysqli_query($con,$queryAddAFeature);
			}
			// Bathrooms
	        if (isset($_POST['FeatureBathroom'])) {
		        $queryAddAFeature = "INSERT INTO Feature (Property_ID, Feature_Name) 
			        	        	 VALUES ('$_POST[Property_ID]','$_POST[FeatureBathroom]')";
			    $queryAddAFeature = mysqli_query($con,$queryAddAFeature);
			}
			// Kitchens
	        if (isset($_POST['FeatureKitchen'])) {
		        $queryAddAFeature = "INSERT INTO Feature (Property_ID, Feature_Name) 
			        	        	 VALUES ('$_POST[Property_ID]','$_POST[FeatureKitchen]')";
			    $queryAddAFeature = mysqli_query($con,$queryAddAFeature);
			}
			// Parking
	        if (isset($_POST['FeatureParking'])) {
		        $queryAddAFeature = "INSERT INTO Feature (Property_ID, Feature_Name) 
			        	        	 VALUES ('$_POST[Property_ID]','$_POST[FeatureParking]')";
			    $queryAddAFeature = mysqli_query($con,$queryAddAFeature);
			}
			// Balcony
	        if (isset($_POST['FeatureBalcony'])) {
		        $queryAddAFeature = "INSERT INTO Feature (Property_ID, Feature_Name) 
			        	        	 VALUES ('$_POST[Property_ID]','$_POST[FeatureBalcony]')";
			    $queryAddAFeature = mysqli_query($con,$queryAddAFeature);
			}
			// Yard
	        if (isset($_POST['FeatureYard'])) {
		        $queryAddAFeature = "INSERT INTO Feature (Property_ID, Feature_Name) 
			        	        	 VALUES ('$_POST[Property_ID]','$_POST[FeatureYard]')";
			    $queryAddAFeature = mysqli_query($con,$queryAddAFeature);
			}
			// Pool
	        if (isset($_POST['FeaturePool'])) {
		        $queryAddAFeature = "INSERT INTO Feature (Property_ID, Feature_Name) 
			        	        	 VALUES ('$_POST[Property_ID]','$_POST[FeaturePool]')";
			    $queryAddAFeature = mysqli_query($con,$queryAddAFeature);
			}
			// Basement
	        if (isset($_POST['FeatureBasement'])) {
		        $queryAddAFeature = "INSERT INTO Feature (Property_ID, Feature_Name) 
			        	        	 VALUES ('$_POST[Property_ID]','$_POST[FeatureBasement]')";
			    $queryAddAFeature = mysqli_query($con,$queryAddAFeature);
			}
			header("Location: supplierdash.php");
		}
		?>
		<?php
		if(isset($_POST['Property_ID'])) {
			include_once 'config/connection.php';
			$queryGetPropertyInfo = "SELECT Street_No,Street_Name,Postal_Code,City,Country,District_Name,Type,Price
									 FROM Property
									 WHERE Property_ID = $_POST[Property_ID]";
			$queryGetPropertyInfo = mysqli_query($con,$queryGetPropertyInfo);
			$rowProp = mysqli_fetch_assoc($queryGetPropertyInfo);
			$queryGetFeatureInfo = "SELECT Feature_Name
									 FROM Feature
									 WHERE Property_ID = $_POST[Property_ID]";
			$queryGetFeatureInfo = mysqli_query($con,$queryGetFeatureInfo);
			$featureArray = array();
			while ($row = mysqli_fetch_assoc($queryGetFeatureInfo)) {
				$featureArray[] = $row["Feature_Name"];
			}
		} else {
			header("Location: supplierdash.php");
			die();
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
	            		<li><a href="supplierdash.php">Cancel</a></li>
	         		</ul>
	        	</div>
	 	    </div>
	    </div>
		<div id="headerwrap" style="padding-top: 10px; min-height: 590px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
						<h1 style="text-align: center">Update your property info:</h1>
					</div>
					<div class="col-lg-6 col-lg-offset-3">
						<form name='list' id='list' action='updateproperty.php' method='POST'>
							<div class="row" style="padding-bottom: 15px;">
								<div class="form-group">
									<div class="col-md-3">
							    		<input style="width: 100%;" type="text" class="form-control" name="Street_No" id="Street_No" <?php echo "value='$rowProp[Street_No]'";?>>
							    	</div>
							    	<div class="col-md-9">
							    		<input style="width: 100%;" type="text" class="form-control" name="Street_Name" id="Street_Name" <?php echo "value='$rowProp[Street_Name]'";?>>
							    	</div>
								</div>
							</div>
							<div class="row" style="padding-bottom: 15px;">
							 	<div class="form-group">
							 		<div class="col-md-4">
							    		<input style="width: 100%;" type="text" class="form-control" name="Postal_Code" id="Postal_Code" <?php echo "value='$rowProp[Postal_Code]'";?>>
							    	</div>
							 		<div class="col-md-4">
							    		<input style="width: 100%;" type="text" class="form-control" name="City" id="City" <?php echo "value='$rowProp[City]'";?>>
							    	</div>
							 		<div class="col-md-4">
							    		<input style="width: 100%;" type="text" class="form-control" name="Country" id="Country" <?php echo "value='$rowProp[Country]'";?>>
							    	</div>
							    </div>
							</div>
							<div class="row" style="padding-bottom: 15px;">
								<div class="form-group">
									<div class="col-md-3">
							    		<select style="width: 100%;" type="text" class="form-control" name="Type" id="Type" value=<?php echo $rowProp['Type'];?>>
							    			<option value=<?php echo $rowProp['Type'];?> selected><?php echo $rowProp['Type'];?></option>
										    <option>Apartment</option>
										    <option>Basement</option>
										    <option>Condo</option>
										    <option>Flat</option>
										    <option>House</option>
										    <option>Townhouse</option>
										</select>
							    	</div>
							    	<div class="col-md-5">
							    		<select style="width: 100%;" type="text" class="form-control" name="District_Name" id="District_Name" value=<?php echo $rowProp['District_Name'];?>>
							    			<option value='<?php echo $rowProp['District_Name'];?>' selected><?php echo $rowProp['District_Name'];?></option>
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
							    		<input style="width: 100%;" type="text" class="form-control" name="Price" id="Price" <?php echo "value='$rowProp[Price]'";?>>
							    	</div>
							    </div>
							</div>
						    <div class="row" style="padding-bottom: 15px; border-top-style: solid; color: white;">
								<div class="form-group" align='left'>
							    	<h4 style='color: white;'>
							    	<div class="col-md-4">
							    		<input type="radio" name="FeatureBedroom" value="1 Bedroom" <?php echo (in_array("1 Bedroom", $featureArray))?'checked':'' ?>> 1 Bedroom
							    	</div>
							    	<div class="col-md-4">
								    	<input type="radio" name="FeatureBedroom" value="2 Bedrooms" <?php echo (in_array("2 Bedrooms", $featureArray))?'checked':'' ?>> 2 Bedrooms
								    </div>
								   	<div class="col-md-4">
								    	<input type="radio" name="FeatureBedroom" value="3+ Bedrooms" <?php echo (in_array("3+ Bedrooms", $featureArray))?'checked':'' ?>> 3+ Bedrooms
								    </div>
									</h4>
							    </div>
							</div>
						    <div class="row" style="padding-bottom: 15px; border-top-style: solid; color: white;">
								<div class="form-group" align='left'>
							    	<h4 style='color: white;'>
							    	<div class="col-md-4">
							    		<input type="radio" name="FeatureBathroom" value="1 Bathroom" <?php echo (in_array("1 Bathroom", $featureArray))?'checked':'' ?>> 1 Bathroom
							    	</div>
							    	<div class="col-md-4">
								    	<input type="radio" name="FeatureBathroom" value="2 Bathrooms" <?php echo (in_array("2 Bathrooms", $featureArray))?'checked':'' ?>> 2 Bathrooms
								    </div>
								   	<div class="col-md-4">
								    	<input type="radio" name="FeatureBathroom" value="3+ Bathrooms" <?php echo (in_array("3+ Bathrooms", $featureArray))?'checked':'' ?>> 3+ Bathrooms
								    </div>
									</h4>
							    </div>
							</div>
						    <div class="row" style="padding-bottom: 15px; border-top-style: solid; color: white;">
								<div class="form-group" align='left'>
							    	<h4 style='color: white;'>
							    	<div class="col-md-4">
							    		<input type="radio" name="FeatureKitchen"  value="No Kitchen" <?php echo (in_array("No Kitchen", $featureArray))?'checked':'' ?>> No Kitchen
							    	</div>
							    	<div class="col-md-4">
							    		<input type="radio" name="FeatureKitchen" value="1 Kitchen" <?php echo (in_array("1 Kitchen", $featureArray))?'checked':'' ?>> 1 Kitchen
							    	</div>
							    	<div class="col-md-4">
								    	<input type="radio" name="FeatureKitchen" value="2 Kitchens" <?php echo (in_array("2 Kitchens", $featureArray))?'checked':'' ?>> 2 Kitchens
								    </div>
									</h4>
							    </div>
							</div>
						    <div class="row" style="padding-bottom: 15px; border-top-style: solid; color: white;">
								<div class="form-group" align='left'>
							    	<h4 style='color: white;'>
							    	<div class="col-md-4">
							    		<input type="radio" name="FeatureParking" value="No Parking" <?php echo (in_array("No Parking", $featureArray))?'checked':'' ?>> No Parking
							    	</div>
							    	<div class="col-md-4">
							    		<input type="radio" name="FeatureParking" value="1 Parking Spot" <?php echo (in_array("1 Parking Spot", $featureArray))?'checked':'' ?>> 1 Parking Spot
							    	</div>
							    	<div class="col-md-4">
								    	<input type="radio" name="FeatureParking" value="2+ Parking Spots" <?php echo (in_array("2+ Parking Spots", $featureArray))?'checked':'' ?>> 2+ Parking Spots
								    </div>
									</h4>
							    </div>
							</div>								
						    <div class="row" style="padding-bottom: 15px; border-top-style: solid; color: white;">
								<div class="form-group" align='center'>
							    	<h4 style='color: white;'>
							    	<div class="col-md-3">
							    		<input type="checkbox" name="FeatureBalcony" value="Balcony" <?php echo (in_array("Balcony", $featureArray))?'checked':'' ?>> Balcony
							    	</div>
							    	<div class="col-md-3">
								    	<input type="checkbox" name="FeatureYard" value="Yard" <?php echo (in_array("Yard", $featureArray))?'checked':'' ?>> Yard
								    </div>
								   	<div class="col-md-3">
								    	<input type="checkbox" name="FeaturePool" value="Pool" <?php echo (in_array("Pool", $featureArray))?'checked':'' ?>> Pool
								    </div>
								    <div class="col-md-3">
								    	<input type="checkbox" name="FeatureBasement" value="Basement" <?php echo (in_array("Basement", $featureArray))?'checked':'' ?>> Basement
								    </div>
									</h4>
							    </div>
							</div>
							<input type='hidden' id='Property_ID' name='Property_ID' value='<?php echo $_POST['Property_ID'];?>'>
						 	<div style="text-align: center">
								<button type="submit" name='update' class="btn btn-default">Update Property</button>
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
