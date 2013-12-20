<?
function script($code){
	header('Content-type: text/javascript');
	 $codeigniter = & get_instance();
	 $codeigniter->load->model('definicoesTenis_model');
	 $listaCustons = $codeigniter->definicoesTenis_model->GetCustom($code);
	 $listaSets =  $codeigniter->definicoesTenis_model->GetCustomSeters($code);
	 $svgJquery = $codeigniter->definicoesTenis_model->GetTennisSvg($code);
	 $setVar = null;
	 $dataPost = null;
	 $dataVar = null;
	 $dataSeters = null;
	 foreach($listaCustons AS $custom)
	 {
		
		$data = $codeigniter->definicoesTenis_model->GetSets($custom['id']);
		if(isset($_GET['sexo']) && isset($_GET['numeracao']))
			{
				$echoGet = $data['slug_tipo_custom'];
		$setVar .= " $data[slug_tipo_custom] = $_GET[$echoGet];
		";
			}
			else
			{
		$setVar .= " $data[slug_tipo_custom] = $data[id_custom];
		";	
			}
		$dataPost .= "$data[slug_tipo_custom]:$data[slug_tipo_custom],";
		$dataVar .= "$data[slug_tipo_custom]:'$data[slug_tipo_custom]|'+$data[slug_tipo_custom],";
		
	 }
	 foreach($listaSets AS $setersDefy)
	 {
		$dataSeters .= "$setersDefy[slug_tipo_custom]_x_$setersDefy[tipo] = $setersDefy[posicao_x];
		"; 
		$dataSeters .= "$setersDefy[slug_tipo_custom]_y_$setersDefy[tipo] = $setersDefy[posicao_y];
		"; 
	 }
?>
			$(function() {
				//Desativa mouse
				$(document).bind("contextmenu",function(e){
				return false;
				});
				//definicoes de pessoa
				sexo = "masculino";
				numeracao = 34;
				$("#TopCustom_Sexo a").on("click",function(){
						
						sexo = $(this).attr("rel");
						$.ajax({
											url: "<?=base_url();?>custom/retornaMedidas/"+sexo,
											success: function(data) 
											{
											$("#TopCustom_Tamanho").html(data);
											numeracao = 34;
											}
								});			
					
					$("#TopCustom_Sexo a").removeAttr("style");
					$(this).css({'background-color': '#e92715','border-radius':'10px','color':'#FFF'});
					
					return false;
				});
				
				$("#TopCustom_Tamanho").on("click",".number",function(){
					$("#TopCustom_Tamanho a").removeAttr("style");
					numeracao = $(this).attr("rev");
					$(this).css({'background': '#e92715','color':'#FFF'});
					return false;
				});
				var desableesqueda = 0;
				var desabledireita = 0;
				//
				var perspectivaDefault = 45;
				defaltDiv = 1;
				subDiv = 2;
				//definicoes anteriores Seters
				code_name = "";
				value_name = "";
				//
				<?=$setVar?>
				//alinhamento de Seters
				<?
				print $dataSeters;
				?>
				//
				function render()
				{
					$.ajax({
						url: "<?=base_url();?>custom/render",
						type: "post",
						async:false,
						data: {<?=$dataPost?>perspectiva:perspectivaDefault,slug_modelo:'<?=$code?>'},
						success: function(data) {
								$('#tenisRender'+subDiv).html(data);
								$('#tenisRender'+defaltDiv).animate({
									opacity: 0.0
									}, 200, function() {
										$(this).html(data);
										$(this).removeAttr('style');
									});
						},
						error: function(){}
					});
				}
				var setTempoOut = 430;
				$(".NextEsquerda").on("click",function(){
					if(desableesqueda == 0)
					{
					desableesqueda = 1;
					if(perspectivaDefault == 45) perspectivaDefault = 0;
					else if(perspectivaDefault == 0) perspectivaDefault = 90;
					else if(perspectivaDefault == 90) perspectivaDefault = 145;
					else if(perspectivaDefault == 145) perspectivaDefault = 270;
					else if(perspectivaDefault == 270) perspectivaDefault = 45;
					$.ajax({
						url: "<?=base_url();?>custom/setVarivel",
						type: "post",
						async:false,
						data: {<?=$dataVar?>perspectiva:perspectivaDefault,slug_modelo:'<?=$code?>'},
						success: function(data) {
								var obj = jQuery.parseJSON(data);
								jQuery.each(obj, function(i, val) {
										var item = val['item'];
										var valor = val['value'];
										mystring = item;
										window[mystring] = valor;
								});
								render();
								if(code_name != "")
								{
									$.ajax({
											url: "<?=base_url();?>custom/retornaCustons/"+perspectivaDefault+"/<?=$code?>/"+code_name+"/"+value_name,
											success: function(data) {
													$("#box_BottomCustom").html(data);
													$("#box_BottomCustom a").each(function(index, value){
														nome_tipo_text = $(this).attr("rel");
														value_nome_tipo = $(this).attr("rev");
														if(window[nome_tipo_text] == value_nome_tipo)
														{
															$(this).css({'border': '6px solid #e92715'});
														}
													});
											},
											error: function(){}
										});
								}
								//MOVER RISCAS
									$.ajax({
											url: "<?=base_url();?>custom/retornaSetersValue/<?=$code?>/"+perspectivaDefault,
											success: function(data) {
											var obj = jQuery.parseJSON(data);
											
												jQuery.each(obj, function(i, val) {
														if(perspectivaDefault == 90)
														{
															if(val['slug_tipo_custom'] == "solado")
															{
																	if(val['tipo'] == "risca")
																	{
																		$('.'+val['slug_tipo_custom']+"_"+val['tipo']).fadeOut(200,function(){
																				if(val['imagem'] != "")
																				{
																				$(this).html('<img src="<?=base_url()?>assets/images/'+val['imagem']+'"/>');
																				}
																				$('.'+val['slug_tipo_custom']+"_"+val['tipo']).animate({
																							left: val['posicao_x'],
																							top: val['posicao_y'],
																						  },400, 'linear', function() {
																							$(this).fadeIn();
																							//*****Retira o SetDesable
																							if(obj.length-1 == i) 
																							{
																							setTimeout(function(){
																								desableesqueda = 0;
																							}, setTempoOut);
																							}
																							//*****Retira o SetDesable
																						  });
																		})
																	}
																	else
																	{
																				$('.'+val['slug_tipo_custom']+"_"+val['tipo']).animate({
																							left: val['posicao_x'],
																							top: val['posicao_y'],
																						  },300, 'linear', function() {
																								//*****Retira o SetDesable
																							if(obj.length-1 == i) 
																							{
																							setTimeout(function(){
																								desableesqueda = 0;
																							}, setTempoOut);
																							}
																							//*****Retira o SetDesable
																						  });
																	}
															}
															else
															{
																							//*****Retira o SetDesable
																							if(obj.length-1 == i) 
																							{
																							setTimeout(function(){
																								desableesqueda = 0;
																							}, setTempoOut);
																							}
																							//*****Retira o SetDesable
																	$('.'+val['slug_tipo_custom']+"_"+val['tipo']).fadeOut();
															}
														}
														else
														{
															$('.'+val['slug_tipo_custom']+"_"+val['tipo']).fadeIn(100,function(){
																if(val['tipo'] == "risca")
																		{
																			var position = $('.'+val['slug_tipo_custom']+"_"+val['tipo']).position();
																			var l = position.left;
																			var t = position.top;
																			if(l != val['posicao_x'] && t != val['posicao_y'])
																			{
																				$('.'+val['slug_tipo_custom']+"_"+val['tipo']).fadeOut(200,function(){
																						$(this).html('<img src="<?=base_url()?>assets/images/'+val['imagem']+'"/>');
																						$('.'+val['slug_tipo_custom']+"_"+val['tipo']).animate({
																									left: val['posicao_x'],
																									top: val['posicao_y'],
																								  },400, 'linear', function() {
																									$(this).fadeIn();
																									//*****Retira o SetDesable
																							if(obj.length-1 == i) 
																							{
																							setTimeout(function(){
																								desableesqueda = 0;
																							}, setTempoOut);
																							}
																							//*****Retira o SetDesable
																								  });
																				})
																			}
																		}
																		else
																		{
																					$('.'+val['slug_tipo_custom']+"_"+val['tipo']).animate({
																								left: val['posicao_x'],
																								top: val['posicao_y'],
																							  },setTempoOut, 'linear', function() {
																								//*****Retira o SetDesable
																							if(obj.length-1 == i) 
																							{
																							setTimeout(function(){
																								desableesqueda = 0;
																							}, setTempoOut);
																							}
																							//*****Retira o SetDesable
																							  });
																							  
																		}
															});			
														}
														
														
														});
														
											}
										});	
								//
						},
						error: function(){}
					});
					}
					return false;
				})
				
				$(".NextDireita").on("click",function(){
					if(desabledireita == 0)
					{
					desabledireita = 1;
					if(perspectivaDefault == 45) perspectivaDefault = 270;
					else if(perspectivaDefault == 270) perspectivaDefault = 145;
					else if(perspectivaDefault == 145) perspectivaDefault = 90;
					else if(perspectivaDefault == 90) perspectivaDefault = 0;
					else if(perspectivaDefault == 0) perspectivaDefault = 45;
					$.ajax({
						url: "<?=base_url();?>custom/setVarivel",
						type: "post",
						async:false,
						data: {<?=$dataVar?>perspectiva:perspectivaDefault,slug_modelo:'<?=$code?>'},
						success: function(data) {
								var obj = jQuery.parseJSON(data);
								jQuery.each(obj, function(i, val) {
										var item = val['item'];
										var valor = val['value'];
										mystring = item;
										window[mystring] = valor;
								});
								render();
								if(code_name != "")
								{
									$.ajax({
											url: "<?=base_url();?>custom/retornaCustons/"+perspectivaDefault+"/<?=$code?>/"+code_name+"/"+value_name,
											success: function(data) {
													$("#box_BottomCustom").html(data);
													$("#box_BottomCustom a").each(function(index, value){
														nome_tipo_text = $(this).attr("rel");
														value_nome_tipo = $(this).attr("rev");
														if(window[nome_tipo_text] == value_nome_tipo)
														{
															$(this).css({ 'border': '6px solid #e92715'});
														}
													});
												
											},
											error: function(){}
										});
								}
								//MOVER RISCAS
									$.ajax({
											url: "<?=base_url();?>custom/retornaSetersValue/<?=$code?>/"+perspectivaDefault,
											success: function(data) {
											var obj = jQuery.parseJSON(data);
												jQuery.each(obj, function(i, val) {
														if(perspectivaDefault == 90)
														{
															if(val['slug_tipo_custom'] == "solado")
															{
																	if(val['tipo'] == "risca")
																	{
																		$('.'+val['slug_tipo_custom']+"_"+val['tipo']).fadeOut(200,function(){
																				if(val['imagem'] != "")
																				{
																				$(this).html('<img src="<?=base_url()?>assets/images/'+val['imagem']+'"/>');
																				}
																				$('.'+val['slug_tipo_custom']+"_"+val['tipo']).animate({
																							left: val['posicao_x'],
																							top: val['posicao_y'],
																						  },400, 'linear', function() {
																							$(this).fadeIn();
																							//*****Retira o SetDesable
																							if(obj.length-1 == i) 
																							{
																							setTimeout(function(){
																								desabledireita = 0;
																							}, setTempoOut);
																							}
																							//*****Retira o SetDesable
																						  });
																		})
																	}
																	else
																	{
																				$('.'+val['slug_tipo_custom']+"_"+val['tipo']).animate({
																							left: val['posicao_x'],
																							top: val['posicao_y'],
																						  },300, 'linear', function() {
																							//*****Retira o SetDesable
																							if(obj.length-1 == i) 
																							{
																							setTimeout(function(){
																								desabledireita = 0;
																							}, setTempoOut);
																							}
																							//*****Retira o SetDesable
																						  });
																	}
															}
															else
															{
																	
																	$('.'+val['slug_tipo_custom']+"_"+val['tipo']).fadeOut();
																	//*****Retira o SetDesable
																							if(obj.length-1 == i) 
																							{
																							setTimeout(function(){
																								desabledireita = 0;
																							}, setTempoOut);
																							}
																							//*****Retira o SetDesable
															}
														}
														else
														{
															$('.'+val['slug_tipo_custom']+"_"+val['tipo']).fadeIn(100,function(){
																if(val['tipo'] == "risca")
																		{
																			var position = $('.'+val['slug_tipo_custom']+"_"+val['tipo']).position();
																			var l = position.left;
																			var t = position.top;
																			if(l != val['posicao_x'] && t != val['posicao_y'])
																			{
																				$('.'+val['slug_tipo_custom']+"_"+val['tipo']).fadeOut(200,function(){
																						$(this).html('<img src="<?=base_url()?>assets/images/'+val['imagem']+'"/>');
																						$('.'+val['slug_tipo_custom']+"_"+val['tipo']).animate({
																									left: val['posicao_x'],
																									top: val['posicao_y'],
																								  },400, 'linear', function() {
																									$(this).fadeIn();
																									//*****Retira o SetDesable
																							if(obj.length-1 == i) 
																							{
																							setTimeout(function(){
																								desabledireita = 0;
																							}, setTempoOut);
																							}
																							//*****Retira o SetDesable
																								  });
																				})
																			}
																		}
																		else
																		{
																					$('.'+val['slug_tipo_custom']+"_"+val['tipo']).animate({
																								left: val['posicao_x'],
																								top: val['posicao_y'],
																							  },400, 'linear', function() {
																							  //*****Retira o SetDesable
																							if(obj.length-1 == i) 
																							{
																							setTimeout(function(){
																								desabledireita = 0;
																							}, setTempoOut);
																							}
																							//*****Retira o SetDesable
																							  });
																		}
															});			
														}
														});
											}
										});	
								//
						},
						error: function(){}
					});
					}
					return false;
				})
				<?
				
				foreach($svgJquery AS $svgAnimate)
				{
						?>
						$("#tenisRender").on(
						{mouseenter: function(){$(this).stop();$(this).animate({opacity: 0.20},100);},
						 mouseleave: function(){$(this).stop();$(this).animate({opacity: 0.00},100);},
						 click:function(){
								var idtipocustom = $(this).attr("rel");
								var slug_tipo_custom = $(this).attr("rev");
								$.ajax({
											url: "<?=base_url();?>custom/retornaCustons/"+perspectivaDefault+"/<?=$code?>/"+idtipocustom+"/"+slug_tipo_custom,
											success: function(data) {
												$("#box_BottomCustom").fadeOut("fast",function(){
													$("#box_BottomCustom").html(data);
													$("#box_BottomCustom a").css({'border': '6px solid #eee'});
													$("#box_BottomCustom a").each(function(index, value){
														nome_tipo_text = $(this).attr("rel");
														value_nome_tipo = $(this).attr("rev");
														if(window[nome_tipo_text] == value_nome_tipo)
														{
															$(this).css({'border': '6px solid #e92715'});
															window['code_name'] = idtipocustom;
															window['value_name'] = slug_tipo_custom;
														}
													});
													$(this).fadeIn();
													
												});
												
											},
											error: function(){}
										});
								return false;
							}
						},"#svg_<?=$svgAnimate['slug_tipo_custom']?>");
						<?
				}
				?>
				$(".personalizar").on("click",function(){
								var idtipocustom = $(this).attr("rel");
								var slug_tipo_custom = $(this).attr("rev");
								$.ajax({
											url: "<?=base_url();?>custom/retornaCustons/"+perspectivaDefault+"/<?=$code?>/"+idtipocustom+"/"+slug_tipo_custom,
											success: function(data) {
												$("#box_BottomCustom").fadeOut("fast",function(){
													$("#box_BottomCustom").html(data);
													$("#box_BottomCustom a").each(function(index, value){
														nome_tipo_text = $(this).attr("rel");
														value_nome_tipo = $(this).attr("rev");
														if(window[nome_tipo_text] == value_nome_tipo)
														{
															$(this).css({'background-color': '#fff', 'border': '6px solid #e92715'});
															window['code_name'] = idtipocustom;
															window['value_name'] = slug_tipo_custom;
														}
													});
													$(this).fadeIn();
													
												});
												
											},
											error: function(){}
										});
					return false;
				});
				$("#box_BottomCustom").on("click",".SeterCustom",function(){
					
						mystring = $(this).attr("rel");
						if(window[mystring] != $(this).attr("rev"))	
						{
							window[mystring] = $(this).attr("rev");
							render();
							$(".SeterCustom").css({'border': '6px solid #eee'});
							$(this).css({'border': '6px solid #e92715'});
						}	
					return false;
					});
				$(".BtnConcluir").on("click",function(){
					<?
					$VarPHP = array();
						foreach($listaCustons AS $sendVarPHP)
						{
							$VarPHP[] .= $sendVarPHP['slug_tipo_custom'].'="+'.$sendVarPHP['slug_tipo_custom'];
						}
					$VarPHP = implode('+"&',$VarPHP);	
					?>
						var VarPHP = new Array;
					$.ajax({
						url: "<?=base_url();?>custom/setVarivel",
						type: "post",
						async:false,
						data: {<?=$dataVar?>perspectiva:45,slug_modelo:'<?=$code?>'},
						success: function(data) {
								var obj = jQuery.parseJSON(data);
								jQuery.each(obj, function(i, val) {
										var item = val['item'];
										var valor = val['value'];
										VarPHP[i] = item+"="+valor;
								});
							}	
						});	
						var joinURL = VarPHP.join("&");
					var SendPHP = "<?=base_url()."custom/concluir/".$code?>?"+joinURL+"&sexo="+sexo+"&numeracao="+numeracao;
						$(this).attr("href",SendPHP);
						$("#tenisCustomizacao").fadeTo(2000, 0.4, function() {});
						$("#boxCustom").fadeTo(1000, 0.4, function() {});
						return true;
					})
				$(".corCustom").on("click",function(){
					var SetCustomDefined = $(this).attr("href");
					SetCustomDefined = SetCustomDefined.split('|');
					var total = SetCustomDefined.length-1;
					for(i=0;i<=total;i++)
					{
						var setValorDefined = SetCustomDefined[i].split(':');
						var item = setValorDefined[0];
						var valor = setValorDefined[1];
						mystring = item;
						window[mystring] = valor;
					}
					perspectivaDefault = 45;
					render();
					//MOVER RISCAS
									$.ajax({
											url: "<?=base_url();?>custom/retornaSetersValue/<?=$code?>/"+perspectivaDefault,
											success: function(data) {
											var obj = jQuery.parseJSON(data);
											
												jQuery.each(obj, function(i, val) {
														
															$('.'+val['slug_tipo_custom']+"_"+val['tipo']).fadeIn(100,function(){
																if(val['tipo'] == "risca")
																		{
																			var position = $('.'+val['slug_tipo_custom']+"_"+val['tipo']).position();
																			var l = position.left;
																			var t = position.top;
																			
																				$('.'+val['slug_tipo_custom']+"_"+val['tipo']).fadeOut(200,function(){
																						$(this).html('<img src="<?=base_url()?>assets/images/'+val['imagem']+'"/>');
																						$('.'+val['slug_tipo_custom']+"_"+val['tipo']).animate({
																									left: val['posicao_x'],
																									top: val['posicao_y'],
																								  },400, 'linear', function() {
																									$(this).fadeIn();
																									//*****Retira o SetDesable
																							if(obj.length-1 == i) 
																							{
																							setTimeout(function(){
																								desableesqueda = 0;
																							}, setTempoOut);
																							}
																							//*****Retira o SetDesable
																								  });
																				})
																		}
																		else
																		{
																					$('.'+val['slug_tipo_custom']+"_"+val['tipo']).animate({
																								left: val['posicao_x'],
																								top: val['posicao_y'],
																							  },setTempoOut, 'linear', function() {
																								//*****Retira o SetDesable
																							if(obj.length-1 == i) 
																							{
																							setTimeout(function(){
																								desableesqueda = 0;
																							}, setTempoOut);
																							}
																							//*****Retira o SetDesable
																							  });
																							  
																		}
															});	
														
														
														});
														
											}
										});	
								//
					return false;
				})	
			});
<?
}
?>
			