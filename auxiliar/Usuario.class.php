<?php



/** @AnotTabela(nome="usuarios", prefixo="u") */
 class Usuario {	
	
	
/** @AnotCampo(nome="id_usuario", tipo="int", ehId=true) */	
public $idUsuario;

/** @AnotCampo(nome="login") */
public $login;

/** @AnotCampo(nome="senha") */
public $senha;

/** @AnotCampo(nome="nome") */
public $nome;

/** @AnotCampo(nome="nome_completo") */
public $nomeCompleto;

/** @AnotCampo(nome="foto") */
public $foto; 

		
}


?>