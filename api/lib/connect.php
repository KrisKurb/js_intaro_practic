<?php
// Содениение с бд
class connect {
    public $connection;
    public function Connection(){

        $path = "config/parameters.ini";
        session_start();
        $ini_array = parse_ini_file($path, true);
        try {
            $this->connection = new PDO("pgsql:host={$ini_array['db']['host']};user={$ini_array['db']['login']};
    password={$ini_array['db']['password']};dbname={$ini_array['db']['user']}");
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage() . "<br/>";
            die();
        }

        return $this->connection;
    }
}