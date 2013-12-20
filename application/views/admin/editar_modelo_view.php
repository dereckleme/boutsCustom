<div>	
	<?php 
	echo heading("Editar Modelo", 2);
	
	$hidden = array('idmodelo'=>$modelo->id, 'foto'=> $modelo->image_default);	
	echo form_open_multipart('admin/modelo/gravar_alteracao', '', $hidden);
		
		echo form_fieldset("Editar Modelo");
			
			echo form_label("Nome: ","nome");
			$attr = array('name'=>'nome', 'id'=>'nome', 'value'=>$modelo->nome);
			echo form_input($attr);
			
			echo '<br>';
			
			echo "<span>";
			echo anchor_popup( base_url('assets/images/'.$modelo->image_default),
				img(array('src'=>base_url('assets/images/'.$modelo->image_default), 'width'=>100, 'height'=>100) )
			);
			echo "</span>";
			
			echo '<br>';
			
			echo form_label('Foto Principal: ', 'userfile');
			$attr = array('name'=>'userfile', 'id'=>'userfile');
			echo form_upload($attr);
			
			echo '<br>';
			echo form_submit("bntSubmit","Alterar");
		echo form_fieldset_close();
		
	echo form_close();
	?>
	
	<p>
	<?php 
		echo anchor(base_url('admin/modelo'), 'Voltar');
	?>
	</p>
</div>