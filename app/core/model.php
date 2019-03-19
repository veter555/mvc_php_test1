<?php
class Model {

    protected $table_name;
    protected $id_column;
    protected $columns = [];
    protected $collection;
    protected $sql;
    protected $params = [];
    
    public function initCollection() {
        $columns = implode(',',$this->getColumns());
        $this->sql = "select $columns from " . $this->table_name ;
        return $this;
    }
    
    public function getColumns() {
        $db = new DB();
        $sql = "show columns from  $this->table_name;";
        $results = $db->query($sql);
        foreach($results as $result) {
            array_push($this->columns,$result['Field']);
        }
        return $this->columns;
    }

    public function sort($params) {
        if(count($params) > 0) {
            $this->sql .= " order by ";
            foreach ($params as $key => $value) {
                $this->sql .= "$key $value,";
            }
            $this->sql= chop($this->sql,',');
        }
        return $this;
    }

    public function filter($params) {
        $this->sql = "select * from $this->table_name where ";
        if(isset($params)) {
            $values = [];
           foreach ($params as  $key => $value){
               $values[] = "$key = '" . $value . "'";
           }   
            if(count($values) > 1){
                 $this->sql .= $values[0] . " and " . $values[1];
            }
            else {
                $this->sql .= $values[0];
            }  
        }
        return $this;
    }


    public function getCollection() {
        $db = new DB();
        $this->sql .= ";";
        $this->collection = $db->query($this->sql, $this->params);
        return $this;
    }
    
    public function select() {
        return $this->collection;
    }
    
    public function selectFirst() {
        return isset($this->collection[0]) ? $this->collection[0] : null;
    }
    
    public function getItem($id) {
        $sql = "select * from $this->table_name where $this->id_column = ?;";
        $db = new DB();
        $params = array($id);
        return $db->query($sql, $params)[0];
    }

    public function saveItem($id, $values) {
        $sql = "update $this->table_name"
                . " set ";
        $params = [];
        foreach ($values as $key=>$value) {
            $sql .= "$key = ?,";
            array_push($params, $value);
        }
        $sql = chop($sql,',');
        $sql .= " where $this->id_column = ?;";
        array_push($params, $id);
        $db = new DB();
        return $db->query($sql, $params);
    }

    public function addItem($values) {
        $sql = "INSERT INTO $this->table_name(";
        $vals = ") VALUES(";
        $params = [];
        foreach ($values as $key=>$value) {
           $sql .= "$key, ";
           $vals .= ":$key, ";
        }
       $sql = rtrim($sql, ", ");
       $vals = rtrim($vals, ", ");;
       $sql = $sql . $vals . ");";
     if($values){
        $db = new DB();
         return $db->query($sql, $values);}
    }

    
    public function getPostValues() {
        $values = [];
        $columns = $this->getColumns();
        foreach ($columns as $column) {
            if($column == "description"){
                $description = htmlspecialchars(filter_input(INPUT_POST, $column));
                $values[$column] = $description;
            }
            /*
            if ( isset($_POST[$column]) && $column !== $this->id_column ) {
                $values[$column] = $_POST[$column];
            }
             * 
             */
           
            $column_value = strip_tags(filter_input(INPUT_POST, $column));
            if ($column_value && $column !== $this->id_column && $column != "description") {
                $values[$column] = $column_value;
            }

        }
        return $values;
    }

}
