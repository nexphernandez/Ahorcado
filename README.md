# <img src=../../../../../../images/computer.png width="40"> Code, Learn & Practice(Acceso a Datos: "Trabajo con ficheros interfaz gráfica")

<img src="https://laruletagiratoria.com/wp-content/uploads/ahorcado.jpg" size="300">

## Preparación

- Descarga el fichero ahorcado.zip que se encuentra dentro de la carpeta recursos.
- Descarga, ejecuta y verifica el correcto funcionamiento.
- Crea un repositorio dentro de github (`https://github.com/tu-usuario/ahorcado`))

- Crea una rama llamada `v1`.
- Genera un README.md para la documentación de proyecto
  
- Diseña un `mock` con [drawio](https://www.drawio.com/), e integra en la carpeta `images`.

## Juego

El juego debe de tener el siguiente diagrama de realaciones de clases

```code
WordProvider  ──►  Game  ◄── Storage
       │               │
       └──────────────►│
                       │
                   Renderer
```

- **WordProvider**: obtiene palabras desde ficheros u otras fuentes.
- **Game**: encapsula la lógica del juego (estado, intentos, victoria/derrota).
- **Storage**: maneja la persistencia del estado (sesiones).
- **Renderer**: dibuja el ahorcado en ASCII según intentos restantes.

---

### Clase: `Game`

**Responsabilidad:** Gestionar la partida.

### Estado interno

- `string $word` — palabra objetivo en MAYÚSCULAS.
- `int $maxAttempts` — número máximo de intentos.
- `int $attemptsLeft` — intentos restantes.
- `string[] $usedLetters` — letras jugadas.

#### Métodos

- `__construct(string $word, int $maxAttempts = 6, ?array $state = null)`  
  Inicializa o restaura estado.
- `guessLetter(string $letter): void`  
  Procesa una letra, resta intentos si falla.
- `getMaskedWord(): string`  
  Devuelve la palabra con guiones bajos y letras descubiertas.
- `getAttemptsLeft(): int`  
  Retorna intentos restantes.
- `getUsedLetters(): array`  
  Retorna letras ya jugadas.
- `isWon(): bool`  
  Verdadero si la palabra fue adivinada.
- `isLost(): bool`  
  Verdadero si no quedan intentos y no ganó.
- `getWord(): string`  
  Devuelve la palabra completa.
- `toState(): array`  
  Serializa estado (para guardar en sesión).

---

### Clase: `WordProvider`

**Responsabilidad:** Proveer palabras para el juego.

#### Estado interno

- `string $filePath` — fichero de palabras.

#### Métodos

- `__construct(string $filePath)`  
  Configura la fuente de palabras.
- `randomWord(): string`  
  Retorna palabra aleatoria (mayúsculas, limpia de acentos).

---

### Clase: `Storage`

**Responsabilidad:** Persistir estado en la sesión.

#### Estado interno

- `string $key` — clave de namespacing en `$_SESSION`.

#### Métodos

- `__construct(string $key = 'ahorcado')`  
  Inicializa sesión y espacio de datos.
- `get(string $name, $default = null)`  
  Recupera valor o `$default`.
- `set(string $name, $value): void`  
  Guarda valor.
- `reset(): void`  
  Elimina estado almacenado.

---

### Clase: `Renderer`

**Responsabilidad:** Renderizar el dibujo ASCII del ahorcado.

#### Métodos
- `ascii(int $attemptsLeft): string`  
  Devuelve el dibujo `<pre>…</pre>` según intentos restantes.

---

## Flujo de uso

1. `Storage` carga estado de sesión.
2. `WordProvider` da la palabra inicial si no existe.
3. `Game` gestiona lógica de letras e intentos.
4. `Storage` guarda de nuevo el estado (`toState()`).
5. `Renderer` convierte intentos restantes en el dibujo ASCII.
6. `index.php` genera HTML con datos de `Game` + `Renderer`.

---

## Extensiones opcionales

- **Pistas:** método que revela una letra con coste de intento.
- **Historial:** registrar partidas en fichero.
- **Categorías/dificultad:** `WordProvider` avanzado.
- **Fichero Configuración**. Carga de inicio el número de intentos/nivel de arranque/etc del juego.



## Referencias

- https://doc.php.net/archives/php5/php_manual_en.tar.gz

## Licencia 📄

Este proyecto está bajo la Licencia (Apache 2.0) - mira el archivo [LICENSE.md]([../../../LICENSE.md](https://github.com/jpexposito/code-learn-practice/blob/main/LICENSE)) para detalles.