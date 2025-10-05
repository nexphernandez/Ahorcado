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
     * Funcion que devuelve la palabra coculta con guiones bajos
     * @return string palabra oculta
     */
    public function getMaskedWord(): string{}

    /**
     * Funcion que devuleve los intentos restantes
     * @return void
     */
    public function getAttemptsLeft(): int{}

    /**
     * Funcion que devuelve las letras ya usadas
     * @return void
     */
    public function getUsedLetters(): array{}

    /**
     * Funcion que comprueba si la partida esta ganada
     * @return void
     */
    public function isWon(): bool{}

    /**
     * Funcion que comprueba si la partida esta perdida
     * @return void
     */
    public function isLost(): bool{}

    /**
     * Funcion que devuelve la palabra completa
     * @return void
     */
    public function getWord(): string{}

    /**
     * Funcion que serealiza el estado actual para guardarlo en la sesion
     * @return void
     */
    public function toState(): array{}

}
?>