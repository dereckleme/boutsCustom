<?php
if(!defined('BASEPATH')) exit('No direct script access allowed.');

class Custom extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Tennis_model','tennis');		
		$this->load->model('Custom_model','custom');
		$this->load->library('table');
	}

	public function index(){
		$data['tennis'] = $this->tennis->listar_tennis();
		$data['perspectivas'] = $this->custom->listar_perspectivas();
		$data['customtipos'] = $this->custom->listar_tipo_custom();
		$data['atributos'] = array(
			'width'      => '800',
            'height'     => '600',
            'scrollbars' => 'yes',
            'status'     => 'yes',
            'resizable'  => 'yes',
            'screenx'    => '525',
            'screeny'    => '0'
		);
		$data2['customs'] = $this->custom->listar_custom();
		$this->load->view('admin/html_header');
		$this->load->view('admin/add_custom_view', $data);
		$this->load->view('admin/custom_view', $data2);
		$this->load->view('admin/html_footer');
	}
	
	public function adicionar(){
		$this->load->library('form_validation');				
		
		$field = array(
			array('field'=>'idperspectiva', 'label'=>'Perspectiva', 'rules'=>'required'),
			array('field'=>'idtennis', 'label'=>'Tennis', 'rules'=>'required'),
			array('field'=>'idtipocustom', 'label'=>'Tipo de Customização', 'rules'=>'required'),
			array('field'=>'posicaoy', 'label'=>'Posição Y', 'rules'=>'required'),
			array('field'=>'posicaox', 'label'=>'Posição X', 'rules'=>'required'),
			array('field'=>'codmateriaprima', 'label'=>'Codigo matéria prima', 'rules'=>'required'),
			array('field'=>'descmateriaprima', 'label'=>'Descrição matéria prima', 'rules'=>'required'),
			array('field'=>'numdocomponente', 'label'=>'Número do componente', 'rules'=>'required'),
			array('field'=>'desccomponente', 'label'=>'Descrição componente', 'rules'=>'required'),
			array('field'=>'forrocolarinho', 'label'=>'Nº/Descrição componente forro colarinho', 'rules'=>'required'),
			array('field'=>'forropala', 'label'=>'Nº/Descrição componente forro pala', 'rules'=>'required'),
			array('field'=>'numdesccomponente', 'label'=>'Nº/Descrição componente', 'rules'=>'required'),
			array('field'=>'codetiquetapala', 'label'=>'Código etiqueta pala', 'rules'=>'required'),
			array('field'=>'descetiquetapala', 'label'=>'Descrição etiqueta pala', 'rules'=>'required'),
			array('field'=>'numcompetiquetapala', 'label'=>'Número componente etiqueta pala', 'rules'=>'required'),
			array('field'=>'desccompetiquetapala', 'label'=>'Descrição componente etiqueta pala', 'rules'=>'required')			
		);		
		$this->form_validation->set_rules($field);
		
		if($this->form_validation->run() == false)
		{			
			$this->index();			
		}
		else
		{	
			//echo"<pre>", print_r($this->input->post()), "</pre>";die();
			$foto = $this->upload_foto();			
			if($this->custom->cadastrar($this->input->post(), $foto)){
				redirect(base_url().'admin/custom');
			}else{
				die('Não foi possivel efetuar a operação');
			}
		}		
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
	
	public function ver($id=null){
		$data['customs'] = $this->custom->ver($id);			
		$this->load->view('admin/html_header');
		$this->load->view('admin/ver_custom_view', $data);
		$this->load->view('admin/html_footer');
	}
	
	public function editar(){
	}
	
	public function gravar_alteracao(){
	}
	
	public function excluir(){
	}
	
}