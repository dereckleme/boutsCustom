<?php
class Modelo_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	public function getModelos(){
		return $this->db->get('modelo')->result(); 
	}
	
	public function cadastar($nome, $foto){
		$slug = strtolower($nome);
		$slug = str_replace(" ", "-", $slug);
		
		$insert = array(
			'nome' => strtoupper($nome),
			'image_default' => $foto,
			'slug_modelo' => $slug
		);		
		$this->db->insert('modelo',$insert);
		return $this->db->affected_rows();		
	}	

	public function ver($idmodelo){
		$this->db->where('id', $idmodelo);
		return $this->db->get('modelo')->row();
	}

	public function gravar_alteracao($idmodelo, $nome, $foto){
		$slug = strtolower($nome);
		$slug = str_replace(" ", "-", $slug);
		
		$update = array(
			'nome' => strtoupper($nome),
			'image_default' => $foto,
			'slug_modelo' => $slug
		);		
		$this->db->where('id', $idmodelo);
		$this->db->update('modelo',$update);
		return $this->db->affected_rows();
	}
	
	public function excluir($idmodelo){
		$excluir = $this->ver($idmodelo);
		@unlink("assets/images/".$excluir->image_default);
		$this->db->where('id', $excluir->id);
		return $this->db->delete('modelo');
	}
	
}