<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Modelo extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Modelo_model','modelo');
		$this->load->library('table');		
	}
	
	public function index(){
		$data['modelos'] = $this->modelo->getModelos();				
		$this->load->view('admin/html_header');
		$this->load->view('admin/add_modelo_view');
		$this->load->view('admin/modelo_view', $data);
		$this->load->view('admin/html_footer');
	}
	
	public function upload_foto(){
		$config['upload_path'] = './assets/images';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '0';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		$config['encrypt_name'] = true;
		$this->load->library('upload', $config);
		if(! $this->upload->do_upload()){
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
			echo "<a href='javascript:history.go(-1)'>Voltar e corrigir.</a>";
			exit();
		}else{
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data']['file_name'];
		}
	}	
	
	public function cadastrar(){
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nome','Nome','required');		
		if($this->form_validation->run() == false)
		{
			$this->index();
		}
		else
		{
			$nome = $this->input->post('nome');
			$foto = $this->upload_foto();
			if($this->modelo->cadastar($nome, $foto))
			{				
				redirect(base_url('admin/modelo'));			
			}
			else
			{
				die('Não foi possivel cadastrar o item!');
			}
		}
	}
	
	public function editar($idmodelo){
		$data['modelo'] = $this->modelo->ver($idmodelo);
		$this->load->view('admin/html_header');		
		$this->load->view('admin/editar_modelo_view', $data);
		$this->load->view('admin/html_footer');
	}
	
	public function gravar_alteracao(){
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('nome','Nome','required');		
		
		if($this->form_validation->run() == false)
		{
			$this->index();
		}
		else
		{
			$idmodelo = $this->input->post('idmodelo');
			$nome = $this->input->post('nome');
			if($_FILES['userfile']['error'] == 0){
				$foto = $this->upload_foto();
			}else{
				$foto = $this->input->post('foto');
			}
			
			if($this->modelo->gravar_alteracao($idmodelo, $nome, $foto))
			{				
				redirect(base_url('admin/modelo'));			
			}
			else
			{
				die('Não foi possivel alterar o modelo!');
			}
		}
	}

	public function excluir($idmodelo){
		if($this->modelo->excluir($idmodelo)){
			redirect(base_url('admin/modelo'));
		}else{
			die('Não foi possível excluir o modelo.');
		}
	}
	
}
/* Location: ./application/controllers/admin/home.php */