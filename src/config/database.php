<?php

class Database {
    public static function getConnection() {
        $envPath = realpath(dirname(__FILE__) . '/../env.ini');
        $env = parse_ini_file($envPath);
        $conn = new mysqli($env['host'], $env['username'], $env['database']]);

        if($conn->conect_error) {
            die("Erro: " . $conn->conect_error);
        }

        return $conn;
    }
 }