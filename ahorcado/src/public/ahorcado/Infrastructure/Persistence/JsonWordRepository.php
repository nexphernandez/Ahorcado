<?php
/**
 * @author  nexphernandez 
 * @version 1.0.0
 */
declare(strict_types= 1);
namespace App\Infrastructure\Persistence;

use App\Domain\Repository\WordRepositoryInterface;
final class JsonWordRepository  implements WordRepositoryInterface{
    private $filePath;

    /**
     * Constructor de la clase JsonWordRepository
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
            throw new \RuntimeException("El archivo de palabras no existe: {$this->filePath}");
        }

        $data = json_decode(file_get_contents($this->filePath), true);
        if (!isset($data['words']) || !is_array($data['words'])) {
            throw new \RuntimeException("El archivo JSON no contiene un array 'words'");
        }

        $randomWord = strtoupper($data['words'][array_rand($data['words'])]);
        return trim($randomWord);
    }

}
?>