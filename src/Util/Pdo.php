<?php
namespace App\Util;

abstract class Pdo
{
    /**
     * Objeto bbdd
     *
     * @var /PDO
     */
    protected $_pdo; 

    

 
    /**
     * Constructor.
     *
     * Partes comunes a todo tipo de entrada
     */
    public static function create ( $object = null )
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=libricos20210128', 'root', 'root');
        if (!$pdo) {
            die('No pudo conectarse: ' . mysql_error());
        }
        echo 'Conectado satisfactoriamente<br /><br />';
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

}

