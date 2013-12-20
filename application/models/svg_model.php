<?php
class Svg_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	public function listar_svg(){
		$this->db->select('tennis.idmodelo, perspectiva.descricao, svg.id, svg.idtennis, svg.svgxml');
		$this->db->join('tennis', 'svg.idtennis = tennis.id', 'LEFT');
		$this->db->join('perspectiva', 'svg.idperspectiva = perspectiva.id', 'LEFT');
		$query = $this->db->get('svg')->result();
		
		$i = 0;
		$array_svg = array();
		foreach($query as $key=>$value){
			$array_svg[$i] = array();
			foreach($value as $key2=>$value2){
				if($key2 == "idmodelo"){
					$array_svg[$i]['modelo'] = $this->nome_modelo($value2);
				}else{
					$array_svg[$i][$key2] = $value2;
				}
			}
			$i++;
		}
		return $array_svg;
	}
	
	public function listar_perspectivas(){
		return $this->db->get('perspectiva')->result();
	} 
	
	public function cadastrar($idtennis, $idperspectiva, $text){	
		$insert = array(
			'idtennis' => $idtennis,
			'idperspectiva' => $idperspectiva,
			'svgxml' => $text			
		);
		$this->db->insert('svg',$insert);
		return $this->db->affected_rows();		
	}	

	function nome_modelo($id){
		$this->db->where('id', $id);
		$query = $this->db->get('modelo')->row();
		return $query->nome;
	}
	
	
}