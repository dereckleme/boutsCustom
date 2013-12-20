
 
 <h4><span class="bordaVermelha"> <?=$nome_custom['descricao']?></span></h4> 
              <p>Selecione a cor</p>
<?
	foreach($itens AS $incustom)
	{
		if(!empty($incustom['hexadecimal']))
		{
		?>
			<a href="#" class="SeterCustom corCustom"  rel="<?=$customVarJQ?>" rev="<?=$incustom['id']?>" style="background-color:<?=$incustom['hexadecimal']?>;"></a>
		<?
		}
		if(!empty($incustom['image_bloco']))
		{
		?>
		<a href="#" class="SeterCustom corCustom" rel="<?=$customVarJQ?>" rev="<?=$incustom['id']?>" style="background-image:url('<?=base_url()?>assets/images/<?=$incustom['image_bloco']?>');"></a>
		<?
		}
	}
?>
