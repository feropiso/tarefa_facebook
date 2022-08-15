<?php



/** @AnotTabela(nome="postagens", prefixo="p") */
 class Postagens {	
	
	
/** @AnotCampo(nome="id_postagem", tipo="int", ehId=true) */	
public $idPostagem;

/** @AnotCampo(nome="texto") */
public $texto;

/** @AnotCampo(nome="imagem") */
public $imagem;

/** @AnotCampo(nome="fk_post_usuario") */
public $fkPostUsuario;

	
}


?>