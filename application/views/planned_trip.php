<?php 
//$trip_info variable will be available passed through the view
// var_dump($trip_info);
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="author" content="Jonathan Ben-Ammi">
 	<title></title>
 	<meta name="description" content="">
 	<link rel="stylesheet" type="text/css" href="">

 </head>
 <body>
 	 <div class="container">
		 <div class="links">
			 <ul>
			 	<li><a href="/view_dashboard">Home</a></li>	 
			 	<li><a href="/logout">Logout</a></li>
			 </ul>
		 </div>
		 <?php for ($array_row = 0; $array_row < count($trip_info); $array_row ++) {
		 	if ($trip_info[$array_row]['user_id'] == $trip_info[$array_row]['trip_creator_id']) { ?>
	 		<h3><?= $trip_info[$array_row]['destination']; ?></h3>
			<p>Planned By: <?= $trip_info[$array_row]['name']; ?></p>
			<p>Description: <?= $trip_info[$array_row]['description']; ?></p>
			<p>Travel Date From: <?= $trip_info[$array_row]['traveldate_start']; ?></p>
			<p>Travel Date To: <?= $trip_info[$array_row]['traveldate_end']; ?></p>
		<?php	 }
		} ?>
		 	<h4>Other users' joining the trip:</h4>
		 <?php for ($array_row = 0; $array_row < count($trip_info); $array_row ++) {
		 	if ($trip_info[$array_row]['user_id'] != $trip_info[$array_row]['trip_creator_id']) { ?>		 	
		 	<p><?= $trip_info[$array_row]['name']; ?></p>
		 <?php	}
		 } ?>
	</div>	 	
 </body>
 </html>