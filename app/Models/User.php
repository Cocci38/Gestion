<?php

namespace App\Models;

use PDO;


class User extends Model
{
    protected $table = 'users';
    protected $username;

    public function __set($prop, $value)
    {
        // if (array_key_exists($prop, $this->donnee)) {
        $this->donnee[$prop] = $value;
        // }
    }

    public function __get($prop)
    {
        // if (array_key_exists($prop, $this->donnee)) {
        return $this->donnee[$prop];
        // }
    }

    public function getByUsername(string $username)
    {

        $select = $this->db->getPDO()->prepare("SELECT * FROM {$this->table} WHERE username = ?");
        $select->execute([$username]);
        // error_log(print_r($select, 1));die;
        return $select->fetchAll(PDO::FETCH_OBJ);
    }
}
