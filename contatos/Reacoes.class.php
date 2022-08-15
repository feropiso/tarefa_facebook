<?php

if(!isset($_SESSION))
session_start();



include_once 'constantes.php';
include_once RAIZ_BD.'BdUtil.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/tarefa_facebook_php/auxiliar/Reacao.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/tarefa_facebook_php/auxiliar/Postagens.class.php';



class Reacoes {
		
	
		
	public function curtida() {
		
		
		$bd=new BdUtil;
				
		
		$like = 1;
		$postagem = $_POST["i"];		
		$usuario = $_SESSION["id_usuario"];	
				
		
		$resposta = $bd->getComoArray("SELECT curtir FROM reacao_usuario WHERE postagem='".$postagem."' AND fk_usuario= '".$usuario."'");	
		
		
		$reacao=new Reacao;
		
		
		$reacao->postagem = $postagem;
		$reacao->curtir = $like;
		$reacao->fk_usuario = $usuario;
		//$reacao->comentario = "0";			
		//$reacao->compartilhar = 0;
		
			if($resposta===null|| !is_array($resposta) || count($resposta)==0){
							
				$retorno=$bd->novo($reacao);	
				print_r($reacao);
				echo $retorno;
				echo '{"situacao":"OK"}';
				return;
				
			}	
	
			if($resposta[0]["curtir"]==0){
				
				$bd->altera($reacao);						
				echo '{"situacao":"OK"}';
				return;
			}
		
		
		$reacao2 = new Reacao;
		
		$reacao2->postagem = $_POST["i"];
		$reacao2->curtir = 0;
		$reacao2->fk_usuario = $usuario;
		
		
		$bd->altera($reacao2);
		

		echo '{"situacao":"OK"}';	
	}
	
	
	
	public function compartilhamento(){


		$bd = new BdUtil;
				
		
		$compartilhar = 1;
		$usuario = $_SESSION["id_usuario"];			
				
		
		$dadosPostagem = $bd->getComoArray("SELECT texto, imagem FROM postagens WHERE id_postagem='".$_POST["i"]."'");
		
		
		$reacao = new Reacao;
		
		
		$reacao->postagem = $_POST["i"];				
		$reacao->fk_usuario = $usuario;			
		$reacao->compartilhar = $compartilhar;
		
		
		$bd->novo($reacao);

		
		$postagem = new Postagens;
		
		
		$postagem->texto = $dadosPostagem[0]['texto'];
		$postagem->imagem = $dadosPostagem[0]['imagem'];
		$postagem->fkPostUsuario = $usuario;
		
		
		$bd->novo($postagem);
		
		
		echo '{"situacao":"OK"}';		
	}	
	
	
	
	public function comentar(){
		
		
		$bd = new BdUtil;
		
		
		$usuario = $_SESSION["id_usuario"];	

		
		$reacao = new Reacao;
		
		
		$reacao->postagem = $_POST["i"];
		$reacao->comentario = $_POST["comentario"];
		$reacao->fk_usuario = $usuario;
		
		
		$bd->novo($reacao);
		
		
		echo '{"situacao":"OK"}';
	}
	
}

?>