<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/tarefa_facebook_php/Estrutura.class.php';

$estrutura = new Estrutura;

$estrutura->topo();

include_once "NovoUsuario.class.php";

$NovoUsuario = new NovoUsuario;

$NovoUsuario->salvaCadastro();

?>