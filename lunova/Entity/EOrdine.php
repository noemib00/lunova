<?php
/**
 * ok
 * @package Entity
 */
class EOrdine {
    private string $IdOrdine;

    private string $CittaSped;

    private string $CAPSped;

    private string $IndirizzoSped;

    private string $ModPagamento;

    private $Dischi = array();

    private float $TotOrdine;

    private string $IdCliente;


    public function __construct(String $Idcl){
        $this->IdOrdine = random_int(0,1000);
        $this->TotOrdine = 0.0;
        $this->IdCliente = $Idcl;
    }

       


    //metodi get

    public function getCittaSpe(): string 
    { reurn $this->CittaSped; }

    public function getIdOrdine(): string 
    { return $this->IdOrdine; }

    public function getCapSped(): string 
    { return $this->CAPSped; }

    public function getIndirizzoSped(): string 
    { return $this->IndirizzoSped; }

    public function getModPagamento(): string 
    {return $this->ModPagamento; }

    public function getDischi(): array 
    { return $this->Dischi; }

    public function getTotOrdine(): float 
    {return $this->TotOrdine;}

    public function getIdCliente(): string 
    { return $this->IdCliente;}



    //metodi set

    public function setCittaSpe(string $cittaspe): void 
    { $this->CittaSped = $cittasped; }

    public function setIdOrdine($IdOrdine): void 
    { $this->IdOrdine = $IdOrdine ; }

    public function setCapSped(string $cap): void {
     $this->CAPSped = $cap; }

    public function setIndirizzoSped( string $ind): void 
    { $this->IndirizzoSped = $ind ; }

    public function setModPagamento(string $mod): void 
    { $this->ModPagamento = $mod ; }

    public function setDischi(array $dischi): void 
    { $this->Dischi = $dischi ; }

    public function setTotOrdine( float $tot): float 
    {$this->TotOrdine = $tot ;}

    public function setIdCliente(string $IdCli): void
    { $this->IdCliente = $IdCli;}


    // _METHODS_
    
    public function addDisco(EOrdineItem $orditem){
        array_push($this->Dischi, $orditem);
    }

    public function NumericTotal(){
        foreach($this->$Dischi as $disco){
            $this->TotOrdine += $disco->getTotPrice();
        }
    }







































    /**
     * @AttributeType int
     */
    //public $id;
    /**
     * @AttributeType Date
     */
    //public $data;
    /**
     * @AttributeType boolean
     */
    //public $pagato=false;
    /**
     * @AttributeType boolean
     */
    //public $confermato=false;
    /**
     * @AssociationType Entity.EUtente
     * @AssociationMultiplicity 1
     */
    //public $_utente;
    /**
     * @AssociationType Entity.EOrdineItem
     * @AssociationMultiplicity 1..*
     * @AssociationKind Aggregation
     */
    //public $_item = array();
    /**
     * @AssociationType Entity.ECartaCredito
     * @AssociationMultiplicity 1
     */
    //public $_cartacredito;

    /**
     * 
     * @return float
     */
    //public function getPrezzoTotale() {
        //$prezzo=0;
        //if (count($this->_item)>0) {
            //foreach($this->_item as $item) {
                //$Disco=$item->getDisco();
                //$prezzo += $Disco->prezzo*$item->quantita;
            //}
       //}
        //return $prezzo;
    //}

    /**
     * 
     * @param EOrdineItem item
     */
    //public function addItem(EOrdineItem $item) {
        //$itemDisco=$item->getDisco();
        ////$aggiornato=false;
        ////foreach ($this->_item as & $thisItem) {
        ////    $thisDisco=$thisItem->getDisco();
       //   //  if ($thisDisco->ISBN==$itemDisco->ISBN) {
     //  //     //    $thisItem->quantita++;
         //     //  $aggiornato=true;
          // // }
        //}
        //if (!$aggiornato)
          //  $this->_item[]=$item;
    //}

    /**
     * 
     * @param $pagato boolean
     */
    //public function setPagato($pagato) {
       // $this->pagato=$pagato;
    //}

    /**
     * 
     * @param $confermato boolean
     */
    //public function setConfermato($confermato) {
      //  $this->confermato=$confermato;
    //}

    /**
     * 
     * @return array()
     */
    //public function getItems() {
        //return $this->_item;
    }
    /**
     * 
     * @param $data string
     */
    //public function setData($data) {
        //$anno=substr($data, 6);
      //  $mese=substr($data, 3, 2);
        //$giorno=substr($data, 0, 2);
      //  $this->data="$anno-$mese-$giorno";
    //}
    /**
     * 
     * @param $cartaCredito ECartaCredito
     */
    //public function setCartaCredito(ECartaCredito $cartaCredito) {
        //$this->_cartacredito=$cartaCredito;
    }
    /**
     * 
     * @param $utente EUtente
     */
    //public function setUtente(EUtente $utente) {
       // $this->_utente=$utente;
    }
    /**
     * rimuovo l'item nella posizione $pos dell'array
     *
     * @param int $pos
     */
    //public function removeItem($pos) {
        //unset($this->_item[$pos]);
      //  $this->_item=array_values($this->_item);
    //}
    /** restituisce l'utente relativo all'ordine
     * @return EUtente
     */
    //public function getUtente() {
    //    return $this->_utente;
  //  }

}

?>