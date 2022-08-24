<?php
namespace Database;

use PDO;

class DBConnection{

    private $dbname; 
    private $username;
    private $password;
    private $pdo;

    /**
     * Construction (instanciation) de notre classe DBConnection
     */
    public function __construct(string $dbname, string $host, string $username, string $password) {
        // Enregistrement des éléments en attribut
        $this->dbname = $dbname;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     *  Je retourne $this->pdo (?? est-il différent de null)
     *  S'il existe tu me le retournes sinon on lui dit quoi faire après les ??
     * 
     *  On fait un tableau [] 
     * (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION : Mettre des exceptions quand il y a des soucis)
     * (PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ : passer les infos récupérer de tableau associatif (le mode par défaut) en OBJET)
     * (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET UTF8' : Pour mettre les caractères en utf8)
     */
    public function getPDO() {
        return $this->pdo ?? $this->pdo = new PDO("mysql:dbname={$this->dbname};host{$this->host}", $this->username, $this->password,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET UTF8'
        ]);
    }

}

?>