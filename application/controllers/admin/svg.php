<?php
if(!defined('BASEPATH')) exit('No direct script access allowed.');

class Svg extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Tennis_model','tennis');		
		$this->load->model('Svg_model','svg');
		$this->load->library('table');
	}

	public function index(){
		$data['svg'] = $this->svg->listar_svg();
		$data2['tennis'] = $this->tennis->listar_tennis();
		$data2['perspectivas'] = $this->svg->listar_perspectivas();
		$this->load->view('admin/html_header');
		$this->load->view('admin/add_svg_view', $data2);
		$this->load->view('admin/svg_view', $data);
		$this->load->view('admin/html_footer');
	}
	
	public function adicionar(){
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('idtennis','Tennis','required');
		$this->form_validation->set_rules('idperspectiva','Perspectiva','required');
		$this->form_validation->set_rules('texto','Texto:','required');		
		
		if($this->form_validation->run() == false)
		{			
			$this->index();			
		}
		else
		{
			$idtennis = $this->input->post('idtennis');		
			$idperspectiva = $this->input->post('idperspectiva');
			$texto = $this->input->post('texto');
			
			if($this->svg->cadastrar($idtennis, $idperspectiva, $texto)){
				redirect(base_url().'admin/svg');
			}else{
				die('N�o foi possivel efetuar a opera��o');
			}	
		}		
	}
	
	public function editar(){
	}
	
	public function gravar_alteracao(){
	}
	
	public function excluir(){
	}
	
}