<?php

if(!isset($_SESSION))
session_start();


include_once 'constantes.php';


 class Login {
	
	
	public function formLogin(){
		
		echo '	
		
			<style>

			</style>
				<link rel="stylesheet" type="text/css"  href="'.RAIZ.'css/estiloLogin.css?id='.rand().'">

				</head>
			<body style="background-color: rgb(240, 240, 240)">

			<div id="bloco1">

				<p id="texto2"><b>facebook</b></p>
				<p id="texto3">O Facebook ajuda você a se conectar e compartilhar com as pessoas que fazem parte da sua vida.</p> 
				
			</div>

			<div id="bloco2">

				<div id="blocoLogin">

					<input type="text" id="usuario" name="usuario" placeholder="Email ou telefone"><br>	
					<input type="password" id="pwd" name="pwd" placeholder="Senha"><br>
					<button onclick="javascript:confereUsuario()" id="button">Entrar</button><br>
					
						<div id="texto1">
							<a href="http://localhost/tarefa_php/atualiza_usuario.php" style="text-decoration: none; color:rgb(30, 144, 255);"><p>Esqueceu a senha?</p></a> 
						</div>
						
						<div id="blocoInferior">
							<button onclick="javascript:cadastraUsuario()" id="button2">Criar nova conta</button><br>					 
						</div>	
				</div>
				
			</div>

			</body>
			</html>';
		
	}
	
	
}





?>