<?php
/**
 * ok
 * @package Entity
 */

class EAdmin extends EUtente{

	private string $IdAdmin;

	public function __construct(string $n, string $c, string $v, string $nc, string $citta, string $prov, string $cap, string $telefono, string $email, string $pw)
	{
		parent::__construct($n, $c, $v, $nc, $citta, $prov, $cap, $telefono, $email, $pw);
		parent::setLivello("A");
		$this-> IdAdmin = "A" . random_int(0,1000);
	}



	//metodo set

	public function setIdAmministratore(string $IdAmministratore): void
    {
        $this->IdAmministratore = $IdAmministratore;
    }



    //metodo set
    
	public function getIdAmministratore(): string
    {
        return $this->IdAmministratore;
    }

}



?>