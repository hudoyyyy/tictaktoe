<?php

namespace app\core;

use app\lib\Db;

abstract class Model {

    public $db;

    public function __construct(){
        $this->db = new Db;
    }

    public function getQuery($sql){
        return $this->db->query($sql);
    }

    public function getRow($sql){
        return $this->db->row($sql);
    }

    public function getColumn($sql){
        return $this->db->column($sql);
    }

}