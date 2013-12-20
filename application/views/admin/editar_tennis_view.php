<div>
	<?php
	$hidden = array(
		'idtennis'=>$tennis->id,
		'imgperfil'=>$tennis->imagem_frente,
		'img45'=>$tennis->imagem_frontal,
		'imgfrente'=>$tennis->imagem_vertical,
		'img145'=>$tennis->imagem_horizontal,
		'imgsolado'=>$tennis->imagem_solo
	);
	echo form_open_multipart('admin/tennis/gravar_alteracao', '', $hidden);
		
		echo "<span style='color:red'>" . validation_errors() . "</span>";
		
		echo form_fieldset('Alterar Tennis');
		
			echo form_label('Modelo: ','modelo');
			$array[''] = "--SELECIONE--";
			foreach($modelos as $modelo){
				$array[$modelo->id] = $modelo->nome;
			}
			echo form_dropdown('idmodelo', $array, $tennis->idmodelo);
			echo '<br>';
			
			echo "<span>";
			echo anchor_popup( base_url('assets/images/'.$tennis->imagem_frente),
				img(array('src'=>base_url('assets/images/'.$tennis->imagem_frente), 'width'=>100, 'height'=>100) )
			);
			echo "</span>";
			echo '<br>';
			
			echo form_label('IMGPERFIL: ','imgperfil');
			$attr = array('name'=>'imgperfil', 'id'=>'imgperfil');
			echo form_upload($attr);
			echo '<br>';
			
			echo "<span>";
			echo anchor_popup( base_url('assets/images/'.$tennis->imagem_frontal),
				img(array('src'=>base_url('assets/images/'.$tennis->imagem_frontal), 'width'=>100, 'height'=>100) )
			);
			echo "</span>";
			echo '<br>';
			
			echo form_label('IMG45: ','img45');
			$attr = array('name'=>'img45', 'id'=>'img45');
			echo form_upload($attr);
			echo '<br>';
			
			echo "<span>";
			echo anchor_popup( base_url('assets/images/'.$tennis->imagem_vertical),
				img(array('src'=>base_url('assets/images/'.$tennis->imagem_vertical), 'width'=>100, 'height'=>100) )
			);
			echo "</span>";
			echo '<br>';
			
			echo form_label('IMGFRENTE: ','imgfrente');
			$attr = array('name'=>'imgfrente', 'id'=>'imgfrente');
			echo form_upload($attr);
			echo '<br>';
			
			echo "<span>";
			echo anchor_popup( base_url('assets/images/'.$tennis->imagem_horizontal),
				img(array('src'=>base_url('assets/images/'.$tennis->imagem_horizontal), 'width'=>100, 'height'=>100) )
			);
			echo "</span>";
			echo '<br>';
			
			echo form_label('IMG145: ','img145');
			$attr = array('name'=>'img145', 'id'=>'img145');
			echo form_upload($attr);
			echo '<br>';
			
			echo "<span>";
			echo anchor_popup( base_url('assets/images/'.$tennis->imagem_solo),
				img(array('src'=>base_url('assets/images/'.$tennis->imagem_solo), 'width'=>100, 'height'=>100) )
			);
			echo "</span>";
			echo '<br>';
			
			echo form_label('IMGSOLADO: ','imgsolado');
			$attr = array('name'=>'imgsolado', 'id'=>'imgsolado');
			echo form_upload($attr);
			echo '<br>';
			
			echo form_submit('bntSubmit','Alterar');			
		echo form_fieldset_close();		
	echo form_close();
	?>
	
	<p>
	<?php 
		echo anchor(base_url('admin/tennis'), 'Voltar');
	?>
	</p>
</div>