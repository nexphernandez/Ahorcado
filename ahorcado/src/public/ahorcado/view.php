<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ahorcado en PHP</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>Juego del Ahorcado</h1>

<div id="game-container">
    <div id="hangman-image">
        <img src="<?= $renderer->ascii($game->getAttemptsLeft()) ?>" alt="Ahorcado">
        
    </div>
    
    <div id="letters-container">
        <?php
        $alfabeto = range('A', 'Z');
        foreach ($alfabeto as $letra):
            $disabled = in_array($letra, $game->getUsedLetters()) ? 'disabled' : '';
            ?>
        <form method="post" style="display:inline;">
            <button type="submit" name="word" value="<?= $letra ?>" <?= $disabled ?>><?= $letra ?></button>
        </form>
        <?php endforeach; ?>
    </div>
</div>
<div id="hangman-text">
    <div>
        <p id="game-stats">Palabra: <?= implode(' ', str_split($mostrar)) ?></p>
    </div>
    <div>
        <p id="game-stats">Intentos restantes: <?= $game->getAttemptsLeft() ?></p>
    </div>
    <div>
        <p id="game-stats">Letras usadas: <?= implode(', ', $game->getUsedLetters()) ?></p>
    </div>
</div>

<?php if ($mensaje !== ""): ?>
    <div id="message" class="<?= $game->isWon() ? 'win' : '' ?>"><?= $mensaje ?></div>
    <div id="game-container">
        <a id="hangman-text" href="reset.php">Jugar de nuevo</a>
    </div>
<?php endif; ?>

</body>
</html>
