<?php
declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Domain\Entity\Game;
use App\Infrastructure\Persistence\JsonWordRepository;
use App\Infrastructure\Session\SessionStorage;
use App\Presentation\Views\Renderer;

final class GameController
{
    private array $config;
    private SessionStorage $storage;
    private Renderer $renderer;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->storage = new SessionStorage();
        $this->renderer = new Renderer();

        session_start();
    }
    
    public function handle(): void
    {
        if (isset($_POST['reset'])) {
            $this->storage->reset();
            header("Location: index.php");
            exit;
        }
        $state = $this->storage->get('state');
        if ($state) {
            $game = new Game($state['word'], $state['maxAttempts'], $state);
        } else {
            $repo = new JsonWordRepository($this->config['ficheros']['words_file']);
            $word = $repo->randomWord();
            $game = new Game($word, $this->config['game']['max_attempts']);
        }

        if (isset($_POST['letter'])) {
            $letter = $_POST['letter'];
            $game->guessLetter($letter);
        }

        $this->storage->set('state', $game->toState());

        $this->renderView($game);
    }

    private function renderView(Game $game): void
    {
        $renderer = $this->renderer;
    $mostrar = $game->getMaskedWord();
    $mensaje = '';

    if ($game->isWon()) {
        $mensaje = " ¡Felicidades! Has ganado. La palabra era: " . $game->getWord();
    } elseif ($game->isLost()) {
        $mensaje = " Has perdido. La palabra era: " . $game->getWord();
    }
        require __DIR__ . '/../Views/View.php';
    }
}