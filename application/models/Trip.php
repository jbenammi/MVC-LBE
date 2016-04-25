<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trip extends CI_Controller{

	public function add_user($user_info){
		$query = "INSERT INTO users(name, username, email, password, created_on, updated_on) VALUES(?, ?, ?, ?, now(), now())";
		$user = [$user_info['name'], $user_info['username'], $user_info['email'], $user_info['password']];
		$query2 = "SELECT username, id, name FROM users WHERE username = ?;";
		$user2 = [$user_info['username']]; 
		if($this->db->query($query2, $user2)->row_array() == null){
			$this->db->query($query, $user);
			return $this->db->query($query2, $user2)->row_array();
		}
		else {
			return FALSE;
		}
	}

	public function signin($user_info){
		$query = "SELECT id, name, username FROM users WHERE username = ? AND password = ?";
		$user = [$user_info['username2'], $user_info['password2']];
		return $this->db->query($query, $user)->row_array();
	}

	public function get_user_trips(){
		$query = "SELECT user_trips.joined_on, user_trips.trips_id AS u_t_id, users.name, users.id AS user_id, trips.trip_creator_id, trips.id as trip_id, trips.destination, trips.description, trips.traveldate_start, trips.traveldate_end FROM trips JOIN user_trips ON user_trips.trips_id = trips.id JOIN users ON user_trips.users_id = users.id";
		return $this->db->query($query)->result_array();
	}

	public function get_trips_not_joined ($id){
	$query = "SELECT * FROM trips left join users on users.id = trip_creator_id where not trips.id in (SELECT trips.id FROM trips left JOIN user_trips ON user_trips.trips_id = trips.id left JOIN users ON user_trips.users_id = users.id where users.id = $id)";

		return $this->db->query($query)->result_array();
}
	public function get_trip_info($id){
		$query = "SELECT users.id AS user_id, users.name, trips.trip_creator_id, trips.id AS trip_id, trips.destination, trips.description, trips.traveldate_start, trips.traveldate_end FROM users JOIN user_trips ON user_trips.users_id = users.id JOIN trips ON user_trips.trips_id = trips.id WHERE trips.id = $id";
		return $this->db->query($query)->result_array();
	}
	public function join_trip($user_id, $trip_id){
		$query = "INSERT INTO user_trips(trips_id, users_id, joined_on) VALUES($trip_id, $user_id, now())";
		$this->db->query($query);
	}

	public function add_new_trip($info){
		$query = "INSERT INTO trips(trip_creator_id, destination, description, traveldate_start, traveldate_end, created_on, updated_on) VALUES(?, ?, ?, ?, ?, now(),now())";
		$trip_info = [$info['creator_id'], $info['destination'], $info['description'], $info['date_from'], $info['date_to']];
		$this->db->query($query, $trip_info);
		$query2 = "SELECT trips.id FROM trips ORDER BY created_on DESC limit 1";
		$id = $this->db->query($query2)->row_array();
		$query3 = "INSERT INTO user_trips(trips_id, users_id, joined_on) VALUES(?, ?, now());";
		$values = [$id['id'], $info['creator_id']];
		$this->db->query($query3, $values);

	}



}	
 ?>