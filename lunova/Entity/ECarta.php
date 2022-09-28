<?php

/**
 * Class ECarta
 */

class ECarta {

    private string $Intestatario;

    private string $Numero;

    private string $CVC;

    private string $Scadenza;

    /**
     * ECarta constructor.
     * @param string $int
     * @param string $num
     * @param string $cvc
     * @param string $scad
     */

    public function __construct(string $int, string $num, string $cvc, string $scad) {

        $this->Intestatario = $int;
        $this->Numero = $num;
        $this->CVC = $cvc;
        $this->Scadenza = $scad;

    }

    /**
     * @return string
     */
    public function getIntestatario(): string
    {
        return $this->Intestatario;
    }

    /**
     * @return string
     */
    public function getNumero(): string
    {
        return $this->Numero;
    }

    /**
     * @return string
     */
    public function getCVC(): string
    {
        return $this->CVC;
    }

    /**
     * @return string
     */
    public function getScadenza(): string
    {
        return $this->Scadenza;
    }






}
