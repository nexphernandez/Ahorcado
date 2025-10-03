<?php

declare (strict_types =1);

namespace srs\public\ahorcado;

final class game {
    public array $usedLetters;
    
    /**
     * constructor de la clase game
     * @param string $word
     * @param int $maxAttempts
     * @param int $attemptsLeft
     */
    public function __construct(
    public String $word,
    public int $maxAttempts,
    public int $attemptsLeft
    
    ){}
}
?>