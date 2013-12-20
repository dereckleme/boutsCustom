<?php
if(!defined('BASEPATH')) exit('No direct script access allowed.');

class TipoCustom extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Tennis_model','tennis');		
		$this->load->model('Custom_model','custom');
		$this->load->library('table');
	}

	public function index(){
		$data['tipos'] = $this->custom->listar_tipo_custom2();
		$data2['tennis'] = $this->tennis->listar_tennis();
		$this->load->view('admin/html_header');
		$this->load->view('admin/add_tipo_view', $data2);
		$this->load->view('admin/tipo_view', $data);
		$this->load->view('admin/html_footer');
	}
	
	public function adicionar(){
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('idtennis','Tennis','required');
		$this->form_validation->set_rules('nome','Custom','required');
		$this->form_validation->set_rules('descricao','Descrição','required');		
		$this->form_validation->set_rules('posicaoy','Posição Y','required');
		$this->form_validation->set_rules('posicaox','Posição X','required');
		
		if($this->form_validation->run() == false)
		{			
			$this->index();			
		}
		else
		{
			$idtennis = $this->input->post('idtennis');		
			$nome = $this->input->post('nome');
			$descricao = $this->input->post('descricao');
			$posicaox = $this->input->post('posicaox');
			$posicaoy = $this->input->post('posicaoy');
			
			if($this->custom->adicionar($idtennis, $nome, $descricao, $posicaox, $posicaoy)){
				redirect(base_url().'admin/tipoCustom');
			}else{
				die('Não foi possivel efetuar a operação');
			}	
		}		
	}
	
	public function editar($idtipo){
		$data['tipo'] = $this->custom->detalhe($idtipo);
		$data['tennis'] = $this->tennis->listar_tennis();
		$this->load->view('admin/html_header');		
		$this->load->view('admin/editar_tipo_view', $data);
		$this->load->view('admin/html_footer');
	}
	
	public function gravar_alteracao(){
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('idtennis','Tennis','required');
		$this->form_validation->set_rules('nome','Custom','required');
		$this->form_validation->set_rules('descricao','Descrição','required');		
		$this->form_validation->set_rules('posicaoy','Posição Y','required');
		$this->form_validation->set_rules('posicaox','Posição X','required');
		
		if($this->form_validation->run() == false)
		{			
			$this->index();			
		}
		else
		{
			$idtipo = $this->input->post('idtipo');
			$idtennis = $this->input->post('idtennis');		
			$nome = $this->input->post('nome');
			$descricao = $this->input->post('descricao');
			$posicaox = $this->input->post('posicaox');
			$posicaoy = $this->input->post('posicaoy');
			
			if($this->custom->gravar_alteracao($idtipo, $idtennis, $nome, $descricao, $posicaox, $posicaoy)){
				redirect(base_url().'admin/tipoCustom');
			}else{
				die('Não foi possivel efetuar a operação');
			}	
		}	
	}
	
	public function excluir($idtipo){
		if($this->custom->excluir($idtipo)){
			redirect(base_url('admin/tipoCustom'));
		}else{
			die('Não foi possivel excluir esse item.');
		}
	}
	
}