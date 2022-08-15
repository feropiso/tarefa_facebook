


function cadastraUsuario(){	
									
	window.open("http://localhost/tarefa_facebook_php/cadastro/cadastro.php", "_self");		
}



function addUsuario(){								
	jQuery.post("http://localhost/tarefa_facebook_php/acao.php",
		{"funcao":"confereCadastro","path":"/cadastro/", "classe":"AvaliaEntradas",
		"novo_usuario":jQuery("#novoUsuario").val(), "nome":jQuery("#nome").val(),
		"sobrenome":jQuery("#sobrenome").val(),"foto":jQuery("#foto").val(),
		"senha_1":jQuery("#senha1").val(),"senha_2":jQuery("#senha2").val()},								
			function(retorno){ 					

				console.log(retorno);						

				var erro = false;
									
				var aux;
																					
					try {	
						aux = $.parseJSON(retorno.substring(retorno.indexOf("{")));							
					}
									
					catch (e) { erro = true; } 
									
				console.log(erro);
									
					if(aux.situacao=="erro"){
						alert("Digite usuário e senha!");
						return;
					}
									
					if(erro||aux.situacao=="erro1"){
						alert("As senhas não são iguais, digite a senha novamente!");
						return;
					}																					
									
					if(aux.situacao=="erro2"){
						alert("Houve um erro!");
						return;
					}
									
					if(aux.situacao=="erro3"){
						alert("Usuário já existente!");
						return;
					}
									
					if(aux.situacao=="OK"){
						alert("Cadastro realizado com sucesso!");
						window.open("http://localhost/tarefa_facebook_php/home.php", "_self");
					}
									
			}					
								
	);					
}