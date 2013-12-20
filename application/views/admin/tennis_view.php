<div>
	<p>
	<?php 
		echo anchor(base_url('admin'), 'Voltar');
	?>
	</p>
		
	<?php 
	echo heading("Tennis Cadastrados", 2);
	
	$array_tennis = array();
	foreach($tennis as $tenni){
		$push = array(
			$tenni->nome,	
			img(array('src'=>base_url("assets/images/".$tenni->imagem_frente), 'width'=>'120', 'height'=>'100')),
			img(array('src'=>base_url("assets/images/".$tenni->imagem_frontal), 'width'=>'120', 'height'=>'100')),
			img(array('src'=>base_url("assets/images/".$tenni->imagem_vertical), 'width'=>'120', 'height'=>'100')),
			img(array('src'=>base_url("assets/images/".$tenni->imagem_horizontal), 'width'=>'120', 'height'=>'100')),
			img(array('src'=>base_url("assets/images/".$tenni->imagem_solo), 'width'=>'120', 'height'=>'100')),
			anchor(
				base_url("admin/tennis/editar/" . $tenni->id),
				'editar'				
			),
			anchor(
				base_url("admin/tennis/excluir/" . $tenni->id),
				'excluir',
				array('onclick'=>"return confirm('Comfirma a exclusão deste Tennis?')")
			)
		);
		array_push($array_tennis, $push);
	}
	?>
	
	<div>
	<?php 
		$this->table->set_heading('Modelo', 'Perfil', '45&deg; Graus', 'Frente', '145&deg; Graus', 'Solado', 'Editar', 'Excluir');
		echo $this->table->generate($array_tennis);
	?>
	</div>
	
	<p>
	<?php 
		echo anchor(base_url('admin'), 'Voltar');
	?>
	</p>
</div>