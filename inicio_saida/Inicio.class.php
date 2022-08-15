<?php

if(!isset($_SESSION))
session_start();



include_once $_SERVER['DOCUMENT_ROOT'].'/tarefa_facebook_php/constantes.php';



class Inicio{
	
	
	
	public function conteudo(){		
		
		$this->topoInicio();
		$this->corpoEsquerda();
		$this->corpoCentro();
		$this->postagens();		
	}
	
	
	
		public function topoInicio(){
						
			$retorno=$this->conectaBD();
						
			echo'<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
			<title>Facebook</title>
			<style>

			</style>
			<link rel="stylesheet" type="text/css"  href="'.RAIZ.'css/estiloInicio.css?id='.rand().'">

			</head>
			<body>
			<div id="topo"> 
				<div id="topoEsquerda"> 
					<a href="http://localhost/tarefa_facebook_php/home.php"><img src="/facebook/imgs/facebook.jpg" id="logo"></a>	
					<input type="text" id="pesquisar" name="pesquisar" placeholder="Pesquisar no Facebook" onkeyup="javascript:encontraAmigo(this.value)">
										
					<div id="sugestao">
						
						<input type="hidden" id="recebeID" name="recebeID">
						
						<div class="foto">
							<button onclick="javascript:abrirPerfil()" class="button2"><img id="fotoAmigo" width="30px" height="30px" style="border-radius:50%;"></button>
						</div>
						<div class="nomeUsuario">
							<p id="txtDica"></p>
						</div>
						
					</div>									
				</div>			
				<div id="topoCentro">
			
					<div id="pag_inicial"> 
						<a href="http://localhost/tarefa_facebook_php/home.php"><img src="/facebook/imgs/pag_inicial.png" width="25px" height="25px"></a>
						<div class="dropdown"> 
							<p>Página inicial</p>	
						</div>			
					</div>';
				
			$iconesTopo = array("/facebook/imgs/amigos.png","/facebook/imgs/watch.png",
				"/facebook/imgs/marketplace.jpg","/facebook/imgs/grupos.jpg");
			
			$textoTopo = array("Amigos","Watch", "Marketplace", "Grupos");
			
				for ($i=0; $i<4; $i++)
						echo '	
					<div class="auxiliar">
						<a href="http://localhost/tarefa_facebook_php/home.php"><img src="'.$iconesTopo[$i].'" width="25px" height="25px"></a>
						<div class="dropdown">
							<p>'.$textoTopo[$i].'</p>
						</div>		
					</div>';				
				
			echo'	
			</div>
			
			<div id="topoDireita"> 
				<div id="usuario">
					<div class="foto">
						<button onclick="javascript:perfil('.$_SESSION["id_usuario"].')" class="button2"><img src="'.$_SESSION["foto"].'" width="30px" height="30px" style="border-radius:50%;"></button>
					</div>			
					<div class="nomeUsuario">
						<p>'.$_SESSION["nome"].'</p>
					</div>		
				</div>';
			
			$iconesTopo2 = array("/facebook/imgs/criar.jpg","/facebook/imgs/messenger.png");
			
			$textoTopo2 = array("Criar","Menssenger");
			
				for ($i=0; $i<2; $i++)
					echo'
						<div class="auxiliar2">
							<a href="http://localhost/tarefa_facebook_php/home.php"><img src="'.$iconesTopo2[$i].'" width="25px" height="25px"></a>
							<div class="dropdown">
								<p>'.$textoTopo2[$i].'</p>
							</div>
						</div>';
				
			$id_solicitacao=$retorno->getComoArray("SELECT id_solicitacao, fk_solicitante FROM solicitacao WHERE fk_solicitado= '".$_SESSION["id_usuario"]."'");
				
				if($id_solicitacao===null || !is_array($id_solicitacao) || count($id_solicitacao)==0){
					
					echo'
						<div class="auxiliar2">
							<a href="http://localhost/tarefa_facebook_php/home.php"><img src="/facebook/imgs/sino.png" width="25px" height="25px"></a>
							<div class="dropdown">
								<p>Notificações</p>
							</div>
						</div>';	
				}
				else{
					
					echo'
						
						<div class="auxiliar3">
							
							<button onclick="javascript:notificacao()" class="button"><img src="/facebook/imgs/sino.png" width="25px" height="25px"></button>';
							
							
							for($i=0; $i<count($id_solicitacao); $i++){
								
								$identificacao3 = $retorno->getComoArray("SELECT nome_completo, foto FROM usuarios 
									WHERE id_usuario= '".$id_solicitacao[0]["fk_solicitante"]."'");
									
								echo'
								
								<p id="textoSolicitacao">Solicitação de amizade</p>
									
									<div id="usuario3">
										<div class="foto">
											<button onclick="javascript:perfil('.$id_solicitacao[0]["fk_solicitante"].')" class="button2"><img src="'.$identificacao3[$i][1].'" width="30px" height="30px" style="border-radius:50%;"></button>
										</div>
										<div class="nomeUsuario">
											<p>'.$identificacao3[$i][0].'</p>
										</div>
										<button onclick="javascript:confirmarAmizade('.$id_solicitacao[0]["fk_solicitante"].')" class="button3">Confirmar</button>
									</div>';		
								
							}							
						echo'	
						</div>
						<p id="numero" style="color:red;float:left;">'.count($id_solicitacao).'</p>';						
				}
				
			echo'			
				<div class="auxiliar2">				
					<button onclick="javascript:sair()" class="button"><img src="/facebook/imgs/conta.png" width="25px" height="25px"></button>						
					<div class="dropdown">
						<p>Sair</p>
					</div>
				</div>	
				
				</div>
			
				</div>';
		}
		
		
		
		public function corpoEsquerda(){
			
			echo'
				<div id="corpoEsquerda">

				<div class="usuario2">
					<div class="foto">
						<button onclick="javascript:perfil('.$_SESSION["id_usuario"].')" class="button2"><img src="'.$_SESSION["foto"].'" width="30px" height="30px" style="border-radius:50%;"></button>
					</div>
					<div class="nomeUsuario">
						<p>'.$_SESSION["nome_completo"].'</p>
					</div>
				</div>
				<div class="usuario2">		
					<div class="nomeUsuario">
						<p>COVID:Central de Informações</p>
					</div>
				</div>
				';
			$iconesTopo3 = array("/facebook/imgs/amigos.png","/facebook/imgs/grupos.jpg",
				"/facebook/imgs/marketplace.jpg","/facebook/imgs/watch.png", 
				"/facebook/imgs/eventos.png","/facebook/imgs/lembrancas.jpg", 
				"/facebook/imgs/salvos.png", "/facebook/imgs/ver_mais.png");
			
			$textoTopo3 = array("Encontrar amigos","Grupos", "Marketplace", "Vídeos", "Eventos", 
			"Lembranças", "Salvos", "Ver mais");
			
				for ($i=0; $i<count($iconesTopo3); $i++)
					echo'			
						<div class="usuario2">
							<div class="foto">
								<a href="http://localhost/tarefa_facebook_php/home.php"><img src="'.$iconesTopo3[$i].'" width="25px" height="25px"></a>
							</div>
							<div class="nomeUsuario">
								<p>'.$textoTopo3[$i].'</p>
							</div>
						</div>';
						
			echo'</div>';
		}
		
		
		
		public function corpoCentro(){
						
			echo'<div id="corpoCentro">
		 
				<div class="topoCentral">
					
					<div id="topoUsuario">
						<div class="foto">
							<button onclick="javascript:perfil('.$_SESSION["id_usuario"].')" class="button2"><img src="'.$_SESSION["foto"].'" width="40px" height="40px" style="border-radius:50%;"></button>
						</div>					  
						<input type="text" id="pensamento" name="pesquisar" placeholder="No que esta pensando, '.$_SESSION["nome"].'?" style="color:LightGray;">		
					</div>';
				
				$iconesCorpo = array("/facebook/imgs/filmadora.png","/facebook/imgs/fotos_videos.png");
			
				$textoCorpo = array("Vídeo ao vivo","Foto/vídeo");
			
				for ($i=0; $i<count($iconesCorpo); $i++)
			
					echo'
					<div class="compartilhamento">
						<div class="foto">
							<a href="http://localhost/tarefa_facebook_php/home.php"><img src="'.$iconesCorpo[$i].'" width="30px" height="30px"></a>
						</div>	
						<div>
							<p>'.$textoCorpo[$i].'</p>				
						</div>						
					</div>';
				
				echo'			
					<div class="compartilhamento2">
						<div class="foto">
							<a href="http://localhost/tarefa_facebook_php/home.php"><img src="/facebook/imgs/sentimento.png" width="25px" height="25px"></a>
						</div>	
						<div>
							<p>Sentimento/atividade</p>				
						</div>						
					</div>
				</div>			
				<div class="topoCentral">
						<div class="compartilhamento3">
							<div class="foto">
								<a href="http://localhost/tarefa_facebook_php/home.php"><img src="/facebook/imgs/filmadora.png" width="25px" height="25px"></a>
							</div>	
							<div>
								<p>Salas.</p>				
							</div>						
						</div>
						
						<div class="compartilhamento4">			
							<div>
								<p>Faça um bate-papo de vídeo com amigos</p>				
							</div>						
						</div>
						
						<div class="compartilhamento5">
							<div class="foto">
								<a href="http://localhost/tarefa_facebook_php/home.php"><img src="/facebook/imgs/informa.png" width="20px" height="20px"></a>
							</div>										
						</div>
						
						<div class="compartilhamento6">			
							<div>
								<p>Criar sala</p>				
							</div>						
						</div>
						
					<div class="foto">
						<button onclick="javascript:perfil('.$_SESSION["id_usuario"].')" class="button2"><img src="'.$_SESSION["foto"].'" width="40px" height="40px" style="border-radius:50%;"></button>
					</div>				
					
				</div>';
				
		}
			
		
		
		public function postagens(){
									
			$retorno=$this->conectaBD();			
			$id_amizade = $retorno->getComoArray("SELECT id_amigos FROM amigos WHERE fk_amigo_1='".$_SESSION["id_usuario"]."' OR fk_amigo_2= '".$_SESSION["id_usuario"]."'");
			
			
			$feed_postagens=$this->postagensUsuario();	
				
				
				if($id_amizade===null || !is_array($id_amizade) || count($id_amizade)==0){
										
					if ($feed_postagens!== null)							
						$this->preparaPostagens($feed_postagens);
						
					$this->corpoDireita($id_amizade);
				}			
				else{
										
					$arrayPostagens=$this->postagensAmigos($this->retornaIDAmigos($id_amizade));					
					$this->preparaPostagens($arrayPostagens);
					$this->preparaPostagens($feed_postagens);
					$this->corpoDireita($this->retornaIDAmigos($id_amizade));
				}
					
		}
		
		
		
			public function postagensUsuario(){
				
				$retorno=$this->conectaBD();
				$postagens = $retorno->getComoArray("SELECT id_postagem, texto, imagem FROM postagens WHERE fk_post_usuario= '".$_SESSION["id_usuario"]."'");
								
				return $postagens;
			}
			
			
			
			
			public function postagensAmigos($amigosID){
								
				$retorno=$this->conectaBD();				
				$arrayPostagens = array();
				
				for($i=0; $i<count($amigosID); $i++)
					$arrayPostagens=$retorno->getComoArray("SELECT id_postagem, texto, imagem FROM postagens WHERE fk_post_usuario= '".$amigosID[$i]."'");
								
				return $arrayPostagens;
			}
			
			
			
				public function preparaPostagens($feed_postagens){
										
					$retorno=$this->conectaBD();					
										
					for($j=0; $j<count($feed_postagens); $j++){
						
						
						$feed_reacoes=$this->reacaoUsuario($feed_postagens[$j]['id_postagem']);				
						$cont_reacoes=$this->contaReacao($feed_reacoes);
						
						$identificacao = $retorno->getComoArray("SELECT fk_post_usuario FROM postagens 
							WHERE id_postagem= '".$feed_postagens[0]['id_postagem']."'");
							
						
						$identificacao1 = $retorno->getComoArray("SELECT nome_completo, foto FROM usuarios 
							WHERE id_usuario= '".$identificacao[0]["fk_post_usuario"]."'");
						
						
						$this->blocoPostagem($identificacao[0]["fk_post_usuario"], $identificacao1[0]["foto"], 
								$identificacao1[0]["nome_completo"], $feed_postagens[$j]['texto'], 
								$feed_postagens[$j]['imagem'], $feed_postagens[$j]['id_postagem'],
								$cont_reacoes[0], $cont_reacoes[1], $cont_reacoes[2]);
								
							if($feed_reacoes!==null){
								
								for($i=0; $i<count($feed_reacoes); $i++){
									
									if($feed_reacoes[$i]['comentario'] !="" 
										||$feed_reacoes[$i]['comentario']!= null){
											
										$identificacao2 = $retorno->getComoArray("SELECT foto,  nome_completo FROM usuarios WHERE id_usuario= '".$feed_reacoes[$i]['fk_usuario']."'");
										$this->blocoComentario($identificacao2[0]['foto'], $identificacao2[0]['nome_completo'], 
											$feed_reacoes[$i]['comentario'], $feed_reacoes[$i]['fk_usuario']);
									}
								}
							}
							
					}
					
				}				
					
					
				
					public function retornaIDAmigos($id_amizade){
												
						$retorno=$this->conectaBD();
						
						$id_Array= array();
						//fazer um laço aqui!
						$x = $retorno->getComoArray("SELECT fk_amigo_1, fk_amigo_2 FROM amigos WHERE id_amigos= '".$id_amizade[0]["id_amigos"]."'");
						
							for($i=0; $i<count($x); $i++){
								
								if($x[$i]['fk_amigo_1']==$_SESSION["id_usuario"])
									$id_Array[$i]=$x[$i]['fk_amigo_2'];
								
								else
									$id_Array[$i]=$x[$i]['fk_amigo_1'];
							}
							
						return $id_Array;
					}


				
			public function reacaoUsuario($postagemID){
								
				$retorno=$this->conectaBD();
								
				$reacoes = $retorno->getComoArray("SELECT curtir,  compartilhar, comentario, fk_usuario FROM reacao_usuario WHERE postagem= '".$postagemID."'");
								
				return $reacoes;
			}
			
			
			
			public function contaReacao($reacoes){
				
				$curtidas=0;
				$compartilhamentos=0;
				$comentarios=0;
				$arrayReacoes = array();
				
				if($reacoes===null || !is_array($reacoes) || count($reacoes)==0){
					$arrayReacoes = array($curtidas, $compartilhamentos, $comentarios);
					return $arrayReacoes;
				}
				
				for($i=0; $i<count($reacoes); $i++){
									
					if($reacoes[$i]['curtir']==1)
						$curtidas++;
									
					if($reacoes[$i]['compartilhar']==1)
						$compartilhamentos++;
									
					if($reacoes[$i]['comentario'] !="" || $reacoes[$i]['comentario']!= null)
						$comentarios++;				
				}
				
				
				$arrayReacoes = array($curtidas, $compartilhamentos, $comentarios);
				
				
				return $arrayReacoes;
			}
			
			
			
			public function blocoPostagem($donoPost_id, $donoPost_foto, $donoPost_nome, $descricao, 
			$imagemPost, $postagem_id, $curtidas, $compartilhamentos, $comentarios ){
				
				
				$emojiArray=array("/facebook/imgs/curtir.jpg", "/facebook/imgs/riso.png",
				"/facebook/imgs/uau.png");
				
				
				echo'<div class="postagem">
				
						<div class="topoPostagem">
						
							<div class="titulo">				
								<div class="foto">
									<button onclick="javascript:perfil('.$donoPost_id.')" 
									class="button2"><img src="'.$donoPost_foto.'" 
									width="30px" height="30px" style="border-radius:50%;"></button>
								</div>
								
								<div class="nomeUsuario">
									<p>'.$donoPost_nome.'</p>
								</div>
							</div>
							
							<div class="descricao">
								<p>'.$descricao.'</p>				
							</div>
							
						</div>
						
						<div class="corpoPostagem">
											
							<div>
								<img src="'.$imagemPost.'" width="100%" height="260px">			
							</div>
												
							<div class="interagir">';
							
							for($i=0; $i<count($emojiArray); $i++)
								
								echo'
								<div class="emoji">
									<button onclick="javascript:curtir('.$postagem_id.')" class="button"><img src="'.$emojiArray[$i].'" width="25px" height="25px"></button>						
								</div>';
								
								
							echo'	
								<div class="texto5">
									<p>'.$curtidas.'</p>
								</div>
								
								<div class="texto6">';
								
						$arrayAux=array($comentarios, "comentários", $compartilhamentos,
								"compartilhamentos");
							
							for($i=0; $i<count($arrayAux); $i++)
								
								echo'
									<div class="reacao">
										<p>'.$arrayAux[$i].'</p>
									</div>';
							
							echo'
								</div>
								
							</div>
							
							<div class="interagir2">
								<div class="interagir3">
									<button onclick="javascript:curtir('.$postagem_id.')" class="button"><img src="/facebook/imgs/curtir2.png" width="25px" height="25px"></button>					
								</div>
								
								<div class="texto7">
									<p>Curtir</p>
								</div>
								
								<div class="interagir3">
									<button class="button"><img src="/facebook/imgs/comentar.png" width="25px" height="25px"></button>					
								</div>
								
								<div class="texto7">
									<p>Comentar</p>
								</div>
								
								<div class="interagir3">
									<button onclick="javascript:compartilhar('.$postagem_id.')" class="button"><img src="/facebook/imgs/compartilhar.png" width="25px" height="25px"></button>										
								</div>
								
								<div class="texto7">
									<p>Compartilhar</p>
								</div>
							</div>
							
							<div class="blocoComentar">	
							
								<input type="text" id="comentario'.$postagem_id.'" name="comentario'.$postagem_id.'" 
								style="background-color:rgb(60,60,60);float:left;color:LightGray;
								width:75%;height:35px;box-sizing:border-box;border:1px solid #ccc;
								border-radius:15px;font-size:16px;padding:5px;margin:5px;">
								
								<div class="reacao">								
									<button onclick="javascript:comentar('.$postagem_id.')" class="button2"><img src="/facebook/imgs/salvar.png" width="25px" height="25px"></button>
								</div>							
							</div>						
							
						</div>				
						
					</div>';
				
			}
			
			
			
				public function blocoComentario($foto, $nome, $comentario, $comentarista_id){
					
					echo '
						<div class="blocoComentario">	
											
							<div class="foto">
								<button onclick="javascript:perfil('.$comentarista_id.')" class="button2"><img src="'.$foto.'" width="30px" height="30px" style="border-radius:50%;"></button>
							</div>
												
							<div class="nomeUsuario">
								<p>'.$nome.'</p>
							</div>
										
							<div class="blocoTexto">
								<p>'.$comentario.'</p>
							</div>
										
						</div>';				
				}
		
		
		
		public function corpoDireita($amigos_id){
						
			$retorno=$this->conectaBD();
						
			echo'
				<div id="corpoDireita"> 
					
				<div class="nomeUsuario">
					<p>Contatos</p>			
				</div>';
				
				if($amigos_id!==null || is_array($amigos_id) || count($amigos_id)!=0){
												
					for($i=0; $i<count($amigos_id); $i++){
						
						$arrayIdentificacao=$retorno->getComoArray("SELECT nome_completo, foto FROM usuarios WHERE id_usuario = '".$amigos_id[$i]."'");
						echo '				
							<div class="usuario2">
								<div class="foto">
									<button onclick="javascript:perfil('.$amigos_id[$i].')" class="button2"><img src="'.$arrayIdentificacao[$i][1].'" width="30px" height="30px" style="border-radius:50%;"></button>
								</div>
								<div class="nomeUsuario">
									<p>'.$arrayIdentificacao[$i][0].'</p>
								</div>
							</div>';
					}					
				}
				
			echo '	
				</div>
				
				<div style="clear:both"></div>
				
				</body>
				</html>';
		}
		
		
		
		public function conectaBD(){
			
			include_once RAIZ_BD.'BdUtil.class.php';
			
			$bd = new BdUtil;
				
			return $bd;
		}
		
}

?>