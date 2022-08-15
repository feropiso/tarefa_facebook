<?php

if(!isset($_SESSION))
session_start();

include_once 'constantes.php';
include_once RAIZ_BD.'BdUtil.class.php';



class ProcessaLogin {
	
	
	public function avaliaEntradas(){
		
		
		$nome="";
		$sen="";
		$x=0;
		$y=0;
		$curtidas=0;
		$compartilhamentos=0;


			if(strlen($_POST["usuario"])==0 || 
					strlen($_POST["senha"])==0){
				echo '{"situacao":"erro"}';
				return;
			}
		
		
		$bd = new BdUtil;
		
		
		$nome=$_POST["usuario"];
		$sen=md5($_POST["senha"]);


		$resposta = $bd->getComoArray("SELECT * FROM usuarios WHERE login='".$nome."' AND senha= '".$sen."'");


			if($resposta===null || !is_array($resposta) || count($resposta)==0 ){	
				echo '{"situacao":"erro2"}';
				return;
			}


		$_SESSION["id_usuario"]=$resposta[0]['id_usuario'];
		$_SESSION["nome_usuario"]=$_POST["usuario"];
		$_SESSION["nome"]=$resposta[0]['nome'];
		$_SESSION["nome_completo"]=$resposta[0]['nome_completo'];
		$_SESSION["foto"]=$resposta[0]['foto'];
		
		echo '{"situacao":"OK"}';
	}	
}


	
?>