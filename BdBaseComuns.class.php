<?php




class BdBaseComuns{


private  $con;



	function __construct(){
	
	$this->conecta();
	}


	
	
	
	
	
	public function conecta(){
	
		$this->con = new PDO("mysql:host=localhost;dbname=tarefa_php;", 'root', '');	
		
		if(!is_object($this->con))
		return false;
		
		//importante para a saída com acentuacao via BD
		$this->con->query("SET NAMES 'utf8'");
		$this->con->query('SET character_set_connection=utf8');
		$this->con->query('SET character_set_client=utf8');
		$this->con->query('SET character_set_results=utf8');
		
		return true;
	}
	
	
	
	
	
	
	
	
	public function getReferencia(){
	
	return $this->con;
	}
	
	
	
	

	
	
}
?>