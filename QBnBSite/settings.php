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
		if(isset($_SESSION['Member_ID'])){
		   include_once 'config/connection.php'; 
	        $query = "SELECT Member_ID,F_Name,L_Name,Email,Phone_No,Grad_Year,Degree_Type,Faculty,Password FROM Member WHERE Member_ID=?";
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
			if(isset($_POST['Delete_Account'])) {
				include_once 'config/connection.php';
				$queryDeleteAccount = "DELETE FROM Member
										WHERE Member_ID = $_SESSION[Member_ID]";
				$queryDeleteAccount = mysqli_query($con,$queryDeleteAccount);
				session_unset();
				session_destroy();
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
						<h1 style="text-align: center">Update your account.</h1>
					</div>
					<div class="col-lg-6 col-lg-offset-3">
						<form name='settings' id='settings' action='settings.php' method='POST'>
							<div class="row" style="padding-bottom: 15px;">
								<div class="form-group">
									<div class="col-md-6">
							    		<input style="width: 100%;" type="text" class="form-control" name="FirstName" id="FirstName" placeholder="First Name" <?php echo "value='$myrow[F_Name]'";?>>
							    	</div>
							    	<div class="col-md-6">
							    		<input style="width: 100%;" type="text" class="form-control" name="LastName" id="LastName" placeholder="Last Name" <?php echo "value='$myrow[L_Name]'";?>>
							    	</div>
								</div>
							</div>
						 	<div class="form-group">
						    	<input style="width: 100%;" type="email" class="form-control" name="Email" id="Email" placeholder="Email Address" <?php echo "value='$myrow[Email]'";?>>
						  	</div>
							<div class="form-group">
						    	<input style="width: 100%;" type="text" class="form-control" name="Phone" id="Phone" placeholder="Phone #" <?php echo "value='$myrow[Phone_No]'";?>>
						 	</div>
							<div class="row" style="padding-bottom: 15px;">
								<div class="form-group">
									<div class="col-md-3">
						    			<select style="width: 100%;" type="text" class="form-control" name="Degree" id="Degree" value=<?php echo $myrow['Degree_Type'];?>>
							    			<option value=<?php echo $myrow['Degree_Type'];?> selected><?php echo $myrow['Degree_Type'];?></option>
										    <option>BA</option>
										    <option>BSc</option>
										    <option>BComm</option>
										    <option>BComp</option>
										    <option>BEd</option>
											<option>BEng</option>
											<option>MA</option>
											<option>MEd</option>										
											<option>MSc</option>
											<option>MBA</option>
											<option>JD</option>
											<option>MD</option>
											<option>PhD</option>
										</select>
							    	</div>
							    	<div class="col-md-6">
							    		<select style="width: 100%;" type="text" class="form-control" name="Faculty" id="Faculty" value=<?php echo $myrow['Faculty'];?>>
							    			<option value=<?php echo $myrow['Faculty'];?> selected><?php echo $myrow['Faculty'];?></option>
							    			<option>Anatomical Sciences</option>
							    			<option>Applied Economics</option>
							    			<option>Art History</option>
							    			<option>Astronomy and Astrophysics</option>
							    			<option>Biochemistry</option>
							    			<option>Biology</option>
							    			<option>Biomedical and Molecular Sciences</option>
							    			<option>Business Administration</option>
							    			<option>Business / Management</option>
							    			<option>Chemical Engineering</option>
							    			<option>Chemistry</option>
							    			<option>Civil Engineering</option>
							    			<option>Classics</option>
							    			<option>Commerce</option>
							    			<option>Computer Engineering</option>
							    			<option>Computing</option>
							    			<option>Drama</option>
							    			<option>Economics</option>
							    			<option>Education</option>
							    			<option>Electrical Engineering</option>
							    			<option>Engineering Chemistry</option>
							    			<option>Engineering Physics</option>
							    			<option>English Language and Literature</option>
							    			<option>Environmental Sciences</option>
							    			<option>Film and Media</option>
							    			<option>Fine Art</option>
							    			<option>French Studies</option>
							    			<option>Gender Studies</option>
							    			<option>Geography</option>
							    			<option>Geological Engineering</option>
							    			<option>Geological Sciences</option>
							    			<option>German</option>
							    			<option>Global Development Studies</option>
							    			<option>Health Sciences</option>
							    			<option>Health Studies</option>
							    			<option>History</option>
							    			<option>Humanities</option>
							    			<option>Indigenous Studies</option>
							    			<option>International Business</option>
							    			<option>International Studies</option>
							    			<option>Jewish Studies</option>
							    			<option>Kinesiology</option>
							    			<option>Law</option>
							    			<option>Linguistics</option>
							    			<option>Languages</option>
							    			<option>Life Sciences</option>
							    			<option>MBA</option>
							    			<option>Management</option>
							    			<option>Mathematics and Engineering</option>
							    			<option>Mathematics and Statistics</option>
							    			<option>Mechanical and Material Engineering</option>
							    			<option>Medicine</option>
							    			<option>Mining Engineering</option>
							    			<option>Music</option>
							    			<option>Neuroscience Studies</option>
							    			<option>Nursing</option>
							    			<option>Occupational Therapy</option>
							    			<option>Pathology and Molecular Medicine</option>
							    			<option>Philosophy</option>
							    			<option>Physical Medicine and Rehabilitation</option>
							    			<option>Physical Therapy</option>
							    			<option>Physical Health and Education</option>
							    			<option>Physics</option>
							    			<option>Political Studies</option>
							    			<option>Psychiatry</option>
							    			<option>Psycology</option>
							    			<option>Public Administration</option>
							    			<option>Public Health</option>
							    			<option>Religious Studies</option>
							    			<option>Statistics</option>
							    			<option>Urban and Regional Planning</option>
							    			<option>World Language Studies</option>
							    		</select>
							    	</div>
							    	<div class="col-md-3">
							    		<select style="width: 100%;" type="text" class="form-control" name="Year" id="Year" value=<?php echo $myrow['Grad_Year'];?>>
							    			<option value=<?php echo $myrow['Grad_Year'];?> selected><?php echo $myrow['Grad_Year'];?></option>
										    <option>2015</option>
										    <option>2014</option>
										    <option>2013</option>
										    <option>2012</option>
										    <option>2011</option>
											<option>2010</option>
											<option>2009</option>
											<option>2008</option>
											<option>2007</option>
											<option>2006</option>
											<option>2005</option>
											<option>2004</option>
											<option>2003</option>
											<option>2002</option>
											<option>2001</option>
											<option>2000</option>
											<option>1999</option>
											<option>1998</option>
											<option>1997</option>
											<option>1996</option>
											<option>1995</option>
											<option>1994</option>
											<option>1993</option>
											<option>1992</option>
											<option>1991</option>
											<option>1990</option>
											<option>1989</option>
											<option>1988</option>
											<option>1987</option>
											<option>1986</option>
											<option>1985</option>
											<option>1984</option>
											<option>1983</option>
											<option>1982</option>
											<option>1981</option>
											<option>1980</option>
											<option>1979</option>
											<option>1978</option>
											<option>1977</option>
											<option>1976</option>
											<option>1975</option>
											<option>1974</option>
											<option>1973</option>
											<option>1972</option>
											<option>1971</option>
											<option>1970</option>
											<option>1969</option>
											<option>1968</option>
											<option>1967</option>
											<option>1966</option>
											<option>1965</option>
											<option>1964</option>
											<option>1963</option>
											<option>1962</option>
											<option>1961</option>
											<option>1960</option>
											<option>1959</option>
											<option>1958</option>
											<option>1957</option>
											<option>1956</option>
							    		</select>
							    	</div>
								</div>
							</div>
						 	<div class="form-group">
						    	<input style="width: 100%;" type="password" class="form-control" name="Password" id="Password" placeholder="Update Password" <?php echo "value='$myrow[Password]'";?>>
						 	</div>
						 	<div style="text-align: center">
								<button type="submit" name='settings' class="btn btn-default">Update</button>
							</div>
						</form>
						<?php 
						if(isset($_POST['settings'])) {
							include_once 'config/connection.php'; 
					        $query = "SELECT Email, Member_ID FROM Member WHERE Email=? AND Member_ID != '$_SESSION[Member_ID]'";
					        if($stmt = $con->prepare($query)) {
						        $stmt->bind_Param("s", $_POST['Email']); 		         
								$stmt->execute();
								$result = $stmt->get_result();
								$num = $result->num_rows;
								if($num===0) {
						        	$query = "UPDATE Member 
						        			  SET F_Name = '$_POST[FirstName]', L_Name = '$_POST[LastName]', Email = '$_POST[Email]', Phone_No = '$_POST[Phone]', Grad_Year = '$_POST[Year]', Faculty = '$_POST[Faculty]', Degree_Type = '$_POST[Degree]', Password = '$_POST[Password]'
						        			  WHERE Member_ID = '$_SESSION[Member_ID]'";
						        	$query = mysqli_query($con,$query);
					        		echo "<script>window.location='settings.php'</script>";
								} else {
									echo "<br><div align='center'><span class='label label-danger'>Email already in use</span></div>";
								}
							}
						}
						?>
					</div>
				</div>
				<br>
				<form align='center' name='Delete_Account' id='Delete_Account' action='settings.php' method='POST'>
					<button type="submit" name='Delete_Account' class="btn btn-danger btn-sm">Delete Account</button>
				</form>
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
