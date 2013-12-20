<div>
	<?php	
	echo form_open('admin/svg/adicionar');
		
		echo form_fieldset('Cadastrar Svg');
		
			echo "<span style='color:red'>" . validation_errors() . "</span>";
			
			echo form_label('Tennis ', 'tennis');
			$array[''] = "--SELECIONE--";
			foreach($tennis as $ten){
				$array[$ten->id] = $ten->nome;
			}
			echo form_dropdown('idtennis',$array);
			echo '<br>';
			
			echo form_label('Perspectiva ', 'perspectiva');
			$array[''] = "--SELECIONE--";
			foreach($perspectivas as $perspectiva){
				$array[$perspectiva->id] = $perspectiva->descricao;
			}
			echo form_dropdown('idperspectiva',$array);
			echo '<br>';
			
			echo form_label('Texto:', 'texto');
			echo '<br>';
			$attr = array('name'=>'texto', 'id'=>'texto');
			echo form_textarea($attr);
			echo '<br>';
			
			echo form_submit('bntSubmit','Cadastrar');						
		echo form_fieldset_close();		
	echo form_close();
	?>
</div>