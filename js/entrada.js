


function confereUsuario(){									
	jQuery.post("http://localhost/tarefa_facebook_php/acao.php",
		{"funcao":"avaliaEntradas","path":"/login/", "classe":"ProcessaLogin",
		"usuario":jQuery("#usuario").val(),"senha":jQuery("#pwd").val()},
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
						alert("Houve um erro!");
						return;
					}																					
									
					if(aux.situacao=="erro2"){
						alert("Usuário ou senha inválida!");
						return;
					}
									
					if(aux.situacao=="OK"){							
						window.open("http://localhost/tarefa_facebook_php/home.php", "_self");							
					}
															
			}					
								
	);									
}
