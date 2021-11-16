<?php
class Conexion extends PDO
{
    public $hostdb = 'bnlurpqojiy6nuutu41n-mysql.services.clever-cloud.com';
    public $bdname = 'bnlurpqojiy6nuutu41n';
    public $usuario = 'uh9dqjgh7377m26v';
    public $password = 'eohq1WQQm9HNiT3CPxyH';

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
