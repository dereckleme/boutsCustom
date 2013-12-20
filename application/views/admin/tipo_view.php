<div>
	<p>
	<?php 
		echo anchor(base_url('admin'), 'Voltar');
	?>
	</p>
		
	<?php 
	echo heading("Tipos de Customizações Cadastrados", 2);
	
	$array_tipos = array();
	foreach($tipos as $tipo){
		$push = array(
			$tipo->tennis,
			$tipo->nome,
			$tipo->descricao,
			$tipo->posicao_y,
			$tipo->posicao_x,
			anchor(base_url('admin/tipoCustom/editar/'.$tipo->id),'editar'),
			anchor(base_url('admin/tipoCustom/excluir/'.$tipo->id),'excluir', array('onclick'=>"return confirm('Comfirma a exclus�o deste item?')"))
		);
		array_push($array_tipos, $push);
	}
	?>
	
	<div>
	<?php 
		$this->table->set_heading('Modelo', 'Custom', 'Descrição', 'Posição Y', 'Posição X', 'Editar', 'Excluir');
		echo $this->table->generate($array_tipos);
	?>
	</div>
	
	<p>
	<?php 
		echo anchor(base_url('admin'), 'Voltar');
	?>
	</p>
</div>