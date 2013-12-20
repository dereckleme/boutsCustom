<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Selecione o modelo</title>
<?
	echo script_tag('assets/js/jquery-1.9.1.js');
?>
<script>
$(function() {
	$("a").on("click",function(){
						if($(this).attr("disabled") != "disabled")
						{
		 $("#conteudoCentro").fadeTo('slow', 0.5, function() {});
		//$("#conteudoGeral").append(' <span class="carregandoPage" style="position:absolute;color:#055053;top:600px;left:500px;font-size:100pt;display:none">Carregando...</span>');
		$(".mensagem_abrir").fadeIn();
							$("a").attr('disabled', true);
							return true;
						}
						else
						{
							return false;
						}
	})
})
</script>
<style type="text/css">
body { background:url(<?=base_url()?>assets/img/rodape.jpg)  repeat-x #000 1px 585px; display:block; margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; color:#FFF}
a { text-decoration:none;}
img { border:none;}
img.logoBouts { margin-left:105px; margin-top:56px}
#esquerda{ float:left;  margin-top:60px; margin-left:200px}
#direita { float:left; margin-top:60px;}

#conteudoGeral { background:url(<?=base_url()?>assets/img/vidro_quebrado.png) no-repeat center; width:1920px; height:1080px; position:absolute}
h3.titulo {}
h4 { text-transform:uppercase; float:left; margin-top:10px; font-weight:bold; font-size:20px; color:#e92715; background:#eee; border-radius:10px 10px 0 0;width:393px; padding-top:15px; text-indent:23px; box-shadow:0px 5px 15px 0px #999}
span.bordaVermelha { width:232px; float:left; padding-bottom:10px; border-bottom:8px solid red;}
p { text-transform:uppercase; color:#333; font-size:14px; margin-left:15px;}
#tenisCustomizacao { width:1096px; height:697px; margin-top:89px; border:1px solid #FFF;}
#btnCustomizacao { width:1096px;}
a.NextEsquerda { margin-left:505px; margin-right:34px}
#tenisRender {  width:821px; height:481px; margin-left:173px; position:relative;top:191px;  border:1px solid #FFF;} 
a.BtnConcluir{position:absolute; margin-left:218px}
#boxCustom { width:408px; height:715px; background:#fff; border-radius:10px; margin-left:42px; margin-top:56px; box-shadow:0px 10px 50px 0px #000}
#box_TopCustom  { width:393px; margin:0 auto;} 
#TopCustom_Sexo a.masculino { margin-left:32px}
#TopCustom_Sexo a.masculino, a.feminino { margin-top:5px;  margin-bottom:15px; float:left; text-transform:uppercase; font-weight:bold;  color:#000; padding:10px 20px; font-size:22px}
#TopCustom_Tamanho a.number { text-transform:uppercase; font-weight:bold;  color:#000; padding:10px 10px; background:#eee; border-radius:10px; margin-botton:10px; margin-left:15px; font-size:22px;}
#TopCustom_Tamanho a.numberSelecao { background:#e92715; color:#FFF}
#TopCustom_Sexo a.sexoSelecao { background:#e92715; color:#FFF; border-radius:10px}
#box_BottomCustom a.corCustom { width:81px; height:72px; background:#CCC; border:6px solid #fff; float:left; border-radius:10px; margin-top:5px;  margin-left:5px;}
#box_BottomCustom a.corSelecao {border: 6px solid #e92715; background:#fff;}
#TopCustom_Sexo {}
#TopCustom_Tamanho {}
#box_BottomCustom { width:393px; margin:0 auto;} 

a.personalizar, span.parteTenis {float:left} 
a.personalizar { }
span.parteTenis { font-size:18px; color:#e92715 }
embed { float:left; }

/*NOVO CSS QUARTA/TERCEIRA/TELA*/ 
 
#coluna_esquerda{ float:left; top:0px; margin-left:198px; margin-top:109px}
#texto_explosao { float:left; margin-left:202px; margin-top:113px; }
#tenis_270 { width:552px; height:721px; background:url(tenis_45%C2%B0.png) no-repeat; margin-left:388px; margin-top:334px;}
#coluna_direita { width:806px; float:right;top:0px; margin-right:163px}
a.btn_iniciar { margin-left:174px; margin-top:147px; float:left}
#studio { width:400px; }

#topo { width:1920px; float:left}
a.BtnContinuar{position:absolute; margin-left:218px}
#status_stride, #status_join, #status_orion { float:left; margin-top:120px}
#status_stride {  margin-left:150px}
#status_stride img.imgStride { margin-top:75px}
#status_stride a.precoStride {margin-left:30px}
#status_orion img.imgOrion { margin-top:75px}
#status_join img.imgJoin{ margin-top:75px}




</style>
</head>

<body>

    <div id="conteudoGeral">
    
    
      <div id="topo">
    
             <div id="esquerda">
                 <h3 class="titulo"><img src="<?=base_url()?>assets/img/selecione_modelo.png" alt="Selecione o modelo" title="Selecione o modelo" /></h3> 
             </div>  

     </div> 
            
       
    <div id="conteudoCentro">
    
       <div id="status_stride" style="margin-left:400px;">
          <a href="<?=base_url()?>custom/modelo/stride" class="precoStride"><img src="<?=base_url()?>assets/img/stride_preco.png" /></a>
             <br class="clear" />
          <a href="<?=base_url()?>custom/modelo/stride" class="fotoStride"><img src="<?=base_url()?>assets/img/stride.png" class="imgStride" /></a> 
       </div>
       
       <!--<div id="status_join" style="position:relative; margin-right:-50px;">
          <a href="<?=base_url()?>custom/modelo/join" class="precoJoin"><img src="<?=base_url()?>assets/img/join_preco.png"  /></a>
             <br class="clear" />
          <a href="<?=base_url()?>custom/modelo/join" class="fotoJoin"><img src="<?=base_url()?>assets/img/join.png" class="imgJoin" /></a> 
       </div>-->
            
            
       <div id="status_orion">
          <a href="<?=base_url()?>custom/modelo/orion" class="precoOrion"><img src="<?=base_url()?>assets/img/orion_preco.png" /></a>
             <br class="clear" />
          <a href="<?=base_url()?>custom/modelo/orion" class="fotoOrion"><img src="<?=base_url()?>assets/img/orion.png" class="imgOrion" /></a> 
       </div>
            
            
    </div>
	<div class="mensagem_abrir" style="position:absolute;top:600px;bottom:0;left:400px;width:1000px;font-size:20pt;display:none"><img src="<?=base_url()?>assets/img/carregando.png"/></div>

    
       




   </div>




</body>
</html>
