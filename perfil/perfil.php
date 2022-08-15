<?php

if(!isset($_SESSION))
session_start();


if(array_key_exists("id_usuario", $_SESSION) && $_SESSION["id_usuario"]>0){
	
	include_once $_SERVER['DOCUMENT_ROOT'].'/tarefa_facebook_php/Estrutura.class.php';
	
	$e = new Estrutura;
	
	$e->topo();
	
	include_once 'Perfil.class.php';

	$perfil = new Perfil;

	$perfil->formPerfil();
	
			
}
else{
			
	include_once 'login/Login.class.php';

	$login = new Login;

	$login->formLogin();
}



?>