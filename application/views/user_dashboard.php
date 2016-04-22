<?php 
$logged_info = $this->session->userdata('logged_info');
// $users_trips and $others_trips will be available as passed variables.
// var_dump($logged_info);
// var_dump($users_trips);

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
			 	<li><a href="/logout">Logout</a></li>
			 </ul>
		 </div>
	 	<h2>Hello, <?= $logged_info['username']; ?> </h2>
	 	<h4>Your Trip Schedule</h4>
	 	<table>
	 		<thead>
	 			<th>Destination</th>
	 			<th>Travel Start Date</th>
	 			<th>Travel End Date</th>
	 			<th>Plan</th>
	 		</thead>
	 		<tbody>
	 			<?php for ($array_row = 0; $array_row < count($users_trips); $array_row ++){ 
	 				if ($users_trips[$array_row]['user_id'] == $logged_info['id']) { ?>
	 			<tr>
	 				<td><a href="/destination/<?= $users_trips[$array_row]['trip_id'];?>"><?= $users_trips[$array_row]['destination'];?></a></td>
	 				<td><?= $users_trips[$array_row]['traveldate_start'];?></td>
	 				<td><?= $users_trips[$array_row]['traveldate_end'];?></td>
	 				<td><?= $users_trips[$array_row]['description'];?></td>
	 			</tr>
	 		<?php	} 
	 		}  ?>
	 		</tbody>
	 	</table>
	 	<h4>Your Trip Schedule</h4>
	 	<table>
	 		<thead>
	 			<th>Name</th>
	 			<th>Destination</th>
	 			<th>Travel Start Date</th>
	 			<th>Travel End Date</th>
	 			<th>Do You Want to Join?</th>
	 		</thead>
	 		<tbody>
	 			<?php for ($array_row = 0; $array_row < count($users_trips); $array_row ++){ 
	 				if($users_trips[$array_row]['trip_creator_id'] != $logged_info['id'] AND $users_trips[$array_row]['u_t_id'] != $logged_info['id'] AND $users_trips[$array_row]['trip_creator_id'] == $users_trips[$array_row]['user_id']){ ?>
	 			<tr>
	 				<td><?= $users_trips[$array_row]['name'];?></td>
	 				<td><a href="/destination/<?= $users_trips[$array_row]['trip_id'];?>"><?= $users_trips[$array_row]['destination'];?></a></td>
	 				<td><?= $users_trips[$array_row]['traveldate_start'];?></td>
	 				<td><?= $users_trips[$array_row]['traveldate_end'];?></td>
	 				<td><a href="/join/<?= $logged_info['id'];?>/<?= $users_trips[$array_row]['trip_id']; ?>">Join</a></td>
	 			</tr>
	 		<?php	} 
	 		} ?>
	 		</tbody>
	 	</table>
	 	<p><a href="/new_trip">Add Travel Plan</a></p>
	</div>
 </body>
 </html>