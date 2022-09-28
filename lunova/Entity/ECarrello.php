<?php

/**
 * Class ECarrello
 */

class ECarrello
{
    private $prodotti = array();

    private string $email;
    
    private int $IdCarrello; 

    private bool $Pagato;

    private float $Totale;

    
/**
     * @return bool|int
     */
    public function getPagato(): bool|int
    {
        return $this->pagato;
    }



    /**
     * @param bool|int $pagato
     */
    public function setPagato(bool|int $pagato): void
    {
        $this->pagato = $pagato;
    }

    /**
     * @param string $id
     * @param array $dischi
     *
     */
    public function __construct($ut)
    {
        if (1 === func_num_args()){
            $this->id =0;
            $this->dischi = array();
            $this->totale = 0.0;
            $this->mail_utente=$ut;
            $this->pagato = 0;
        }
        elseif (4 === func_num_args()){
            $idcar=func_get_arg(0);
            $disco=func_get_arg(1);
            $quantita=func_get_arg(2);
            $utente=func_get_arg(3);
            $this->id=$idcar;
            $disco_new=new EDisco($disco);
            $this->dischi[$disco_new->getId()]=$quantita;
            $this->totale=$disco_new->getPrezzo()*$quantita;
            $this->mail_utente=$utente;
            $this->pagato=0;


        }

    }

    /**
     * @param string $mail_utente
     */
    public function setMailUtente(string $mail_utente): void
    {
        $this->mail_utente = $mail_utente;
    }

    /**
     * @return string
     */
    public function getMailUtente(): string
    {
        return $this->mail_utente;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }//

    /**
     * @param array $dischi
     */
    public function aggiungiDisco(EDisco $disco, int $QuantitaRichiesta): void
    {
        if($disco->getQuantita() >= $QuantitaRichiesta){
            $this->dischi[$disco->getId()] = $QuantitaRichiesta;
            $this->totale += $disco->getPrezzo() * $QuantitaRichiesta;
        }
        else print("Quantità non disponibile");

    }

    public function modificaQuantita(EDisco $disco, int $quantita): void
    {
        if ($disco->getQuantita() >= $quantita) {
            $differenzaPrezzo = ($this->dischi[$disco->getId()] - $quantita) * $disco->getPrezzo();
            $this->dischi[$disco->getId()] = $quantita;
            $this->totale += $differenzaPrezzo;
        }
    }

    /**
     * @param float $totale
     */
    public function setTotale(float $totale): void
    {
        $this->totale = $totale;
    }

    /**
     * @return float
     */
    public function getTotale(): float
    {
        return $this->totale;
    }
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getDischi(): array
    {
        return $this->dischi;
    }














}