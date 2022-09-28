<?php


/**
 * Class checked
 * @package Entity
 */
class EOrdineItem {
    
    private string $IdOrdineItem
    
    private int $quantity;
    
    private EDisco $_disco;
    
    private float $totprice;

    public function __construct(EDisco $disco){
        $this->IdOrdineItem = random_int(0,1000);
        $this->prodotto = $disco;
        $this->quantity = 1;
        $this->totprice = 0.0; 
    }



    //metodi get

    public function getIdOrdineItem()
    { return $this->IdOrdineItem; }

    public function getItem():EDisco
    { return $this->_disco; }

    public function getQuantity(): int 
    { return $this->quantity; }

    public function getTotPrice(): float 
    { return $this->totprice; }



    //metodi set
    
    public function setIdOrdineItem( $IdOrdineItem ) :void 
    { $this->IdOrdineItem = $IdOrdineItem; }

    public function setItem( EDisco $_disco ) :void 
    { $this->_disco = $_disco; }

    public function setQuantity( int $quantity) :void 
    { $this->quantity = $quantity; }

    public function setTotPrice( float $totprice ) :void 
    { $this->totprice = $totprice; }

}
?>