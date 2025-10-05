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

$provider = new WordProvider(filePath: __DIR__ . '/resources/palabras.txt');

try {
    $palabra = $storage->get('word', $provider ->randomWord());
} catch (Exception $e) {
    print($e);
}

$game = new Game($palabra,6,[
    'word' => $palabra,
    'maxAttempts' => 6,
    'attemptsLeft' => $storage->get('attemptsLeft', 6),
    'usedLetters' => $storage->get('usedLetters', [])
]);

if (isset($_POST['word'])) {
    $game ->guessLetter($_POST['word']);
}

$storage ->set('word', $game->getWord());
$storage ->set('attemptsLeft', $game->getAttemptsLeft());
$storage ->set('usedLetters', $game->getUsedLetters());

$renderer = new Renderer();
$mostrar = $game->getMaskedWord();
$mensaje = "";
if ($game->isWon()) {
    $mensaje = "Felicidades ¡Ganaste! La palabra era: " . $game->getWord();
} elseif ($game->isLost()){
    $mensaje = "Lo siento ¡Perdiste! La palabra era: " . $game->getWord();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ahorcado en PHP</title>
</head>
<body>
<h1>Juego del Ahorcado</h1>

<?php echo "<img src='".$renderer->ascii($game->getAttemptsLeft())."' alt='Ahorcado'>"; ?>

<p>Palabra: <?php echo implode(" ", str_split($mostrar)); ?></p>
<p>Intentos restantes: <?php echo $game->getAttemptsLeft(); ?></p>
<p>Letras usadas: <?php echo implode(", ", $game->getUsedLetters()); ?></p>

<?php if ($mensaje === ""): ?>
    <form method="post">
    <?php
    $alfabeto = range('A', 'Z');
    foreach ($alfabeto as $letra):
        $disabled = in_array($letra, $game->getUsedLetters()) ? 'disabled' : '';
    ?>
        <button type="submit" name="word" value="<?= $letra ?>" <?= $disabled ?>><?= $letra ?></button>
    <?php endforeach; ?>
</form>
<?php else: ?>
    <p><strong><?php echo $mensaje; ?></strong></p>
    <a href="reset.php">Jugar de nuevo</a>
<?php endif; ?>

</body>
</html>
