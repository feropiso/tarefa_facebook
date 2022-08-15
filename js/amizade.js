


function encontraAmigo(i){									
	jQuery.post("http://localhost/tarefa_facebook_php/acao.php",
		{"funcao":"encontraAmigos","path":"/contatos/", "classe":"Amigos", i},
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
						jQuery("#sugestao").css("display", "none");						
						return;
					}
									
					if(aux.situacao=="OK"){							
						jQuery("#sugestao").css("display", "block");						
						document.getElementById("fotoAmigo").src = aux.foto;						
						jQuery("#txtDica").html(aux.resposta);	
						jQuery("#recebeID").val(aux.ID);
					}
															
			}					
								
	);									
}



function solicitaAmizade(i){									
	jQuery.post("http://localhost/tarefa_facebook_php/acao.php",
		{"funcao":"solicitacaoDeAmizade","path":"/contatos/", "classe":"Amigos", i},
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
						alert("A solicitação de amizade já foi enviada!");
						return;
					}
								
					if(aux.situacao=="OK"){	
						alert("Solicitacao de amizade enviada!");	
						window.open("http://localhost/tarefa_facebook_php/perfil/perfil.php", "_self");
												
					}
															
			}					
								
	);									
}



function confirmarAmizade(i){									
	jQuery.post("http://localhost/tarefa_facebook_php/acao.php",
		{"funcao":"confirmaAmizade","path":"/contatos/", "classe":"Amigos", i},
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
						alert("Houve um erro!");
						return;
					}
									
					if(erro||aux.situacao=="erro1"){
						alert("Houve um erro, tente mais tarde!");
						return;
					}		
									
					if(aux.situacao=="OK"){	
						alert("Vocês são amigos agora!");
						deletaNotificacao(aux.retorno);												
					}
															
			}					
								
	);									
}



function deletaNotificacao(i){
	jQuery.post("http://localhost/tarefa_facebook_php/acao.php",
		{"funcao":"deletaSolicitacao","path":"/contatos/", "classe":"Amigos", i},
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



function notificacao(){
	jQuery("#textoSolicitacao").css("display", "block");
	jQuery("#usuario3").css("display", "block");	
	jQuery("#numero").css("display", "none");	
}			