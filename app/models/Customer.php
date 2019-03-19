<?php

class Customer extends Model {

    function __construct() {
        $this->table_name = "customer";
        $this->id_column = "id";
    }
   
}