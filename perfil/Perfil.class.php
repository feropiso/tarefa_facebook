<?php
if(!isset($_SESSION))
session_start();



include_once $_SERVER['DOCUMENT_ROOT'].'/tarefa_facebook_php/inicio_saida/Inicio.class.php';



class Perfil extends Inicio{
		
	
	
	public function formPerfil(){
		
		$this->topoPerfil();		
	}
	
	
	
		public function topoPerfil(){
			
			$fotoPerfil ="";
			$nome = "";
			
			$retorno=$this->conectaBD();
				
			$identificacao3 = $retorno->getComoArray("SELECT foto, nome_completo FROM usuarios WHERE id_usuario= '".$_SESSION["i"]."'");
			
			$fotoPerfil = $identificacao3[0]['foto'];
			$nome = $identificacao3[0]['nome_completo'];
			
			
			echo'<meta charset="UTF-8">
			<title>'.$_SESSION["nome"].'</title>
				<style>

				</style>
					<link rel="stylesheet" type="text/css"  href="'.RAIZ.'css/estiloPerfil.css?id='.rand().'">

				</head>
				<body>
					<div id="topo">
						
						<div id="topoEsquerda">
						
							<div id="usuario">				
								<a href="http://localhost/tarefa_facebook_php/perfil.php"><img src="'.$fotoPerfil.'" id="fotoPerfil"></a>							
								<div id="nome">
									<p>'.$nome.'</p>
								</div>		
							</div>
										
						</div>
						
						<div id="topoDireita">
						
							<div id="atualiza">
								<p>Atualizar Informações</p>
							</div>
							
							<div id="registro">			
								<p>Ver Registro de Atividades</p>				
							</div>
										
						</div>
						
						<div id="topoBaixo">';
						
			$arrayButtons= array("Linha do tempo","Sobre","Amigos","Fotos");
				
				
				for($i=0; $i<count($arrayButtons); $i++)
					echo'<button class="button3">'.$arrayButtons[$i].'</button>';
					
				
				if($this->verificaAmizade()){
					
					if($this->verificaSolicitacao())
						echo '<button onclick="javascript:confirmarAmizade('.$_SESSION["i"].')" class="button4"><img src="/facebook/imgs/add_facebook_icon.png" width="40px" height="45px"></button>';
					else
						echo '<button onclick="javascript:solicitaAmizade('.$_SESSION["i"].')" class="button4"><img src="/facebook/imgs/add_facebook_icon.png" width="40px" height="45px"></button>';
				}
				
			echo'
				</div>
			</div>		
			
			<div id="corpo">
			
				<div id="esquerda">
				
					<div id="apresentacao"> 
					
						<div id="texto">			
							<p>Apresentação</p>				
						</div>
						
					</div>	
					
				</div>
				<div id="direita">';			
				
				$this->corpoCentro();
				$this->postagemPerfil($fotoPerfil, $nome);
			
			echo'</div>
			</div>';
			
		}
		
		
		
		public function postagemPerfil($fotoPerfil, $nome){
			
			
			$retorno=$this->conectaBD();
			
			
			$postagensUsuario = $retorno->getComoArray("SELECT * FROM postagens WHERE fk_post_usuario= '".$_SESSION["i"]."'");
			
				
				if($postagensUsuario!==null){	
				
					for($i=0; $i<count($postagensUsuario); $i++){
						
						$feed_reacoes=$this->reacaoUsuario($postagensUsuario[$i]['id_postagem']);
						$cont_reacoes=$this->contaReacao($feed_reacoes);
						
						$this->blocoPostagem($_SESSION["i"], $fotoPerfil, $nome, 
							$postagensUsuario[$i]['texto'], $postagensUsuario[$i]['imagem'],
							$postagensUsuario[$i]['id_postagem'], $cont_reacoes[0], 
							$cont_reacoes[1], $cont_reacoes[2]);							
							
							if ($feed_reacoes!== null){
								
								for($j=0; $j<count($feed_reacoes); $j++){
									
									if($feed_reacoes[$j]['comentario'] !="" || $feed_reacoes[$j]['comentario']!= null){
										
										$identificacao2 = $retorno->getComoArray("SELECT foto,  nome_completo FROM usuarios WHERE id_usuario= '".$feed_reacoes[$j]['fk_usuario']."'");
										
										$this->blocoComentario($identificacao2[0]['foto'], $identificacao2[0]['nome_completo'], 
											$feed_reacoes[$j]['comentario'], $feed_reacoes[$j]['fk_usuario']);
									}
								}
							}
					}
												
				}
				
			echo '		
				</div>

				<div style="clear:both"></div>

				</body>
				</html> ';
		}
		
		
		
		public function verificaAmizade(){
			
			
			$aux=false;
			
			
				if($_SESSION["id_usuario"]===$_SESSION["i"])
					return $aux;
			
			
			$retorno=$this->conectaBD();
			
			
			$id_amizade = $retorno->getComoArray("SELECT id_amigos FROM amigos WHERE fk_amigo_1='".$_SESSION["i"]."' AND fk_amigo_2='".$_SESSION["id_usuario"]."'OR fk_amigo_1='".$_SESSION["id_usuario"]."' AND fk_amigo_2= '".$_SESSION["i"]."'");
				
				
				if($id_amizade===null || !is_array($id_amizade) || count($id_amizade)==0 ){
					$aux=true;
					return $aux;					
				}				
				
			return $aux;
		}

		
		
		public function verificaSolicitacao(){
			
			
			$aux=false;
			
			$retorno=$this->conectaBD();
			
			$fk_amizade = $retorno->getComoArray("SELECT fk_solicitante FROM solicitacao WHERE fk_solicitado='".$_SESSION["id_usuario"]."'");
				
				
				if($fk_amizade===null || !is_array($fk_amizade) || count($fk_amizade)==0 )
					return $aux;
				
				if($fk_amizade[0]['fk_solicitante']==$_SESSION["i"]){
					$aux=true;
					return $aux;
				}
					
			return $aux;
		}	
	
}

?>