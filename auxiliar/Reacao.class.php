<?php



/** @AnotTabela(nome="reacao_usuario", prefixo="e") */
 class Reacao {	
	
	
/** @AnotCampo(nome="id_reacao_usuario", tipo="int", ehId=true) */	
public $idReacaoUsuario;

/** @AnotCampo(nome="curtir", tipo="int") */
public $curtir;

/** @AnotCampo(nome="comentario") */
public $comentario;

/** @AnotCampo(nome="compartilhar", tipo="int") */
public $compartilhar;

/** @AnotCampo(nome="postagem", tipo="int") */
public $postagem;

/** @AnotCampo(nome="fk_usuario", tipo="int") */
public $fk_usuario; 

		
}


?>