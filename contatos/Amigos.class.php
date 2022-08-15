<?php
if(!isset($_SESSION))
session_start();



include_once 'constantes.php';
include_once RAIZ_BD.'BdUtil.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/tarefa_facebook_php/auxiliar/Solicitacao.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/tarefa_facebook_php/auxiliar/Friends.class.php';



class Amigos{
	
	
	
	public function encontraAmigos(){
		
		
		$bd = new BdUtil;
		$dica = "";				
		$usuarios = $bd->getComoArray("SELECT id_usuario, nome_completo, foto FROM usuarios WHERE id_usuario <> '".$_SESSION["id_usuario"]."'");
		
		
			if (strlen($_POST["i"])==0 || $usuarios===false || !is_array($usuarios)) {				
				echo '{"situacao":"erro"}';
				return;    
			}
		
		
		$q = strtolower($_POST["i"]);
		$tam = strlen($q);
		
		
			if ($q !== "") {
				
				foreach($usuarios as $n) {
					
					$nome=$n['nome_completo'];
										
					if (stristr($q, substr($nome, 0, $tam))) {					  
						$dica = $nome;
						echo '{"situacao":"OK", "resposta":"'.$dica.'",  
						"foto":"'.$n['foto'].'", "ID":"'.$n['id_usuario'].'"}';							
					}
				}			
			}
			
	}
	
	
	
	public function solicitacaoDeAmizade(){
		
		
		$bd = new BdUtil;		
		$usuario = $_SESSION["id_usuario"];			
		$id_solicitacao=$bd->getComoArray("SELECT id_solicitacao FROM solicitacao WHERE fk_solicitante='".$usuario."' AND fk_solicitado= '".$_POST["i"]."'");
		
		
		if($id_solicitacao===null || !is_array($id_solicitacao) || count($id_solicitacao)==0){
			
			$solicitacao=new Solicitacao;
		
			$solicitacao->fkSolicitante = $usuario;
			$solicitacao->fkSolicitado = $_POST["i"];
			
			$bd->novo($solicitacao);

			echo '{"situacao":"OK"}';
			return; 
		}
		
		
		echo '{"situacao":"erro"}';
		
	}
	
	
	
	public function confirmaAmizade(){
		
		
		$bd = new BdUtil;			
		$usuario = $_SESSION["id_usuario"];		
		
		
		$amigos=new Friends;
		
		
		$amigos->fkAmigo1 = $usuario;
		$amigos->fkAmigo2 = $_POST["i"];
		
		
		$auxiliar=$bd->novo($amigos);
		
		
			if($auxiliar===null){				
				echo '{"situacao":"erro1"}';
				return;    
			}
		
		
		$id_solicitacao=$bd->getComoArray("SELECT id_solicitacao FROM solicitacao WHERE fk_solicitante='".$_POST["i"]."' AND fk_solicitado= '".$usuario."'");
		
		
		echo '{"situacao":"OK", "retorno":"'.$id_solicitacao[0]["id_solicitacao"].'" }';			
	}
	
	
	
	public function deletaSolicitacao(){
		
		
		$bd = new BdUtil;
		
		//$usuario = $_SESSION["id_usuario"];	
				
		//$id_solicitacao=$bd->getComoArray("SELECT id_solicitacao FROM solicitacao WHERE fk_solicitante='".$usuario."' AND fk_solicitado= '".$_POST["i"]."'");
				
		$retorno=$bd->deletaPorId(new Solicitacao, $_POST["i"]);
			
			
			if ($retorno===null) {				
				echo '{"situacao":"erro"}';
				return;    
			}
		
		echo '{"situacao":"OK"}';
				
	}


}


?>