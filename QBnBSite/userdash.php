<!DOCTYPE html>

<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="author" content="ZB&amp;VH">
	    <link rel="shortcut icon" href="img/favicon.png">
	    <title>QBnB - Dashboard</title>
	    <link href="css/bootstrap.css" rel="stylesheet">
	    <link href="css/main.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
 	</head>
	<body>
	  	<?php
	 	session_start();
	 	?>
	 	 <?php
		if(isset($_SESSION['Member_ID'])){
			include_once 'config/connection.php'; 
	    	$query = "SELECT Member_ID,F_Name,L_Name,Email FROM Member WHERE Member_ID=?";
	    	$stmt = $con->prepare($query);
	    	$stmt->bind_Param("s", $_SESSION['Member_ID']);
			$stmt->execute();
			$result = $stmt->get_result();
			$myrow = $result->fetch_assoc();
			
		} else {
			header("Location: index.php");
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
		         	<a class="navbar-brand" href="userdash.php"><b>QBnB</b></a>
		        </div>
		        <div class="navbar-collapse collapse">
	         		<ul class="nav navbar-nav navbar-right">
	         			<li class="active dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="settings.php">Update Account Info</a>
								</li>
								<li>
	            					<a href="login.php?logout=1">Log Out</a>
								</li>
								<?php if ($myrow['Member_ID'] <= 5) echo "<li role='separator' class='divider'></li>
																		  <li><a href='admindash.php'>Admin Dashboard</a></li>";?>
							</ul>
						</li>
	         		</ul>
	        	</div>
		    </div>
	    </div>
		<div id="headerwrap" style="padding-top: 50px; min-height: 590px;">
			<div class="container">
				<div class="row">
					<h1>Welcome <?php echo $myrow['F_Name'];?>!</h1>
					<div class="col-lg-6" style="height: 400px !important; overflow: scroll;">
						<table class="table table-bordered table-hover">
				            <thead style="background-color: #dddddd">
				                <th>Address</th>
				                <th>City</th>
				                <th>Type</th>
				                <th>Price</th>
				            </thead>
				            <?php
				            	include_once 'config/connection.php';
				            	// Query for property list.
				            	$queryAllPropertiesInfo = "SELECT DISTINCT Street_No, Street_Name, City, Postal_Code, Country, District_Name, Type, Price, Property_ID, Owner_ID
				            			  				   FROM Property";
				            	$queryAllPropertiesInfo = mysqli_query($con,$queryAllPropertiesInfo);

				            	// Fill table with property info.
				            	while ($rowProp = mysqli_fetch_array($queryAllPropertiesInfo)) {

				            		// Owner info query.
					            	$queryPropertyForOwnerInfo = "SELECT DISTINCT F_Name, L_Name, Email, Phone_No 
					            								  FROM Member
																  WHERE Member_ID = '$rowProp[Owner_ID]'";
					            	$queryPropertyForOwnerInfo = mysqli_query($con,$queryPropertyForOwnerInfo);
					            	$rowOwner = mysqli_fetch_assoc($queryPropertyForOwnerInfo);

					            	// Property Ratings and Comments query.
									$queryPropertyRatings = "SELECT DISTINCT Property_ID, Comment_Text, Owner_Reply, Rating 
															 FROM Comment NATURAL JOIN Booking
															 WHERE Booking.Property_ID = '$rowProp[Property_ID]'
															 ORDER BY Comment_Time";
					            	$queryPropertyRatings = mysqli_query($con,$queryPropertyRatings);

					            	// Basic property info.
				                	echo "<tbody>";
				                	echo "<tr data-toggle='collapse' data-target='.prop".$rowProp['Property_ID']."info'>";
				                	echo "<td>".$rowProp['Street_No'].' '.$rowProp['Street_Name']."</td>";
				                	echo "<td>".$rowProp['City']."</td>";
				                	echo "<td>".$rowProp['Type']."</td>";
				                	echo "<td>".'$'.$rowProp['Price'].'/Week'."</td>";
				                	echo "</tr>";

				          			// Hidden FULL info.
				                	echo "<tr class='collapse prop".$rowProp['Property_ID']."info hiddenRow'>";
				                	echo "<td style='background-color: #dddddd' colspan='2'></td>";
				                	echo "<td style='background-color: #dddddd' colspan='2'>";
				                	echo "Owner: ".$rowOwner['F_Name'].' '.$rowOwner['L_Name'].'<br>Email: '.$rowOwner['Email'].'<br>Phone: '.$rowOwner['Phone_No']."</td></tr>";

				                	echo "<tr class='collapse prop".$rowProp['Property_ID']."info hiddenRow'>";
				                	echo "<td style='background-color: #dddddd' colspan='4'>";
				                	echo "<br>Address: ".$rowProp['Street_No'].' '.$rowProp['Street_Name'].', '.$rowProp['Postal_Code'].', '.$rowProp['City'];
				                	echo "<br>District: ".$rowProp['District_Name'];
				                	echo "<br>Nearby: POIs here...!</td></tr>";

				                	echo "<tr class='collapse prop".$rowProp['Property_ID']."info hiddenRow'>";
				                	echo "<td style='background-color: #dddddd' colspan='4'>";

				                	if (mysqli_num_rows($queryPropertyRatings) > 0) {
				                		echo "<br>Comments:<br>";
										while ($rowRating = mysqli_fetch_array($queryPropertyRatings)) {
											echo $rowRating['Comment_Text'];
											if (is_null($rowRating['Rating'])) {
												echo "No rating.";
											} else {
												echo " Rating: ".$rowRating['Rating']."/5";
											}
										}
									} else {
										echo "No ratings yet!";
									}
				                	echo "</td></tr>";
				                	echo "</tbody>";

				               }
				            ?>
		        		</table>	
		        	</div>
				</div>
			</div>
		</div>	
			<hr>
		</div>	
		<div class="container">
			<p class="centered">Created by BH &amp; Associates</p>
		</div>
	    <script src="https://code.jquery.com/jquery-1.10.2.min.js">
	    </script>
	    <script src="js/bootstrap.min.js">
	    </script>
	    <script type="text/javascript">
			$('.collapse').on('show.bs.collapse', function () {
    		$('.collapse.in').collapse('hide');
			});
	    </script>
	</body>
</html>
