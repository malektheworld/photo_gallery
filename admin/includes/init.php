<?php


defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
 define('SITE_ROOT' , DS. 'C:'. DS . 'xampp'. DS .'htdocs'.DS.'gallery1');
defined('INCLUDES_PATH') ? null :  define('INCLUDES_PATH', SITE_ROOT. DS .'admin'. DS .'includes'  );








require_once( 'function.php') ; 
require_once( 'db_object.php') ; 
include ('new_config.php') ; 
include ('database.php') ; 
include ('user.php') ; 
include ('photo.php') ; 
include ('comment.php') ; 
include ('paginate.php') ; 
include ('session.php') ; 























?>