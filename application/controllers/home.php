<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{
	
	public function __construct(){
		parent::__construct();		
	}
	
	public function index(){
		
		$this->load->view('html_header_view');
		$this->load->view('cabecalho_view');
		$this->load->view('home_view');
		$this->load->view('rodape_view');
		$this->load->view('html_footer_view');
		
	}
	public function selecione(){
		
		$this->load->view('html_header_view');
		$this->load->view('cabecalho_view');
		$this->load->view('home_view');
		$this->load->view('rodape_view');
		$this->load->view('html_footer_view');
		
	}
}
/* Location: ./application/controllers/home.php */