<?php
include 'database.php';
$obj=new query();
$condition_arr= array('name'=>'xyz','email'=>'xyz');
$result=$obj->updateData('user',$condition_arr,'id','3');
print_r($result);



?>