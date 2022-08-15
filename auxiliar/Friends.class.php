<?php



/** @AnotTabela(nome="amigos", prefixo="a") */
 class Friends {	
	
	
/** @AnotCampo(nome="id_amigos", tipo="int", ehId=true) */	
public $idAmigos;

/** @AnotCampo(nome="fk_amigo_1") */
public $fkAmigo1;

/** @AnotCampo(nome="fk_amigo_2") */
public $fkAmigo2;

	
}


?>