<?php

namespace App\Models;

use Database\DBConnection;

class Model {

    protected $db;
    protected $table;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }
}

?>