<div>
	<p>
	<?php 
		echo anchor(base_url('admin'), 'Voltar');
	?>
	</p>
		
	<?php 
	echo heading("Svg Cadastrados", 2);
	
	$array_svg = array();
	foreach($svg as $dados){
		$push = array(
			$dados['modelo'],
			$dados['descricao'],
			$dados['svgxml'],
			anchor(base_url('admin/svg/editar/'.$dados['id']),'editar'),
			anchor(base_url('admin/svg/excluir/'.$dados['id']),'excluir', array('onclick'=>"return confirm('Comfirma a exclusão deste Svg?')"))
		);
		array_push($array_svg, $push);
	}
	?>
	
	<div>
	<?php 
		$this->table->set_heading('Modelo', 'Perspectiva', 'Svg Xml', 'Editar', 'Excluir');
		echo $this->table->generate($array_svg);
	?>
	</div>
	
	<p>
	<?php 
		echo anchor(base_url('admin'), 'Voltar');
	?>
	</p>
</div>