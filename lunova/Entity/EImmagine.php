<?php

/**
 * Class EImmagine
 */

class EImmagine {

    private string $Id;

    private string $Nome;

    private string $Formato;

    private string $Byte;

    /**
     * EImmagine constructor.
     * @param string $nome
     * @param string $byte
     * @param string $formato
     * @throws Exception
     */

    public function __construct(string $nome, string $byte, string $formato){
        $this->setId("I".random_int(0,1000));
        $this->setNome($nome);
        $this->setFormato($formato);
        $this->setByte($byte);
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->Nome;
    }

    /**
     * @param string $Nome
     */
    public function setNome(string $Nome): void
    {
        $this->Nome = $Nome;
    }

    /**
     * @return string
     */
    public function getByte(): string
    {
        return $this->Byte;
    }

    /**
     * @param string $Byte
     */
    public function setByte(string $Byte): void
    {
        $this->Byte = $Byte;
    }

    /**
     * @return string
     */
    public function getFormato(): string
    {
        return $this->Formato;
    }

    /**
     * @param string $Formato
     */
    public function setFormato(string $Formato): void
    {
        $this->Formato = $Formato;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->Id;
    }

    /**
     * @param string $Id
     */
    public function setId(string $Id): void
    {
        $this->Id = $Id;
    }






}