<?php
if(!defined('BASEPATH')) exit('No direct script access allowed.');

class Tennis extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Tennis_model','tennis');
		$this->load->model('Modelo_model','modelo');
		$this->load->library('table');
	}

	public function index(){
		$data['modelos'] = $this->modelo->getModelos();
		$data2['tennis'] = $this->tennis->listar_tennis();
		$this->load->view('admin/html_header');
		$this->load->view('admin/add_tennis_view', $data);
		$this->load->view('admin/tennis_view', $data2);
		$this->load->view('admin/html_footer');
	}
	
	public function adicionar(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('modelo', 'Modelo', 'required');
		
		if($this->form_validation->run() == false)
		{
			$this->index();
		}
		else
		{
			$modelo = $this->input->post('modelo');		
			$img['imagen_perfil'] = $this->upload_foto('imgperfil');
			$img['imagen_frontal'] = $this->upload_foto('img45');
			$img['imagen_vertical'] = $this->upload_foto('imgfrente');
			$img['imagen_horizontal'] = $this->upload_foto('img145');
			$img['imagen_solo'] = $this->upload_foto('imgsolado');
			
			if($this->tennis->cadastrar($modelo,$img)){
				redirect(base_url().'admin/tennis');
			}else{
				die('Não foi possivel efetuar a operação');
			}
		}
				
	}
	
	public function upload_foto($userfile){
		$config['upload_path'] = './assets/images';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '0';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		$config['encrypt_name'] = true;
		$this->load->library('upload', $config);
		if(! $this->upload->do_upload($userfile)){
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
			echo "<a href='javascript:history.go(-1)'>Voltar e corrigir.</a>";
			exit();
		}else{
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data']['file_name'];
		}
	}	
	
	public function editar($idtennis){
		$data['modelos'] = $this->modelo->getModelos();
		$data['tennis'] = $this->tennis->ver($idtennis);
		$this->load->view('admin/html_header');
		$this->load->view('admin/editar_tennis_view', $data);		
		$this->load->view('admin/html_footer');
	}
	
	public function gravar_alteracao(){		
		/*$this->load->library('form_validation');
		$this->form_validation->set_rules('idmodelo', 'Modelo', 'required');
		
		if($this->form_validation->run() == false)
		{
			die('aqui');
			//$this->editar($idtennis);
		}
		else
		{*/		
			$idtennis = $this->input->post('idtennis');	
			$modelo = $this->input->post('modelo');

			if($_FILES['imgperfil']['error'] == 0){
				$img['imagen_perfil'] = $this->upload_foto('imgperfil');
			}else{
				$img['imagen_perfil'] = $this->input->post('imgperfil');
			}			
			
			if($_FILES['img45']['error'] == 0){
				$img['imagen_frontal'] = $this->upload_foto('img45');
			}else{
				$img['imagen_frontal'] = $this->input->post('img45');
			}
		
			if($_FILES['imgfrente']['error'] == 0){
				$img['imagen_vertical'] = $this->upload_foto('imgfrente');
			}else{
				$img['imagen_vertical'] = $this->input->post('imgfrente');
			}
		
			if($_FILES['img145']['error'] == 0){
				$img['imagen_horizontal'] = $this->upload_foto('img145');
			}else{
				$img['imagen_horizontal'] = $this->input->post('img145');
			}
		
			if($_FILES['imgsolado']['error'] == 0){
				$img['imagen_solo'] = $this->upload_foto('imgsolado');
			}else{
				$img['imagen_solo'] = $this->input->post('imgsolado');
			}			
			
			
			if($this->tennis->gravar_alteracao($idtennis, $modelo, $img)){
				redirect(base_url().'admin/tennis');
			}else{
				die('Não foi possivel efetuar a operação');
			}
		/*}*/
	}
	
	public function excluir($idtennis){
	}
	
	
}