<?php
/**
 * @author  nexphernandez 
 * @version 1.0.0
 */
declare(strict_types=1);
namespace srs\public\ahorcado;

final class Storage{
    private String $key;

    /**
     * Constructor de la clase Storage
     * @param string $key clave de para guardar los datos del juego
     */
    function __construct(String $key = 'ahoracado') {
        $this-> key = $key;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION[$this->key])) {
            $_SESSION[$this->key] = [];
        }
    }

    /**
     * metodo que obtiene un valor almacenado en la sesion
     * @param string $name nombre de la variable
     * @param mixed $default valor a devolver si no exisite
     * @return string nombre o null
     */
    function get(String $name, $default = null){
        return $_SESSION[$this->key][$name] ?? $default;
    }

    /**
     * Funcion que guarda un valor en la sesion
     * @param string $name nombre del valor
     * @param mixed $value valor a guardar
     * @return void
     */
    function set(String $name, $value): void{
        $_SESSION[$this->key][$name] = $value;
    }

    /**
     * Elimina todo los datos guardados en la sesion
     * @return void
     */
    function reset():void{
        $_SESSION[$this->key] = [];
    }

}
?>