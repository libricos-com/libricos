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
        try{
            $pdo = new \PDO('mysql:host=localhost;dbname=libricos20210128', 'root', 'root');
            echo 'Conectado satisfactoriamente<br /><br />';
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo; 
        }catch(Exception $e){
            echo $e->getMessage();
            return false;
        } 
    }

}

