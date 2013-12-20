<center><h1>CUSTOM</h1></center>

<div id="tenisRender">
	<div id="tenisRender1">
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
	</div>
	<div id="tenisRender2">
	
	</div>
</div>
<div id="boxCustom">
	<div id="box_TopCustom">
			<div id="TopCustom_Tamanho">tamanho</div>
			<div id="TopCustom_Sexo">sexo / Mas/Fem</div>
	</div>
	<div id="box_BottomCustom">
			Custom Definição
	</div>
</div>

<a href="#" class="NextEsquerda">MOVER ESQUERDA</a><BR/>
<a href="#" class="NextDireita">MOVER DIREITA</a>




<a href="" class="teste_render">teste RENDER</a><br/>
<a href="" class="set_Transparencia">Teste Transparencia</a>
<div class="debug"><br/><br/></div>