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
		?> <!--End authorization check -->

		<?php
			if(isset($_POST['Delete_Property'])) {
				include_once 'config/connection.php';
				$queryDeleteProperty = "DELETE FROM Property
										WHERE Property_ID = $_POST[Property_ID]";
				$queryDeleteProperty = mysqli_query($con,$queryDeleteProperty);
			}
		?> <!--POST Request for deleting member-->

		<?php
			if(isset($_POST['Delete_Member'])) {

				include_once 'config/connection.php';
				$queryDeleteMember = "DELETE FROM Member
									  WHERE Member_ID = $_POST[Member_ID]";
				$queryDeleteMember = mysqli_query($con,$queryDeleteMember);
			}
		?> <!--POST request for deleting member-->
		<div class="navbar navbar-default navbar-fixed-top">
	     	<div class="container">
	        	<div class="navbar-header">
	          		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            	<span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
			        </button>
		         	<a class="navbar-brand" href="admindash.php"><b>QBnB</b></a>
		        </div>
		        <div class="navbar-collapse collapse">
	         		<ul class="nav navbar-nav navbar-right">
	         			<li>
	         				<a href='userdash.php'>View &amp; Create Bookings</a>
	         			</li>
	         			<li>
	         				<a href='supplierdash.php'>View &amp; Create Listings</a>
	         			</li>
	         			<li class="active dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="settings.php">My Account</a>
								</li>
								<li>
	            					<a href="login.php?logout=1">Log Out</a>
								</li>
							</ul>
						</li>
	         		</ul>
	        	</div>
		    </div>
	    </div>
		<div id="headerwrap" style="padding-top: 50px; min-height: 590px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
						<h1 style="text-align: center">Administrator Dashboard</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<h2 style="margin-top: 0px;">Member Information:</h2>
						<div style="max-height: 380px !important; overflow: scroll;">
							<table class="table table-bordered table-hover"> <!-- Member table -->
					            <thead style="background-color: #dddddd">
					                <th>ID</th>
					                <th>Name</th>
					                <th>Owner?</th>
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
										//For popover, get history of member as a consumer
										$queryConsumerHistory = "SELECT Booking_ID, Booking_Start, Booking_Status
																 FROM Booking
																 WHERE Member_ID = '$rowMember[Member_ID]'";
										$queryConsumerHistory = mysqli_query($con, $queryConsumerHistory);

										echo "<tbody style='color: white;'>";
										echo "<tr>";
										echo "<td>".$rowMember['Member_ID']."</td>";

										//Consumer popover section
										echo "<td><a class='intable' data-placement='right' data-toggle='popover' title='Consumer Details'>";
										echo $rowMember['F_Name'].' '.$rowMember['L_Name']."</a>";
										echo "<div id='popover-content' class='hide'><p style='color: #3498db'>";
										echo "<b>Email: </b>".$rowMember['Email']."<br><b>Phone:</b> ".$rowMember['Phone_No'];
										echo "<br>";

										//Fill booking history per consumer
										echo "<b>Consumer Activity: </b><ol>";
										//Check if there is any consumer history to report
										if (mysqli_num_rows($queryConsumerHistory) == 0)
											echo "This member has not made any bookings.</ol>";

										//Report consumer history if it exists
										while ($rowConsumerHistory = mysqli_fetch_array($queryConsumerHistory)){
											echo "<li><i>Booking ID: </i>".' '.$rowConsumerHistory['Booking_ID']."</li>";
											echo "<ul style ='list-style-type:disc' ><li><i>Booking Start: </i>".' '.preg_replace('/^(.*?)\ 00:00:00/','$1',$rowConsumerHistory['Booking_Start'])."</li>";
											echo "<li><i>Booking Status: </i>".' '.$rowConsumerHistory['Booking_Status']."</li>";
											echo "</ul>";
											echo "</li>";
										}//End loop filling in consumer history
										echo "</p></div></td>"; //Close popover content

										//Determine if member owns property
										$queryCheckIfOwner = "SELECT Property_ID
															  FROM Property
															  WHERE Owner_ID = '$rowMember[Member_ID]'";
										$queryCheckIfOwner = mysqli_query($con, $queryCheckIfOwner);

										//Query to obtain owner's average rating across properties, only ran if they are an owner
										$queryGetOwnerAverage = "SELECT avg(Rating) as 'Owner_Average'
																 FROM Comment NATURAL JOIN Booking
																 WHERE Owner_ID = '$rowMember[Member_ID]'";

										//Query to obtain number of properties a person owns, only ran if they are an owner
										$queryGetNumProp = "SELECT count(Property_ID) as 'Num_Prop'
															FROM Property
															WHERE Owner_ID = '$rowMember[Member_ID]'";

										//Query to obtain all bookings associated with that owner, only ran if they are an owner
										$queryOwnerHistory = "SELECT Booking_ID, Booking_Start, Booking_Status, Member_ID, Property_ID
															  FROM Booking
															  WHERE Owner_ID = '$rowMember[Member_ID]'";

										//The owner summary popover is only created if the member owns property
										if (mysqli_num_rows($queryCheckIfOwner) == 0)
											echo "<td> No </td>";
										else {
											$queryGetNumProp = mysqli_query($con, $queryGetNumProp);
											$queryGetOwnerAverage = mysqli_query($con, $queryGetOwnerAverage);
											$queryOwnerHistory = mysqli_query($con, $queryOwnerHistory);
											$rowNumProp = mysqli_fetch_array($queryGetNumProp);
											$rowOwnerAverage = mysqli_fetch_array($queryGetOwnerAverage);
											echo "<td><a class='intable' data-placement='right' data-toggle='popover' title='Owner Details'>";
											echo "Yes </a>";
											echo "<div id='popover-content' class='hide'><p style='color: #3498db'>";
											echo "<b>Properties Owned: </b>".$rowNumProp['Num_Prop']."<br>";

											//Only report average rating if they have ratings, do not put 0 as default
											if ($rowOwnerAverage['Owner_Average'] == NULL)
												echo "<b>Average Rating:</b>".' '.'No ratings yet!'."<br>";
											else {
											echo "<b>Average Rating:</b>".' '.round($rowOwnerAverage['Owner_Average'],2),"<br>";
											}//End rating check

											//Check if there is any owner history to report
											if (mysqli_num_rows($queryOwnerHistory) == 0)
												echo "There are not any bookings on this member's property yet.";
											else
												echo "<b>Booking History: </b><ol>";
											//Report history if it exists
											while ($rowOwnerHistory = mysqli_fetch_array($queryOwnerHistory)){
												echo "<li><i>Property ID: </i>".' '.$rowOwnerHistory['Member_ID']."</li>";
												echo "<ul><li><i>Member ID: </i>".' '.$rowOwnerHistory['Member_ID']."</li>";	
												echo "<li><i>Booking ID: </i>".' '.$rowOwnerHistory['Booking_ID']."</li>";
												echo "<li><i>Booking Start: </i>".' '.preg_replace('/^(.*?)\ 00:00:00/','$1',$rowOwnerHistory['Booking_Start'])."</li>";
												echo "<li><i>Booking Status: </i>".' '.$rowOwnerHistory['Booking_Status']."</li>";
												echo "</ul><br>";
											}//End loop filling owner history
											echo "<br>";
											echo "</p></div></td>"; //Close popover content
										}//End loop filling in if members own property

										//Delete member form
										echo "<td align='center'><form name='Delete_Member' id='Delete_Member' action='admindash.php' method='POST'>";
										echo "<input type='hidden' id='Member_ID' name='Member_ID' value='".$rowMember['Member_ID']."'>";
										echo "<button style='background: transparent; border: none; padding: 0;' type=submit name='Delete_Member'
													data-toggle='tooltip' data-placement='right' title='Are you sure?'>";
										echo "<span class='glyphicon glyphicon-remove' aria-hidden='true' style='color: red;'></span></form></td>";
										echo"</tr>";
									}//End while filling member info
								?>
								</table> <!-- End member table -->
								</div><!-- scroll -->
							</div><!-- col-lg-3 -->
							<div class="col-lg-8" style='padding-bottom: 20px;'>
								<h2 style="margin-top: 0px;">Property Information:</h2>
								<div style="max-height: 380px !important; overflow: scroll;">
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

												//Show bookings and ratings on property
												$queryPropertyHistory = "SELECT Booking.Booking_ID, Booking_Start, Booking_Status, Rating
																		 FROM Booking LEFT JOIN Comment 
																		 ON Booking.Booking_ID = Comment.Booking_ID
																		 WHERE Property_ID = '$rowProperty[Property_ID]'";
												$queryPropertyHistory = mysqli_query($con, $queryPropertyHistory);

												echo "<tbody style='color: white;'>";
												echo "<tr><td>".$rowProperty['Property_ID']."</td>";

												echo "<td><a class='intable' data-placement='right' data-toggle='popover' title='Property Details'>";
												echo $rowProperty['Street_No'].' '.$rowProperty['Street_Name']."</a>";
												echo "<div id='popover-content' class='hide'><p style='color: #3498db' overflow-y: scroll>";

												//Fill popover-content
												//Fill owner name
												echo "<b>Owner: </b>".$rowOwnerInfo['F_Name'].' '.$rowOwnerInfo['L_Name']."<br>";

												//Fill average rating
												if ($averageRating['Average'] == NULL)
													echo "<b>Average Rating:</b>".' '.'No ratings yet!'."<br>";
												else {
													echo "<b>Average Rating:</b>".' '.round($averageRating['Average'], 2)."<br>";
												}//End if state filling average rating

												//Fill booking history per property
												echo "<b>Booking History: </b><ol>";
												//Check if there is any booking history to report
												if (mysqli_num_rows($queryPropertyHistory) == 0)
													echo "This property has yet to be booked.";

												//Report booking history
												while ($rowPropertyHistory = mysqli_fetch_array($queryPropertyHistory)){
													echo "<li><i>Booking ID: </i>".' '.$rowPropertyHistory['Booking_ID']."</li>";
													echo "<ul style ='list-style-type:disc' ><li><i>Booking Start: </i>".' '.preg_replace('/^(.*?)\ 00:00:00/','$1',$rowPropertyHistory['Booking_Start'])."</li>";
													echo "<li><i>Booking Status: </i>".' '.$rowPropertyHistory['Booking_Status']."</li>";
													if ($rowPropertyHistory['Rating'] == NULL)
														echo "<li><i>Rating:<i> No rating given.</li>";
													else{
														echo "<li><i>Rating: </i>".' '.$rowPropertyHistory['Rating']."</li>";
													}
													echo "</ul><br>";
												}//End loop filling property history
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
										?> <!--End php needed to fill property table -->
									</table> <!-- End property table -->
								</div><!-- scroll -->
							</div><!-- col-lg-3 -->
						</div><!-- row -->
						<!-- Footer -->
					</div>
				</div>
			</div>
		</div>
		<div style='max-height: 25px;'>
				<hr>
			<div class="container">
				<p class="centered">Created by BH &amp; Associates</p>
			</div>
		</div> <!--End footer -->
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
