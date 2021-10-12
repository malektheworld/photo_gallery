<?php



class Photo extends Db_object {


    protected static $db_table = "photos" ; 
    public $id ; 
    public $title ; 
    public $description ; 
    public $caption ;
    public $alternative_text ; 
    public $filename ; 
    public $type ; 
    public $size ; 
    protected static $db_table_fields = array('id','title',  'caption', 'decscription','filename','alternative_text' ,'type','size' ) ; 
public $tmp_path ; 
public $upload_directory = "images" ; 
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

            $this->filename = basename($file['name']) ; 
            $this->tmp_path = $file['tmp_name'] ;
            $this->type = $file['type'] ;
            $this->size = $file['size'] ;

    }


}
public function picture_path() {
    return $this->upload_directory.DS.$this->filename ; 




}





public function save()
{
    if($this->id) {
        $this->update();
    }
    else {
       if(!empty($this->errors)) {
           return false ; 
       }
       if(empty($this->filename) || empty($this->tmp_path)) { 
           $this->errors[]= "the file was not available ";
           return false ; 
       }
       //
          $target_path =  '.'. DS . $this->upload_directory. DS .$this->filename ;
          
        if (file_exists($target_path)) {
            $this->errors[] = "The file {$this->filename} already exists " ; 
            return false ; 

        }

        if(move_uploaded_file($this->tmp_path,$target_path)) {
            if( $this->create() ) {
                unset($this->tmp_path);
                return true ; 
            }

        }  
        
        
        else {

            $this->errors[] = "The folder probably dose not have premission";
            return false ; 
            
        }

    }
}

public function delete_photo() {

if($this->delete()) 
{
    $target_path = SITE_ROOT.DS.'admin'.DS. $this->picture_path() ; 

    return unlink($target_path) ? true : false    ;

}
else {
    return false ; 
}


}
public static function display_sidebar_daata($photo_id){
    $photo = Photo::find_by_id($photo_id) ;
        $output = "<a class='thumbnail' href='#'><img width='100' src='{$photo->picture_path()}' </a>";
        $output.= "<p> {$photo->filename} </p> ";
        $output.= "<p> {$photo->type} </p> " ;
        $output.= "<p>{$photo->size}</p>" ;

echo $output;







}
















}

?>