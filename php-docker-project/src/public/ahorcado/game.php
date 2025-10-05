<?php
/**
 * @author  nexphernandez 
 * @version 1.0.0
 */
declare (strict_types =1);
namespace srs\public\ahorcado;
final class game {
    private String $word;
    private int $maxAttempts;
    private int $attemptsLeft;
    public array $usedLetters;
    
    /**
     * constructor de la clase game
     * @param string $word palabra a adivinar
     * @param int $maxAttempts maximos intentos posibles
     * @param int $state estado de la partida 
     */
    public function __construct(String $word, int $maxAttempts = 6, ?array $state = null){
        
    }

    /**
     * Funcion que verifica si la letra es aceptada o no
     * @param string $letter letra a verificar
     * @return void
     */
    public function guessLetter(string $letter): void{}

    /**
     * Funcion que encuentra la palabra coculta
     * @return string palabra oculta
     */
    public function getMaskedWord(): string{}

    public function getAttemptsLeft(): int{}

    public function getUsedLetters(): array{}

    public function isWon(): bool{}

    public function isLost(): bool{}

    public function getWord(): string{}

    public function toState(): array{}

}
?>