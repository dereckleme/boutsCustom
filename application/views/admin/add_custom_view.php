<div>
	<?php	
	echo form_open_multipart('admin/custom/adicionar');

		echo "<span style='color:green;font-weight:bold'>Os campos que não serão preenchidos, favor
		colocar NULL!</span>";
	
		echo form_fieldset('Cadastrar Customização');
			
			echo "<span style='color:red'>" . validation_errors() . "</span>";
			
			echo form_label('Perspectiva ', 'perspectiva');
			$array[''] = "--SELECIONE--";
			foreach($perspectivas as $perspectiva){
				$array[$perspectiva->id] = $perspectiva->descricao;
			}
			echo form_dropdown('idperspectiva',$array);
			echo '<br>';
			
			echo form_label('Tennis ', 'tennis');
			$array2[''] = "--SELECIONE--";
			foreach($tennis as $ten){
				$array2[$ten->id] = $ten->nome;
			}
			echo form_dropdown('idtennis',$array2);
			echo '<br>';
			
			echo form_label('Tipo de Customização ', 'idtipocustom');
			$array3[''] = "--SELECIONE--";
			foreach($customtipos as $customtipo){
				$array3[$customtipo->id] = $customtipo->nome;
			}
			echo form_dropdown('idtipocustom',$array3);
			echo '<br>';
			
			echo form_label('Posição Y ', 'posicaoy');
			$attr = array('name'=>'posicaoy', 'id'=>'posicaoy');
			echo form_input($attr);
			echo '<br/>';
			
			echo form_label('Posição X ', 'posicaox');
			$attr = array('name'=>'posicaox', 'id'=>'posicaox');
			echo form_input($attr);
			echo '<br/>';
			
			echo form_label('Codigo matéria prima ', 'codmateriaprima');
			$attr = array('name'=>'codmateriaprima', 'id'=>'codmateriaprima');
			echo form_input($attr);
			echo '<br/>';
			
			echo form_label('Descrição matéria prima ', 'descmateriaprima');
			$attr = array('name'=>'descmateriaprima', 'id'=>'descmateriaprima');
			echo form_input($attr);
			echo '<br/>';
			
			echo form_label('Número do componente ', 'numdocomponente');
			$attr = array('name'=>'numdocomponente', 'id'=>'numdocomponente');
			echo form_input($attr);
			echo '<br/>';
			
			echo form_label('Descrição componente ', 'desccomponente');
			$attr = array('name'=>'desccomponente', 'id'=>'desccomponente');
			echo form_input($attr);
			echo '<br/>';
			
			echo form_label('Nº/Descrição componente forro colarinho ', 'forrocolarinho');
			$attr = array('name'=>'forrocolarinho', 'id'=>'forrocolarinho');
			echo form_input($attr);
			echo '<br/>';
			
			echo form_label('Nº/Descrição componente forro pala ', 'forropala');
			$attr = array('name'=>'forropala', 'id'=>'forropala');
			echo form_input($attr);
			echo '<br/>';
			
			echo form_label('Nº/Descrição componente ', 'numdesccomponente');
			$attr = array('name'=>'numdesccomponente', 'id'=>'numdesccomponente', 'rows'=>2, 'cols'=>40);
			echo form_textarea($attr);
			echo '<br/>';
			
			echo form_label('Código etiqueta pala ', 'codetiquetapala');
			$attr = array('name'=>'codetiquetapala', 'id'=>'codetiquetapala');
			echo form_input($attr);
			echo '<br/>';
			// text area
			echo form_label('Descrição etiqueta pala ', 'descetiquetapala');
			$attr = array('name'=>'descetiquetapala', 'id'=>'descetiquetapala');
			echo form_input($attr);
			echo '<br/>';
			
			echo form_label('Número componente etiqueta pala ', 'numcompetiquetapala');
			$attr = array('name'=>'numcompetiquetapala', 'id'=>'numcompetiquetapala');
			echo form_input($attr);
			echo '<br/>';
			
			echo form_label('Descrição componente etiqueta pala ', 'desccompetiquetapala');
			$attr = array('name'=>'desccompetiquetapala', 'id'=>'desccompetiquetapala');
			echo form_input($attr);
			echo '<br/>';
			
			echo form_label('Foto ', 'userfile');
			$attr = array('name'=>'userfile', 'id'=>'userfile');
			echo form_upload($attr);
			echo '<br/>';
			
			echo form_submit('bntSubmit','Cadastrar');						
		echo form_fieldset_close();		
	echo form_close();
	?>
</div>