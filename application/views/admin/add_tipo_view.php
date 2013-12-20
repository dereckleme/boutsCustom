<div>
	<?php	
	echo form_open('admin/tipoCustom/adicionar');
		
		echo form_fieldset('Cadastrar Tipos de Customizações');
		
			echo "<span style='color:red'>" . validation_errors() . "</span>";
			
			echo form_label('Tennis ', 'idtennis');
			$array[''] = "--SELECIONE--";
			foreach($tennis as $ten){
				$array[$ten->id] = $ten->nome;
			}
			echo form_dropdown('idtennis',$array);
			echo '<br>';
			
			echo form_label('Custom ', 'nome');			
			$attr = array('name'=>'nome', 'id'=>'nome');
			echo form_input($attr);
			echo '<br>';
			
			echo form_label('Descrição ', 'descricao');			
			$attr = array('name'=>'descricao', 'id'=>'descricao');
			echo form_input($attr);
			echo '<br>';
			
			echo form_label('Posição Y ', 'posicaoy');			
			$attr = array('name'=>'posicaoy', 'id'=>'posicaoy');
			echo form_input($attr);
			echo '<br>';
			
			echo form_label('Posição X ', 'posicaox');			
			$attr = array('name'=>'posicaox', 'id'=>'posicaox');
			echo form_input($attr);
			echo '<br>';
			
			echo form_submit('bntSubmit','Cadastrar');						
		echo form_fieldset_close();		
	echo form_close();
	?>
</div>