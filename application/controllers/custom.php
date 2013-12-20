<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Custom extends CI_Controller{
	
	public function __construct(){
		parent::__construct();		
		$this->load->library('MyXml','myxml');
		$this->load->model('Xml_model','xmldb');
	}
	
	public function iniciar()
	{
		$this->load->view('iniciar_view');
	}
	public function selecione()
	{
		$this->load->view('selecione_view');
	}
	public function modelo($modelo_tenis){
		$this->load->model("definicoesTenis_model");
		$predefinidoGet = false;
		//Definição DE get
		$setersGet = null;
			if(isset($_GET['sexo']) && isset($_GET['numeracao']))
			{
				//URL
				$keyArrayGET = array_keys($_GET);
				foreach($keyArrayGET AS $keyGET)
				{
					$setersGet[] = $keyGET."=".$_GET[$keyGET];
				}
				$setersGet = implode("&",$setersGet);
				$setersGet = "?".$setersGet;
				//FIM
				$data['setersGet'] = $this->definicoesTenis_model->GetCustonSETS($_GET,true,$modelo_tenis);
				$data['listSVGSetedGET'] = $this->definicoesTenis_model->GetTennisSvg($modelo_tenis,45);
			}
			//fim
		$data['predefinidoGet'] = $predefinidoGet;
		for($i = 0; $i<=7; $i++)
		{
		$data['listItensRand'][] = $this->definicoesTenis_model->GeraItensRandHome($modelo_tenis);
		}
		$data['tennis'] = $this->definicoesTenis_model->GetTennisCode($modelo_tenis);
		$data['svg'] = $this->definicoesTenis_model->GetTennisSvg($modelo_tenis);
		$data['seters'] = $this->definicoesTenis_model->GetCustomSeters($modelo_tenis);
		$data['codeTenis'] = $modelo_tenis;
		$this->load->view('html_header_view');
		$data['script_custom'] = '<script src="'.base_url().'custom/script/'.$modelo_tenis.$setersGet.'" language="javascript" type="text/javascript"></script>';
		$this->load->view('cabecalho_view',$data);
		$this->load->view('custom_view');
		
	}
	public function concluir($modelo_tenis){
		$this->load->model("definicoesTenis_model");
		$predefinidoGet = false;
		//Definição DE get
		$setersGet = null;
			if(isset($_GET['sexo']) && isset($_GET['numeracao']))
			{
				//URL
				$keyArrayGET = array_keys($_GET);
				foreach($keyArrayGET AS $keyGET)
				{
					$setersGet[] = $keyGET."=".$_GET[$keyGET];
				}
				$setersGet = implode("&",$setersGet);
				$setersGet = "?".$setersGet;
				//FIM
				$data['setersGet'] = $this->definicoesTenis_model->GetCustonSETS($_GET,true,$modelo_tenis);
				$data['listSVGSetedGET'] = $this->definicoesTenis_model->GetTennisSvg($modelo_tenis,45);
			}
			//fim
		$data['predefinidoGet'] = $predefinidoGet;
		for($i = 0; $i<=7; $i++)
		{
		$data['listItensRand'][] = $this->definicoesTenis_model->GeraItensRandHome($modelo_tenis);
		}
		$data['tennis'] = $this->definicoesTenis_model->GetTennisCode($modelo_tenis);
		$data['svg'] = $this->definicoesTenis_model->GetTennisSvg($modelo_tenis);
		$data['seters'] = $this->definicoesTenis_model->GetCustomSeters($modelo_tenis);
		$data['codeTenis'] = $modelo_tenis;
		$this->load->view('html_header_view');
		$data['script_custom'] = '<script src="'.base_url().'custom/script_concluir/'.$modelo_tenis.$setersGet.'" language="javascript" type="text/javascript"></script>';
		$this->load->view('cabecalho_view',$data);
		$this->load->view('concluir_view');
	}
	public function script($modelo_tenis)
	{
		$this->load->helper("jquery_helper");
		script($modelo_tenis);
	}
	public function script_concluir($modelo_tenis)
	{
		$this->load->helper("concluir_helper");
		script($modelo_tenis);
	}
	public function render()
	{
		$this->load->helper("render_helper");
	}
	public function retornaCustons($idperspectiva,$Codetennis,$idtipocustom,$slug_tipo_custom)
	{
		$this->load->model("definicoesTenis_model");
		$data['nome_custom'] = $this->definicoesTenis_model->GetNameCustom($idtipocustom);
		
		$data['itens'] = $this->definicoesTenis_model->GetPersonalizacoes($idperspectiva,$Codetennis,$idtipocustom);
		$data['customVarJQ'] = $slug_tipo_custom;
		$this->load->view("customitens_view",$data);
	}
	public function setVarivel()
	{
		
		$this->load->model("definicoesTenis_model");
		$perspectiva = $_POST['perspectiva'];
		$slug_modelo = $_POST['slug_modelo'];
		unset($_POST['perspectiva']);
		unset($_POST['slug_modelo']);
		foreach($_POST as $sets)
		{
			
			$value = explode("|", $sets);
			$item = $value[0];
			$valor = $value[1];
		    $cor = $this->definicoesTenis_model->GetSetsNsCor($valor);
			$cornew = $cor['cor'];
			$slug_tipo_custom = $cor['slug_tipo_custom'];
			$newId = $this->definicoesTenis_model->GetSetsNs($slug_tipo_custom,$perspectiva,$cornew);
			$returnArray[] = array("item"=>$item,"value" => $newId['id']);
		}
		
		print json_encode($returnArray);
	}
	public function retornaSetersValue($codeTenis,$perspectiva)
	{
		$this->load->model("definicoesTenis_model");
		$retorno = $this->definicoesTenis_model->GetCustomSeters($codeTenis,$perspectiva);
		print json_encode($retorno);
	}
	public function retornaMedidas($sexo)
	{
		
		if($sexo == "masculino")
		{
			$this->load->view("numeracao_masculino");
		}
		else if($sexo == "feminino")
		{
			$this->load->view("numeracao_feminino");
		}
	}
	public function gerar($teste)
	{
		date_default_timezone_set('America/Sao_Paulo');
		$info = explode(" ", date("d-m-Y H:i:s"));
				
		$url = prep_url($this->input->server('SERVER_NAME').$this->input->server('REQUEST_URI'));
		$methodo = "estrutura_".$this->uri->segment(3);
		$tenis = strtoupper($this->uri->segment(3));		
		$colarinho = $this->input->get('colarinho');		
		$cabedal = ($this->input->get('cabedal')) ? $this->input->get('cabedal') : $this->input->get('silk');
		$cadarco = $this->input->get('cadarco');
		$solado = $this->input->get('solado');
		$nylon = $this->input->get('nylon');
		$sexo = $this->input->get('sexo');
		$numeracao = $this->input->get('numeracao');		
		$codigo = $this->xmldb->get_xml_id($url);
		$nome_arquivo = $info[0] . "-0$codigo.xml";
		$sku = $this->xmldb->sku($tenis, $numeracao, $sexo);		
		//$sku = "800045520408";		
		
		/**
		 * Abaixo se encontra a estrutura do XML
		 */
		$this->myxml->openTag("Customizacao");
		
			$this->myxml->openTag("Header");
				$this->myxml->addTag("url", "http://{$_SERVER['HTTP_HOST']}/boots/custom/receipt/{$codigo}/computador1");
				$this->myxml->addTag("acesso", "computador1");
				$this->myxml->addTag("data", $info[0]);
				$this->myxml->addTag("hora", substr($info[1], 0, -3));
			$this->myxml->closeTag("Header");
			
			$this->myxml->openTag("Body");
				
				$this->myxml->openTag("Tennis");
					$this->myxml->addTag("Modelo", "$tenis");
					$this->myxml->addTag("Tamanho", "$numeracao");
					$this->myxml->addTag("Sexo", "$sexo");
					$this->myxml->addTag("Sku", "$sku");
				$this->myxml->closeTag("Tennis");
				
				$this->myxml->openTag("Customizacoes");
					
					$this->myxml->openTag("Customs");
						//primeiro item						
						$this->myxml->openTagAttr("Custom", 'COLARINHO');							
							$this->myxml->tagFree($this->$methodo($this->xmldb->lista_customizacao($colarinho), 'colarinho'));								
						$this->myxml->closeTag("Custom");
						
						//segundo item						
						$this->myxml->openTagAttr("Custom", 'CABEDAL');							
							$this->myxml->tagFree($this->$methodo($this->xmldb->lista_customizacao($cabedal), 'cabedal'));							
						$this->myxml->closeTag("Custom");
						
						//terceiro item
						$this->myxml->openTagAttr("Custom", 'CADARCO');						
							$this->myxml->tagFree($this->$methodo($this->xmldb->lista_customizacao($cadarco), 'cadarco'));							
						$this->myxml->closeTag("Custom");
						
						//quarto item
						$this->myxml->openTagAttr("Custom", 'SOLADO');						
							$this->myxml->tagFree($this->$methodo($this->xmldb->lista_customizacao($solado), 'solado'));						
						$this->myxml->closeTag("Custom");
						
						//quinto item
						$this->myxml->openTagAttr("Custom", 'NYLON');						
							$this->myxml->tagFree($this->$methodo($this->xmldb->lista_customizacao($nylon), 'nylon'));						
						$this->myxml->closeTag("Custom");
						
					$this->myxml->closeTag("Customs");

					//Combinatorios					
					$this->myxml->openTag('Combinatorios');					
						// combinatorio um
						$this->myxml->tagFree($this->$methodo($this->xmldb->lista_etiqueta($nylon), 'etiqueta'));
						
						// combinatorio dois						
						$this->myxml->tagFree($this->$methodo($this->xmldb->palmilha($cabedal, $this->uri->segment(3)), 'palmilha'));
						
						if($this->uri->segment(3) == 'stride'){ // inicio if do stride								
							// combinatorio tres
							$this->myxml->tagFree($this->$methodo($this->xmldb->lista_traseiro($cabedal), 'traseiro'));
							
							// combinatorio quatro
							$this->myxml->tagFree($this->$methodo('','inserto'));
							
							// combinatorio cinco
							$this->myxml->tagFree($this->$methodo('','amortecedor'));
							
						}// fim if do stride
						
						if($this->uri->segment(3) == 'join'){ // inicio if do join								
							// combinatorio tres 
							$this->myxml->tagFree($this->$methodo($this->xmldb->lista_biqueira($cabedal), 'biqueira'));
							
							// combinatorio quatro
							$this->myxml->tagFree($this->$methodo('','inserto'));
							
							// combinatorio cinco
							$this->myxml->tagFree($this->$methodo('','sdianteira'));
							
							// combinatorio seis
							$this->myxml->tagFree($this->$methodo('','straseira'));
							
							// combinatorio sete
							$this->myxml->tagFree($this->$methodo('','estabilizador'));
							
						}// fim if do join
						
					$this->myxml->closeTag('Combinatorios');
										
				$this->myxml->closeTag("Customizacoes");
				
			$this->myxml->closeTag("Body");
			
		$this->myxml->closeTag("Customizacao");
		
		$str = $this->myxml->__toString();		
		$fp = fopen("assets/xml/$nome_arquivo", "a");
		$escreve = fwrite($fp, $str);
		@fclose($escreve);
		
		$this->xmldb->atualizar_xml($codigo, "assets/xml/$nome_arquivo", $url);		
		redirect(base_url('custom/integrar/'.$codigo));
	}
	public function integrar($id){
		date_default_timezone_set('America/Sao_Paulo');
		$info = explode(" ", date("d-m-Y H:i:s"));
		$xml_data = $this->xmldb->lista_xml($id);
					
		$this->load->helper('file');
		$string = read_file($xml_data->conteudo);
		$string = htmlspecialchars($string);
		
		//$wsdl_url = "http://qaswsb2b.centauro.com.br/Services/CustomizacaoItens.asmx?wsdl";// url de teste
		$wsdl_url = "http://bouts2.centauro.com.br/Services/CustomizacaoItens.asmx?wsdl";// url final; status: teste
		$cliente = new SoapClient($wsdl_url);		
		$p = array('xmlCustomizacao'=>$string);
		$cli = $cliente->CriarCarrinhoDeCompras($p);
		
		//print_r($cli);
		//die();
		
		redirect($cli->CriarCarrinhoDeComprasResult);
		///echo $string;
	}
	
	public function estrutura_orion($data, $customizacao){
		switch ($customizacao){
			case 'colarinho':
				$array = explode("/", $data->num_desc_componente_forro_colarinho);
				$array2 = explode("/", $data->num_desc_componente_forro_pala);
				$conteudo = "<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_materia_prima}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_materia_prima}</descricao>\n";
				$conteudo .= "</Materia-prima>\n";
				$conteudo .= "<Componentes>\n";
				$conteudo .= "\t<componente item=\"FORRO-COLARINHO\">\n";
				$conteudo .= "\t<numero>{$array[0]}</numero>\n";
				$conteudo .= "\t<descricao>{$array[1]}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t<componente item=\"FORRO-PALA\">\n";
				$conteudo .= "\t<numero>{$array2[0]}</numero>\n";
				$conteudo .= "\t<descricao>{$array2[1]}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "</Componentes>\n";
				return $conteudo;
			break;
			case 'cabedal':				
				$conteudo = "<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_materia_prima}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_materia_prima}</descricao>\n";
				$conteudo .= "</Materia-prima>\n";
				$conteudo .= "<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data->num_componente}</numero>\n";
				$conteudo .= "\t<descricao>{$data->desc_componente}</descricao>\n";
				$conteudo .= "\t</componente>\n";			
				$conteudo .= "</Componentes>\n";
				return $conteudo;
			break;
			case 'cadarco':				
				$conteudo = "<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_materia_prima}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_materia_prima}</descricao>\n";
				$conteudo .= "</Materia-prima>\n";
				$conteudo .= "<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data->num_componente}</numero>\n";
				$conteudo .= "\t<descricao>{$data->desc_componente}</descricao>\n";
				$conteudo .= "\t</componente>\n";			
				$conteudo .= "</Componentes>\n";
				return $conteudo;
			break;
			case 'solado':				
				$conteudo = "<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_materia_prima}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_materia_prima}</descricao>\n";
				$conteudo .= "</Materia-prima>\n";
				$conteudo .= "<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data->num_componente}</numero>\n";
				$conteudo .= "\t<descricao>{$data->desc_componente}</descricao>\n";
				$conteudo .= "\t</componente>\n";			
				$conteudo .= "</Componentes>\n";
				return $conteudo;
			break;
			case 'nylon':
				$arrayn = explode("-", $data->num_desc_componente);
				$conteudo = "<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_materia_prima}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_materia_prima}</descricao>\n";
				$conteudo .= "</Materia-prima>\n";
				$conteudo .= "<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero-descricao-1>{$arrayn[0]}</numero-descricao-1>\n";
				$conteudo .= "\t<numero-descricao-2>{$arrayn[1]}</numero-descricao-2>\n";
				$conteudo .= "\t<numero-descricao-3>{$arrayn[2]}</numero-descricao-3>\n";				
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t<componente item=\"ETIQUETA-PALA\">\n";
				$conteudo .= "\t<codigo>{$data->cod_etiqueta_pala}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_etiqueta_pala}</descricao>\n";
				$conteudo .= "\t<numero-componente>{$data->num_componente_etiqueta_pala}</numero-componente>\n";
				$conteudo .= "\t<descricao-componente>{$data->desc_componente_etiqueta_pala}</descricao-componente>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "</Componentes>\n";
				return $conteudo;
			break;
			case 'etiqueta':
				$conteudo = "<Combinatorio item=\"ETIQUETA\">\n";
				$conteudo .= "\t<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_etiqueta_pala}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_etiqueta_pala}</descricao>\n";
				$conteudo .= "\t</Materia-prima>\n";
				$conteudo .= "\t<Componentes>\n";				
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data->num_componente_etiqueta_pala}</numero>\n";
				$conteudo .= "\t<descricao>{$data->desc_componente_etiqueta_pala}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t</Componentes>\n";
				$conteudo .= "</Combinatorio>\n";				
				return $conteudo;
			break;
			case 'palmilha':
				$conteudo = "<Combinatorio item=\"PALMILHA\">\n";
				$conteudo .= "\t<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data['codigo-primo']}</codigo>\n";
				$conteudo .= "\t<descricao>{$data['materia-prima']}</descricao>\n";
				$conteudo .= "\t</Materia-prima>\n";
				$conteudo .= "\t<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data['numero-componente']}</numero>\n";
				$conteudo .= "\t<descricao>{$data['descricao-componente']}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t</Componentes>\n";
				$conteudo .= "</Combinatorio>\n";
				return $conteudo;
			break;
		}
	}
	
	public function estrutura_stride($data, $customizacao){
		switch ($customizacao){
			case 'colarinho':
				$array = explode("/", $data->num_desc_componente_forro_colarinho);
				$array2 = explode("/", $data->num_desc_componente_forro_pala);
				$conteudo = "<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_materia_prima}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_materia_prima}</descricao>\n";
				$conteudo .= "</Materia-prima>\n";
				$conteudo .= "<Componentes>\n";
				$conteudo .= "\t<componente item=\"FORRO-COLARINHO\">\n";
				$conteudo .= "\t<numero>{$array[0]}</numero>\n";
				$conteudo .= "\t<descricao>{$array[1]}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t<componente item=\"FORRO-PALA\">\n";
				$conteudo .= "\t<numero>{$array2[0]}</numero>\n";
				$conteudo .= "\t<descricao>{$array2[1]}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "</Componentes>\n";
				return $conteudo;
				break;
			case 'cabedal':
				$conteudo = "<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_materia_prima}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_materia_prima}</descricao>\n";
				$conteudo .= "</Materia-prima>\n";
				$conteudo .= "<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data->num_componente}</numero>\n";
				$conteudo .= "\t<descricao>{$data->desc_componente}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "</Componentes>\n";
				return $conteudo;
				break;
			case 'cadarco':
				$conteudo = "<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_materia_prima}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_materia_prima}</descricao>\n";
				$conteudo .= "</Materia-prima>\n";
				$conteudo .= "<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data->num_componente}</numero>\n";
				$conteudo .= "\t<descricao>{$data->desc_componente}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "</Componentes>\n";
				return $conteudo;
				break;
			case 'solado':
				$conteudo = "<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_materia_prima}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_materia_prima}</descricao>\n";
				$conteudo .= "</Materia-prima>\n";
				$conteudo .= "<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data->num_componente}</numero>\n";
				$conteudo .= "\t<descricao>{$data->desc_componente}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "</Componentes>\n";
				return $conteudo;
				break;
			case 'nylon':
				$arrayn = explode("\n", $data->num_desc_componente);
				$conteudo = "<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_materia_prima}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_materia_prima}</descricao>\n";
				$conteudo .= "</Materia-prima>\n";
				$conteudo .= "<Componentes>\n";
				$conteudo .= "\t<componente item=\"PALA\">\n";
				$conteudo .= "\t<numero-descricao-1>{$arrayn[0]}</numero-descricao-1>\n";
				$conteudo .= "\t<complemento item=\"PALA\">\n";
				$conteudo .= "\t<numero-descricao>{$arrayn[1]}</numero-descricao>\n";
				$conteudo .= "\t</complemento>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t<componente item=\"NYLON-LATERAL\">\n";
				$conteudo .= "\t<numero-descricao-1>{$arrayn[2]}</numero-descricao-1>\n";				
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t<componente item=\"ETIQUETA-PALA\">\n";
				$conteudo .= "\t<codigo>{$data->cod_etiqueta_pala}</codigo>\n";				
				$conteudo .= "\t<descricao>{$data->desc_etiqueta_pala}</descricao>\n";				
				$conteudo .= "\t<numero-componente>{$data->num_componente_etiqueta_pala}</numero-componente>\n";				
				$conteudo .= "\t<descricao-componente>{$data->desc_componente_etiqueta_pala}</descricao-componente>\n";				
				$conteudo .= "\t</componente>\n";
				$conteudo .= "</Componentes>\n";
				return $conteudo;
				break;
			case 'etiqueta':
				$conteudo = "<Combinatorio item=\"ETIQUETA\">\n";
				$conteudo .= "\t<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_etiqueta_pala}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_etiqueta_pala}</descricao>\n";
				$conteudo .= "\t</Materia-prima>\n";
				$conteudo .= "\t<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data->num_componente_etiqueta_pala}</numero>\n";
				$conteudo .= "\t<descricao>{$data->desc_componente_etiqueta_pala}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t</Componentes>\n";
				$conteudo .= "</Combinatorio>\n";
				return $conteudo;
				break;
			case 'palmilha':
				$conteudo = "<Combinatorio item=\"PALMILHA\">\n";
				$conteudo .= "\t<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data['codigo-primo']}</codigo>\n";
				$conteudo .= "\t<descricao>{$data['materia-prima']}</descricao>\n";
				$conteudo .= "\t</Materia-prima>\n";
				$conteudo .= "\t<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data['numero-componente']}</numero>\n";
				$conteudo .= "\t<descricao>{$data['descricao-componente']}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t</Componentes>\n";
				$conteudo .= "</Combinatorio>\n";
				return $conteudo;
				break;
			case 'traseiro':
				$conteudo = "<Combinatorio item=\"TRASEIRO\">\n";
				$conteudo .= "\t<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data['codigo']}</codigo>\n";
				$conteudo .= "\t<descricao>{$data['descricao']}</descricao>\n";
				$conteudo .= "\t</Materia-prima>\n";
				$conteudo .= "\t<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data['numero']}</numero>\n";
				$conteudo .= "\t<descricao>{$data['descricao2']}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t</Componentes>\n";
				$conteudo .= "</Combinatorio>\n";
				return $conteudo;
				break;
			case 'inserto':
				$conteudo = "<Combinatorio item=\"INSERTO\">\n";
				$conteudo .= "\t<Materia-prima>\n";
				$conteudo .= "\t<codigo>904.181.963</codigo>\n";
				$conteudo .= "\t<descricao>INSERTO 8020 PRATA</descricao>\n";
				$conteudo .= "\t</Materia-prima>\n";
				$conteudo .= "\t<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>3560</numero>\n";
				$conteudo .= "\t<descricao>INSERTO</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t</Componentes>\n";
				$conteudo .= "</Combinatorio>\n";
				return $conteudo;
				break;
			case 'amortecedor':
				$conteudo = "<Combinatorio item=\"AMOTECEDOR\">\n";
				$conteudo .= "\t<Materia-prima>\n";
				$conteudo .= "\t<codigo>904.182.963</codigo>\n";
				$conteudo .= "\t<descricao>AMORTECEDOR 8020 PRATA</descricao>\n";
				$conteudo .= "\t</Materia-prima>\n";
				$conteudo .= "\t<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>3550</numero>\n";
				$conteudo .= "\t<descricao>AMORTECEDOR</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t</Componentes>\n";
				$conteudo .= "</Combinatorio>\n";
				return $conteudo;
				break;
		}
	}
	
	public function estrutura_join($data, $customizacao){
		switch ($customizacao){
			case 'colarinho':
				$array = explode("/", $data->num_desc_componente_forro_colarinho);
				$array2 = explode("/", $data->num_desc_componente_forro_pala);
				$conteudo = "<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_materia_prima}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_materia_prima}</descricao>\n";
				$conteudo .= "</Materia-prima>\n";
				$conteudo .= "<Componentes>\n";
				$conteudo .= "\t<componente item=\"FORRO-COLARINHO\">\n";
				$conteudo .= "\t<numero>{$array[0]}</numero>\n";
				$conteudo .= "\t<descricao>{$array[1]}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t<componente item=\"FORRO-PALA\">\n";
				$conteudo .= "\t<numero>{$array2[0]}</numero>\n";
				$conteudo .= "\t<descricao>{$array2[1]}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "</Componentes>\n";
				return $conteudo;
				break;
			case 'cabedal':
				$conteudo = "<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_materia_prima}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_materia_prima}</descricao>\n";
				$conteudo .= "</Materia-prima>\n";
				$conteudo .= "<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data->num_componente}</numero>\n";
				$conteudo .= "\t<descricao>{$data->desc_componente}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "</Componentes>\n";
				return $conteudo;
				break;
			case 'cadarco':
				$conteudo = "<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_materia_prima}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_materia_prima}</descricao>\n";
				$conteudo .= "</Materia-prima>\n";
				$conteudo .= "<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data->num_componente}</numero>\n";
				$conteudo .= "\t<descricao>{$data->desc_componente}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "</Componentes>\n";
				return $conteudo;
				break;
			case 'solado':
				$conteudo = "<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_materia_prima}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_materia_prima}</descricao>\n";
				$conteudo .= "</Materia-prima>\n";
				$conteudo .= "<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data->num_componente}</numero>\n";
				$conteudo .= "\t<descricao>{$data->desc_componente}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "</Componentes>\n";
				return $conteudo;
				break;
			case 'nylon':
				$arrayn = explode("-", $data->num_desc_componente);
				$conteudo = "<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_materia_prima}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_materia_prima}</descricao>\n";
				$conteudo .= "</Materia-prima>\n";
				$conteudo .= "<Componentes>\n";
				$conteudo .= "\t<componente item=\"PALA\">\n";
				$conteudo .= "\t<numero-descricao-1>{$arrayn[0]}</numero-descricao-1>\n";
				$conteudo .= "\t<complemento item=\"PALA\">\n";
				$conteudo .= "\t<numero-descricao>{$arrayn[1]}</numero-descricao>\n";
				$conteudo .= "\t</complemento>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t<componente item=\"NYLON-LATERAL\">\n";
				$conteudo .= "\t<numero-descricao-1>{$arrayn[2]}</numero-descricao-1>\n";				
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t<componente item=\"ETIQUETA-PALA\">\n";
				$conteudo .= "\t<codigo>{$data->cod_etiqueta_pala}</codigo>\n";				
				$conteudo .= "\t<descricao>{$data->desc_etiqueta_pala}</descricao>\n";				
				$conteudo .= "\t<numero-componente>{$data->num_componente_etiqueta_pala}</numero-componente>\n";				
				$conteudo .= "\t<descricao-componente>{$data->desc_componente_etiqueta_pala}</descricao-componente>\n";				
				$conteudo .= "\t</componente>\n";
				$conteudo .= "</Componentes>\n";
				return $conteudo;
				break;
			case 'etiqueta':
				$conteudo = "<Combinatorio item=\"ETIQUETA\">\n";
				$conteudo .= "\t<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data->cod_etiqueta_pala}</codigo>\n";
				$conteudo .= "\t<descricao>{$data->desc_etiqueta_pala}</descricao>\n";
				$conteudo .= "\t</Materia-prima>\n";
				$conteudo .= "\t<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data->num_componente_etiqueta_pala}</numero>\n";
				$conteudo .= "\t<descricao>{$data->desc_componente_etiqueta_pala}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t</Componentes>\n";
				$conteudo .= "</Combinatorio>\n";
				return $conteudo;
				break;
			case 'palmilha':
				$conteudo = "<Combinatorio item=\"PALMILHA\">\n";
				$conteudo .= "\t<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data['codigo-primo']}</codigo>\n";
				$conteudo .= "\t<descricao>{$data['materia-prima']}</descricao>\n";
				$conteudo .= "\t</Materia-prima>\n";
				$conteudo .= "\t<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data['numero-componente']}</numero>\n";
				$conteudo .= "\t<descricao>{$data['descricao-componente']}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t</Componentes>\n";
				$conteudo .= "</Combinatorio>\n";
				return $conteudo;
				break;
			case 'biqueira':
				$conteudo = "<Combinatorio item=\"BIQUEIRA\">\n";
				$conteudo .= "\t<Materia-prima>\n";
				$conteudo .= "\t<codigo>{$data['codigo']}</codigo>\n";
				$conteudo .= "\t<descricao>{$data['descricao']}</descricao>\n";
				$conteudo .= "\t</Materia-prima>\n";
				$conteudo .= "\t<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>{$data['numero']}</numero>\n";
				$conteudo .= "\t<descricao>{$data['descricao2']}</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t</Componentes>\n";
				$conteudo .= "</Combinatorio>\n";
				return $conteudo;
				break;
			case 'inserto':
				$conteudo = "<Combinatorio item=\"INSERTO\">\n";
				$conteudo .= "\t<Materia-prima>\n";
				$conteudo .= "\t<codigo>904.190.963</codigo>\n";
				$conteudo .= "\t<descricao>INSERTO 9650 PRATA</descricao>\n";
				$conteudo .= "\t</Materia-prima>\n";
				$conteudo .= "\t<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>3560</numero>\n";
				$conteudo .= "\t<descricao>INSERTO</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t</Componentes>\n";
				$conteudo .= "</Combinatorio>\n";
				return $conteudo;
				break;
			case 'sdianteira':
				$conteudo = "<Combinatorio item=\"SOLETA-DIANTEIRA\">\n";
				$conteudo .= "\t<Materia-prima>\n";
				$conteudo .= "\t<codigo>904.192.902</codigo>\n";
				$conteudo .= "\t<descricao>SOLETA DIANTEIRA 9650 PRETO</descricao>\n";
				$conteudo .= "\t</Materia-prima>\n";
				$conteudo .= "\t<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>3520</numero>\n";
				$conteudo .= "\t<descricao>SOLA DIANTEIRA</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t</Componentes>\n";
				$conteudo .= "</Combinatorio>\n";
				return $conteudo;
				break;
			case 'straseira':
				$conteudo = "<Combinatorio item=\"SOLETA-TRASEIRA\">\n";
				$conteudo .= "\t<Materia-prima>\n";
				$conteudo .= "\t<codigo>904.193.902</codigo>\n";
				$conteudo .= "\t<descricao>SOLETA TRASEIRA 9650 PRETO</descricao>\n";
				$conteudo .= "\t</Materia-prima>\n";
				$conteudo .= "\t<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>3530</numero>\n";
				$conteudo .= "\t<descricao>SOLA TRASEIRA</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t</Componentes>\n";
				$conteudo .= "</Combinatorio>\n";
				return $conteudo;
				break;
			case 'estabilizador':
				$conteudo = "<Combinatorio item=\"ESTABILIZADOR\">\n";
				$conteudo .= "\t<Materia-prima>\n";
				$conteudo .= "\t<codigo>904.191.963</codigo>\n";
				$conteudo .= "\t<descricao>ESTABILIZADOR 9650 PRATA</descricao>\n";
				$conteudo .= "\t</Materia-prima>\n";
				$conteudo .= "\t<Componentes>\n";
				$conteudo .= "\t<componente>\n";
				$conteudo .= "\t<numero>3540</numero>\n";
				$conteudo .= "\t<descricao>ESTABILIZADOR</descricao>\n";
				$conteudo .= "\t</componente>\n";
				$conteudo .= "\t</Componentes>\n";
				$conteudo .= "</Combinatorio>\n";
				return $conteudo;
				break;
		}
	}
	public function receipt($codigo, $computer, $codigo_centauro){
		
		$this->load->model("definicoesTenis_model");
		$this->xmldb->comfirmacao($codigo, $computer, $codigo_centauro);
		// abaixo retorna em linhas os dados correspondete ao tenins customizado em questao
		$xml_data = $this->xmldb->lista_xml($codigo);
		$array = explode("?",$xml_data->url);
		$modelo_tenis = array_reverse(explode("/",$xml_data->url));
		$modelo_tenis = explode("?", $modelo_tenis[0]);
		$modelo_tenis = $modelo_tenis[0];
		parse_str($array[1],$_GET);
		$data['GET'] = $_GET;
		$predefinidoGet = false;
		//Definição DE get
		$setersGet = null;
			if(isset($_GET['sexo']) && isset($_GET['numeracao']))
			{
				//URL
				$keyArrayGET = array_keys($_GET);
				foreach($keyArrayGET AS $keyGET)
				{
					$setersGet[] = $keyGET."=".$_GET[$keyGET];
				}
				$setersGet = implode("&",$setersGet);
				$setersGet = "?".$setersGet;
				//FIM
				$data['setersGet'] = $this->definicoesTenis_model->GetCustonSETS($_GET,true,$modelo_tenis);
				$data['listSVGSetedGET'] = $this->definicoesTenis_model->GetTennisSvg($modelo_tenis,45);
			}
			//fim	
		$data['pedido'] = $codigo_centauro;			
		$data['datapedido'] = $this->data_extenso();
		$this->load->view('receipt_view', $data);
		
	}
	function data_extenso(){
		$dia = date('d');
		$mes = date('m');
		$ano = date('Y');
		
		switch ($mes){		
			case 1: $nmes = "Janeiro"; break;
			case 2: $nmes = "Fevereiro"; break;
			case 3: $nmes = "Mar�o"; break;
			case 4: $nmes = "Abril"; break;
			case 5: $nmes = "Maio"; break;
			case 6: $nmes = "Junho"; break;
			case 7: $nmes = "Julho"; break;
			case 8: $nmes = "Agosto"; break;
			case 9: $nmes = "Setembro"; break;
			case 10: $nmes = "Outubro"; break;
			case 11: $nmes = "Novembro"; break;
			case 12: $nmes = "Dezembro"; break;		
		}
		
		$data_por_extenso = "$dia de $nmes de $ano.";
		return $data_por_extenso;
	}
}
/* Location: ./application/controllers/home.php */