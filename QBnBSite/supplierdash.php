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
			if(isset($_POST['Delete_Property'])) {
				include_once 'config/connection.php';
				$queryDeleteProperty = "DELETE FROM Property
										WHERE Property_ID = $_POST[Property_ID]";
				$queryDeleteProperty = mysqli_query($con,$queryDeleteProperty);
			}
		?>
		<?php
	    	if(isset($_POST['Post_Reply'])) {
				include_once 'config/connection.php';
		    	$queryPostReview = "UPDATE Comment
								    SET Owner_Reply = '$_POST[Owner_Reply]'
									WHERE Booking_ID = '$_POST[Booking_ID]'";
				$queryPostReview = mysqli_query($con,$queryPostReview);
			}
		?>
		<?php
	    	if(isset($_POST['Approve_Booking'])) {
				include_once 'config/connection.php';
		    	$queryApprove = "UPDATE Booking
								 SET Booking_Status = 'Approved'
							     WHERE Booking_ID = $_POST[Booking_ID]";
				$queryApprove = mysqli_query($con,$queryApprove);
			}
		?>
		<?php
	    	if(isset($_POST['Reject_Booking'])) {
				include_once 'config/connection.php';
		    	$queryReject = "UPDATE Booking
								SET Booking_Status = 'Rejected'
								WHERE Booking_ID = $_POST[Booking_ID]";
				$queryReject = mysqli_query($con,$queryReject);
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
		         	<a class="navbar-brand" href="supplierdash.php"><b>QBnB</b></a>
		        </div>
		        <div class="navbar-collapse collapse">
	         		<ul class="nav navbar-nav navbar-right">
	         			<li>
	         				<p style="padding-top: 11px; padding-bottom: 15px; color:white;">Welcome <?php echo $myrow['F_Name'];?></p>
	         			</li>
	         			<li>
	         				<a href='userdash.php'>View &amp; Create Bookings</a>
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
						<h2>My listings:
						<button onclick='makeProp();' type='button' class='pull-right btn btn-sm btn-warning'><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Create New Listing</button>
						</h2>
			            <?php
			            	include_once 'config/connection.php';
			            	$queryAllMyPropertiesInfo = "SELECT Street_No, Street_Name, City, Price, Property_ID
			            							     FROM Property
			            							     WHERE Property.Owner_ID = '$_SESSION[Member_ID]'";
							$queryAllMyPropertiesInfo = mysqli_query($con,$queryAllMyPropertiesInfo);
			            	echo "<div style='max-height: 300px !important; overflow: scroll;'>";
			            	echo "<table class='table table-bordered table-hover'>";
			            	echo "<thead style='background-color: #dddddd'>";
			            	echo "<th>Address</th><th>City</th><th>Price</th><th colspan='2'>Settings</th></thead>";
			            	if (mysqli_num_rows($queryAllMyPropertiesInfo) > 0) {
				            	while ($rowProp = mysqli_fetch_array($queryAllMyPropertiesInfo)) {
				                	echo "<tbody style='color: white;'>";
				                	echo "<tr>";
				                	echo "<td>".$rowProp['Street_No'].' '.$rowProp['Street_Name']."</td>";
				                	echo "<td>".$rowProp['City']."</td>";
				                	echo "<td>".'$'.$rowProp['Price'].'/Week'."</td>";
				                	echo "<td align='center'><form name='Update_Property' id='Update_Property' action='updateproperty.php' method='POST'>";
				                	echo "<input type='hidden' id='Property_ID' name='Property_ID' value='".$rowProp['Property_ID']."'>";
				                	echo "<button style='background: transparent; border: none; padding: 0;' type=submit name='Delete_Property'>";
				                	echo "<span class='glyphicon glyphicon-edit intable' aria-hidden='true'></span></form></td>";
				                	echo "<td align='center'><form name='Delete_Property' id='Delete_Property' action='supplierdash.php' method='POST'>";
				                	echo "<input type='hidden' id='Property_ID' name='Property_ID' value='".$rowProp['Property_ID']."'>";
				                	echo "<button style='background: transparent; border: none; padding: 0;' type=submit name='Delete_Property'>";
				                	echo "<span class='glyphicon glyphicon-remove' aria-hidden='true' style='color: red;'></span></form></td>";
				                	echo "</tr>";
				          		}
				          	} else {
				          		echo "<tbody style='color: white;'>";
				                echo "<tr><td colspan='5' align='center'>You don't own any properties! Why not list one?</td></tr>";
				          	}
				            echo "</tbody></table></div>";
				        ?>
				        <h2>View comments:</h2>
				        <?php
			            	include_once 'config/connection.php';
			            	$queryMyCommentsInfo = "SELECT Street_No, Street_Name, Comment_Text, Rating, Owner_Reply, Booking_ID
													FROM `Property` JOIN (`Comment` NATURAL JOIN `Booking`)
			            							WHERE Property.Owner_ID = '$_SESSION[Member_ID]' AND Property.Property_ID = Booking.Property_ID";
							$queryMyCommentsInfo = mysqli_query($con,$queryMyCommentsInfo);
							echo "<div style='max-height: 300px !important; overflow: scroll;'>";
			            	echo "<table class='table table-bordered table-hover'>";
			            	echo "<thead style='background-color: #dddddd'>";
			            	echo "<th>Address</th><th>Comment</th><th>Rating</th><th>Your Reply</th></thead>";
			            	if (mysqli_num_rows($queryMyCommentsInfo) > 0) {
				            	while ($rowComm = mysqli_fetch_array($queryMyCommentsInfo)) {
				                	echo "<tbody style='color: white;'><tr>";
				                	echo "<td>".$rowComm['Street_No'].' '.$rowComm['Street_Name']."</td>";
				                	echo "<td>".$rowComm['Comment_Text']."</td>";
				                	echo "<td>".$rowComm['Rating']."/5</td>";
				                	if (is_null($rowComm['Owner_Reply'])) {
				                		echo "<td align='center'><a style='color:white' data-placement='right' data-toggle='popover' title='Write your reply'>";
						               	echo "<span class='glyphicon glyphicon-edit intable' aria-hidden='true'></span></a>";
						               	echo "<div id='popover-content' class='hide'>";
					                	echo "<form name='comment' id='comment' action='supplierdash.php' method='POST'>";
										echo "<textarea rows='4' cols='20' name='Owner_Reply' id='Owner_Reply' placeholder='Enter your reply...'></textarea>";
										echo "<input type='hidden' id='Booking_ID' name='Booking_ID' value='".$rowComm['Booking_ID']."'>";
					            		echo "<button style='width: 100%' type='submit' id='Post_Reply' name='Post_Reply' class='btn btn-primary'>Post Reply</button></form>";
					            		echo "</div></td>";
				                	} else {
				                		echo "<td>".$rowComm['Owner_Reply']."</td>";
				                	}
				                	echo "</tr>";
				          		}
				          	} else {
				          		echo "<tbody style='color: white;'>";
				                echo "<tr><td colspan='4' align='center'>There are no comments on your properties!</td></tr>";
				          	}
				            echo "</tbody></table></div>";
						?>
			        </div>
			        <div class='col-lg-6'>
						<h2>Listed bookings:</h2>
						<?php
			            	include_once 'config/connection.php';
			            	$queryAllMyBookingInfo = "SELECT F_Name, L_Name, Booking_Start, Booking_Status, Street_No, Street_Name, Booking_ID
													  FROM (Booking NATURAL JOIN Member) NATURAL JOIN Property
													  WHERE Property.Owner_ID = $_SESSION[Member_ID]";
							$queryAllMyBookingInfo = mysqli_query($con,$queryAllMyBookingInfo);
			            	echo "<div style='max-height: 300px !important; overflow: scroll;'>";
			            	echo "<table class='table table-bordered table-hover'>";
			            	echo "<thead style='background-color: #dddddd'>";
			            	echo "<th>Address</th><th>User</th><th>Booking Start</th><th colspan='2'>Status</th></thead>";
			            	if (mysqli_num_rows($queryAllMyBookingInfo) > 0) {
				            	while ($rowInfo = mysqli_fetch_array($queryAllMyBookingInfo)) {
				                	echo "<tbody style='color: white;'>";
				                	echo "<tr>";
				                	echo "<td>".$rowInfo['Street_No'].' '.$rowInfo['Street_Name']."</td>";
				                	echo "<td>".$rowInfo['F_Name'].' '.$rowInfo['L_Name']."</td>";
				                	echo "<td>".preg_replace('/^(.*?)\ 00:00:00/','$1',$rowInfo['Booking_Start'])."</td>";
				                	if ($rowInfo['Booking_Status'] == 'Approved' || $rowInfo['Booking_Status'] == 'Rejected') {
				                		echo "<td colspan='2'>".$rowInfo['Booking_Status']."</td>";
				                	} else {
					                	echo "<td align='center'>";
					                	echo "<form name='Approve_Booking' id='Approve_Booking' action='supplierdash.php' method='POST'>";
					                	echo "<input type='hidden' id='Booking_ID' name='Booking_ID' value='".$rowInfo['Booking_ID']."'>";
					                	echo "<button style='background: transparent; border: none; padding: 0;' type='submit' name='Approve_Booking'>";
					                	echo "<span class='glyphicon glyphicon-ok' aria-hidden='true' style='color: green;'>";
					                	echo "</span></form></td>";

					                	echo "<td align='center'>";
					                	echo "<form name='Reject_Booking' id='Reject_Booking' action='supplierdash.php' method='POST'>";
					                	echo "<input type='hidden' id='Booking_ID' name='Booking_ID' value='".$rowInfo['Booking_ID']."'>";
					                	echo "<button style='background: transparent; border: none; padding: 0;' type='submit' name='Reject_Booking'>";
					                	echo "<span class='glyphicon glyphicon-remove' aria-hidden='true' style='color: red;'>";
					                	echo "</span></form></td>";
					                }
				                	echo "</tr>";
				          		}
				          	} else {
				          		echo "<tbody style='color: white;'>";
				                echo "<tr><td colspan='5' align='center'>You don't own any properties! Why not list one?</td></tr>";
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
	    <script>
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
			function makeProp() {
				location.href='createproperty.php';
				return true;
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
