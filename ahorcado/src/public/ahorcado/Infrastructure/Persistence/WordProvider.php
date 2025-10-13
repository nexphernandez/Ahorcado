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
    public function __construct(string $filePath){
        $this->filePath = $filePath;
    }

    /**
     * Funcion que devuelve una palabra ramdom del archivo
     * @return string palabra ramdom
     */
    public function randomWord(): string{
        if (!file_exists($this->filePath)) {
            throw new Exception("El archivo con las palabras no existe: {$this->filePath}");
        }
        $words = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (!$words) {
            throw new Exception("El archivo de las palabras se encuentra vacio: {$this->filePath}");
        }
        $indexRand = array_rand($words);
        return trim(strtoupper($words[$indexRand]));
    }

}
?>