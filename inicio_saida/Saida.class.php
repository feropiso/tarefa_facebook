<?php

if(!isset($_SESSION))
session_start();



class Saida {
	
	
	public function sair(){
				
		session_unset();
		
		echo '{"situacao":"OK"}';		
	}	
	
}



?>