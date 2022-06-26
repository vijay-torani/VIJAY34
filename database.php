<?php


class database{
private $server;
private $user;
private $password;
private $db_name;
public function connect(){
    $this->server="localhost";
    $this->user="root";
    $this->password="";
    $this->db_name="crudoops";
    $con=new mysqli($this->server,$this->user,$this->password,$this->db_name);
    if($con){
        echo "connection succsful";
    }
    return $con;
}
}

class query extends database{
public function getdata($table,$filed='*',$condition_arr='',$order_by_filed='',$order_by_type='',$limit=''){
    $sql="SELECT $filed from $table";
    
    if($condition_arr!=''){
       
        
        $sql.=" where ";
        $c=count($condition_arr);
        $i=1;
        foreach($condition_arr as $key=>$val){
            if($i==$c){
            $sql.="$key='$val' ";
            }
            else {
                $sql.="$key='$val' and ";
            }        
$i++;
        }
       
    }

    if($order_by_filed!=''){
        $sql.=" oder by $order_by_filed $order_by_type";
    }
    if($limit!=''){
        $sql.=" limit $limit";
    }
    // die($sql);

    $result=$this->connect()->query($sql);
   
   if($result->num_rows>0){
       $arr= array();
    
        while($row=$result->fetch_assoc()){
           $arr[]=$row;
          

        
    }
    return $arr;
    
}else {
    return 0;
}
}

public function insertData($table,$condition_arr=''){
   

    
    if($condition_arr!=''){
       
        foreach($condition_arr as $key=>$val){
           $filedarr[]=$key;
           $valuearr[]=$val;
           

        }
        $filed=implode(',',$filedarr);
        $value=implode("','",$valuearr);
        $value="'".$value."'";
        $sql="INSERT INTO  $table($filed) values($value)";
       
       
    }
   

   
    // die($sql);

    $result=$this->connect()->query($sql);
  
die($sql);

}
public function deleteData($table,$condition_arr=''){
    
    if($condition_arr!=''){
       
        
        $sql="delete from $table where ";
        $c=count($condition_arr);
        $i=1;
        foreach($condition_arr as $key=>$val){
            if($i==$c){
            $sql.="$key='$val' ";
            }
            else {
                $sql.="$key='$val' and ";
            }        
$i++;
        }
       
    }
    $result=$this->connect()->query($sql);
    die($sql);
    
    
}
public function updateData($table,$condition_arr='',$where_filed,$where_value){
    
    if($condition_arr!=''){
       
        
        $sql="update $table set ";
        $c=count($condition_arr);
        $i=1;
        foreach($condition_arr as $key=>$val){
            if($i==$c){
            $sql.="$key='$val' ";
            }
            else {
                $sql.="$key='$val' , ";
            }        
$i++;
        }
       
    }
    $sql.="where $where_filed=$where_value";
    $result=$this->connect()->query($sql);
    die($sql);
    
    
}
   
    // die($sql);
}
//select $filed form $table where $condition like $like $order_by_filed $order_by_type limit $limit;
?>