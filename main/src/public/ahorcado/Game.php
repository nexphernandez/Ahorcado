<?php
/**
 * @author  nexphernandez 
 * @version 1.0.0
 */
declare (strict_types =1);
namespace srs\public\ahorcado;
final class Game {
    private String $word;
    private int $maxAttempts;
    private int $attemptsLeft;
    private array $usedLetters;
    
    /**
     * constructor de la clase game
     * @param string $word palabra a adivinar
     * @param int $maxAttempts maximos intentos posibles
     * @param array $state estado de la partida
     */
    public function __construct(String $word, int $maxAttempts = 6, ?array $state = null){
        if ($state !== null) {
            $this->word = strtoupper($state['word']);
            $this->maxAttempts = (int) $state['maxAttempts'];
            $this->attemptsLeft = (int) $state['attemptsLeft'];
            $this->usedLetters = array_values(array_unique(array_map('strtoupper', (array)$state['usedLetters'])));
            return;
        }
        
        $this->word =strtoupper(trim($word));
        $this->maxAttempts = max(1, $maxAttempts);
        $this->attemptsLeft =$this->maxAttempts;
        $this->usedLetters = [];
    }

    /**
     * Funcion que verifica si la letra es aceptada o no
     * @param string $letter letra a verificar
     * @return void
     */
    public function guessLetter(string $letter): void{
        if ($this->isWon() || $this->isLost()) {
            return;
        }
        $letter = strtoupper(substr($letter, 0, 1));
        if (!preg_match('/^[A-Z]$/', $letter)) {
            return;
        }
        if (in_array($letter, $this->usedLetters)) {
            return;
        }
        $this->usedLetters [] = $letter;
        if(strpos($this->word, $letter) === false){
            if ($this->attemptsLeft > 0) {
                $this->attemptsLeft --;
            }
        }
    }

    /**
     * Funcion que devuelve la palabra coculta con guiones bajos
     * @return string palabra oculta
     */
    public function getMaskedWord(): string{
        $characters = preg_split('//', $this->word , -1, PREG_SPLIT_NO_EMPTY);
        $solution = array_map(function (String $character):String{
            return in_array($character,$this->usedLetters,true)? $character : '_';
        }, $characters);
        return implode(' ', $solution);
    }

    /**
     * Funcion que devuleve los intentos restantes
     * @return int
     */
    public function getAttemptsLeft(): int{
        return $this->attemptsLeft;
    }

    /**
     * Funcion que devuelve las letras ya usadas
     * @return void
     */
    public function getUsedLetters(): array{
        return $this->usedLetters;
    }

    /**
     * Funcion que comprueba si la partida esta ganada
     * @return void
     */
    public function isWon(): bool{
        return strpos($this->getMaskedWord(), '_') === false;
    }

    /**
     * Funcion que comprueba si la partida esta perdida
     * @return void
     */
    public function isLost(): bool{
        return $this->attemptsLeft <=0 && !$this->isWon();
    }

    /**
     * Funcion que devuelve la palabra completa
     * @return void
     */
    public function getWord(): string{
        return $this->word;
    }

    /**
     * Funcion que serealiza el estado actual para guardarlo en la sesion
     * @return void
     */
    public function toState(): array{
        return[
            'word' => $this->word,
            'maxAttempts' => $this->maxAttempts,
            'attemptsLeft' => $this-> attemptsLeft,
            'usedLetters' => $this-> usedLetters,
        ];
    }

}
?>