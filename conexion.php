<?php
class Conexion extends PDO
{
    public $hostdb = 'localhost';
    public $bdname = 'alec';
    public $usuario = 'root';
    public $password = '';

    public function __construct()
    {
        try {
            parent::__construct( 'mysql:host=' . $this->hostdb .
                ';dbname=' . $this->bdname . ';charset=utf8',
                $this->usuario,
                $this->password, array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ) );

        } catch ( PDOException $status ) {
            echo 'Problemas de conexion: ' . $status->getMessage();
            exit();
        }

    }

}