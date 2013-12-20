<div id="conteudoGeral">


<div id="esquerda">
  <h3 class="titulo"><img src="<?=base_url()?>assets/img/personalizar.png" alt="Personalize seu tênis" title="Personalize seu tênis" /></h3>
     
     <div id="tenisCustomizacao">
			
		   <?
			foreach($seters AS $set)
			{
					if($set['tipo'] == "risca")
					{
				?>
					<div style="position:absolute;z-index:1;top:<?=$set['posicao_y']?>px;left:<?=$set['posicao_x']?>px;" class="<?=$set['slug_tipo_custom']."_".$set['tipo']?>"><img src="<?=base_url()?>assets/images/<?=$set['imagem']?>"/></div>
				<?
					}
					else
					{
						?>
						<div class="<?=$set['slug_tipo_custom']."_".$set['tipo']?>" style="position:absolute;z-index:3;top:<?=$set['posicao_y']?>px;left:<?=$set['posicao_x']?>px;font-weight:bold">
						<a class="personalizar" rel="<?=$set['idtipocustom']?>" rev="<?=$set['slug_tipo_custom']?>" href="" style="position:absolute; width:60px; height:61px;display:block"></a>
						<?if($set['posicao_y'] > 522)
						{?>
					       <embed src="<?=base_url()?>assets/img/btnCusomizacao_preto.swf"  wmode="transparent"   width="60" height="61"></embed>
						   <?
						   }
						   else
						   {
						   ?>
						   <embed src="<?=base_url()?>assets/img/btnCusomizacao.swf"  wmode="transparent"   width="60" height="61"></embed>
						   <?
						   }
						   ?>
						  <a href="#" class="personalizar" style="font-size:14px; color:#FFF; text-transform:uppercase; text-decoration:none; margin-top:10px; margin-left:16px" rel="<?=$set['idtipocustom']?>" rev="<?=$set['slug_tipo_custom']?>"><span <?if($set['posicao_y'] > 522) print 'style="color:black"';?>>Personalizar</span><br /><span class="parteTenis"><?=$set['nome']?></span></a>
						</div>
						<?
					}
			}
		   ?>
           <div id="tenisRender" style="color:#9C0">            
					<div id="tenisRender1">
					<?
					if(isset($_GET['sexo']) && isset($_GET['numeracao']))
			{
				
					$nome_ar = null;
					unset($_GET['sexo']);
					unset($_GET['numeracao']);
					foreach($_GET AS $dados_test)
					{
						$nome_ar .= $dados_test;
					}
	if(!is_file("./assets/images/render/$nome_ar.png"))
	{
		$arrayCustom = $setersGet;
		
		$fundo = $arrayCustom[0]['imagem_frontal'];
		
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
	$list_svg = $listSVGSetedGET;
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
					
			<?
			}
			else
			{
				?>
				<svg width="821" height="480" xmlns="http://www.w3.org/2000/svg"  style="background-image: url('<?=base_url()?>assets/images/<?=$tennis['imagem_frontal']?>');">
						<?
							foreach($svg AS $desenho)
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
				<?
			}
			?>		
					</div>
					<div id="tenisRender2">
					
					</div>              
           </div>
     </div>
      <div id="btnCustomizacao">
	  
	    <a href="#" class="NextDireita"><img src="<?=base_url()?>assets/img/mover_esquerda.png" alt="Mover direita" title="Mover direita" /></a>
	    <a href="#" class="NextEsquerda"><img src="<?=base_url()?>assets/img/mover_direita.png" alt="Mover esquerda" title="Mover esquerda" /></a>
         
      </div>    
</div>   

<div id="direita">
       <a href="#" class="BtnConcluir"><img src="<?=base_url()?>assets/img/continuar.png" /></a>
       <a href="<?=base_url()?>custom/selecione" class="BtnVoltar"><img src="<?=base_url()?>assets/img/voltar.png" /></a>
      
       <div id="boxCustom">
             <div id="box_TopCustom">
                 <div id="TopCustom_Sexo" >
                     <h4><span class="bordaVermelha">Selecione o sexo</span><div id="testDefixn"></div></h4>                                         
                     <a href="" class="masculino" style="background:#e92715; color:#FFF; border-radius:10px" rel="masculino">Masculino</a>
                     <a href="" class="feminino" rel="feminino">Feminino</a>
                 </div>
                 <div id="TopCustom_Tamanho" style="margin-top:30px; margin-bottom:30px;">
                     <h4 style="margin-bottom:50px;"><span class="bordaVermelha"> numeração</span></h4>                   
                     <a href="" class="number" rev="34" style="background:#e92715; color:#FFF">34</a>
                     <a href="" class="number" rev="35">35</a> 
                     <a href="" class="number" rev="36">36</a> 
                     <a href="" class="number" rev="37">37</a>  
                     <a href="" class="number" rev="38">38</a> 
                     <a href="" class="number" rev="39">39</a>
                     <br /> 
                     <br /> 
                     <br /> 
                     <a href="" class="number" rev="40">40</a>
                     <a href="" class="number" rev="41">41</a>  
                     <a href="" class="number" rev="42">42</a> 
                     <a href="" class="number" rev="43">43</a>
                     <a href="" class="number" rev="44">44</a>                                      
                 </div>
             </div>
             <div id="box_BottomCustom">
               <h4><span class="bordaVermelha">Crie seu estilo</span></h4> 
              <p>Se preferir, selecione um ponto de partida</p>
			  <?
					foreach($listItensRand AS $randed)
					{
			  ?>
               <a href="<?=$randed['slug']?>" class="corCustom"><img width="80" style="margin-top:10px;" src="<?=base_url()?>assets/images/render/<?=$randed['imagem']?>"/></a>
               <?
					}
			   ?>
             </div>

</div>

</div>
 
</body>
</html>