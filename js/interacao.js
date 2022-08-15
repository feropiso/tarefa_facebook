


function curtir(i){
	jQuery.post("http://localhost/tarefa_facebook_php/acao.php",
		{"funcao":"curtida","path":"/contatos/", "classe":"Reacoes", i},
			function(retorno){ 					

				console.log(retorno);
									
				var erro = false;
									
				var aux;									
																					
					try {									
						aux = $.parseJSON(retorno.substring(retorno.indexOf("{")));							
					}
									
					catch (e) { erro = true; } 
									
				console.log(erro);									
									
					if(erro||aux.situacao!="OK"){
						alert("Houve um erro!");
						return;
					}
									
					if(aux.situacao=="OK"){	
						console.log(retorno);
						window.open("http://localhost/tarefa_facebook_php/home.php", "_self");							
					}
															
			}		
	);										
}


			
function compartilhar(i){
	jQuery.post("http://localhost/tarefa_facebook_php/acao.php",
		{"funcao":"compartilhamento","path":"/contatos/", "classe":"Reacoes", i},
			function(retorno){ 					

				console.log(retorno);
									
				var erro = false;
									
				var aux;									
																					
					try {										
						aux = $.parseJSON(retorno.substring(retorno.indexOf("{")));							
					}
									
					catch (e) { erro = true; } 
									
				console.log(erro);									
									
					if(erro||aux.situacao!="OK"){
						alert("Houve um erro!");
						return;
					}
									
					if(aux.situacao=="OK"){											
						window.open("http://localhost/tarefa_facebook_php/home.php", "_self");							
					}
															
			}		
	);								
											
}


			
function comentar(i){								
	jQuery.post("http://localhost/tarefa_facebook_php/acao.php",
		{"funcao":"comentar","path":"/contatos/", "classe":"Reacoes", 
		"comentario":jQuery("#comentario"+i).val(), i},							
		function(retorno){ 					
																		
			console.log(retorno);
									
			var erro = false;
									
			var aux;									
																					
				try {										
					aux = $.parseJSON(retorno.substring(retorno.indexOf("{")));							
				}
									
				catch (e) { erro = true; } 
									
			console.log(erro);									
									
				if(erro||aux.situacao=="erro1"){
					alert("Houve um erro!");
					return;
				}
									
				if(aux.situacao=="erro"){
					alert("Houve um erro 1!");
					return;
				}
									
				if(aux.situacao=="OK"){											
					window.open("http://localhost/tarefa_facebook_php/home.php", "_self");							
				}
															
		}		
	);										
}