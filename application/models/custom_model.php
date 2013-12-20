<?php
class Custom_model extends CI_Model{
	
	var $idperspectiva;
	var $idtennis;
	var $idtipocustom;
	var $posicao_x;
	var $posicao_y;
	var $cod_materia_prima;
	var $desc_materia_prima;
	var $num_componente;
	var $desc_componente;
	var $num_desc_componente_forro_colarinho;
	var $num_desc_componente_forro_pala;
	var $num_desc_componente;
	var $cod_etiqueta_pala;
	var $desc_etiqueta_pala;
	var $num_componente_etiqueta_pala;
	var $desc_componente_etiqueta_pala;
	var $imagem_custom;	
	
	function __construct(){
		parent::__construct();
	}
	
	public function listar_custom(){
		$this->db->select('modelo.nome AS tennis,
						   perspectiva.descricao,
						   tipo_custom.nome AS tipocustom,
						   custom.posicao_y,
						   custom.posicao_x,
						   custom.imagem_custom,
                           custom.id');
		$this->db->from('tennis');
		$this->db->join('modelo', 'tennis.idmodelo = modelo.id', 'LEFT');
		$this->db->join('custom', 'custom.idtennis = tennis.id', 'LEFT');
		$this->db->join('perspectiva', 'custom.idperspectiva = perspectiva.id', 'LEFT');
		$this->db->join('tipo_custom', 'custom.idtipocustom = tipo_custom.id', 'LEFT');
		return $this->db->get()->result();
	}
	
	public function listar_perspectivas(){
		return $this->db->get('perspectiva')->result();
	} 
	
	public function listar_tipo_custom(){
		return $this->db->get('tipo_custom')->result();
	}
	
	public function cadastrar($infos = array(), $image){
		$this->idperspectiva = $infos['idperspectiva'];
		$this->idtennis = $infos['idtennis'];		
		$this->idtipocustom = $infos['idtipocustom'];
		$this->posicao_x = $infos['posicaoy'];
		$this->posicao_y = $infos['posicaox'];
		$this->cod_materia_prima = $infos['codmateriaprima'];
		$this->desc_materia_prima = $this->convertem($infos['codmateriaprima'], 1);
		$this->num_componente = $infos['numdocomponente'];
		$this->desc_componente = $this->convertem($infos['desccomponente'], 1);
		$this->num_desc_componente_forro_colarinho = $this->convertem($infos['forrocolarinho'], 1);
		$this->num_desc_componente_forro_pala = $this->convertem($infos['forropala'], 1);
		$this->num_desc_componente = $this->convertem($infos['numdesccomponente'], 1);
		$this->cod_etiqueta_pala = $infos['codetiquetapala'];
		$this->desc_etiqueta_pala = $this->convertem($infos['descetiquetapala'], 1);
		$this->num_componente_etiqueta_pala = $infos['numcompetiquetapala'];
		$this->desc_componente_etiqueta_pala = $this->convertem($infos['desccompetiquetapala'], 1);
		$this->imagem_custom = $image;
		
		$this->db->insert('custom',$this);
		return $this->db->affected_rows();		
	}	

	public function ver($id){
		$this->db->select('modelo.nome AS tennis,
						   perspectiva.descricao,
						   tipo_custom.nome AS tipocustom,
						   custom.*');
		$this->db->from('tennis');
		$this->db->join('modelo', 'tennis.idmodelo = modelo.id', 'LEFT');
		$this->db->join('custom', 'custom.idtennis = tennis.id', 'LEFT');
		$this->db->join('perspectiva', 'custom.idperspectiva = perspectiva.id', 'LEFT');
		$this->db->join('tipo_custom', 'custom.idtipocustom = tipo_custom.id', 'LEFT');
		$this->db->where('custom.id',$id);
		return $this->db->get()->row();
	}
	
	// tipo custom inicio
	public function listar_tipo_custom2(){
		$this->db->select('modelo.nome as tennis, tipo_custom.*');
		$this->db->join('tennis', 'tipo_custom.idtennis = tennis.id', 'LEFT');
		$this->db->join('modelo', 'tennis.idmodelo = modelo.id', 'LEFT');	
		return $this->db->get('tipo_custom')->result();
	}
	
	public function adicionar($idtennis, $nome, $descricao, $posicaox, $posicaoy){
		$strtr = strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
		
		$values = array(
			'idtennis' => $idtennis,
			'nome' => $strtr,
			'descricao' => strtoupper($descricao),
			'posicao_x' => $posicaox,
			'posicao_y' => $posicaoy
		);
		
		$this->db->insert('tipo_custom', $values);
		return $this->db->affected_rows();
	}
	
	public function detalhe($idtipo){
		$this->db->where('id', $idtipo);
		return $this->db->get('tipo_custom')->row();
	} 
	
	public function gravar_alteracao($idtipo, $idtennis, $nome, $descricao, $posicaox, $posicaoy){
		$strtr = strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
		
		$values = array(
			'idtennis' => $idtennis,
			'nome' => $strtr,
			'descricao' => strtoupper($descricao),
			'posicao_x' => $posicaox,
			'posicao_y' => $posicaoy
		);
		$this->db->where('id', $idtipo);
		return $this->db->update('tipo_custom', $values);		 
	}
	
	public function excluir($idtipo){
		$this->db->where('id', $idtipo);
		return $this->db->delete('tipo_custom');
	}
	// tipo custom fim
	
	function convertem($term, $tp){
		if($tp == 1) $palavra = strtr(strtoupper($term), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
		elseif($tp == 0) $palavra = strtr(strtolower($term), "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß", "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ");
		return $palavra;
	} 
}