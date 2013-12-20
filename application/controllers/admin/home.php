<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{
	
	public function __construct(){
		parent::__construct();		
	}
	
	public function index(){		
		$this->load->view('admin/html_header');
		$this->load->view('admin/home_view');
		$this->load->view('admin/html_footer');
	}
	
}
/* Location: ./application/controllers/admin/home.php */