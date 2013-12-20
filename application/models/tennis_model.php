<?php
class Tennis_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	public function listar_tennis(){
		$this->db->select('modelo.nome, tennis.*');
		$this->db->join('modelo', 'tennis.idmodelo = modelo.id', 'LEFT');
		return $this->db->get('tennis')->result();
	}
	
	public function cadastrar($modelo, $imagens=array()){
		$insert = array(
			'idmodelo' => $modelo,
			'imagem_frente' => $imagens['imagen_perfil'],
			'imagem_frontal' => $imagens['imagen_frontal'],
			'imagem_vertical' => $imagens['imagen_vertical'],
			'imagem_horizontal' => $imagens['imagen_horizontal'],
			'imagem_solo' => $imagens['imagen_solo']
		);
		$this->db->insert('tennis',$insert);
		return $this->db->affected_rows();		
	}	

	public function ver($idtennis){
		$this->db->where('id', $idtennis);
		return $this->db->get('tennis')->row();
	} 
	
	public function gravar_alteracoes($idtennis, $modelo, $img=array()){
		$update = array(
			'idmodelo' => $modelo,
			'imagem_frente' => $img['imagen_perfil'],
			'imagem_frontal' => $img['imagen_frontal'],
			'imagem_vertical' => $img['imagen_vertical'],
			'imagem_horizontal' => $img['imagen_horizontal'],
			'imagem_solo' => $img['imagen_solo']
		);
		$this->db->where('id', $idtennis);
		return $this->db->update('tennis',$update);		
	}
	
	public function excluir($idtennis){
	}
	
}