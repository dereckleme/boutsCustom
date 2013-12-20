<div>
	<?php 
	$array_detalhes = array(
	 	'Perspectiva: ',
		$customs->descricao,
		'Tennis: ',
		$customs->tennis,
		'Customização: ',
		$customs->tipocustom,
		'Eixo X: ',
		$customs->posicao_x,
		'Eixo Y: ',
		$customs->posicao_y,
		'Código da matéria prima: ',
		$customs->cod_materia_prima,
		'Descrição da matéria prima: ',
		$customs->desc_materia_prima,
		'Número Componente: ',
		$customs->num_componente,
		'Descrição Componente: ',
		$customs->desc_componente,
		'Nº/ Descrição Componente Forro Colarinho: ',
		$customs->num_desc_componente_forro_colarinho,
		'Nº/ Descrição Componente Forro Pala: ',
		$customs->num_desc_componente_forro_pala,
		'Nº/ Descrição Componente: ',
		$customs->num_desc_componente,
		'Código etiqueta pala: ',
		$customs->cod_etiqueta_pala,
		'Descrição etiqueta pala: ',
		$customs->desc_etiqueta_pala,
		'Nº Componente etiqueta pala: ',
		$customs->num_componente_etiqueta_pala,
		'Descrição Componente etiqueta pala: ',
		$customs->desc_componente_etiqueta_pala,
		'Imagem da Customização: ',
		img(array('src'=>base_url("assets/images/".$customs->imagem_custom), 'width'=>'120', 'height'=>'100'))
	);	
	$new_list = $this->table->make_columns($array_detalhes, 2);
	echo $this->table->generate($new_list);
	?>
</div>