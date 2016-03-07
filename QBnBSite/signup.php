<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="">

    <meta name="author" content="">

    <link rel="shortcut icon" href="img/favicon.png">

    <title>QBnB - Sign Up</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">

    <!-- Fonts from Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
    
</head>

<body>

	<?php
	  //Create a user session or resume an existing one
	 session_start();
	?> 
	 
	<?php
	 //check if the user is already logged in and has an active session
	if(isset($_SESSION['Member_ID'])) {
		//Redirect the browser to the profile editing page and kill this page.
		header("Location: userdash.php");
		die();
	}
	?>
	 
	<?php 
	//check if the signup form has been submitted
	if(isset($_POST['sign_up'])) {
	 
	    // include database connection
	    include_once 'config/connection.php'; 
		
		// SELECT query
        $query = "SELECT Email FROM Member WHERE Email=?";
 
        // prepare query for execution
        if($stmt = $con->prepare($query)) {

	        // bind the parameters. This is the best way to prevent SQL injection hacks.
	        $stmt->bind_Param("s", $_POST['Email']); 
	         
	        // Execute the query
			$stmt->execute();
	 
			/* resultset */
			$result = $stmt->get_result();

			// Get the number of rows returned
			$num = $result->num_rows;

			//If the username/password does not match a user in our database
			if($num===0) {
				//Create entry in the Member table
	        	$query = "INSERT INTO Member (F_Name,L_Name,Email,Phone_No,Grad_Year,Faculty,Degree_Type,Password) 
	        	VALUES ('$_POST[FirstName]','$_POST[LastName]','$_POST[Email]','$_POST[Phone]','$_POST[Year]','$_POST[Faculty]','$_POST[Degree]','$_POST[Password]')";
				
		        // execute the query
        		mysqli_query($con,$query);

        		// Get ID so we can start session
        		$query = "SELECT Member_ID FROM Member WHERE Email = '$_POST[Email]'";

		        // execute the query and get row data.
        		$myrow = mysqli_query($con,$query)->fetch_assoc();

				//Create a session variable that holds the user's id
				$_SESSION['Member_ID'] = $myrow['Member_ID'];

				//Redirect the browser to the user dashboard and kill this page.
				header("Location: userdash.php");
				die();
			} else {
				//If the username/password doesn't match a user in our database
				// Display an error message and the login form
				echo "Email already in use";
			}
		} else {
			echo "failed to prepare the SQL";
		}
	}
	?>

    <!-- Fixed navbar -->
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

            		<li><a href="login.php">Already a member?</a></li>

         		</ul>

        	</div>
        	<!--/.nav-collapse -->

	    </div>

    </div>

	<div id="headerwrap" style="padding-top: 50px; min-height: 590px;">

		<div class="container">

			<div class="row">

				<div class="col-lg-6 col-lg-offset-3">

					<h1 style="text-align: center">Welcome aboard.</h1>

				</div>

				<div class="col-lg-6 col-lg-offset-3">

					<form name='signup' id='signup' action='signup.php' method='POST'>

						<div class="row" style="padding-bottom: 15px;">

							<div class="form-group">

								<div class="col-md-6">

						    		<input style="width: 100%;" type="text" class="form-control" name="FirstName" id="FirstName" placeholder="First Name">

						    	</div>

						    	<div class="col-md-6">

						    		<input style="width: 100%;" type="text" class="form-control" name="LastName" id="LastName" placeholder="Last Name">

						    	</div>
							 	
							</div>
						
						</div>

					 	<div class="form-group">

					    	<input style="width: 100%;" type="email" class="form-control" name="Email" id="Email" placeholder="Email Address">

					    	<script>

							    var captured = /email=([^&]+)/.exec(window.location.href)[1];
							    var result = captured ? captured : '';
							    result = result.replace('%40','@');
							    document.getElementById("Email").value = String(result);

							</script>
						  	
					  	</div>

						<div class="form-group">

					    	<input style="width: 100%;" type="text" class="form-control" name="Phone" id="Phone" placeholder="Phone #">
					 	
					 	</div>

						<div class="row" style="padding-bottom: 15px;">

							<div class="form-group">

								<div class="col-md-3">

						    		<select style="width: 100%;" type="text" class="form-control" name="Degree" id="Degree">
															    	
									    <option value="" selected disabled>Degree</option>

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

						    		<select style="width: 100%;" type="text" class="form-control" name="Faculty" id="Faculty">

						    			<option value="" selected disabled>Faculty / Department</option>

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

						    		<select style="width: 100%;" type="text" class="form-control" name="Year" id="Year">

						    			<option value="" selected disabled>Year</option>

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

					    	<input style="width: 100%;" type="password" class="form-control" name="Password" id="Password" placeholder="Create Password">
					 	
					 	</div>

					 	<div style="text-align: center">

							<button type="submit" name='sign_up' class="btn btn-default">Sign Up</button>

						</div>
					
					</form>

				</div>
				<!-- /col-lg-6 -->
				
			</div>
			<!-- /row -->

		</div>
		<!-- /container -->

	</div>
	<!-- /headerwrap -->
	
	<div class="container">

		<hr>

		<p class="centered">Created by BH &amp; Associates</p>

	</div>
	<!-- /container -->
	

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    <script src="js/bootstrap.min.js"></script>

  </body>

</html>
