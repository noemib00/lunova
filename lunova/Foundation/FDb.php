<?php
	if (file_exists('./inc/configdb.php'))
	{
    	require_once './inc/configdb.php';
	}


	class FDb{
		/** Istanza della classe */
    	private static FDb $instance;

	    /** Oggetto PDO che effettua la connessione al DB */
	    private PDO $db;

		//private $conn;
	 	public $pdo;
	 	/*
	 	public function __construct(){
	 		$this->connect(DB_HOST,DB_USER,DB_NAME, DB_PASS);
	 	}
	 	*/

	 	public function __construct() {
	    	
	 		try {
            $this->db = new PDO('mysql:dbname='. DB_NAME .';host=' . DB_HOST, DB_USER, DB_PASS);
	        } catch (PDOException $e) {
	            echo "DB Connection Failed" . $e->getMessage();
  				die;
  			}
	  	}
	  	/**
	     * Metodo che restituisce l'unica istanza dell'oggetto DB
	     * @return FDb
	     */
	    public static function getInstance(): FDb
	    {
	        if (!isset(FDb::$instance)) {
	            $class = __CLASS__;
	            FDb::$instance = new $class;
	        }
	        return FDb::$instance;
	    }



	  	public function query($sql) {
	    	$q = $this->pdo->query($sql);
	    	if(!$q)
	    	{
	      		die("Execute query error, because: ". print_r($this->pdo->errorInfo(),true) );
	    	}
	    
		    $data = $q->fetchAll(); 
	    	return $data;
  		}

  		/**
	     * Metodo che permette di salvare un oggetto Entity sul database
	     * @param class classe da passare
	     * @param obj oggetto da salvare
	     */
	    public function storeDB($class, $obj)
	    {
	        try {
	            $this->db->beginTransaction();
	            $query = "INSERT INTO " . $class::getTables() . " VALUES " . $class::getValues();
	            $stmt = $this->db->prepare($query);
	            $class::bind($stmt, $obj);
	            $stmt->execute();
	            $query = " SELECT LAST_INSERT_ID() ";
	            $stmt = $this->db->query($query);
	            $id = $stmt->fetchColumn();
	            $this->closeDbConnection();
	            return $id;
	        } catch (PDOException $e) {
	            echo "!ERRORE!" . $e->getMessage();
	            $this->db->rollBack();
	            return null;
	        }
    	}

     	/**
	     * Funzione per la load dal DB
	     * @param $class
	     * @param $field
	     * @param $value
	     * @return array|mixed|null
	     */
	    public function loadDB($class, $field, $value)
	    {
	        try {
	            $this->db->beginTransaction();
	            $query = "SELECT * FROM " . $class::getTables() . " WHERE " . $field . "='" . $value . "';";
	            $stmt = $this->db->prepare($query);
	            $stmt->execute();
	            $num = $stmt->rowCount();
	            if ($num == 0) {
	                $result = null;                                   //nessuna riga interessata -> return null
	            } elseif ($num == 1) {                                //nel caso in cui una sola riga fosse interessata
	                $result = $stmt->fetch(PDO::FETCH_ASSOC);   //ritorna una sola riga
	            } else {
	                $result = array();                                //nel caso in cui piu' righe fossero interessate
	                $stmt->setFetchMode(PDO::FETCH_ASSOC);      //imposta la modalità di fetch come array associativo
	                while ($row = $stmt->fetch()) {
	                    $result[] = $row;                             //ritorna un array di righe
	                }
	            }
	            $this->closeDbConnection();
	            return $result;
	        	} catch (PDOException $e) {
		            echo "!ERRORE!" . $e->getMessage();
		            $this->db->rollBack();
		            return null;
	        	}
	    }

	    /**
	     * Metodo che restituisce il numero di righe interessate dalla query
	     * @param $class
	     * @param $field
	     * @param $id
	     * @return int|null
	     */
	    public function interestedRows($class, $field, $id): ?int
	    {
	        try {
	            $this->db->beginTransaction();
	            $query = "SELECT * FROM " . $class::getTables() . " WHERE " . $field . "='" . $id . "';";
	            $stmt = $this->db->prepare($query);
	            $stmt->execute();
	            $num = $stmt->rowCount();
	            $this->closeDbConnection();
	            return $num;
	        } catch (PDOException $e) {
	            echo "!ERRORE!" . $e->getMessage();
	            $this->db->rollBack();
	            return null;
	        }
	    }

	    /**
	     * Metodo che permette di eliminare un oggetto dal DB
	     * @param $class
	     * @param $field
	     * @param $id
	     * @return bool|null
	     */
	    public function deleteDB($class, $field, $id): ?bool
	    {
	        try {
	            $result = null;
	            $exist = $this->existDB($class, $field, $id);
	            $this->db->beginTransaction();
	            if ($exist) {
	                $query = "DELETE FROM " . $class::getTables() . " WHERE " . $field . "='" . $id . "';";
	                $stmt = $this->db->prepare($query);
	                $stmt->execute();
	                $result = true;
	            }
	            $this->closeDbConnection();
	        } catch (PDOException $e) {
	            echo "!ERRORE!" . $e->getMessage();
	            $this->db->rollBack();
	        }
	        return $result;
	    }

	    /**
	     * Metodo che permette di aggiornare il valore di un attributo passato come parametro
	     * @param $class
	     * @param $field
	     * @param $newvalue
	     * @param $pk
	     * @param $value
	     * @return bool
	     */
	    public function updateDB($class, $field, $newvalue, $pk, $value): bool
	    {
	        try {
	            $this->db->beginTransaction();
	            $query = "UPDATE " . $class::getTables() . " SET " . $field . "='" . $newvalue . "' WHERE " . $pk . "='" . $value . "';";
	            $stmt = $this->db->prepare($query);
	            $stmt->execute();
	            $this->closeDbConnection();
	            return true;
	        } catch (PDOException $e) {
	            echo "!ERRORE!" . $e->getMessage();
	            $this->db->rollBack();
	            return false;
	        }
	    }

	    /**
	     * Metodo che controlla l'esistenza sul DB di un determinato campo inserito in input
	     * @param $class
	     * @param $field
	     * @param $value
	     * @return bool|void|null
	     * @field $field
	     * @id $id
	     */
	    public function existDB($class, $field, $value)
	    {
	        try {
	            $this->db->beginTransaction();
	            $query = "SELECT * FROM " . $class::getTables() . " WHERE " . $field . "='" . $value . "';";
	            $stmt = $this->db->prepare($query);
	            $stmt->execute();
	            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	            if (count($result) == 1) {
	                $this->closeDbConnection();
	                return true;                                     //rimane solo l'array interno
	            } else if (count($result) > 1) {
	                $this->closeDbConnection();
	                return false;                                    //restituisce array di array
	            }
	            $this->closeDbConnection();
	        } catch (PDOException $e) {
	            echo "!ERRORE!" . $e->getMessage();
	            $this->db->rollBack();
	            return null;
	        }
	    }

	    /**
	     * Metodo che verifica l'accesso di un utente, controllando che le credenziali (email e password) siano presenti nel DB
	     * @param $email
	     * @param $password
	     * @return mixed|null
	     */
	    public function loadVerificaAccesso($email, $password)
	    {
	        try {
	            $this->db->beginTransaction();
	            $query = "SELECT * FROM " . FUtente::getTables() . " WHERE email ='" . $email . "' AND "."password='" . $password . "';";
	            $stmt = $this->db->prepare($query);
	            $stmt->execute();
	            $num = $stmt->rowCount();
	            if ($num == 0) {
	                $result = null;                                     //nessuna riga interessata: return null
	            } else {                                                //nel caso in cui una sola riga fosse interessata
	                $result = $stmt->fetch(PDO::FETCH_ASSOC);     //ritorna una sola riga
	            }
	            $this->closeDbConnection();
	            return $result;
	        } catch (PDOException $e) {
	            echo "!ERRORE!". $e->getMessage();
	            $this->db->rollBack();
	            return null;
	        }
	    }

	    public function loadSingola($sql){
	        try{
	            $this->db->beginTransaction();
	            $stmt=$this->db->prepare($sql);
	            $stmt->execute();
	            $row=$stmt->fetch(PDO::FETCH_ASSOC);
	            $this->closeDbConnection();
	            return $row;
	        }catch(PDOException $e) {
	            echo "!ERRORE!" . $e->getMessage();
	            die;
	        }
	    }

	    /**  Metodo che chiude la connessione con il DB */
	    public function closeDbConnection(){
	        $this->db->commit();
	        //FDb::$instance = null;
	    }

	    /**
	     * Funzione utilizzata per cercare gli elementi in base al campo inserito
	     * @param  $input
	     * @param $class
	     * @param $campo
	     * @return array|null
	     */
	    public function ricercaParola($input, $class, $campo): ?array
	    {
	        try {
	            $this->db->beginTransaction();
	            $query = "SELECT * FROM " . $class::getTables() . " WHERE " . $campo . " LIKE '%" . $input . "%';";
	            $stmt = $this->db->prepare($query);
	            $stmt->execute();
	            $num = $stmt->rowCount();
	            if ($num == 0) {
	                $result = null;                                        //nessuna riga interessata. return null
	            } else {
	                $result = array();                                     //nel caso in cui piu' righe fossero interessate
	                $stmt->setFetchMode(PDO::FETCH_ASSOC);          //imposta la modalità di fetch come array associativo
	                while ($row = $stmt->fetch())
	                    $result[] = $row;                                 //ritorna un array di righe.
	            }
	            $this->closeDbConnection();
	            return array($result, $num);
	        } catch (PDOException $e) {
	            echo "!ERRORE!" . $e->getMessage();
	            $this->db->rollBack();
	            return null;
	        }
	    }

	    /**
	     * Funzione per la load dal DB di tutti gli elementi
	     * @param $class
	     * @return array|mixed|null
	     */
	    public function LoadAll($class)
	    {
	        try {
	            $this->db->beginTransaction();
	            $query = "SELECT * FROM " . $class::getTables() . ";";
	            $stmt = $this->db->prepare($query);
	            $stmt->execute();
	            $num = $stmt->rowCount();
	            if ($num == 0) {
	                $result = null;                                       //nessuna riga interessata. return null
	            } elseif ($num == 1) {                                    //nel caso in cui una sola riga fosse interessata
	                $result = $stmt->fetch(PDO::FETCH_ASSOC);      //ritorna una sola riga
	            } else {
	                $result = array();                                   //nel caso in cui piu' righe fossero interessate
	                $stmt->setFetchMode(PDO::FETCH_ASSOC);         //imposta la modalità di fetch come array associativo
	                while ($row = $stmt->fetch())
	                    $result[] = $row;                                //ritorna un array di righe.
	            }
	            $this->closeDbConnection();
	            return $result;
	        } catch (PDOException $e) {
	            echo "!ERRORE!" . $e->getMessage();
	            $this->db->rollBack();
	            return null;
	        }
	    }

	    /**
	     * Funzione per la cancellazione dal DB di una Disco (funz. admin)
	     * @param $titoloD
	     * @return bool|null
	     */
	    public function RemoveDisco($titoloD): ?bool
	    {
	        $return = null;
	        try {
	            $class = "FDisco";
	            $this->deleteDB("$class", "titolo", $titoloD);
	        } catch (PDOException $e) {
	            echo "!ERRORE! " . $e->getMessage();
	            $this->db->rollBack();
	        }
	        return $return;
	    }
	}


		}

?>