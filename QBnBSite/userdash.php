<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="ZB&amp;VH">

    <link rel="shortcut icon" href="img/favicon.png">

    <title>QBnB - Dashboard</title>

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
	if(isset($_SESSION['Member_ID'])){
	   // include database connection
	   include_once 'config/connection.php'; 
		
		// SELECT query
        $query = "SELECT Member_ID,F_Name,L_Name,Email,Password FROM Member WHERE Member_ID=?";
 
        // prepare query for execution
        $stmt = $con->prepare($query);
		
        // bind the parameters. This is the best way to prevent SQL injection hacks.
        $stmt->bind_Param("s", $_SESSION['Member_ID']);

        // Execute the query
		$stmt->execute();
 
		// results 
		$result = $stmt->get_result();
		
		// Row data
		$myrow = $result->fetch_assoc();
		
	} else {
		//User is not logged in. Redirect the browser to the login index.php page and kill this page.
		header("Location: index.php");
		die();
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

            		<li><a href="login.php?logout=1">Log Out</a></li>

         		</ul>

        	</div>
        	<!--/.nav-collapse -->

	    </div>

    </div>

	<div id="headerwrap">

		<div class="container">

			<div class="row">

				<h1>Welcome <?php echo $myrow['F_Name'];?>!</h1>
				
			</div>
			<!-- /row -->

		</div>
		<!-- /container -->

	</div>
	<!-- /headerwrap -->
	
		<hr>

	</div>
	<!-- /container -->
	
	<div class="container">

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
