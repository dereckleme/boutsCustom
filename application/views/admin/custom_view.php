<div>
	<p>
	<?php 
		echo anchor(base_url('admin'), 'Voltar');
	?>
	</p>
	<?php
	echo heading("Customizações Cadastradas", 2);
	
	$array_customs = array();
	foreach($customs as $custom){
		$push = array(
			$custom->tennis,
			$custom->descricao,
			$custom->tipocustom,
			$custom->posicao_y,
			$custom->posicao_x,
			img(array('src'=>base_url("assets/images/".$custom->imagem_custom), 'width'=>'120', 'height'=>'100')),			
			anchor_popup(
				base_url("admin/custom/ver/" . $custom->id), 
				'Detalhes', 
				$atributos
			),
			anchor(
				base_url("admin/custom/editar/" . $custom->id),
				'editar'				
			),
			anchor(
				base_url("admin/custom/excluir/" . $custom->id),
				'excluir',
				array('onclick'=>"return confirm('Comfirma a exclusão deste Modelo?')")
			)
		);
		array_push($array_customs, $push);
	}
	?>
	
	<div>
	<?php 
		$this->table->set_heading('Modelo', 'Perspectiva', 'Custom', 'Eixo Y', 'Eixo X', 'Image Default', 'Visualização', 'Editar', 'Excluir');
		echo $this->table->generate($array_customs);
	?>
	</div>
	
	<p>
	<?php 
		echo anchor(base_url('admin'), 'Voltar');
	?>
	</p>
</div>