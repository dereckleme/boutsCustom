<?php
		echo heading("Você deseja: ",2);

		$lista = array(
			anchor('admin/modelo', 'Cadastrar Modelo', 'title="Cadastrar Modelo"'),
			anchor('admin/tipoCustom', 'Cadastrar tipo de customização', 'title="Cadastrar tipo de customização"'),
			anchor('admin/tennis', 'Cadastrar Tennis', 'title="Cadastrar Tennis"'),
			anchor('admin/svg', 'Cadastrar SVG', 'title="Cadastrar SVG"'),
			anchor('admin/custom', 'Cadastrar Customização', 'title="Cadastrar Customização"')
		);
		echo ul($lista);
?>