<?php
require './business.php';
class post extends business{
    function __construct() 
    {
      
        $this->_table_name = 'accounts';
         
      
        $this->_key = 'id';
         
      
        parent::__construct();
    }
}
$test = new post();
// $test->add_new(array(
//     'username' => 'bien van phuc123',
//     'email' => 'onion',
//     'password' => '123'
// ));
// $test->delete_by_id(12);
$test->update_by_id(array(
    'username' => 'php'
), 13);
echo "thanh cong";
?>