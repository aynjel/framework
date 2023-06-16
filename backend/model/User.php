<?php

namespace backend\model;

use backend\core\Model;

class User extends Model{
    
    protected $table = 'users';
    protected $primaryKey = 'id';
    
    public function __construct(){
        parent::__construct();
    }

}