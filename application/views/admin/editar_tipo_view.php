<div>
	<?php	
	$hidden = array('idtipo'=>$tipo->id);
	echo form_open('admin/tipoCustom/gravar_alteracao', '', $hidden);
		
		echo form_fieldset('Alterar tipo de customização');
		
			echo "<span style='color:red'>" . validation_errors() . "</span>";
			
			echo form_label('Tennis ', 'idtennis');
			$array[''] = "--SELECIONE--";
			foreach($tennis as $ten){
				$array[$ten->id] = $ten->nome;
			}
			echo form_dropdown('idtennis',$array, $tipo->idtennis);
			echo '<br>';
			
			echo form_label('Custom ', 'nome');			
			$attr = array('name'=>'nome', 'id'=>'nome', 'value'=>$tipo->nome);
			echo form_input($attr);
			echo '<br>';
			
			echo form_label('Descrição ', 'descricao');			
			$attr = array('name'=>'descricao', 'id'=>'descricao', 'value'=>$tipo->descricao);
			echo form_input($attr);
			echo '<br>';
			
			echo form_label('Posição Y ', 'posicaoy');			
			$attr = array('name'=>'posicaoy', 'id'=>'posicaoy', 'value'=>$tipo->posicao_y);
			echo form_input($attr);
			echo '<br>';
			
			echo form_label('Posição X ', 'posicaox');			
			$attr = array('name'=>'posicaox', 'id'=>'posicaox', 'value'=>$tipo->posicao_x);
			echo form_input($attr);
			echo '<br>';
			
			echo form_submit('bntSubmit','Alterar');						
		echo form_fieldset_close();		
	echo form_close();
	?>
	
	<p>
	<?php 
		echo anchor(base_url('admin/tipoCustom'), 'Voltar');
	?>
	</p>
</div>