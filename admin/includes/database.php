<?php

require_once("new_config.php") ;







class Database
 {
   
     public  $connection ;
    function __construct() {

       $this-> open_db_connection() ; 

    }
        
    



   public  function open_db_connection()
{



//$this->connection  = mysqli_connect(DB_HOST,DB_User,DB_PASS,DB_NAME) ;  
    $this->connection = new mysqli(DB_HOST,DB_User,DB_PASS,DB_NAME) ;


   if($this->connection->connect_errno) 
   {
       die(  "Query Faild" . $this->connection->connect_error   ) ; 
   }
    

}
public function query($sql){

    $result =   $this->connection->query($sql);
   
    return $result ; 
    






}

private function confirm_query($result) {


    if(!$result){

        die("Query faild" .$this->connection->error ) ; 

    }
}
 public function escape_string($string) {

  $escaped_string =   $this->connection->real_escape_string($string) ;
return $escaped_string ; 



 }
 public function the_insert_id1(){

return $this->connection->inserrt_id;



 }
 public function the_insert_id() {
     return mysqli_insert_id($this->connection) ; 
 }


}
$database = new Database() ; 
$database->open_db_connection() ; 

 



?>