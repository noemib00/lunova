<?php

	class FAdmin{
		private static $class = "FAdmin"
		private static $table = "admin"
		private static $values = ":IdAdmin:Email,:Nome,:Cognome,:Via,:NCivico,:Provincia,:Citta,:CAP,:NTelefono,:Password,:Livello)";

		public function __construct(){}

		public static function getTable(): string
		{ return self::$table; }

		public static function getClass(): string
		{ return self::$class; }

		public static function getValues(): string
		{ return self::$values; }

		public static function bind($statement, EAdmin $admin, $foreignkey){
			$statement->bindValue(":IdAdmin", $admin->getIdAdmin, PDO::PARAM_STR);
			$statement->bindValue(":Nome", $admin->getNome, PDO::PARAM_STR);
			$statement->bindValue(":Cognome", $admin->getCognome, PDO::PARAM_STR);
			$statement->bindValue(":Via", $admin->getVia, PDO::PARAM_STR);
			$statement->bindValue(':NCivico',$admin->getNumeroCivico(), PDO::PARAM_STR);
	        $statement->bindValue(':Provincia',$admin->getProvincia(), PDO::PARAM_STR);
	        $statement->bindValue(':Citta',$admin->getCitta(), PDO::PARAM_STR);
	        $statement->bindValue(':CAP',$admin->getCAP(), PDO::PARAM_STR);
	        $statement->bindValue(':NTelefono',$admin->getTelefono(), PDO::PARAM_STR);
	        $statement->bindValue(':Password', password_hash($admin->getPassword(),PASSWORD_DEFAULT), PDO::PARAM_STR);
	        $statement->bindValue(':Livello',$admin->getLivello(), PDO::PARAM_STR);
    	}

    	public static function loadAdmin($etichetta,$id){
    		$connection = FPersistentManager::getInstance();
    		$result = $connection->load(static::getClass(),$etichetta,$id);
    		$resultAdmn = $result[0];
    		$admn = new EAdmin($resultAdmn["Nome"],$resultAdmn["Cognome"],,$resultAdmn["Via"],$resultAdmn["NCivico"],$resultAdmn["Provincia"],$resultAdmn["Citta"],$resultAdmn["CAP"],$resultAdmn["NTelefono"],$resultAdmn["Email"],$resultAdmn["Password"]);
    		$admn = setAdmin($resultAdmn["IdAdmin"]);
    		return $admn;
    	}

    	public static function login($email, $pw){
    		$pers = FPersistentManager::getInstance();
    		$query = "SELECT * FROM" . FAdmin::getClass . "WHERE" . "Email" . "='" . $email . "';";
    		$queryready = $pers->connection->db->prepare($query);
    		$queryready = execute();
    		$result = $queryready->fetchAll(PDO:FETCH_ASSOC);
    		If(count($results)>0){
    			$hash = $result[0]["Password"];
    			$log = password_verify($pw,$hash);
    			if ($log){
    				$resultAdmn = $result[0];
    				$Admn = new EAdmin( $resultAdmn["Nome"],$resultAdmn["Cognome"],$resultAdmn["Via"],$resultAdmn["NCivico"],$resultAdmn["Provincia"],$resultAdmn["Citta"],$resultAdmn["CAP"],$resultAdmn["NTelefono"],$resultAdmn["Email"],$resultAdmn["Password"]);)
					$Admn = setIdAdmin($result["IdAdmin"]);
					return $Admn;
    			}
    			else { return null;}
    		}
    		else { return null;}	
 
    	}

		
	}

?>