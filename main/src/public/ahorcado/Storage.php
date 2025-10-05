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
    function __construct(String $key = 'ahoracado') {}

    /**
     * metodo que obtiene un valor almacenado en la sesion
     * @param string $name nombre de la variable
     * @param mixed $default valor a devover si no existe
     * @return string nombre o null
     */
    function get(String $name, $default = null){}

    /**
     * Funcion que guarda un valor en la sesion
     * @param string $name nombre del valor
     * @param mixed $value valor a guardar
     * @return void
     */
    function set(String $name, $value): void{}

    /**
     * Elimina todo los datos guardados en la sesion
     * @return void
     */
    function reset():void{}

}
?>