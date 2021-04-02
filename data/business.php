<?php
require './data.php';

class business extends database{
    protected $table_name;
    protected $key;

    public function __construct()
    {
        parent::connect();

    }
    function add_new($data){
        return parent::insert($this->_table_name, $data);
    }
 
    function delete_by_id($id){
        return $this->delete($this->_table_name, $this->_key.'='.(int)$id);
    }
 
    function update_by_id($data, $id){
        return $this->update($this->_table_name, $data, $this->_key."=".(int)$id);
    }
 
    function select_by_id($select, $id){
        $sql = "select $select from ".$this->_table_name." where ".$this->_key." = ".(int)$id;
        return $this->get_row($sql);
    }
}

?>