<?php
class definicoesTenis_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	public function GetCustom($codeTenis)
	{
		$this->db->select('tipo_custom.*');
		$this->db->from('tipo_custom');
		$this->db->join('tennis', 'tennis.id = tipo_custom.idtennis');
		$this->db->join('modelo', 'tennis.idmodelo = modelo.id');
		$this->db->where("modelo.slug_modelo = '$codeTenis'");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function GetCustomSeters($codeTenis,$perspectiva = 45)
	{
		$this->db->select('tipo_custom_alinhamento.*,tipo_custom.slug_tipo_custom,tipo_custom.nome,perspectiva.perspectiva AS posicao_pers');
		$this->db->from('tipo_custom');
		$this->db->join('tennis', 'tennis.id = tipo_custom.idtennis');
		$this->db->join('modelo', 'tennis.idmodelo = modelo.id');
		$this->db->join('tipo_custom_alinhamento', 'tipo_custom_alinhamento.idtipocustom = tipo_custom.id');
		$this->db->join('perspectiva', 'perspectiva.id = tipo_custom_alinhamento.idperspectiva');
		$this->db->where("modelo.slug_modelo = '$codeTenis'");
		$this->db->where("perspectiva.perspectiva = '$perspectiva'");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function GetSets($idcustom)
	{
		$this->db->select('tipo_custom.slug_tipo_custom, tipo_custom.id AS id_tipo_custom, custom.id AS id_custom');
		$this->db->from('custom');
		$this->db->join('tennis', 'tennis.id = custom.idtennis');
		$this->db->join('tipo_custom', 'custom.idtipocustom = tipo_custom.id');
		$this->db->where("custom.idtipocustom = '$idcustom'");
		$this->db->where("custom.default = 's'");
		$query = $this->db->get();
		return $query->row_array();
	}
	public function GetSetsNsCor($idcustom)
	{
		$this->db->select('custom.cor,tipo_custom.slug_tipo_custom');
		$this->db->from('custom');
		$this->db->join('tipo_custom', 'custom.idtipocustom = tipo_custom.id');
		$this->db->where("custom.id = '$idcustom'");
		$query = $this->db->get();
		return $query->row_array();
	}
	public function GetSetsNs($slug_tipo_custom,$perspectiva,$cor)
	{
		$this->db->select('custom.id');
		$this->db->from('custom');
		$this->db->join('tennis', 'tennis.id = custom.idtennis');
		$this->db->join('perspectiva', 'custom.idperspectiva = perspectiva.id');
		$this->db->join('tipo_custom', 'custom.idtipocustom = tipo_custom.id');
		$this->db->where("custom.cor = '$cor'");
		$this->db->where("perspectiva.perspectiva = '$perspectiva'");
		$this->db->where("tipo_custom.slug_tipo_custom = '$slug_tipo_custom'");
		$query = $this->db->get();
		return $query->row_array();
	}
	public function GetTennisCode($codeTenis)
	{
		$this->db->select('tennis.*');
		$this->db->from('modelo');
		$this->db->join('tennis','modelo.id = tennis.idmodelo');
		$this->db->where("modelo.slug_modelo = '$codeTenis'");
		$query = $this->db->get();
		return $query->row_array();
	}
	public function GetTennisSvg($codeTenis,$perspectiva = 45)
	{
		$this->db->select('svg.*,tipo_custom.slug_tipo_custom, tipo_custom.id AS id_custom');
		$this->db->from('svg');
		$this->db->join('tennis','svg.idtennis = tennis.id');
		$this->db->join('perspectiva','svg.idperspectiva = perspectiva.id');
		$this->db->join('tipo_custom','svg.idtipocustom = tipo_custom.id');
		$this->db->join('modelo','tennis.idmodelo = modelo.id');
		$this->db->where("modelo.slug_modelo = '$codeTenis'");
		$this->db->where("perspectiva.perspectiva = '$perspectiva'");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function GetPersonalizacoes($idperspectiva,$Codetennis,$idtipocustom)
	{
		
		$this->db->select('custom.*');
		$this->db->from("custom");
		$this->db->join('perspectiva','custom.idperspectiva = perspectiva.id');
		$this->db->join('tennis','custom.idtennis = tennis.id');
		$this->db->join('tipo_custom','custom.idtipocustom = tipo_custom.id');
		$this->db->join('modelo','tennis.idmodelo = modelo.id');
		$this->db->where("perspectiva.perspectiva = '$idperspectiva'");
		$this->db->where("modelo.slug_modelo = '$Codetennis'");
		$this->db->where("tipo_custom.id = '$idtipocustom'");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function GetCustonSETS($sets,$defined = false,$modelo = null)
	{
		if($defined == false)
		{
		$perspectiva = $sets['perspectiva'];
		$slug_modelo = $sets['slug_modelo'];
		unset($sets['perspectiva']);
		unset($sets['slug_modelo']);
		}
		else
		{
		$perspectiva = 45;
		$slug_modelo = $modelo;
		unset($sets['sexo']);
		unset($sets['numeracao']);
		}
		$this->db->select('custom.*,tennis.*');
		$this->db->from("custom");
		$this->db->join('tennis','tennis.id = custom.idtennis');
		$this->db->join('modelo','modelo.id = tennis.idmodelo');
		$this->db->join('perspectiva','custom.idperspectiva = perspectiva.id');
		$this->db->where("modelo.slug_modelo = '$slug_modelo'");
		$this->db->where("perspectiva.perspectiva = '$perspectiva'");
		$names = $sets;
		$this->db->where_in('custom.id', $names);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function GetNameCustom($idTipoCustom)
	{
		$this->db->select('descricao');
		$this->db->from("tipo_custom");
		$this->db->where("id = '$idTipoCustom'");
		$query = $this->db->get();
		return $query->row_array();
	}
	public function GeraItensRandHome($codeTenis)
	{
		$this->db->select('custom.*,tipo_custom.*,custom.ID as id_custom,tennis.IMAGEM_FRONTAL');
		$this->db->from("(SELECT * FROM custom ORDER BY rand()) AS custom");
		$this->db->join('tipo_custom','custom.IDTIPOCUSTOM = tipo_custom.ID');
		$this->db->join('tennis','custom.IDTENNIS = tennis.ID');
		$this->db->join('modelo','tennis.IDMODELO = modelo.ID');
		$this->db->where("custom.IDPERSPECTIVA = '2'");
		$this->db->where("modelo.SLUG_MODELO = '$codeTenis'");
		$this->db->Group_by("custom.idtipocustom");
		$this->db->order_by("custom.ID", "asc");
		$query = $this->db->get(); 
		//print $this->db->last_query();
		
		$data['listItensRand'] = $query->result_array();
		//*********Cria Mini TamBS hOME by Drk^^//
		
		$nome_ar = null;
		$custons = array();
		foreach($data['listItensRand'] AS $itensRand)
		{
			$slugList[] = $itensRand["slug_tipo_custom"].":".$itensRand["id_custom"];
		}
		foreach($data['listItensRand'] AS $itensRand)
		{
			$nome_ar .= $itensRand["id_custom"];
			$custons['idDosCustons'][] = $itensRand["id_custom"];
			$custons['imagem'] = "$nome_ar.png";
			$custons['slug'] = implode("|",$slugList);
			
		}
		if(!is_file("./assets/images/render/$nome_ar.png"))
			{
				$fundo = $data['listItensRand'][0]['IMAGEM_FRONTAL'];
				$backgroundSource = "./assets/images/$fundo";
				$source = imagecreatefrompng($backgroundSource);
				imagesavealpha($source,true);
				foreach($data['listItensRand'] AS $itensRand)
					{
						if(!empty($itensRand['imagem_custom']))
						{
							$marca=imagecreatefrompng("./assets/images/$itensRand[imagem_custom]");     // não esquecer de verificar o nome do arquivo
							imagecopyresampled($source,$marca,$itensRand['posicao_x'],$itensRand['posicao_y'],0,0,imagesx($marca),imagesy($marca),imagesx($marca),imagesy($marca));
						}						
					}
					imagepng($source,"./assets/images/render/$nome_ar.png",false,100);	
			}
		//****************//
		return $custons;
	}
}	