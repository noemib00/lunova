<?php

/**
 * ok
 * Class EWallet
 */

class EWallet{

    private string $IdWallet;

    private ECarta $Carta;

    private float $Conto;

    public function __construct( ){

        $this->IdWallet = "W" . random_int(0, 100);
        $this->Conto = 100.00;
    }



    //metodi get

    public function getIdWallet(): string
    { return $this->IdWallet; }

    public function getConto(): float
    { return $this->Conto; }



    //metodi set

    public function setIdWallet( string $Id): string
    { $this->IdWallet = $id; }

    public function setConto( float $m): float
    { $this->Conto = $m; }



    // _METHODS_

    public function recharge(float $m){
        $this->Conto += $m ;
    }

    public function scarica(float $m){
        $this->Conto =- $m ;
    }
}