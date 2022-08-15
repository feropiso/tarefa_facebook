<?php
include_once 'constantes.php';
include_once RAIZ_BD.'BdUtil.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/tarefa_facebook_php/auxiliar/Usuario.class.php';


class AvaliaEntradas{
	
	
	
	public function confereCadastro(){
		
		
		$login="";
		$sen="";
		$nome="";
		$sobre_nome="";
		$foto="";
		

			if(strlen($_POST["novo_usuario"])==0 || strlen($_POST["senha_1"])==0 || 
				strlen($_POST["senha_2"])==0||strlen($_POST["nome"])==0||strlen($_POST["sobrenome"])==0||
				strlen($_POST["foto"])==0){
				echo '{"situacao":"erro"}';			
				return;
			}

			if($_POST["senha_1"]!=$_POST["senha_2"]){
				echo '{"situacao":"erro1"}';
				return;
			}

		
		$bd = new BdUtil;
	
	
		$login=$_POST["novo_usuario"];
		$sen=md5($_POST["senha_1"]);
		$nome=($_POST["nome"]);
		$sobre_nome=($_POST["sobrenome"]);
		$foto=($_POST["foto"]);
	
	
		$resposta = $bd->getComoArray("SELECT id_usuario FROM usuarios WHERE login='".$login."' AND senha='".$sen."' AND nome='".$nome."' AND nome_completo='".$sobre_nome."' AND foto= '".$foto."'");
			
		
			if($resposta===null|| !is_array($resposta) || count($resposta)==0){
				
				$usuario=new Usuario;
		
				$usuario->login = $login;
				$usuario->senha = $sen;
				$usuario->nome = $nome;
				$usuario->nomeCompleto = $sobre_nome;
				$usuario->foto = $foto;
				
				$bd->novo($usuario);
						
				echo '{"situacao":"OK"}';
				
				return;
			}
	
	
		echo '{"situacao":"erro3"}';
	}
}


?>