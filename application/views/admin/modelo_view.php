<div>
	<p>
	<?php 
		echo anchor(base_url('admin'), 'Voltar');
	?>
	</p>
	<?php 
	echo heading("Modelos Cadastrados", 2);
	
	$array_modelos = array();
	foreach($modelos as $modelo){
		$push = array(
			$modelo->nome,	
			img(array('src'=>base_url("assets/images/".$modelo->image_default), 'width'=>'120', 'height'=>'100')),
			$modelo->slug_modelo,			
			anchor(
				base_url("admin/modelo/editar/" . $modelo->id),
				'editar'				
			),
			anchor(
				base_url("admin/modelo/excluir/" . $modelo->id),
				'excluir',
				array('onclick'=>"return confirm('Comfirma a exclusão deste Modelo?')")
			)
		);
		array_push($array_modelos, $push);
	}
	?>
	
	<div>
	<?php 
		$this->table->set_heading('Modelo', 'Image Default', 'Slug', 'Editar', 'Excluir');
		echo $this->table->generate($array_modelos);
	?>
	</div>
	
	<p>
	<?php 
		echo anchor(base_url('admin'), 'Voltar');
	?>
	</p>
</div>