<?php


class Db_object {


    protected static $db_table ; 


    public static function find_all() {
        return  static::find_by_query("SELECT * FROM ". static::$db_table ." ");
      }
      
      
      public static function find_by_id($id) {
      
      global $database ; 
      $query = static::find_by_query("SELECT * FROM ". static::$db_table ." WHERE id = {$id} ") ; 
      return !empty($query) ? array_shift($query) : false ; 
      
      /* way 2
      if(!empty($query)) {
      //array shift brings the fisrt item 
      $first_item =  array_shift($query) ; 
      return $first_item; 
      
      }
      else  {
          return false ; 
      } */ 
      
      
      }


      public static function find_by_query($sql) {
        global $database ; 
    
        $result_set = $database->query($sql) ;
        $the_object_array = array();
        while($row=mysqli_fetch_array($result_set) ) {
            $the_object_array[]= static::instat($row) ; 
    
    
    
    
        }
        return $the_object_array ;
    
    
    
    }

    
public static function instat($the_record) {
    $caling_class = get_called_class();
    $the_object = new $caling_class ;  
   

foreach ($the_record as $the_attribute => $value) {
if($the_object->has_the_attribute($the_attribute)) {
    $the_object->$the_attribute = $value ; 
}

}
return $the_object ; 

}
private function has_the_attribute($the_attribute) {
    $object_properties =  get_object_vars($this) ;
    // true or false 
    return array_key_exists($the_attribute,$object_properties) ; 
  
  }

  public function save() {

    return isset($this->id) ? $this->update() : $this->create();
    
    
    
    
    
    
    
    
    }
    
    public function create() {
    global $database ; 
    
    $propreties = $this->clean_properties();  
    
    $sql  = "INSERT INTO ". static::$db_table."(" . implode ("," , array_keys($propreties))   . ")";
    $sql .= "values ('" .       implode ("','" , array_values($propreties))          . "')" ; 
    
    /*
    $sql .= $database->escape_string($this->username) . "', '" ;
    $sql .= $database->escape_string($this->password) . "', '" ;
    $sql .= $database->escape_string($this->first_name) . "', '" ;
    $sql .= $database->escape_string($this->last_name) . "')" ;*/
    
    /*
    $sql = "INSERT INTO users (username,password,first_name , last_name) 
    values ( '$database->escape_string($this->username)',
             '$database->escape_string($this->password)',
            '$database->escape_string($this->first_name)',
            '$database->escape_string($this->last_name) ' )";  */
            
            if($database->query($sql)) {
                $this->id = $database->the_insert_id() ;
    
    return true ; 
    
            } else {
                return false ; 
    
            }
    
    
    
    }
     function update() {
         global $database ; 
         $propreties = $this->clean_properties();
         $propreties_pairs = array() ; 
         foreach($propreties as $key=>$value  ) {
             $propreties_pairs[] = "{$key}= '{$value}'";
    
         }
    
    $sql = "UPDATE ". static::$db_table." SET "; 
    $sql.= implode(", ", $propreties_pairs);
    
    /*
    $sql.= "username= '"   . $database->escape_string($this->username)     . "', ";
    $sql.= "password= '"   . $database->escape_string($this->password)     . "', ";
    $sql.= "first_name= '" . $database->escape_string($this->first_name) . "', ";
    $sql.= "last_name= '"  . $database->escape_string($this->last_name)   . "'  ";*/
    $sql .= " WHERE id= "  . $database->escape_string($this->id); 
    $database->query($sql) ; 
    return (mysqli_affected_rows($database->connection) == 1) ? true : false  ; 
    
    
     }
     function delete() {
    
    global $database ;
     
    $sql = "DELETE FROM ". static::$db_table." " ;
    $sql .= "Where id=". $database->escape_string($this->id); 
    $sql .= " LIMIT 1" ; 
    $database->query($sql) ; 
    return (mysqli_affected_rows($database->connection) == 1) ? true : false  ; 
    
    
    
    
    
    
     }
     protected function properties() {
        $propreties = array() ; 
    
        foreach(static::$db_table_fields as $db_fields) {
            if(property_exists($this,$db_fields)) {
                $propreties[$db_fields] = $this->$db_fields; 
            }
    
        }
        return $propreties ; 
    
    
    }
    
    
    
    



     protected function clean_properties() {
        global $database ; 
        $clean_properties  = array() ; 
        foreach ($this->properties() as $key=>$value ) {
            $clean_properties[$key]= $database->escape_string($value) ; 
    
        }
        return $clean_properties ; 
    }
    
    public static function count_all() {
        global $database ; 

         $sql = "SELECT COUNT(*) FROM ".static::$db_table;
         $result_set = $database->query($sql) ; 
         $row = mysqli_fetch_array($result_set);
         return array_shift($row) ; 








    }
    
    





}






























?>