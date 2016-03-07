<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="">

    <meta name="author" content="">

    <link rel="shortcut icon" href="img/favicon.png">

    <title>QBnB - Log In</title>

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
	 //check if the user clicked the logout link and set the logout GET parameter
	if(isset($_GET['logout'])) {
		//Destroy the user's session.
		$_SESSION['Member_ID'] = null;
		session_destroy();
	}
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
	//check if the login form has been submitted
	if(isset($_POST['signin'])) {
	 
	    // include database connection
	    include_once 'config/connection.php'; 
		
		// SELECT query
        $query = "SELECT Member_ID,F_Name,L_Name,Email,Password FROM Member WHERE Email=? AND Password=?";
 
        // prepare query for execution
        if($stmt = $con->prepare($query)) {
			
	        // bind the parameters. This is the best way to prevent SQL injection hacks.
	        $stmt->bind_Param("ss", $_POST['Email'], $_POST['Password']);
	         
	        // Execute the query
			$stmt->execute();
	 
			/* resultset */
			$result = $stmt->get_result();

			// Get the number of rows returned
			$num = $result->num_rows;

			//If the username/password matches a user in our database		
			if($num>0){
				//Read the user details
				$myrow = $result->fetch_assoc();

				//Create a session variable that holds the user's id
				$_SESSION['Member_ID'] = $myrow['Member_ID'];

				//Redirect the browser to the user dashboard and kill this page.
				header("Location: userdash.php");
				die();
			} else {
				//If the username/password doesn't match a user in our database
				// Display an error message and the login form
				echo "Failed to login";
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

            		<li><a href="signup.php">Not a member?</a></li>

         		</ul>

        	</div>
        	<!--/.nav-collapse -->

      	</div>

    </div>

	<div id="headerwrap" style="padding-top: 100px; min-height: 590px;">

		<div class="container">

			<div class="row">

				<div class="col-lg-4 col-lg-offset-4">

					<h1 style="text-align:center">Welcome back.</h1>

					<form name='login' id='login' action='login.php' method='POST'>

					 	<div class="form-group">
					    					    
					    	<input style="width: 100%;" name="Email" type="email" class="form-control" id="Email" placeholder="youremail@address.ca">
					  	
					  	</div>

					 	<div class="form-group">

					    	<input style="width: 100%;" name="Password" type="password" class="form-control" id="Password" placeholder="Password">
					 	
					 	</div>

					 	<div style="text-align: center">

							<button type="submit" class="btn btn-default" name="signin">Sign In</button>

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
