<title></title>
		<meta charset="UTF-8" />
		<?php 
		// css
		echo link_tag('assets/css/reset.css');
		echo link_tag('assets/css/style.css');
		// js
		echo script_tag('assets/js/jquery-1.9.1.js');
		?>
		<?
			if(isset($script_custom)) print $script_custom;
		?>
		<style type="text/css">
body { background:url(<?=base_url()?>assets/img/rodape.jpg) repeat-x #000 1px 585px; display:block; margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; color:#FFF}
a { text-decoration:none;}
img { border:none;}
img.logoBouts { margin-left:105px; margin-top:56px}
#esquerda{ float:left;  margin-top:60px; margin-left:200px}
#direita { float:left;   margin-top:60px;}
#conteudoGeral { background:url(<?=base_url()?>assets/img/vidro_quebrado.png) no-repeat center; width:1920px; height:1080px; position:absolute}
h3.titulo {}
h4 { text-transform:uppercase; float:left; margin-top:10px; font-weight:bold; font-size:20px; color:#e92715; background:#eee; border-radius:10px 10px 0 0;width:393px; padding-top:15px; text-indent:23px; box-shadow:0px 5px 15px 0px #999}
h5, h6 {margin:0px; padding:0px;}
h5 { font-size:30px; text-transform:uppercase;}
h6 {font-size:18px; color:#e92715; text-transform:uppercase}
span.bordaVermelha { width:300px; float:left; padding-bottom:10px; border-bottom:8px solid red;}
p { text-transform:uppercase; color:#333; font-size:14px; margin-left:15px;}
#tenisCustomizacao { width:1096px; height:697px; margin-top:89px}
#btnCustomizacao { width:1096px;}
a.NextDireita { margin-left:505px; margin-right:34px}

#tenisRender {  width:821px; height:481px; margin-left:173px; position:relative;top:191px} 
a.BtnConcluir{position:absolute; margin-left:218px}
#boxCustom { width:408px; height:715px; background:#fff; border-radius:10px; margin-left:42px; margin-top:56px; box-shadow:0px 10px 50px 0px #000}
#box_TopCustom  { width:393px; margin:0 auto;} 
#box_TopCustom_concluir  { width:480px; margin:0 auto;height:700px;} 

#TopCustom_Sexo a.masculino { margin-left:32px}
#TopCustom_Sexo a.masculino, a.feminino { margin-top:5px;  margin-bottom:15px; float:left; text-transform:uppercase; font-weight:bold;  color:#000; padding:10px 20px; font-size:22px}
#TopCustom_Tamanho a.number { text-transform:uppercase; font-weight:bold;  color:#000; padding:10px 10px; background:#eee; border-radius:10px; margin-botton:10px; margin-left:15px; font-size:22px;}
#TopCustom_Tamanho a.numberSelecao { background:#e92715; color:#FFF}
#TopCustom_Sexo a.sexoSelecao { background:#e92715; color:#FFF; border-radius:10px}
#box_BottomCustom a.corCustom { width:81px; height:72px; background:#CCC; border:6px solid #eee; float:left; border-radius:10px; margin-top:5px;  margin-left:5px;}
#box_BottomCustom a.corSelecao {border: 6px solid #e92715; background:#fff;}
a.SeterCustom { width:81px; height:72px; background:#CCC; border:6px solid #eee; float:left; border-radius:10px; margin-top:5px;  margin-left:5px;}
#TopCustom_Sexo {}
#TopCustom_Tamanho {}
#box_BottomCustom { width:393px; margin:0 auto;} 

a.personalizar, span.parteTenis {float:left} 
a.personalizar { }
span.parteTenis { font-size:18px; color:#e92715 }
embed { float:left; }


/*CSS QUARTA PAGINA*/
#coluna_direita { float:left; margin-top:60px; }
#box_aviso { width:550px; height:722px; background:#fff; border-radius:10px;  box-shadow:0px 10px 50px 0px #000;}
#box_TopCustom  { width:393px;margin:0 auto;}
ul li.text_tiptoe { font-size:17px; color:#000;  list-style:none; background:url(<?=base_url()?>/assets/img/icon_lista.png) no-repeat left 9px; text-indent:12px; margin-bottom:10px; line-height:24px} 
p.text_tiptoe { text-transform:none; line-height:20px; margin-left:0px; font-size:13px; color:#000}
a.btnConcluirCustomizacao { margin-left:35px; position:absolute; margin-top:-60px}
#botoes_voltar { padding-bottom:60px; }
a.BtnNovaCustomizacao { position:absolute; margin-left:220px; margin-top:-2px}
input { border:none; margin-right:10px; padding:0px}
label { font-size:17px; color:#000; line-height:24px}
#popup {background:#FFF; border-radius:10px; width:900px; box-shadow:0px 10px 50px 0px #000; position:absolute; margin-left:252px; z-index:8; margin-top:150px; height:615px; padding-top:17px; padding-left:33px; padding-right:33px; margin-bottom:30px;}
#text_popup {overflow-y: scroll; height:535px; padding-right:20px;}
#text_popup p {font-size:14px; text-transform:none;}
a.btnFechar { font-size:16px; color:#FFF; background:#e92715; border-radius:50px; padding:15px 50px; font-weight:bold; float:right; margin-top:12px}



</style>
	</head>

	<body>