<?php
/**
 * @author  nexphernandez 
 * @version 1.0.0
 */
declare(strict_types=1);
namespace srs\public\ahorcado;

final class Renderer{
    /**
     * Metodo que devuelve el dibujo segun los intentos restantes
     * @param int $attempsLeft intentos restantes
     * @return string url del dibujo
     */
    public function ascii(int $attempsLeft):string{
        $images = [
            6 => "/resources/images/ahorcado1.drawio.png",
            5 => "/resources/images/ahorcado2.drawio.png",
            4 => "/resources/images/ahorcado3.drawio.png",
            3 => "/resources/images/ahorcado4.drawio.png",
            2 => "/resources/images/ahorcado5.drawio.png",
            1 => "/resources/images/ahorcado6.drawio.png",
            0 => "/resources/images/ahorcado7.drawio.png",
        ];
        return $images[$attempsLeft] ?? "/resources/images/ahorcado1.drawio.png";
    }
}


?>
