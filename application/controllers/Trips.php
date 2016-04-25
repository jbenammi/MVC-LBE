<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trips extends CI_Controller{


		public function index () {
			$this->load->view('login_register');
		}
		public function error_login() {
			$this->load->view('login_register');
		}
		public function register(){
			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules("email", "E-Mail", "trim|required|valid_email");
			$this->form_validation->set_rules("confirmpass", "Confirm Password", "trim|required|matches[password]");
			$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]|do_hash");
			$this->form_validation->set_rules("name", "Full Name", "trim|required|min_length[3]|xss_clean");
			$this->form_validation->set_rules("username", "Username", "trim|required|min_length[3]|xss_clean");
		if($this->form_validation->run() === FALSE){
			$this->load->view('login_register');
		}
		else{
			$this->load->model("Trip");
			$user_info = $this->input->post();
			$add_user = $this->Trip->add_user($user_info);
			if ($add_user){
				$this->session->set_userdata(['logged_info' => $add_user]);
				redirect("/view_dashboard");
			}
			else{
				$this->session->set_flashdata("login_error", "E-Mail Address is already registered");
			redirect('/');
			}
		}
	}

		public function signin_process(){
			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules("username2", "Username", "trim|required|min_length[3]|xss_clean");
			$this->form_validation->set_rules("password2", "Password", "trim|required|min_length[8]|do_hash");
			var_dump($this->input->post());
			die();

		if($this->form_validation->run() == FALSE){
			$this->load->view('login_register');
		
		}
		else {
			$this->load->model('Trip');
			$user_info = $this->input->post();
			$user_signin = $this->Trip->signin($user_info);
			if($user_signin) {
				$this->session->set_userdata(['logged_info' => $user_signin]);
				redirect('/Trips/view_dashboard');
			}
			else {
				$this->session->set_flashdata("login_error", "The E-Mail or Password information is incorrect.");
			redirect('/');
			}
		}
	}

	public function view_dashboard(){
		$logged_info = $this->session->userdata('logged_info');
		$this->load->model('Trip');
		$user_trips = $this->Trip->get_user_trips();
		$trips_not_joined = $this->Trip->get_trips_not_joined();
		$this->load->view('user_dashboard', ['users_trips' => $user_trips, 'trips_not_joined' => $trips_not_joined]);
	}

	public function view_destination($trip_id){
		$this->load->model('Trip');
		$trip_info = $this->Trip->get_trip_info($trip_id);
		$this->load->view('planned_trip', ['trip_info' => $trip_info]);
	}
	public function join_trips($user_id, $trip_id){
		$this->load->model('Trip');
		$this->Trip->join_trip($user_id, $trip_id);
		redirect('/Trips/view_dashboard');
	}
	public function new_trip(){
		$this->load->view('add_trip');
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}

	public function compareDate_endDate() {
	  $startDate = strtotime($_POST['startDate']);
	  $endDate = strtotime($_POST['endDate']);

	  if ($endDate > $startDate)
	    return True;
	  else {
	    $this->form_validation->set_message('compareDate_endDate', '%s should be greater than trip start date.');
	    return False;
	  }
	}

	public function compareDate_startDate() {
	  $startDate = strtotime($_POST['startDate']);
	  $endDate = strtotime($_POST['endDate']);
	  $today = strtotime(date('Y-m-d'));
	  if ($startDate > $today)
	    return True;
	  else {
	    $this->form_validation->set_message('compareDate_startDate', '%s should be set for a date in the future.');
	    return False;
	  }
	}

	public function add_trips(){
		$this->load->library('form_validation');
		$this->load->helper('security');

		$validation = array(
		  array('field' => 'startDate', 'label' => 'Travel Date From', 'rules' => 'required|callback_compareDate_startDate'),
		  array('field' => 'endDate', 'label' => 'Travel End Date', 'rules' => 'required|callback_compareDate_endDate'),
		);
		$this->form_validation->set_rules($validation);
		$this->form_validation->set_message('required', '%s is required.');
		$this->form_validation->set_rules("destination", "Destination", "trim|required|xss_clean");
		$this->form_validation->set_rules("description", "Description", "trim|required|xss_clean");
		if($this->form_validation->run() === FALSE){
			$this->load->view('add_trip');
		}
		else {
			$this->load->model('Trip');
			$trip_info = $this->input->post();
			$this->Trip->add_new_trip($trip_info);
			redirect('/Trips/view_dashboard');
			}
	}		
}
 ?>