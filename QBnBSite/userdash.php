<!DOCTYPE html>

<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="author" content="ZB&amp;VH">
	    <link rel="shortcut icon" href="img/favicon.png">
	    <title>QBnB - Dashboard</title>
	    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
		<?php
	    	if(isset($_POST['Booking_Start'])) {
				include_once 'config/connection.php';
		    	$queryMakeBooking = "INSERT INTO Booking (Property_ID,Member_ID,Owner_ID,Booking_Start,Booking_Status) 
						  			 VALUES ('$_POST[Property_ID]','$_SESSION[Member_ID]','$_POST[Owner_ID]','$_POST[Booking_Start]','Pending')";
				mysqli_query($con,$queryMakeBooking);
				header("Location: userdash.php");
			}
		?>
		<?php
	    	if(isset($_POST['Post_Review'])) {
				include_once 'config/connection.php';
				if($_POST['Rating']) {
			    	$queryPostReview = "INSERT INTO Comment (Booking_ID,Member_ID,Rating,Comment_Text) 
							  			VALUES ('$_POST[Booking_ID]','$_SESSION[Member_ID]','$_POST[Rating]','$_POST[Comment_Text]')";
					mysqli_query($con,$queryPostReview);
				} else {
					$queryPostReview = "INSERT INTO Comment (Booking_ID,Member_ID,Comment_Text) 
							  			VALUES ('$_POST[Booking_ID]','$_SESSION[Member_ID]','$_POST[Comment_Text]')";
					mysqli_query($con,$queryPostReview);
				}
			}
		?>
		<?php
			if(isset($_POST['Cancel_Booking'])) {
				include_once 'config/connection.php';
				$queryCancelBooking = "DELETE FROM Booking
									   WHERE Booking_ID = '$_POST[Booking_ID]'";
				echo var_dump($queryCancelBooking);
				$queryCancelBooking = mysqli_query($con,$queryCancelBooking);
				echo var_dump($queryCancelBooking);
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
	         			<li>
	         				<p style="padding-top: 11px; padding-bottom: 15px; color:white;">Welcome <?php echo $myrow['F_Name'];?></p>
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
								<?php if ($myrow['Member_ID'] <= 5) echo "<li role='separator' class='divider'></li>
																		  <li><a href='admindash.php'>Admin Dashboard</a></li>";?>
							</ul>
						</li>
	         		</ul>
	        	</div>
		    </div>
	    </div>
		<div id="headerwrap" style="padding-top: 100px; min-height: 590px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<h2 style="color: #dddddd;">Available properties:</h2>
						<form name='filter' id='filter' action='userdash.php' method='POST'>
							<div class="row" style="padding-bottom: 10px;">
								<div class="form-group">
									<div class="col-md-6">
						    			<select style="width: 100%; height: 34px;" type="text" class="form-control" name="district" id="district">
										    <option value="" selected disabled>Any District</option>
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
							    	<div class="col-md-3">
							    		<select style="width: 100%; height: 34px;" type="text" class="form-control" name="priceselect" id="priceselect">
							    			<option value="" selected disabled>Price</option>
							    			<option <?php echo (isset($_POST['priceselect']) && $_POST['priceselect'] == "Equals")?' selected':'';?> >Equals</option>
							    			<option <?php echo (isset($_POST['priceselect']) && $_POST['priceselect'] == "Less Than")?' selected':'';?> >Less Than</option>
							    			<option <?php echo (isset($_POST['priceselect']) && $_POST['priceselect'] == "Greater Than")?' selected':'';?> >Greater Than</option>
							    		</select>
							    	</div>
							    	<div class="col-md-3">
							    		<input style="width: 100%; height: 34px;" type="text" class="form-control" name="price" id="price" placeholder="$CAD" <?php echo (isset($_POST['price']))?"value='$_POST[price]'":''?>>
							    	</div>
							    </div>
							</div>
							<div class="row" style="padding-bottom: 10px;">
								<div class="form-group">
									<div class="col-md-4">
						    			<select style="width: 100%; height: 34px;" type="text" class="form-control" name="type" id="type">
										    <option value="" selected disabled>Any Type</option>
										    <?php
							            	include_once 'config/connection.php';
							            	// Query for type list.
							            	$queryTypeNames = "SELECT DISTINCT Type
							            			  		   FROM Property";
							            	$queryTypeNames = mysqli_query($con, $queryTypeNames);
							            	while ($rowTName = mysqli_fetch_array($queryTypeNames)) {
							            		echo "<option";
							            		echo (isset($_POST['type']) && $_POST['type'] == $rowTName['Type'])?' selected':'';
							            		echo ">".$rowTName['Type']."</option>";
							            	}
							            	?>
										</select>
							    	</div>
							    	<div class="col-md-4">
						    			<select style="width: 100%; height: 34px;" type="text" class="form-control" name="feature" id="feature">
										    <option value="" selected disabled>Any Feature</option>
										    <?php
							            	include_once 'config/connection.php';
							            	// Query for feature list.
							            	$queryFeatureNames = "SELECT DISTINCT Feature_Name
							            			  			  FROM Feature
							            			  			  ORDER BY Feature_Name";
							            	$queryFeatureNames = mysqli_query($con, $queryFeatureNames);
							            	// Fill table with property info.
							            	while ($rowFName = mysqli_fetch_array($queryFeatureNames)) {
							            		echo "<option";
							            		echo (isset($_POST['feature']) && $_POST['feature'] == $rowFName['Feature_Name'])?' selected':'';
												echo ">".$rowFName['Feature_Name']."</option>";							            	}
							            	?>
										</select>
							    	</div>
							    	<div class="col-md-2">
										<button style="padding: 4px 10px; font-size: 18px; height: 34px;" type="submit" name='filter' class="btn btn-default">Search</button>
									</div>
									<div class="col-md-2">
										<button style="padding: 4px 10px; font-size: 18px; height: 34px;" type="reset" name='filter' onclick="return resetForm(this.form);" class="btn btn-default">Reset</button>
									</div>
							    </div>
							</div>
						</form>
			            <?php
			            	if(isset($_POST['filter'])) {	 
				            	include_once 'config/connection.php';
				            	// Query for property list.
				            	$queryAllPropertiesInfo = "SELECT DISTINCT Street_No, Street_Name, City, Postal_Code, Country, District_Name, Type, Price, Property_ID, Owner_ID
				            			  				   FROM Property NATURAL JOIN Feature
				            			  				   WHERE";
				            	if (isset($_POST['district'])) {
				            		$queryAllPropertiesInfo = $queryAllPropertiesInfo." District_Name = '$_POST[district]'";
				            	} else {
				            		$queryAllPropertiesInfo = $queryAllPropertiesInfo." District_Name IS NOT NULL";
				            	}
				            	if (isset($_POST['priceselect']) and isset($_POST['price'])) {
				            		if ($_POST['priceselect'] == "Equals") {
				            			$queryAllPropertiesInfo = $queryAllPropertiesInfo." AND Price = '$_POST[price]'";
				            		}					            		
				            		elseif ($_POST['priceselect'] == "Less Than") {
				            			$queryAllPropertiesInfo = $queryAllPropertiesInfo." AND Price < '$_POST[price]'";
				            		}					            		
				            		elseif ($_POST['priceselect'] == "Greater Than") {
				            		$queryAllPropertiesInfo = $queryAllPropertiesInfo." AND Price > '$_POST[price]'";
				            		}	
				            	} else {
				            		$queryAllPropertiesInfo = $queryAllPropertiesInfo." AND Price IS NOT NULL";
				            	}
				            	if (isset($_POST['type'])) {
				            		$queryAllPropertiesInfo = $queryAllPropertiesInfo." AND Type = '$_POST[type]'";
				            	} else {
				            		$queryAllPropertiesInfo = $queryAllPropertiesInfo." AND Type IS NOT NULL";
				            	}
				            	if (isset($_POST['feature'])) {
				            		$queryAllPropertiesInfo = $queryAllPropertiesInfo." AND Feature_NAME = '$_POST[feature]'";
				            	} else {
				            		$queryAllPropertiesInfo = $queryAllPropertiesInfo." AND Feature_NAME IS NOT NULL";
				            	}
				            } else {
				            	$queryAllPropertiesInfo = "SELECT DISTINCT Street_No, Street_Name, City, Postal_Code, Country, District_Name, Type, Price, Property_ID, Owner_ID
				            			  				   FROM Property NATURAL JOIN Feature ORDER BY City, District_Name";
				            }

							$queryAllPropertiesInfo = mysqli_query($con,$queryAllPropertiesInfo);
			            	// Fill table with property info.
			            	echo "<div style='max-height: 312px !important; overflow: scroll;'>";
			            	echo "<table class='table table-bordered table-hover'>";
			            	echo "<thead style='background-color: #dddddd'>";
			            	echo "<th>Address</th><th>District</th><th>City</th><th>Type</th><th>Price</th></thead>";
			            	if (mysqli_num_rows($queryAllPropertiesInfo) > 0) {
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
					            	// Owner info query.
					            	$queryDistrictPOI = "SELECT DISTINCT GROUP_CONCAT(POI_Name)
					            						 FROM POI
													     WHERE District_Name = '$rowProp[District_Name]'";
					            	$queryDistrictPOI = mysqli_query($con,$queryDistrictPOI);
					            	// Features query.
					            	$queryFeatures = "SELECT DISTINCT Feature_Name
					            					  FROM Feature
													  WHERE Property_ID = '$rowProp[Property_ID]'";
					            	$queryFeatures = mysqli_query($con,$queryFeatures);
					            	// Basic property info.
				                	echo "<tbody style='color: white;'>";
				                	echo "<tr data-toggle='collapse' data-target='.prop".$rowProp['Property_ID']."info'>";
				                	echo "<td>".$rowProp['Street_No'].' '.$rowProp['Street_Name']."</td>";
				                	echo "<td>".$rowProp['District_Name']."</td>";
				                	echo "<td>".$rowProp['City']."</td>";
				                	echo "<td>".$rowProp['Type']."</td>";
				                	echo "<td>".'$'.$rowProp['Price'].'/Week'."</td>";
				                	echo "</tr>";
				          			// Hidden FULL info.
				                	echo "<tr class='collapse prop".$rowProp['Property_ID']."info hiddenRow'>";
				                	echo "<td style='background-color: #dddddd' colspan='3'>";
				                	echo "<b>Owner:</b> ".$rowOwner['F_Name'].' '.$rowOwner['L_Name'].'<br><b>Email:</b> '.$rowOwner['Email'].'<br><b>Phone:</b> '.$rowOwner['Phone_No']."</td>";
				                	echo "<td style='background-color: #dddddd' colspan='2'><br>";
				                	echo "<button type='button' class='btn btn-lg btn-primary' data-toggle='popover' title='".$rowProp['Street_No'].' '.$rowProp['Street_Name']."'>";
				                	echo "<span class='glyphicon glyphicon-home' aria-hidden='true'></span> Book me!</button>";
				                	echo "<div id='popover-content' class='hide'>";
									$startTime = new DateTime();
				                	$endTime = new DateTime();
				                	for ($i = 1; $i < 5; $i++) { 
				                		echo "<form name='booking' id='booking' action='userdash.php' method='POST'>";
										$startTime->modify('Sunday this week');
										$endTime->modify('Saturday next week');
										$sqltime = $startTime->format('Y-m-d H:i:s');
					                	$queryAvailability = "SELECT Booking_ID
						            					  	  FROM Booking
														  	  WHERE Property_ID = '$rowProp[Property_ID]' AND Booking_Start = '".$sqltime."' AND ((Booking_Status  = 'Approved') OR (Booking_Status = 'Pending' AND Member_ID = '$_SESSION[Member_ID]'))";
						            	$queryAvailability = mysqli_query($con,$queryAvailability);
						            	if (mysqli_num_rows($queryAvailability) == 0) {
						            		echo "<input type='hidden' name='Property_ID' value='".$rowProp['Property_ID']."'>";
						            		echo "<input type='hidden' name='Owner_ID' value='".$rowProp['Owner_ID']."'>";
						            		echo "<button style='width: 100%' type='submit' name='Booking_Start' value='".$sqltime."' class='btn btn-primary'>";
						            	} else {
						            		echo "<button disabled style='width: 100%' type='submit' class='btn btn-danger'>";
						            	}		       
										echo $startTime->format( 'F jS, Y' )." - ".$endTime->format( 'F jS, Y' );
										echo "</button></form>";
									}	
									echo "</div></td></tr>";
				                	echo "<tr class='collapse prop".$rowProp['Property_ID']."info hiddenRow'>";
				                	echo "<td style='background-color: #dddddd' colspan='5'>";
				                	echo "<b>Address:</b> ".$rowProp['Street_No'].' '.$rowProp['Street_Name'].', '.$rowProp['Postal_Code'].', '.$rowProp['City'];
				                	echo "<br><b>District:</b> ".$rowProp['District_Name'];
				                	echo "<br><b>Nearby:</b> ";
				                	while ($rowPOI = mysqli_fetch_row($queryDistrictPOI)) {
										echo str_replace(",",", ",implode(',', $rowPOI));
									}
									echo "<br><b>Features:</b> ";
				                	$row = array();
				                	while($rowFeatures = mysqli_fetch_assoc($queryFeatures)) {
									   $row[] = implode('', $rowFeatures);
									}
									echo implode(", ", $row);
									echo "</td></tr>";
				                	echo "<tr class='collapse prop".$rowProp['Property_ID']."info hiddenRow'>";
				                	echo "<td style='background-color: #dddddd' colspan='5'>";
				                	if (mysqli_num_rows($queryPropertyRatings) > 0) {
				                		echo "<b>Comments:</b>";
										while ($rowRating = mysqli_fetch_array($queryPropertyRatings)) {
											echo "<br>".$rowRating['Comment_Text'];
											if (is_null($rowRating['Rating'])) {
												echo " No rating.";
											} else {
												echo " Rating: ".$rowRating['Rating']."/5";
											}
										}
									} else {
										echo "<b>No ratings yet!</b>";
									}
								}
							} else {
				          		echo "<tbody style='color: white;'>";
				                echo "<tr><td colspan='5' align='center'>No properties matched your search. Why not try again?</td></tr>";
				          	}
				            echo "</td></tr></tbody></table></div>";
				        ?>
			        </div>
					<div class='col-lg-6'>
						<h2 style="color: #dddddd;">Your bookings:</h2>
						<?php 
				            include_once 'config/connection.php';
				            $queryBookingsInfo = "SELECT DISTINCT Street_No, Street_Name, City, Postal_Code, Country, District_Name, Type, Price, Property_ID, Owner_ID, Booking_Start, Booking_Status, Booking_ID
				            			  			   FROM Property NATURAL JOIN Booking
				            			  			   WHERE Member_ID = '$_SESSION[Member_ID]'
				            			  			   ORDER BY Booking_Status, Booking_Start";
							$queryBookingsInfo = mysqli_query($con,$queryBookingsInfo);
				            // Fill table with property info.
			            	echo "<div style='max-height: 400px !important; overflow: scroll;'>";
			            	echo "<table class='table table-bordered'>";
			            	echo "<thead style='background-color: #dddddd'>";
			            	echo "<th>Address</th><th>Owner</th><th>Start Date</th><th>Review</th><th colspan='2'>Status</th></thead>";
			            	if (mysqli_num_rows($queryBookingsInfo) > 0) {
				            	while ($rowBooking = mysqli_fetch_array($queryBookingsInfo)) {
				            		// Owner info query.
					            	$queryPropertyForOwnerInfo = "SELECT DISTINCT F_Name, L_Name, Email, Phone_No 
					            								  FROM Member
																  WHERE Member_ID = '$rowBooking[Owner_ID]'";
					            	$queryPropertyForOwnerInfo = mysqli_query($con,$queryPropertyForOwnerInfo);
					            	$rowOwner = mysqli_fetch_assoc($queryPropertyForOwnerInfo);
					            	// Features query.
					            	$queryFeatures = "SELECT DISTINCT Feature_Name
					            					  FROM Feature
													  WHERE Property_ID = '$rowBooking[Property_ID]'";
					            	$queryFeatures = mysqli_query($con,$queryFeatures);
					            	// Comments query.
					            	$queryComments = "SELECT DISTINCT Comment_Text, Rating, Owner_Reply
					            					  FROM Comment
													  WHERE Booking_ID = '$rowBooking[Booking_ID]'";
					            	$queryComments = mysqli_query($con,$queryComments);
					            	// Basic property info.
				                	echo "<tbody style='color: white;'>";
				                	echo "<tr>";
				                	echo "<td><a style='color:white' data-placement='bottom' data-toggle='popover' title='Address Details'>";
					               	echo $rowBooking['Street_No'].' '.$rowBooking['Street_Name']."</a>";
					               	echo "<div id='popover-content' class='hide'><p style='color: #3498db'>";
					               	echo $rowBooking['Street_No'].' '.$rowBooking['Street_Name'].'<br>'.$rowBooking['Postal_Code'].', '.$rowBooking['City'].'<br><br>'.$rowBooking['Type'].' with: ';
				                	$row = array();
				                	while($rowFeatures = mysqli_fetch_assoc($queryFeatures)) {
									   $row[] = implode('', $rowFeatures);
									}
									echo implode(", ", $row);
					               	echo "</p></div></td>";
									echo "<td><a style='color:white' data-placement='bottom' data-toggle='popover' title='Owner Info'>";
					               	echo $rowOwner['F_Name'].' '.$rowOwner['L_Name']."</a>";
					               	echo "<div id='popover-content' class='hide'><p style='color: #3498db'>";
					               	echo "<b>Email: </b>".$rowOwner['Email'].'<br><b>Phone:</b> '.$rowOwner['Phone_No'];
					               	echo "</p></div></td>";
					               	echo "<td>".preg_replace('/^(.*?)\ 00:00:00/','$1',$rowBooking['Booking_Start'])."</td>";
					                if (mysqli_num_rows($queryComments) == 0) {
										echo "<td align='center'><a style='color:white' data-placement='bottom' data-toggle='popover' title='Make Review'>";
						               	echo "<span class='glyphicon glyphicon-edit' aria-hidden='true' style='color: white;'></span></a>";
						               	echo "<div id='popover-content' class='hide'>";
					                	echo "<form align='center' name='comment' id='comment' action='userdash.php' method='POST'>";
										echo "<textarea rows='4' cols='20' name='Comment_Text' id='Comment_Text' placeholder='Enter your comment...'></textarea>";
										echo "<span class='rating'>";
										echo "<input type='radio' class='rating-input' id='rating-input-1-5' name='Rating' value='5'/><label for='rating-input-1-5' class='rating-star'></label>";
										echo "<input type='radio' class='rating-input' id='rating-input-1-4' name='Rating' value='4'/><label for='rating-input-1-4' class='rating-star'></label>";
										echo "<input type='radio' class='rating-input' id='rating-input-1-3' name='Rating' value='3'/><label for='rating-input-1-3' class='rating-star'></label>";
										echo "<input type='radio' class='rating-input' id='rating-input-1-2' name='Rating' value='2'/><label for='rating-input-1-2' class='rating-star'></label>";
										echo "<input type='radio' class='rating-input' id='rating-input-1-1' name='Rating' value='1'/><label for='rating-input-1-1' class='rating-star'></label>";
										echo "</span>";
										echo "<input type='hidden' id='Booking_ID' name='Booking_ID' value='".$rowBooking['Booking_ID']."'>";
					            		echo "<button style='width: 100%' type='submit' id='Post_Review' name='Post_Review' class='btn btn-primary'>Post Review</button></form>";
					            		echo "</div></td>";
				                	} else {
				                		$review = mysqli_fetch_assoc($queryComments);
										echo "<td align='center'><a style='color:white' data-placement='bottom' data-toggle='popover' title='Your Review'>";
						               	echo "<span class='glyphicon glyphicon-comment' aria-hidden='true' style='color: white;'></span></a>";
						               	echo "<div id='popover-content' class='hide'><p style='color: #3498db'>";
						               	echo "<b>Comment: </b>".$review['Comment_Text']."<br>";
						               	if (is_null($review['Rating'])) {
											echo "<b>No rating.</b><br>";
										} else {
											echo "<b>Rating: </b>".$review['Rating']."/5<br>";
										}					               	
										if (is_null($review['Owner_Reply'])) {
											echo "<b>No Owner Reply.</b>";
										} else {
											echo "<b>Owner Reply: </b>".$review['Owner_Reply'];
										}
						               	echo "</p></div></td>";			                	
						            }
						            echo "<td>".$rowBooking['Booking_Status']."</td>";				                
						            echo "<td><form name='Cancel_Booking' id='Cancel_Booking' action='userdash.php' method='POST'>";
				                	echo "<input type='hidden' id='Booking_ID' name='Booking_ID' value='".$rowBooking['Booking_ID']."'>";
				                	echo "<button style='background: transparent; border: none; padding: 0;' type=submit name='Cancel_Booking'>";
						            echo "<span class='glyphicon glyphicon-remove' aria-hidden='true' style='color: red;'></span></form></td>";
				                	echo "</tr>";
				                }
			                } else {
				          		echo "<tbody style='color: white;'>";
				                echo "<tr><td colspan='5' align='center'>You don't have any bookings! Why not make one?</td></tr>";
				          	}
			                echo "</tbody></table></div>";
						?>
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
	    <script type="text/javascript">
			function resetForm(form) {
			    var inputs = form.getElementsByTagName('input');
			    for (var i = 0; i<inputs.length; i++) {
			        switch (inputs[i].type) {
			            case 'text':
			                inputs[i].value = '';
			                break;
			            case 'radio':
			            case 'checkbox':
			                inputs[i].checked = false;   
			        }
			    }
			    var selects = form.getElementsByTagName('select');
			    for (var i = 0; i<selects.length; i++)
			        selects[i].selectedIndex = 0;
			    var text= form.getElementsByTagName('textarea');
			    for (var i = 0; i<text.length; i++)
			        text[i].innerHTML= '';
			    return false;
			}
		</script>
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
