	
	
			
function perfil(i){									
	jQuery.post("http://localhost/tarefa_facebook_php/acao.php",
		{"funcao":"recebeValores","path":"/perfil/", "classe":"AnalisaPerfil", i},							
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
						window.open("http://localhost/tarefa_facebook_php/perfil/perfil.php", "_self");							
					}
															
			}		
	);										
											
}



function abrirPerfil(){

	perfil(jQuery("#recebeID").val());
	
}				
					
				

