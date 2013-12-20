<div>
	<?php	
	echo form_open_multipart('admin/tennis/adicionar');
		
		echo "<span style='color:red'>" . validation_errors() . "</span>";
		
		echo form_fieldset('Cadastrar Tennis');
		
			echo form_label('Modelo: ','modelo');
			$array[''] = "--SELECIONE--";
			foreach($modelos as $modelo){
				$array[$modelo->id] = $modelo->nome;
			}
			echo form_dropdown('modelo',$array);
			echo '<br>';
			
			echo form_label('IMGPERFIL: ','imgperfil');
			$attr = array('name'=>'imgperfil', 'id'=>'imgperfil');
			echo form_upload($attr);
			echo '<br>';
			
			echo form_label('IMG45: ','img45');
			$attr = array('name'=>'img45', 'id'=>'img45');
			echo form_upload($attr);
			echo '<br>';
			
			echo form_label('IMGFRENTE: ','imgfrente');
			$attr = array('name'=>'imgfrente', 'id'=>'imgfrente');
			echo form_upload($attr);
			echo '<br>';
			
			echo form_label('IMG145: ','img145');
			$attr = array('name'=>'img145', 'id'=>'img145');
			echo form_upload($attr);
			echo '<br>';
			
			echo form_label('IMGSOLADO: ','imgsolado');
			$attr = array('name'=>'imgsolado', 'id'=>'imgsolado');
			echo form_upload($attr);
			echo '<br>';
			
			echo form_submit('bntSubmit','Cadastrar');
			echo anchor('admin/tennis','Voltar','Voltar');
		echo form_fieldset_close();		
	echo form_close();
	?>
</div>