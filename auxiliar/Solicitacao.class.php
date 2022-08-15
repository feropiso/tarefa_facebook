<?php



/** @AnotTabela(nome="solicitacao", prefixo="s") */
 class Solicitacao {	
	
	
/** @AnotCampo(nome="id_solicitacao", tipo="int", ehId=true) */	
public $idSolicitacao;

/** @AnotCampo(nome="fk_solicitante") */
public $fkSolicitante;

/** @AnotCampo(nome="fk_solicitado") */
public $fkSolicitado;

	
}


?>