<?php

if(!isset($_SESSION))
session_start();


include_once 'constantes.php';



 class Estrutura {	
	
	
	public function topo(){
		
		
		echo '<!DOCTYPE html>
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<script type="text/javascript"  src="'.RAIZ.'js/jquery.min.js"></script>
				<script type="text/javascript" src="'.RAIZ.'js/amizade.js?id='.rand().'"></script>
				<script type="text/javascript" src="'.RAIZ.'js/entrada.js?id='.rand().'"></script>
				<script type="text/javascript" src="'.RAIZ.'js/interacao.js?id='.rand().'"></script>
				<script type="text/javascript" src="'.RAIZ.'js/novoUsuario.js?id='.rand().'"></script>
				<script type="text/javascript" src="'.RAIZ.'js/saida.js?id='.rand().'"></script>
				<script type="text/javascript" src="'.RAIZ.'js/usuarioPerfil.js?id='.rand().'"></script>';
	}
	
	
	
	public function conteudo(){
		
		
		if(array_key_exists("id_usuario", $_SESSION) && $_SESSION["id_usuario"]>0){
			
			
			include_once "inicio_saida/Inicio.class.php";

			$inicio = new Inicio;

			$inicio->conteudo();
		}
		else{
			
			include_once "login/Login.class.php";

			$login = new Login;

			$login->formLogin();
		}

		
	}
		
}





?>