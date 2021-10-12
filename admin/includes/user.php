<?php


class User extends db_object  {
    protected static $db_table = "users" ; 
    public $id ; 
    public $username ; 
    public $password ; 
    public $first_name ; 
    public $last_name ; 
    protected static $db_table_fields = array('username','password','first_name','last_name','user_image') ; 
    public $user_image ; 
    public $upload_directory = "images" ; 
    public $image_placeholder = "https://via.placeholder.com/300.png/09f/fff

C/O https://placeholder.com/ " ; 
public $errors = array() ; 

public $upload_errors_array = array(
    UPLOAD_ERR_OK => "There is no error",
    UPLOAD_ERR_INI_SIZE => "The upload file exceeds the upload_max filesize",
    UPLOAD_ERR_FORM_SIZE => "The upload file exceeds the upload_max filesize",
    UPLOAD_ERR_PARTIAL => "The upload file was only parially uploaded" ,
    UPLOAD_ERR_NO_FILE => "no file was uploaded" , 
    UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder" ,
    UPLOAD_ERR_CANT_WRITE => "Faild to write file to disk " , 
    UPLOAD_ERR_EXTENSION => "A php extension stopped the file Upload" );
    
/*
    function __construct()
    {
        
    }*/


    public function set_file($file)
    {
    
    
        if(empty($file) || !$file || !is_array($file) ) {
            $this->errors[] = "There is no file uploaded here" ;
            return false ; 
        }
        elseif($file['error']!= 0 ) {
            $this->errors[]= $this->upload_errors_array[$file['error'] ] ;
            return false ;
        }
        else{
    
                $this->user_image = basename($file['name']) ; 
                $this->tmp_path = $file['tmp_name'] ;
                $this->type = $file['type'] ;
                $this->size = $file['size'] ;
    
        }
    
    
    }
    public function upload_photo ()
{
   
       if(!empty($this->errors)) {
           return false ; 
       }
       if(empty($this->user_image) || empty($this->tmp_path)) { 
           $this->errors[]= "the file was not available ";
           return false ; 
       }
       //
          $target_path =  '.'. DS . $this->upload_directory. DS .$this->user_image ;
          
        if (file_exists($target_path)) {
            $this->errors[] = "The file {$this->user_image} already exists " ; 
            return false ; 

        }

        if(move_uploaded_file($this->tmp_path,$target_path)) {
                unset($this->tmp_path);
                return true ; 
            

        }  
        
        
        else {

            $this->errors[] = "The folder probably dose not have premission";
            return false ; 
            
        }

    
}



public function image_path_placeholder() {




    return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
}


public static function verify_user($username,$password) {


global $database ; 
$username = $database->escape_string($username) ; 
$password = $database->escape_string($password); 

$sql = "SELECT * FROM ". self::$db_table ." WHERE username = '{$username}' AND password = '{$password}' ";

$query = self::find_by_query($sql) ; 

return  !empty($query) ? array_shift($query) : false ; 




}
public function ajax_save_user_image($user_image,$user_id) {
    global $database ; 

    $user_image = $database->escape_string($user_image) ; 
    $user_id = $database->escape_string($user_id); 
    $this->user_image= $user_image; 
    $this->id=$user_id ;
    $sql= "UPDATE ".self::$db_table." SET user_image = '{$this->user_image}' ";
    $sql.= " WHERE id = {$this->id} " ; 
    $update_image = $database->query($sql) ; 
    echo $this->image_path_placeholder() ; 


}

    









}  // end of class users 
 

































?>