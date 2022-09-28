<?php
/**
 * ok
 * Class ECliente
 * @package Entity
 */

class EClient extends EUtente{

    private String $IdClient;

    private EWallet $Wallet;

    public function __construct((string $n, string $c, string $v, string $nc, string $citta, string $prov, string $cap, string $telefono, string $email, string $pw, EWallet $wallet){

        parent::__construct($n, $c, $v, $nc, $citta, $prov, $cap, $telefono, $email, $pw);
        parent::setLivello("C");
        $this->IdClient = "C"  . random_int(0,100);
        $this->Wallet = $wallet;
    }



    //metodi get

    public function getIdClient(): string 
    { return $this->IdClient; }

    public function getWallet(): EWallet
    { return $this->Wallet; }



    //metodi set

    public function setIdClient(string $id): void 
    { return $this->IdClient = $id; }
    
}


?>