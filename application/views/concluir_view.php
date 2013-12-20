<div id="conteudoGeral">



<div id="esquerda">
   
   <div id="botoes_voltar">
     
      <a href="<?=base_url();?>custom/iniciar" class="BtnNovaCustomizacao"><img src="<?=base_url()?>/assets/img/nova_customizacao.png" /></a>
	  <?
		//gera URL
		$keysUrl = array_keys($_GET);
		foreach($keysUrl AS $keyValue)
		{
			$itensUrl[] = $keyValue."=".$_GET[$keyValue];
		}
		$itensUrl = implode("&",$itensUrl);
	  ?>
      <a href="<?=base_url()?>custom/modelo/<?=$codeTenis?>?<?=$itensUrl?>" class="BtnVoltar"><img src="<?=base_url()?>assets/img/voltar.png"  /></a>
   </div>   
     
     <div id="tenisCustomizacao">
			
		   <?
			foreach($seters AS $set)
			{
					if($set['tipo'] == "risca")
					{
				?>
					<div style="display:none;position:absolute;z-index:1;top:<?=$set['posicao_y']?>px;left:<?=$set['posicao_x']?>px;" class="<?=$set['slug_tipo_custom']."_".$set['tipo']?>"></div>
				<?
					}
					else
					{
						?>
						<div class="<?=$set['slug_tipo_custom']."_".$set['tipo']?>" style="display:none;position:absolute;z-index:3;top:<?=$set['posicao_y']?>px;left:<?=$set['posicao_x']?>px;font-weight:bold">
						
						</div>
						<?
					}
			}
		   ?>
           <div id="tenisRender" style="color:#9C0">            
					<div id="tenisRender1">
					<?
					if(isset($_GET['sexo']) && isset($_GET['numeracao']))
			{
				
					$nome_ar = null;
					unset($_GET['sexo']);
					unset($_GET['numeracao']);
					foreach($_GET AS $dados_test)
					{
						$nome_ar .= $dados_test;
					}
	if(!is_file("./assets/images/render/$nome_ar.png"))
	{
		$arrayCustom = $setersGet;
		
		$fundo = $arrayCustom[0]['imagem_frontal'];
		
		$backgroundSource = "./assets/images/$fundo";
		$source = imagecreatefrompng($backgroundSource);
		imagesavealpha($source,true);
		foreach($arrayCustom AS $linha)
		{	
				if(!empty($linha['imagem_custom']))
				{
					$marca=imagecreatefrompng("./assets/images/$linha[imagem_custom]");     // não esquecer de verificar o nome do arquivo
					imagecopyresampled($source,$marca,$linha['posicao_x'],$linha['posicao_y'],0,0,imagesx($marca),imagesy($marca),imagesx($marca),imagesy($marca));
				}	
		}
		imagepng($source,"./assets/images/render/$nome_ar.png",false,100);
	}
	$list_svg = $listSVGSetedGET;
?>
<svg width="821" height="480" xmlns="http://www.w3.org/2000/svg"  style="background-image: url('<?=base_url()?>assets/images/render/<?=$nome_ar?>.png?uf=<?=time()?>');">
		<?
			foreach($list_svg AS $desenho)
			{
				?>
				<a xlink:href="#" id="svg_<?=$desenho['slug_tipo_custom']?>" rev="<?=$desenho['slug_tipo_custom']?>" rel="<?=$desenho['id_custom']?>" style="opacity:0.00">
					<g>
						<?=$desenho['svgxml']?>
					</g>
				</a>	
				<?
			}
		?>
	</svg>
					
			<?
			}
			else
			{
				?>
				<svg width="821" height="480" xmlns="http://www.w3.org/2000/svg"  style="background-image: url('<?=base_url()?>assets/images/<?=$tennis['imagem_frontal']?>');">
						<?
							foreach($svg AS $desenho)
							{
								?>
								<a xlink:href="#" id="svg_<?=$desenho['slug_tipo_custom']?>" rev="<?=$desenho['slug_tipo_custom']?>" rel="<?=$desenho['id_custom']?>" style="opacity:0.00">
									<g>
										<?=$desenho['svgxml']?>
									</g>
								</a>	
								<?
							}
						?>
					</svg>
				<?
			}
			?>		
					</div>
					<div id="tenisRender2">
					
					</div>              
           </div>
     </div>
      <div id="btnCustomizacao">
	  
           <a href="#" class="NextDireita"><img src="<?=base_url()?>assets/img/mover_esquerda.png" alt="Mover direita" title="Mover direita" /></a>
           <a href="#" class="NextEsquerda"><img src="<?=base_url()?>assets/img/mover_direita.png" alt="Mover esquerda" title="Mover esquerda" /></a>
      </div>    
</div>   

<div id="coluna_direita">
       
     
         <div id="box_aviso">
             <div id="box_TopCustom_concluir" style="color:black; margin-left:23px; height:630px; overflow-y: scroll;margin-top:23px; padding-right:30px;float:left">
				   <h5>Importante</h5>
                   <h6>foto meramente ilustrativa</h6>
                   <ul style="padding:0px;">
                     <li class="text_tiptoe">Poderão haver pequenas variações na cor do produto;</li>
                     <li class="text_tiptoe">O monitor de vídeo e a impressão sobre o papel não reproduzem com total exatidão a cor do produto adquirido;</li>
                     <li class="text_tiptoe">As cores utilizadas no solado podem variar mesmo entre modelos iguais;</li>
                     <li class="text_tiptoe">O comprovante emitido por esse sistema confirma apenas o pedido realizado. Seu comprovante de compra está sujeito à análise de crédito ou à confirmação do pagamento do boleto;</li>
                     <li class="text_tiptoe">Após aprovação da compra, o produto será entregue no endereço cadastrado em até 45 dias;</li>
                     <li class="text_tiptoe">Por se tratarem de produtos personalizados, e conseqüentemente únicos,<strong style="text-decoration:underline;"> não serão aceitos pedidos de troca</strong>, salvo nos casos em que o produto apresentar defeitos de fabricação. Para esses eventos, o produto levará até 45 dias para ser substituído.  </li>
                   </ul>
                 
                   <form>
                      <input type="radio" name="selecione" value="1" class="liconcordoCeck" CHECKED /><label class="LiConcordo">Li e concordo com as informações acima, bem como,  aquelas apresentadas no <strong>"Termo de Uso e Condições"</strong></label><a href="#" class="ler_popup" style="font-weight:bold; color:#e92715; font-size:18px"> (Clique aqui para Ler)</a>
                      <br /> <br /> 
                      <input type="radio" name="selecione" value="0" class="liconcordoCeck"/><label class="NaoConcordo">Li e <strong>NÃO</strong> concordo com as informações apresentadas acima. Desejo não prosseguir com a minha personalização.</label>
                   </form>
             </div>
         </div>
         
         <a href="<?=base_url()?>custom/gerar/<?=$codeTenis?>?<?=$itensUrl?>" class="btnConcluirCustomizacao"><img src="<?=base_url()?>/assets/img/concluir_custom.png" /></a>
    

</div>
<div class="mensagem_abrir" style="position:absolute;top:500px;bottom:0;left:400px;width:1000px;font-size:20pt;display:none;z-index:9"><img src="<?=base_url()?>assets/img/4carregando.png"/></div>
</div>

<div id="popup" style="display:none">
   <div id="text_popup">
     <p class="text_impressao"><strong>TERMO E CONDIÇÕES DE USO:</strong>
          <br />
          <br />          
          <strong>APRESENTAÇÃO:</strong>
          <br />
A centauro.com.br em parceria com a Bout´s  te convida para ser um usuário do Quiosque de Personalização Bout´s e conhecer os Termos e Condições que conduzem a sua utilização.
<strong>Ao navegar pelo site de personalização dos produtos, o usuário estará de acordo com os Termos e Condições de Uso que o regem e com todos os outros avisos que possam aparecer nas páginas, pertinentes a assuntos tratados nos referidos Termos.</strong>
</p>      
         <p class="text_impressao"><strong>1. Definições:</strong>
1.1 Os termos abaixo descritos, quando empregados no presente Termos e Condições de Uso para os produtos personalizados adquiridos nos Quiosques Bout´s, terão os seguintes significados:
• Classificam-se como "cliente" todas as pessoas que utilizam os produtos e/ou serviços oferecidos pelo site de personalização Bout´s, pagos ou não.
• Classificam-se como "usuários" todas as pessoas que se cadastram no Site de personalização Bout´s e recebem uma identificação individual e exclusiva, ou que já possuam essa identificação através do site Centauro.com.br.
• Entende-se por identificação individual toda informação que não está disponível para o público em geral e é atribuída, personalizadamente, a um determinado cliente/usuário. São exemplos de dados de identificação individual os números de CPF ou CNPJ, dados para contato e dados sobre cobrança.
• Meu Cadastro: área restrita do site, onde os usuários inserem suas informações cadastrais.
• Login: Identificação de um usuário perante o sistema. Para ter acesso, é preciso digitar sua identificação (login), seguido de sua senha.
• Senha: Conjuntos de caracteres, de conhecimento único do usuário, utilizado no processo de verificação de sua identidade, assegurando que ele é realmente quem diz ser.
</p>
        <p class="text_impressao"><strong>2. Finalidade do Quiosque de Personalização Bout´s:</strong>
2.1 O quiosque para personalização dos produtos Bout´s coloca à disposição do usuário a loja virtual, a fim de trazer maior praticidade para o consumidor em suas compras.
2.2 O usuário terá a sua disposição 03 modelos de tênis para personalização. Serão passíveis de customização os seguintes itens:
• Cabedal: 08 possibilidades de cores;
• Colarinho: 08 possibilidades de cores;
• Cadarço: 08 possibilidades de cores;
• Solado: 08 possibilidades de cores;
• Nylon: 08 possibilidades de cores;

Após a escolha dos itens personalizáveis, o cliente será direcionado ao carrinho (plataforma centauro.com.br) para finalização da sua compra.
2.3 O usuário, após cadastramento no site da centauro.com.br, poderá realizar a customização online, escolher a forma de pagamento,  solicitar trocas, realizar contato com o Serviço de Atendimento ao Cliente etc.
2.4 É de inteira responsabilidade do usuário a inserção das informações na base de dados no site centauro.com.br .
</p>    
        <p class="text_impressao"><strong>3. Quem pode cadastrar-se? </strong>
3.1 Para ser um usuário do site de personalizações da Bout´s, basta que o cliente preencha o formulário de cadastro disponível. Usuários com cadastro no site da centauro.com poderão utilizar o mesmo login para realizar o acesso.
3.2. O usuário precisa ter capacidade legal para contratar e ser maior de 18 anos. 
3.3. O usuário que cadastrar-se no site utilizando dados de terceiros poderá incorrer nos crimes de falsa identidade e estelionato, ambos previstos no Código Penal Brasileiro, sem prejuízo de eventual responsabilização por legislação específica.
</p> 
        <p class="text_impressao"><strong>4. Cadastro, Login, Senha e Segurança:</strong> 
4.1 São vedados aos usuários a cessão, venda, aluguel ou qualquer outra forma de transferência de seu cadastro.
4.2. É de inteira responsabilidade do usuário a inserção dos dados no formulário de cadastramento.
4.3. Caso a Centauro constate qualquer inexatidão nas informações prestadas pelo usuário, ou ilegalidade em sua conduta, poderá, a seu exclusivo critério, suspender e/ou cancelar o correspondente cadastro. Tal atitude, contudo, não cessa nem diminui a responsabilidade do usuário quanto à exatidão e veracidade dos dados que fornecer.
4.4. Quando o usuário realizar o seu cadastro, deverá criar seu próprio login e senha.
4.5. As instruções para a troca de senha estão disponibilizadas no site e deverão ser seguidas pelos usuários.
4.6. O usuário será o único responsável por seu login e senha e responderá por todos os atos praticados com estes. Portanto, é o seu dever zelar pela guarda e confidencialidade de sua senha.
4.7. A senha e os dados cadastrais poderão ser alterados a qualquer momento pelo usuário.
4.8. O usuário concorda em notificar imediatamente a Centauro.com.br sobre o extravio, perda, roubo ou qualquer uso não-autorizado de seu login e senha, além de qualquer quebra de segurança de seu conhecimento. Diante destas situações, constitui também obrigação do usuário alterar imediatamente a sua senha após a ocorrência de tais fatos.
4.9. A Centauro.com.br não solicita dados de login, senha ou outras informações cadastrais e/ou financeiras a seus usuários e/ou clientes por e-mail, em hipótese alguma.
</p>
      <p class="text_impressao"><strong>5. Informações: </strong>
5.1. É de exclusiva responsabilidade do usuário a interpretação das informações disponibilizadas neste site, bem como das comunicações trocadas entre o setor de Atendimento da Centauro.com.br.
5.2. É responsabilidade de o usuário fornecer informações verídicas e mantê-las atualizadas, principalmente, seus dados cadastrais e bancários, eximindo a Centauro de quaisquer responsabilidades.
</p>
     <p class="text_impressao"><strong>6. Privacidade do Usuário:</strong>
6.1. Temos o compromisso com o nosso usuário de zelar pela excelência em nossos serviços prestados e, principalmente, para com a segurança dos seus dados cadastrais. Por isso, atuamos com tecnologias avançadas e contamos com a competência de diversos profissionais que prezam pela segurança de todo o nosso sistema, proporcionando a você uma excelente experiência de compra. Atuamos com rigorosas políticas de privacidade em todo os nossos processos,  garantindo que os dados cadastrais jamais sejam vendidos, trocados ou divulgados a terceiros, exceto quando isso for condição para algum processo relacionado à entrega, cobrança ou participação em promoções, desde que seja solicitada pelo usuário. Nestes casos, os dados pessoais são fundamentais para que o pedido chegue com assertividade e segurança no endereço de entrega.   
</p> 
    <p class="text_impressao"><strong>7. Responsabilidade do Usuário: </strong>
7.1. O usuário assume todos os ônus e responsabilidades decorrentes dos atos que praticar neste site, ainda, pelos atos que terceiros praticarem em seu nome, por meio do uso de seu login e senha.
7.2. O usuário é o único responsável pelas informações que prestar ou divulgar neste site, inclusive, pelos atos que praticar através do mesmo.
7.3. O usuário SE COMPROMETE A INDENIZAR a Centauro.com.br por quaisquer prejuízos e danos que causar a ele em decorrência de suas ações ou omissões que violem as disposições contidas na legislação vigente ou nos Termos e Condições de Uso do site.
</p>  
    <p class="text_impressao"><strong>8. Exclusão de Garantias e de Responsabilidade:</strong> 
8.1. Em decorrência de questões operacionais e de terceirização de serviços, o Site está sujeito a eventuais problemas de interrupção, falha técnica e indisponibilidade de funcionamento temporário. 
8.2. O Site Centauro.com.br se exime de qualquer responsabilidade pelos danos e prejuízos de toda natureza que possam decorrer da falta de disponibilidade ou de continuidade de funcionamento.
8.3. A Centauro.com.br não se responsabiliza por eventuais produtos pessoais devolvidos erroneamente juntamente com os produtos adquiridos através do site.
Ao solicitar devolução do produto, verifique se existe algum item pessoal que foi utilizado como teste, para evitar que seja encaminhado juntamente com o item objeto de devolução ao Centro de Distribuição. Se houver dúvida de que foi encaminhado item pessoal com objeto da devolução, por favor, contate-nos através do e-mail, Chat ou telefone (11) 4004 8008, para verificação.
8.4. Destacamos que a Centauro.com.br não se responsabiliza pela eventual reprovação de crédito no momento de realização da compra, pois, trata-se de procedimentos da respectiva Administradora do Cartão de Crédito utilizado pelo cliente no momento da compra. Informamos também que o Site não tem conhecimento do motivo da reprovação de crédito e/ou outros motivos da eventual reprovação. Caso ocorra a reprovação de sua compra por essas razões, por favor, entre em contato com a administradora do cartão utilizado no momento da compra.
</p>
     <p class="text_impressao"><strong>9. Condições Comerciais:</strong>
9.1. Processo de compra 
9.1.1. Somente poderão fazer uso e adquirir produtos divulgados no quiosque de personalização da Bout´s pessoas físicas ou jurídicas capazes e em pleno exercício de seus direitos e obrigações, de acordo com a lei brasileira e demais regulamentações internacionais que possam ser aplicáveis.
9.1.2. Todos os preços e condições são válidos apenas para compras realizadas no  quiosque de personalizações da Bout´s e não se aplicam para nossas lojas físicas e para o site centauro.com.br.
9.1.3. Após a finalização da personalização do produto escolhido, o consumidor será remetido a um ambiente de cadastro e autenticação, se o mesmo já possuir cadastro no site da centauro.com.br bastará apenas autenticar-se para que tenha acesso direto à área exclusiva, na qual o cliente informará os dados para fechamento da compra e entrega.
9.1.4. Após o acesso à área segura, o cliente deverá informar os dados para fechamento da compra e entrega, devendo selecionar um dos endereços cadastrados ou, se local de remessa for diferente dos já fornecidos, digitar o CEP do local da entrega do pedido para que o valor do frete seja calculado automaticamente e somado à sua compra.
9.1.5. Após a validação dos dados o consumidor receberá uma confirmação de que a compra foi realizada com sucesso, além de um Código de Compra que deverá ser usado para o acompanhamento do pedido.
9.1.6. Por fim, o usuário receberá uma mensagem do Site Centauro.com.br com os dados da compra, na conta de e-mail fornecida no cadastro.

9.2. Meios de pagamento e reembolso de valores
9.2.1. Atualmente, nossos usuários podem optar pelos pagamentos feitos através de Cartão de Crédito - das bandeiras Hipercard, Mastercard, Credicard, DinnersClub e American Express - e Boleto Bancário.
9.2.2. Caso o usuário opte pelo boleto bancário e o pagamento não seja efetuado até a data do vencimento do título, o pedido será automaticamente cancelado. Se houver problemas no momento da impressão ou da compra, acesse a seção de "Meu cadastro" no Site Centauro.com.br > Informar e-mail e senha de cadastro > Menu Meus Pedidos > , ao lado do pedido realizado com a opção de boleto, acesse o link para reimpressão e clique em "Imprimir boleto".
9.2.3. Caso o usuário opte pelo cartão de crédito, poderá parcelar suas compras com ou sem juros, de acordo com o produto ofertado, das condições do pedido e do tipo de cartão.
9.2.4. O Site Centauro.com.br se reserva ao direito de não trabalhar com cartões de crédito emitidos no exterior.
9.2.5. Destacamos que o Site Centauro.com.br não solicita senha e dados de cartão de crédito aos seus clientes. Excepcionalmente, quando houver o cancelamento da compra e o pagamento se der por boleto bancário, a Centauro.com.br solicitará informações de dados bancários como: nome do banco, agência e conta de seus clientes por e-mail, para o devido ressarcimento. Portanto, pedimos que o usuário que eventualmente receba um e-mail com conteúdo inapropriado ou duvidoso, não responda, desconsidere-o e se possível encaminhe-o para sac@centauro.com.br ou entre em contato através do telefone (11) 4004-8008.
</p>
    <p class="text_impressao"><strong>10. Entrega dos produtos:</strong> 
10.1. Por se tratar de produtos personalizados e de fabricação exclusiva, o prazo de entrega dos produtos adquiridos no Quiosque Bout´s é de até 45 dias após a aprovação do pedido de compra pela operadora do cartão de crédito ou da confirmação do pagamento do boleto bancário.
10.2. O cliente deverá receber os produtos comprados no site de personalização da Bout´s de segunda a sexta, das 08h às 21h, por tal motivo, ele deve se comprometer a manter alguém presente no endereço estipulado para assinar o protocolo de entrega.
10.3. O serviço de entrega do Site Centauro.com.br fará até 03 (três) tentativas de entrega. Caso não seja encontrado ninguém no endereço especificado, a mercadoria voltará para a Central de Distribuição.
10.4. Não será possível a alteração do endereço de entrega após o processamento do pedido e liberação do produto na Central de Distribuição do Site Centauro.com.br.
10.5. O prazo para entrega dos produtos variará de acordo com a região de entrega, a forma de pagamento e o produto comprado. A previsão de entrega será dada na fase de finalização do processo de compra, porém o mesmo não excederá ao prazo máximo de 45 dias após a aprovação do pedido de compra pela operadora do cartão de crédito ou da confirmação do pagamento do boleto bancário.
10.6. O cálculo do frete de entrega dos produtos varia, dependendo da região em que o cliente se encontre, do peso e do volume dos produtos. O valor do frete será feito automaticamente no fechamento das compras, sendo que o cliente será cientificado do valor a ser pago antes da finalização do processo de compra.
10.7. Todos os produtos comprados serão entregues em caixas e/ou envelopes personalizados, lacrados com uma fita exclusiva do Site Centauro.com.br.
10.8. Se o lacre estiver violado, o cliente não deverá aceitar o produto. Neste caso, deve entrar em contato com o serviço de atendimento do site Centauro.com.br, através dos seguintes meios de comunicação:
•	via Chat, acessando o Site Centauro.com.br no endereço eletrônico (www.centauro.com.br), clicando em Atendimento e selecionando a opção atendimento ao vivo (CHAT);
•	por e-mail, acessando o Site Centauro.com.br no endereço eletrônico (www.centauro.com.br), clicando em Atendimento, selecionando a opção fale conosco por e-mail, preenchendo os campos solicitados e clicando em enviar;
•	pelo telefone (11) 4004 8008.
</p>
    <p class="text_impressao"><strong>11. Troca e devolução dos produtos:</strong>
11.1. O cliente que tenha comprado ou ganhado um produto vendido no Quiosque Bout´s terá o direito de realizar apenas a troca do mesmo pelos seguintes motivos:
•	Vício ou Defeito;
•	Avaria ou Entrega de produto em desacordo com o pedido feito;
11.2. Por se tratarem de produtos personalizados, e únicos, não serão aceitas devoluções por insatisfação, desistência ou arrependimento com a compra efetuada no quiosque Bout´s, tendo em vista que não altera a qualidade e características do produto provado pelo consumidor, alterando somente as cores dos itens escolhidos pelo consumidor.
11.3. Apesar do Site Centauro.com.br envidar todos os meios possíveis para que o produto enviado esteja em perfeito estado de funcionamento, caso o cliente perceba algum problema, avaria ou estrago, deverá recusar o recebimento do produto e notificar a Central de Atendimento.
11.4. Caso o problema, avaria ou estrago somente seja detectado após o recebimento do produto, a Central de Atendimento deverá ser notificada novamente e sua solicitação somente será processada se a notificação ocorrer em até 07 (sete) dias corridos, após o recebimento da mercadoria.
11.5. Caso o cliente constate  vício, defeito técnico ou de fabricação do produto, a Central de Atendimento deverá ser notificada e a solicitação somente será processada se a comunicação do fato ocorrer em até 90 (noventa) dias corridos, a partir da data do recebimento da mercadoria, conforme estabelece o artigo 26, II, § 1º, do Código De Defesa Do Consumidor.
11.6. Caso o defeito técnico ou de fabricação do produto seja constatado somente após 90 (noventa) dias do recebimento do produto, independentemente do tipo, o cliente deverá encaminhar o produto à Assistência Técnica do Fabricante para conserto ou troca do mesmo, utilizando-se do prazo de garantia, ficando o Site Centauro.com.br isento de qualquer responsabilidade, a partir desse prazo, conforme estabelece o artigo 13, I, do Código De Defesa Do Consumidor.
11.7. A Centauro.com.br isenta-se de trocar o produto ou ressarcir o consumidor, no caso  que tenha sido constatado algum vício de qualidade por mau uso.
11.8. Caso o cliente receba um produto em desacordo com o pedido feito, deverá o mesmo recusar a entrega da mercadoria e notificar a Central de Atendimento do ocorrido.
11.9. Caso o envio de mercadoria em desacordo somente seja detectado após o recebimento do produto, a Central de Atendimento deverá ser notificada novamente e sua solicitação somente será processada se a notificação ocorrer em até 07 (sete) dias corridos, após o recebimento da mercadoria.
11.10. Por se tratar de produtos personalizados, e conseqüentemente únicos, o prazo para reposição desses é de até 45 dias corridos após o recebimento do produto em nosso centro de distribuição.  
11.11. Para que se evite o erro de apuração da data de entrega, tal deverá ser checada em nosso sistema e, caso a data informada seja incompatível, não será possível a troca ou devolução do produto. 
11.12. Toda troca de produto deverá ser comunicada à Central de Atendimento antes do reenvio dos produtos ao nosso Centro de Distribuição. Tal procedimento visa confirmar se a mercadoria a ser devolvida está dentro das normas dos Termos de Uso do Site Centauro.com.br.
11.13. Só será aceita a troca do produto que esteja:
•	Perfeitamente acondicionado na embalagem original;
•	Acompanhado de todos os acessórios;
•	Sem indícios de estrago por mau uso;
•	Acompanhado da 1ª via da Nota Fiscal de Venda ou Cupom Fiscal (a mesma sempre será enviada com o produto, sendo que aquelas relativas a presentes não demonstrarão o valor da compra).
11.14. Qualquer produto devolvido sem essa comunicação anterior deverá ser reenviado ao cliente sem prévia consulta.
11.15. Toda troca de produto somente poderá ser realizada pelo mesmo meio em que foi recebido, por tal motivo, as trocas ou devoluções que não ocorram no exato momento da entrega somente poderão ocorrer após o acionamento da Central de Atendimento, que providenciará o meio de recolhimento do produto.
11.16. Quando a devolução do produto para troca não for feita pelos motivos abaixo, a Central de Atendimento entrará em contato com o cliente para resolver o problema:
•	Ausência do cliente no local;
•	Endereço incorreto;
•	Descumprimento dos quesitos a, b e c do item 11.13.
11.17. Caso não seja possível solucionar a ocorrência em até 05 (cinco) dias úteis, a solicitação de devolução do produto será cancelada.
11.18. A troca será efetivada após análise do produto, feita pela Central de Distribuição. O prazo será de até 45 dias úteis, contados a partir do recebimento do produto.
11.19. Havendo descumprimento de qualquer dos quesitos elencados no item 11. o Site Centauro.com.br não acatará a solicitação de troca do produto que será remetido para o respectivo endereço de entrega.
</p> 
     <p class="text_impressao"><strong>12. Do cancelamento da compra pelo Site Centauro.com.br:</strong> 
12.1. Por se tratarem de produtos personalizados, após a finalização do pedido, não será possível realizar alterações ou cancelamento do pedido realizado através do Quiosque Bout´s.
12.2. O cancelamento da compra por iniciativa do Site Centauro.com.br será automático nas seguintes situações:
•	Não pagamento do boleto bancário;
•	Inconsistência de dados preenchidos no pedido;
•	Impossibilidade de entrega do produto adquirido, em vista de inexistência do endereço de entrega como indicado pelo comprador ou a sua não acessibilidade. Não tendo sido feita a entrega por essa razão, o Site Centauro.com.br fará retornar o(s) produto(s) para sua Central de Distribuição e anulará a operação, gerando devolução por parte do Site Centauro.com.br dos valores correspondentes aos preços dos produtos, excluindo-se os custos com frete;
•	Caso ocorram erros sistêmicos que alterem dados, erros de informações referentes ao produto ou até mesmo referentes aos preços informados no site, o cliente será comunicado via e-mail e/ou telefone. Não tendo sido feita a entrega por essa razão, o Site Centauro.com.br fará retornar o(s) produto(s) para sua Central de Distribuição e anulará a operação, gerando devolução por parte do Site Centauro.com.br dos valores correspondentes aos preços dos produtos, excluindo-se os custos com frete.
12.3. O cancelamento da compra por iniciativa do Site Centauro.com.br, ocorrerá após 05 (cinco) dias da data da compra sem alteração na forma de pagamento, nova tentativa de cobrança, após solicitação do cliente na seguinte situação:
•	Impossibilidade de execução ou efetivação do débito correspondente à compra no cartão de crédito.
</p>
    <p class="text_impressao"><strong>13. Modificações destes Termos e Condições:</strong>
13.1. Os Termos e Condições de Uso do Quisoque Bout´s estão sujeitos a constante melhoria e aprimoramento. Assim, o Site Centauro.com.br se reserva o direito de modificar a qualquer momento, de forma unilateral, o presente Termos e Condições de Uso, não gerando ônus  para o consumidor que já finalizou a compra.
13.2. Ao navegar  pelo Quiosque Bout´s, você aceita guiar-se pelos Termos e Condições de Uso do Site que se encontram vigentes na data e, portanto, deve verificar os mesmos previamente cada vez que visitá-lo. 
</p>
    <p class="text_impressao"><strong>14. Rescisão:</strong> 
14.1. O presente Termo e Condições de Uso tem validade e eficácia a menos e até ser denunciado pelo usuário/cliente ou pelo Site Centauro.com.br. O usuário/cliente poderá encerrar este acordo a qualquer momento, desde que interrompa qualquer uso deste Site. A Centauro.com.br também pode denunciar o presente acordo a qualquer momento imediatamente e sem aviso prévio, e, consequentemente, negar-lhe o acesso ao Site, se você deixar de cumprir qualquer termo ou disposição do presente Acordo. Em caso de cancelamento do acordo pelo usuário/cliente ou pelo Site Centauro.com.br, o usuário/cliente deverá imediatamente destruir todos os materiais baixados ou obtidos a partir deste Site, bem como todas as cópias de tais materiais, mesmo que tenham sido obtidos conforme os Termos de Uso.
</p>
     <p class="text_impressao"><strong>15. Disposições Gerais:</strong> 
15.1. A tolerância do eventual descumprimento de quaisquer das cláusulas e condições do presente instrumento não constituirá renovação das obrigações aqui estipuladas, e tampouco, impedirá ou inibirá a exigibilidade das mesmas a qualquer tempo.
15.2. O usuário autoriza expressamente o Site Centauro.com.br a comunicar-se com o mesmo através de todos os canais de comunicação disponíveis, incluindo correio eletrônico (e-mail), celular, SMS, entre outros, ficando ressaltado que a principal via de informação para o usuário é o Site Centauro.com.br .
15.3. Este site tem como base o horário oficial de Brasília.
</p>
    <p class="text_impressao"><strong>16. Lei aplicável e Jurisdição:</strong> 
16.1. Os Termos e Condições de Uso aqui descritos são regidos pela legislação da República Federativa do Brasil. Seu texto deverá ser interpretado no idioma português e os usuários do site se submetem ao Foro da Comarca da Capital do Estado de São Paulo.
16.2. Os Termos e Condições de Uso do Quiosque Bout´s aplicam-se a todos os usuários, clientes etc que utilizam o sistema para personalização dos produtos.
</p>
     <p class="text_impressao"><strong>17. Dúvidas:</strong> 
17.1. Caso tenha qualquer dúvida em relação ao presente documento, favor entrar em contato enviando um e-mail para sac@centauro.com.br ou pelo telefone (11) 4004 8008.
</p>
 </div>
 
 <a href="" class="btnFechar" id="fecharPopup">FECHAR</a>    
    
</div>
 
</body>
</html>