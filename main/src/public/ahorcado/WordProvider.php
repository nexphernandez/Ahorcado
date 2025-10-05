<?php
/**
 * @author  nexphernandez 
 * @version 1.0.0
 */
declare(strict_types= 1);
namespace srs\public\ahorcado;

final class WordProvider{
    private $filePath;

    /**
     * Constructor de la clase WordProvider
     * @param string $filePath ruta del archivo
     */
    public function __construct(string $filePath){}

    /**
     * Funcion que devuelve una palabra ramdom del archivo
     * @return string palabra ramdom
     */
    public function randomWord(): string{}

}
?>