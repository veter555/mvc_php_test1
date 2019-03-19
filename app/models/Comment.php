<?php
class Comment extends Model {

    function __construct() {
        $this->table_name = "comment";
        $this->id_column = "id";
    }
}
