<?php
//Database connection
class Database {

    private $server = 'localhost';
    private $user   = 'root';
    private $pass   = '';
    private $dbh    = 'grid';

    protected function connect(){
        
        $db_type_and_name = 'mysql:host='.$this->server.';dbname='.$this->dbh;

        $pdo = new PDO($db_type_and_name, $this->user, $this->pass);

        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $pdo;
    }
}
