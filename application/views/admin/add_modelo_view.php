	<div>
	<?php
		echo form_open_multipart(base_url('admin/modelo/cadastrar'));
			
			echo form_fieldset("Cadastrar Modelo");
									
				echo "<span style='color:red'>" . validation_errors() . "</span>";
			
				echo form_label("Nome: ","nome");
				$attr = array('name'=>'nome', 'id'=>'nome');
				echo form_input($attr);
				
				echo '<br>';
				
				echo form_label('Foto Principal: ', 'userfile');
				$attr = array('name'=>'userfile', 'id'=>'userfile');
				echo form_upload($attr);
				
				echo '<br>';
				
				$attr = array('name' => 'voltar','type'=>'button', 'value'=>'Voltar', 'onclick'=>'history.go(-1)');
				echo form_input($attr);
				
				echo form_submit("bntSubmit","Cadastrar");		
			echo form_fieldset_close();
			
		echo form_close();
	?>
	</div>