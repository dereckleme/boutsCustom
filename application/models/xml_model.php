<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Xml_model extends CI_Model{
	
	var $id;
	var $conteudo;
	var $num_pedido;
	var $local;
	var $data_criacao;
	var $data_confirmacao;
	var $url;
	var $ativo;
	//var $ci;
	
	public function __construct(){
		parent::__construct();
		//$this->ci=&get_instance();
		date_default_timezone_set('America/Sao_Paulo');
	}
	
	public function get_xml_id($url){
		$this->db->insert('xml', $this);
		return $this->db->insert_id();
	}
	
	public function atualizar_xml($cod, $xml_content, $url){
		$this->id = $cod;
		$this->conteudo = $xml_content;
		$this->num_pedido = '';
		$this->local = '';
		$this->data_criacao = date("Y-m-d H:i:s");
		$this->data_confirmacao = "0000-00-00 00:00:00";
		$this->url = $url;	
		$this->ativo = 'n';	
		$this->db->where('id', $cod);		
		return $this->db->update('xml', $this);		
	}
	
	public function comfirmacao($id, $computer_name, $codigo_centauro){
		
		$data = $this->lista_xml($id);
		
		$this->id = $data->id;
		$this->conteudo = $data->conteudo;
		$this->num_pedido = $codigo_centauro;
		$this->local = $computer_name;
		$this->data_criacao = $data->data_criacao;
		$this->data_confirmacao = date('Y-m-d H:i:s');
		$this->url = $data->url;
		$this->ativo = 's';
		$this->db->where('id', $id);
		return $this->db->update('xml', $this);		
	} 
	
	public function lista_xml($id){
		$this->db->where('id', $id);
		$query = $this->db->get('xml');
		return $query->row();
	}
	
	public function sku($tenis, $numeracao, $sexo){
		$method = "sku_".strtolower($tenis);
		switch ($tenis){
			case "JOIN": return $this->$method($numeracao, $sexo);
			break;
			case "ORION": return $this->$method($numeracao, $sexo);
			break;
			case "STRIDE": return $this->$method($numeracao, $sexo);
			break;
		}
		
	}
	
	public function sku_join($numeracao, $sexo){
		$dflt = "892315";
		
		if($numeracao > '40' && $sexo == 'masculino'){
			switch ($numeracao){
				case "41": return $dflt."151361";
				break;
				case "42": return $dflt."151378";
				break;
				case "43": return $dflt."151385";
				break;
				case "44": return $dflt."151392";
				break;
			}
		}else{
			switch ($numeracao){
				case "34": return $dflt."151293";
				break;
				case "35": return $dflt."151309";
				break;
				case "36": return $dflt."151316";
				break;
				case "37": return $dflt."151323";
				break;
				case "38": return $dflt."151330";
				break;
				case "39": return $dflt."151347";
				break;
				case "40": return $dflt."151354";
				break;				
			}
		}		
	}
	
	public function sku_orion($numeracao, $sexo){
		$dflt = "810456";
	
		if($numeracao > '40' && $sexo == 'masculino'){
			switch ($numeracao){
				case "41": return $dflt."000413";
				break;
				case "42": return $dflt."000420";
				break;
				case "43": return $dflt."000437";
				break;
				case "44": return $dflt."000444";
				break;
			}
		}else{
			switch ($numeracao){
				case "33": return $dflt."000338";
				break;
				case "34": return $dflt."000345";
				break;
				case "35": return $dflt."000352";
				break;
				case "36": return $dflt."000369";
				break;
				case "37": return $dflt."000376";
				break;
				case "38": return $dflt."000383";
				break;
				case "39": return $dflt."000390";
				break;
				case "40": return $dflt."000406";
				break;
			}
		}
	}
	
	public function sku_stride($numeracao, $sexo){
		$dflt = "892315";
	
		if($numeracao > '40' && $sexo == 'masculino'){
			switch ($numeracao){
				case "41": return $dflt."155833";
				break;
				case "42": return $dflt."155840";
				break;
				case "43": return $dflt."155857";
				break;
				case "44": return $dflt."155864";
				break;
			}
		}else{
			switch ($numeracao){
				case "34": return $dflt."155765";
				break;
				case "35": return $dflt."155772";
				break;
				case "36": return $dflt."155789";
				break;
				case "37": return $dflt."155796";
				break;
				case "38": return $dflt."155802";
				break;
				case "39": return $dflt."155819";
				break;
				case "40": return $dflt."155826";
				break;
			}
		}
	}
	
	public function lista_customizacao($id){
		$this->db->where('custom.id', $id);
		$query = $this->db->get('custom');
		return $query->row();
	}

	public function lista_etiqueta($id){
		$this->db->select('cod_etiqueta_pala, desc_etiqueta_pala, num_componente_etiqueta_pala, desc_componente_etiqueta_pala');
		$this->db->where('custom.id', $id);
		$query = $this->db->get('custom');
		return $query->row();
	}

	public function palmilha($id, $tenis){
		$method = "palmilha_$tenis";
		
		$this->db->select('cor');
		$this->db->where('id', $id);
		$query = $this->db->get('custom');
		//echo $this->db->last_query();
		if($query->num_rows() > 0){
			$row = $query->row();
			 return $this->$method($row->cor);
		}else{
			die(':-( by bouts');
		}
	}
	
	public function palmilha_orion($cor){
		switch ($cor){
			case "cinza_preto":
				$array = array(
					'codigo-primo' => '113.027.902',
					'materia-prima' => 'PALMILHA PLANA 5MM 7720 TEC FAV PRETO C/ SILK',
					'numero-componente' => '3315',
					'descricao-componente' => 'PALM MOLD 7720'
				);
				return $array;
			break;
			case "coral_turquesa":
				$array = array(
					'codigo-primo' => '113.027.963',
					'materia-prima' => 'PALMILHA PLANA 5MM 7720 TEC FAV CINZA C/ SILK',
					'numero-componente' => '3315',
					'descricao-componente' => 'PALM MOLD 7720'
				);
				return $array;
			break;
			case "amarelofluor_preto":
				$array = array(
					'codigo-primo' => '113.027.902',
					'materia-prima' => 'PALMILHA PLANA 5MM 7720 TEC FAV PRETO C/ SILK',
					'numero-componente' => '3315',
					'descricao-componente' => 'PALM MOLD 7720'
				);
				return $array;
			break;
			case "preto_laranja":
				$array = array(
					'codigo-primo' => '113.027.902',
					'materia-prima' => 'PALMILHA PLANA 5MM 7720 TEC FAV PRETO C/ SILK',
					'numero-componente' => '3315',
					'descricao-componente' => 'PALM MOLD 7720'
				);
				return $array;
			break;
			case "marinho_prata":
				$array = array(
					'codigo-primo' => '113.027.963',
					'materia-prima' => 'PALMILHA PLANA 5MM 7720 TEC FAV CINZA C/ SILK',
					'numero-componente' => '3315',
					'descricao-componente' => 'PALM MOLD 7720'
				);
				return $array;
			break;
			case "cinza_pink":
				$array = array(
					'codigo-primo' => '113.027.963',
					'materia-prima' => 'PALMILHA PLANA 5MM 7720 TEC FAV CINZA C/ SILK',
					'numero-componente' => '3315',
					'descricao-componente' => 'PALM MOLD 7720'
				);
				return $array;
			break;
			case "chiclete_amarelofluor":
				$array = array(
					'codigo-primo' => '113.027.963',
					'materia-prima' => 'PALMILHA PLANA 5MM 7720 TEC FAV CINZA C/ SILK',
					'numero-componente' => '3315',
					'descricao-componente' => 'PALM MOLD 7720'
				);
				return $array;
			break;
			case "uva_coral":
				$array = array(
					'codigo-primo' => '113.027.963',
					'materia-prima' => 'PALMILHA PLANA 5MM 7720 TEC FAV CINZA C/ SILK',
					'numero-componente' => '3315',
					'descricao-componente' => 'PALM MOLD 7720'
				);
				return $array;
			break;
			
			default: echo ":-(";
			break;
		}
	}
	
	public function palmilha_stride($cor){
		switch ($cor){
			case "grafite_prata":
				$array = array(
					'codigo-primo' => '113.027.963',
					'materia-prima' => 'PALMILHA PLANA 5MM 7720 TEC FAV CINZA C/ SILK',
					'numero-componente' => '3315',
					'descricao-componente' => 'PALM MOLD 7720'
				);
				return $array;
			break;
			case "grafite_preto":
				$array = array(
					'codigo-primo' => '113.027.902',
					'materia-prima' => 'PALMILHA PLANA 5MM 7720 TEC FAV PRETO C/ SILK',
					'numero-componente' => '3315',
					'descricao-componente' => 'PALM MOLD 7720'
				);
				return $array;
			break;
			case "preto_prata":
				$array = array(
					'codigo-primo' => '113.027.902',
					'materia-prima' => 'PALMILHA PLANA 5MM 7720 TEC FAV PRETO C/ SILK',
					'numero-componente' => '3315',
					'descricao-componente' => 'PALM MOLD 7720'
				);
				return $array;
			break;
			case "branco_pink":
				$array = array(
					'codigo-primo' => '113.027.963',
					'materia-prima' => 'PALMILHA PLANA 5MM 7720 TEC FAV CINZA C/ SILK',
					'numero-componente' => '3315',
					'descricao-componente' => 'PALM MOLD 7720'
				);
				return $array;
			break;
			case "grafite_coral":
				$array = array(
					'codigo-primo' => '113.027.963',
					'materia-prima' => 'PALMILHA PLANA 5MM 7720 TEC FAV CINZA C/ SILK',
					'numero-componente' => '3315',
					'descricao-componente' => 'PALM MOLD 7720'
				);
				return $array;
			break;
			case "uva_pink":
				$array = array(
					'codigo-primo' => '113.027.963',
					'materia-prima' => 'PALMILHA PLANA 5MM 7720 TEC FAV CINZA C/ SILK',
					'numero-componente' => '3315',
					'descricao-componente' => 'PALM MOLD 7720'
				);
				return $array;
			break;
			case "marinho_amarelofluor":
				$array = array(
					'codigo-primo' => '113.027.963',
					'materia-prima' => 'PALMILHA PLANA 5MM 7720 TEC FAV CINZA C/ SILK',
					'numero-componente' => '3315',
					'descricao-componente' => 'PALM MOLD 7720'
				);
				return $array;
			break;
			case "grafite_violeta":
				$array = array(
					'codigo-primo' => '113.027.963',
					'materia-prima' => 'PALMILHA PLANA 5MM 7720 TEC FAV CINZA C/ SILK',
					'numero-componente' => '3315',
					'descricao-componente' => 'PALM MOLD 7720'
				);
				return $array;
			break;
			
			default: echo ":-(";
			break;
		}
	}
	
	public function palmilha_join($cor){
		switch ($cor){
			case "cinza_branco":
				$array = array(
					'codigo-primo' => '906.003.905',
					'materia-prima' => 'PALMILHA PU 7720 INJ C/ TEC CINZA',
					'numero-componente' => '3601',
					'descricao-componente' => 'PALMILHA PU INJETADA'
				);
				return $array;
			break;
			case "grafite_prata":
				$array = array(
					'codigo-primo' => '906.003.905',
					'materia-prima' => 'PALMILHA PU 7720 INJ C/ TEC CINZA',
					'numero-componente' => '3601',
					'descricao-componente' => 'PALMILHA PU INJETADA'
				);
				return $array;
			break;
			case "laranja_preto":
				$array = array(
					'codigo-primo' => '906.003.902',
					'materia-prima' => 'PALMILHA PU 7720 INJ C/ TEC PRETO',
					'numero-componente' => '3601',
					'descricao-componente' => 'PALMILHA PU INJETADA'
				);
				return $array;
			break;
			case "coral_prata":
				$array = array(
					'codigo-primo' => '906.003.905',
					'materia-prima' => 'PALMILHA PU 7720 INJ C/ TEC CINZA',
					'numero-componente' => '3601',
					'descricao-componente' => 'PALMILHA PU INJETADA'
				);
				return $array;
			break;
			case "marinho_prata":
				$array = array(
					'codigo-primo' => '906.003.905',
					'materia-prima' => 'PALMILHA PU 7720 INJ C/ TEC CINZA',
					'numero-componente' => '3601',
					'descricao-componente' => 'PALMILHA PU INJETADA'
				);
				return $array;
			break;
			case "preto_vermelho":
				$array = array(
					'codigo-primo' => '906.003.902',
					'materia-prima' => 'PALMILHA PU 7720 INJ C/ TEC PRETO',
					'numero-componente' => '3601',
					'descricao-componente' => 'PALMILHA PU INJETADA'
				);
				return $array;
			break;
			case "preto_amarelo_fluor":
				$array = array(
					'codigo-primo' => '906.003.902',
					'materia-prima' => 'PALMILHA PU 7720 INJ C/ TEC PRETO',
					'numero-componente' => '3601',
					'descricao-componente' => 'PALMILHA PU INJETADA'
				);
				return $array;
			break;
			case "preto_pink":
				$array = array(
					'codigo-primo' => '906.003.902',
					'materia-prima' => 'PALMILHA PU 7720 INJ C/ TEC PRETO',
					'numero-componente' => '3601',
					'descricao-componente' => 'PALMILHA PU INJETADA'
				);
				return $array;
			break;
			
			default: echo ":-(";
			break;
		}
	}
	
	public function lista_traseiro($cabedal){
		$this->db->select('cor');
		$this->db->where('id', $cabedal);
		$query = $this->db->get('custom');
		//echo $this->db->last_query();
		if($query->num_rows() > 0){
			$row = $query->row();
			
			switch ($row->cor){
				case"grafite_prata":
					$array = array(
						'codigo' => '251.025.950',
						'descricao' => 'TRASEIRO INJ 8022 CHUM MET',
						'numero' => '3590',
						'descricao2' => 'TRAS INJET'
					);
					return $array;
				break;
				case"grafite_preto":
					$array = array(
							'codigo' => '251.025.950',
							'descricao' => 'TRASEIRO INJ 8022 CHUM MET',
							'numero' => '3590',
							'descricao2' => 'TRAS INJET'
					);
					return $array;
				break;
				case"preto_prata":
					$array = array(
							'codigo' => '251.025.902',
							'descricao' => 'TRASEIRO INJ 8022 PRETO',
							'numero' => '3590',
							'descricao2' => 'TRAS INJET'
					);
					return $array;
				break;
				case"branco_pink":
					$array = array(
							'codigo' => '251.025.901',
							'descricao' => 'TRASEIRO INJ 8022 BRANCO',
							'numero' => '3590',
							'descricao2' => 'TRAS INJET'
					);
					return $array;
				break;
				case"grafite_coral":
					$array = array(
							'codigo' => '251.025.950',
							'descricao' => 'TRASEIRO INJ 8022 CHUM MET',
							'numero' => '3590',
							'descricao2' => 'TRAS INJET'
					);
					return $array;
				break;
				case"uva_pink":
					$array = array(
							'codigo' => '251.025.911',
							'descricao' => 'TRASEIRO INJ 8022 UVA MET',
							'numero' => '3590',
							'descricao2' => 'TRAS INJET'
					);
					return $array;
				break;
				case"marinho_amarelofluor":
					$array = array(
							'codigo' => '251.025.907',
							'descricao' => 'TRASEIRO INJ 8022 MARI MET',
							'numero' => '3590',
							'descricao2' => 'TRAS INJET'
					);
					return $array;
				break;
				case"grafite_violeta":
					$array = array(
							'codigo' => '251.025.950',
							'descricao' => 'TRASEIRO INJ 8022 CHUM MET',
							'numero' => '3590',
							'descricao2' => 'TRAS INJET'
					);
					return $array;
				break;
				
				default: echo ":-(";
				break;
			}
			
		}else{
			die(':-( by bouts');
		}
		
	}	
	
	public function lista_biqueira($cabedal){
		$this->db->select('cor');
		$this->db->where('id', $cabedal);
		$query = $this->db->get('custom');
		//echo $this->db->last_query();
		if($query->num_rows() > 0){
			$row = $query->row();
			
			switch ($row->cor){
				case "cinza_branco":
					$array = array(
						'codigo' => '102.056.905',
						'descricao' => 'SINTETICO ATHENAS 1.50MM CINZA',
						'numero' => '40',
						'descricao2' => 'BIQUEIRA 2X1',
					);
					return $array;
				break;
				case "grafite_prata":
					$array = array(
						'codigo' => '102.056.745',
						'descricao' => 'SINTETICO ATHENAS 1.50MM GRAFITE',
						'numero' => '40',
						'descricao2' => 'BIQUEIRA 2X1',
					);
					return $array;
				break;
				case "laranja_preto":
					$array = array(
						'codigo' => '102.056.902',
						'descricao' => 'SINTETICO ATHENAS 1.50MM PRETO',
						'numero' => '40',
						'descricao2' => 'BIQUEIRA 2X1',
					);
					return $array;
				break;
				case "coral_prata":
					$array = array(
						'codigo' => '102.056.4828',
						'descricao' => 'SINTETICO ATHENAS 1.50MM CORAL',
						'numero' => '40',
						'descricao2' => 'BIQUEIRA 2X1',
					);
					return $array;
				break;
				case "marinho_prata":
					$array = array(
						'codigo' => '102.056.907',
						'descricao' => 'SINTETICO ATHENAS 1.50MM MARINHO',
						'numero' => '40',
						'descricao2' => 'BIQUEIRA 2X1',
					);
					return $array;
				break;
				case "preto_vermelho":
					$array = array(
						'codigo' => '102.056.902',
						'descricao' => 'SINTETICO ATHENAS 1.50MM PRETO',
						'numero' => '40',
						'descricao2' => 'BIQUEIRA 2X1',
					);
					return $array;
				break;
				case "preto_amarelofluor":
					$array = array(
						'codigo' => '102.056.902',
						'descricao' => 'SINTETICO ATHENAS 1.50MM PRETO',
						'numero' => '40',
						'descricao2' => 'BIQUEIRA 2X1',
					);
					return $array;
				break;
				case "preto_pink":
					$array = array(
						'codigo' => '102.056.902',
						'descricao' => 'SINTETICO ATHENAS 1.50MM PRETO',
						'numero' => '40',
						'descricao2' => 'BIQUEIRA 2X1',
					);
					return $array;
				break;
				
				default: echo ":-(";
				break;
			}
			
		}else{
			echo ':-(';
		}	
			
	}
	
}