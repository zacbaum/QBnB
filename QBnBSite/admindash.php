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
			if ($_SESSION['Member_ID'] > 5){
				header("Location: userdash.php");
				die();
			}
		} else {
			if ($_SESSION['Member_ID'] > 5){
				header("Location: userdash.php");
				die();
			}
		}
		?>

		<?php
			if(isset($_POST['Delete_Property'])) {
				include_once 'config/connection.php';
				$queryDeleteProperty = "DELETE FROM Property
																WHERE Property_ID = $_POST[Property_ID]";
				$queryDeleteProperty = mysqli_query($con,$queryDeleteProperty);
			}
		?>

		<?php
			if(isset($_POST['Delete_Member'])) {

				include_once 'config/connection.php';
				$queryDeleteMember = "DELETE FROM Member
										WHERE Member_ID = $_POST[Member_ID]";
				$queryDeleteMember = mysqli_query($con,$queryDeleteMember);
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
							<div style="max-height: 400px !important; overflow: scroll;">
								<table class="table table-bordered table-hover"> <!-- Member table -->
						            <thead style="background-color: #dddddd">
						                <th>ID</th>
						                <th>Name</th>
						                <th>Property Owner?</th>
						                <th>Delete</th>
						            </thead>
								<?php
								 			include_once 'config/connection.php';
											$queryBasicMemberInfo = "SELECT *
																							 FROM Member";
											$queryBasicMemberInfo = mysqli_query($con,$queryBasicMemberInfo);

											//Fill in member information. In this loop, another query to check if members
											//own property will also be executed.
											while ($rowMember = mysqli_fetch_array($queryBasicMemberInfo)){
												echo "<tbody style='color: white;'>";
												echo "<tr>";
												echo "<td>".$rowMember['Member_ID']."</td>";

												echo "<td><a style='color:white' data-placement='right' data-toggle='popover' title='Member Details'>";
												echo $rowMember['F_Name'].' '.$rowMember['L_Name']."</a>";
												echo "<div id='popover-content' class='hide'><p style='color: #3498db'>";
												echo "<b>Email: </b>".$rowMember['Email']."<br><b>Phone:</b> ".$rowMember['Phone_No'];
												echo "</p></div></td>";

												$queryCheckIfOwner = "SELECT Property_ID
																							FROM Property
																							WHERE Owner_ID = '$rowMember[Member_ID]'";
												$queryCheckIfOwner = mysqli_query($con, $queryCheckIfOwner);

												if (mysqli_num_rows($queryCheckIfOwner) == 0)
													echo "<td> No </td>";
												else {
													echo "<td> Yes </td>";
												}//End loop filling in if members own property

												//Delete member form
												echo "<td align = center ><form name='Delete_Member' id='Delete_Member' action='admindash.php' method='POST'>";
												echo "<input type='hidden' id='Member_ID' name='Member_ID' value='".$rowMember['Member_ID']."'>";
												echo "<button style='background: transparent; border: none; padding: 0;' type=submit name='Delete_Member'
															data-toggle='tooltip' data-placement='right' title='Are you sure?'>";
												echo "<span class='glyphicon glyphicon-remove' aria-hidden='true' style='color: red;'></span></form></td>";
												echo"</tr>";


											}//End while filling member info
								?>
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
						                <th>ID</th>
						                <th>Address </th>
						                <th>District</th>
						                <th>City</th>
														<th>Type</th>
						                <th>Price</th>
						                <th>Delete</th>
						            </thead>
												<?php
												 			include_once 'config/connection.php';
															$queryBasicPropInfo = "SELECT *
																										 FROM Property";
															$queryBasicPropInfo = mysqli_query($con,$queryBasicPropInfo);

															//Fill in property information
															while ($rowProperty = mysqli_fetch_array($queryBasicPropInfo)){

																//For popover, get owner name
																$queryGetOwner = "SELECT F_Name, L_Name
																											FROM Member
																											WHERE Member_ID = '$rowProperty[Owner_ID]'";
																$queryGetOwner = mysqli_query($con, $queryGetOwner);
																$rowOwnerInfo = mysqli_fetch_array($queryGetOwner);

																//For popover, get average rating on property
																$queryGetAverage = "SELECT avg(Rating) as 'Average'
																									FROM Booking NATURAL JOIN Comment
																									WHERE Property_ID = '$rowProperty[Property_ID]'";
																$queryGetAverage = mysqli_query($con, $queryGetAverage);
																$averageRating = mysqli_fetch_array($queryGetAverage);

																echo "<tbody style='color: white;'>";
																echo "<tr><td>".$rowProperty['Property_ID']."</td>";

																echo "<td><a style='color:white' data-placement='right' data-toggle='popover' title='Property Details'>";
																echo $rowProperty['Street_No'].' '.$rowProperty['Street_Name']."</a>";
																echo "<div id='popover-content' class='hide'><p style='color: #3498db'>";

																//Fill popover-content
																echo "<b>Owner: </b>".$rowOwnerInfo['F_Name'].' '.$rowOwnerInfo['L_Name']."<br>";
																if ($averageRating['Average'] == NULL)
																	echo "<b>Average Ratings:</b>".' '.'No ratings yet!'."<br>";
																else {
																	echo "<b>Average Rating:</b>".$averageRating['Average']."<br>";
																}
																echo "</p></div></td>"; //Close popover-content for properties

																echo "<td>".$rowProperty['District_Name']."</td>";
																echo "<td>".$rowProperty['City']."</td>";
																echo "<td>".$rowProperty['Type']."</td>";
																echo "<td>".'$'.$rowProperty['Price'].'/Week'."</td>";
																echo "<td align = center ><form name='Delete_Property' id='Delete_Property' action='admindash.php' method='POST'>";
																echo "<input type='hidden' id='Property_ID' name='Property_ID' value='".$rowProperty['Property_ID']."'>";
																echo "<button style='background: transparent; border: none; padding: 0;' type=submit name='Delete_Property'
																			data-toggle='tooltip' data-placement='right' title='Are you sure?'>";
																echo "<span class='glyphicon glyphicon-remove' aria-hidden='true' style='color: red;'></span></form></td></tr>";
															}//End while filling property info
											?>
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
			<script>
				$("[data-toggle=popover]").popover({
						html: true,
						content: function() {
								return $(this).next('#popover-content').html();
						}
				});
			</script>
	</body>
</html>
