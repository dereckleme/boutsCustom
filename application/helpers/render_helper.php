<?
$codeigniter = & get_instance();
$codeigniter->load->model('definicoesTenis_model');
	$nome_ar = null;
	foreach($_POST AS $dados_test)
	{
		$nome_ar .= $dados_test;
	}
	if(!is_file("./assets/images/render/$nome_ar.png"))
	{
		$arrayCustom = $codeigniter->definicoesTenis_model->GetCustonSETS($_POST);
		
		if($_POST['perspectiva'] == 0) $fundo = $arrayCustom[0]['imagem_frente'];
		if($_POST['perspectiva'] == 45) $fundo = $arrayCustom[0]['imagem_frontal'];
		if($_POST['perspectiva'] == 270) $fundo = $arrayCustom[0]['imagem_vertical'];
		if($_POST['perspectiva'] == 145) $fundo = $arrayCustom[0]['imagem_horizontal'];
		if($_POST['perspectiva'] == 90) $fundo = $arrayCustom[0]['imagem_solo'];
		
		$backgroundSource = "./assets/images/$fundo";
		$source = imagecreatefrompng($backgroundSource);
		imagesavealpha($source,true);
		foreach($arrayCustom AS $linha)
		{	
				if(!empty($linha['imagem_custom']))
				{
					$marca=imagecreatefrompng("./assets/images/$linha[imagem_custom]");     // não esquecer de verificar o nome do arquivo
					imagecopyresampled($source,$marca,$linha['posicao_x'],$linha['posicao_y'],0,0,imagesx($marca),imagesy($marca),imagesx($marca),imagesy($marca));
				}	
		}
		imagepng($source,"./assets/images/render/$nome_ar.png",false,100);
	}
	$list_svg = $codeigniter->definicoesTenis_model->GetTennisSvg($_POST['slug_modelo'],$_POST['perspectiva']);
?>
<svg width="821" height="480" xmlns="http://www.w3.org/2000/svg"  style="background-image: url('<?=base_url()?>assets/images/render/<?=$nome_ar?>.png?uf=<?=time()?>');">
		<?
			foreach($list_svg AS $desenho)
			{
				?>
				<a xlink:href="#" id="svg_<?=$desenho['slug_tipo_custom']?>" rev="<?=$desenho['slug_tipo_custom']?>" rel="<?=$desenho['id_custom']?>" style="opacity:0.00">
					<g>
						<?=$desenho['svgxml']?>
					</g>
				</a>	
				<?
			}
		?>
	</svg>