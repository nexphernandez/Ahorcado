<?php
declare(strict_types=1);

use srs\public\ahorcado\Game;
use srs\public\ahorcado\Renderer;
use srs\public\ahorcado\Storage;
use srs\public\ahorcado\WordProvider;

require_once __DIR__ . '/Game.php';
require_once __DIR__ . '/Renderer.php';
require_once __DIR__ . '/Storage.php';
require_once __DIR__ . '/WordProvider.php';

$storage = new Storage();
$provider = new WordProvider(filePath: __DIR__ . '/resources/ficheros/words.txt');

try {
    $palabra = $storage->get('word', $provider->randomWord());
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

$game = new Game($palabra, 6, [
    'word' => $palabra,
    'maxAttempts' => 6,
    'attemptsLeft' => $storage->get('attemptsLeft', 6),
    'usedLetters' => $storage->get('usedLetters', [])
]);

if (isset($_POST['word'])) {
    $game->guessLetter($_POST['word']);
}

$storage->set('word', $game->getWord());
$storage->set('attemptsLeft', $game->getAttemptsLeft());
$storage->set('usedLetters', $game->getUsedLetters());

$renderer = new Renderer();
$mostrar = $game->getMaskedWord();
$mensaje = "";
if ($game->isWon()) {
    $mensaje = "Felicidades ¡Ganaste! La palabra era: " . $game->getWord();
} elseif ($game->isLost()) {
    $mensaje = "Lo siento ¡Perdiste! La palabra era: " . $game->getWord();
}

require __DIR__ . '/view.php';
