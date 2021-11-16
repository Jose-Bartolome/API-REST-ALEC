<?php
class Conexion extends PDO
{
    public $hostdb = 'bvmsi8xlfpo4eoqm8huh-mysql.services.clever-cloud.com';
    public $bdname = 'bvmsi8xlfpo4eoqm8huh';
    public $usuario = 'ubbdnduwftfi4ixe';
    public $password = 'byKV4JdznwI3aAe3so57';

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
