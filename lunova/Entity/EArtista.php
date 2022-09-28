<?php
/**
 * ok
 * @package Entity
 */

class EArtista extends EUtente{

	private string $IdArtista;

	private $Album = array();

	private string $IBAN;

	public function __construct( string $n, string $c, string $v, string $nc, string $citta, string $prov, string $cap, string $telefono, string $email, string $pw, string $iban) {

		parent::__construct(($n, $c, $v, $nc, $citta, $prov, $cap, $telefono, $email, $pw);
		parent::setLivello("B");
		$this->IdArtista = "B" . random_int(0 , 100);
		$this->IBAN = $iban;
	}

	public function addAlbum(EDisco $d){
		array_push($this->Album, $d)
	}	



	//metodi get

	public function getIdArtista(): string
	{ return $this->IdArtista; }

	public function getIban(): string
	{ return $this->iban; }



	//metodi set 

	public function setIdArtista(string $a): void
	{ $this->IdArtista = $a; }

	public function setIban(string $i): void
	{ $this->iban = $i; }
}

?>