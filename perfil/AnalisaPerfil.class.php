<?php

if(!isset($_SESSION))
session_start();



 class AnalisaPerfil {	
	
	
	public function recebeValores(){
		
			if(strlen($_POST["i"])==0){
				echo '{"situacao":"erro", "ID":"'.$_POST["i"].'"}';				
				return;
			}
	
		$_SESSION["i"]= $_POST["i"];
		
		echo '{"situacao":"OK"}';	
	}
 }
		
?>
