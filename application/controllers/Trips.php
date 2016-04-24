<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trips extends CI_Controller{

		public function index () {
			$this->load->view('login_register');
		}
		public function error_redirect() {
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
			$errors = $this->form_validation->getErrorsArray();
			$this->session->set_flashdata("errors", $errors);
			redirect(base_url());
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
			redirect(base_url());
			}
		}
	}

		public function signin_process(){
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules("username", "Username", "trim|required|min_length[3]|xss_clean");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]|do_hash");

		if($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->getErrorsArray();
			$this->session->set_flashdata("errors2", $errors);
			redirect(base_url());
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
			redirect(base_url());
			}
		}
	}

	public function view_dashboard(){
		$logged_info = $this->session->userdata('logged_info');
		$this->load->model('Trip');
		$user_trips = $this->Trip->get_user_trips();
		$this->load->view('user_dashboard', ['users_trips' => $user_trips]);
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
		redirect('../');
	}

	public function add_trips(){
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules("destination", "Destination", "trim|required|xss_clean");
		$this->form_validation->set_rules("description", "Description", "trim|required|xss_clean");
		$this->form_validation->set_rules("date_from", "Travel Date From", "trim|required");
		$this->form_validation->set_rules("date_to", "Travel Date To", "trim|required");
		if($this->form_validation->run() === FALSE){
			$errors = $this->form_validation->getErrorsArray();
			$this->session->set_flashdata("errors", $errors);
			redirect(base_url("/new_trip"));
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