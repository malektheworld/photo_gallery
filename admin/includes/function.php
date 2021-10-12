<?php




function redirect($location) {

    header("Location: {$location}") ; 
}



/* this func will replaced
function __autoload($class)
*/

function classAutoLoader($class)
{
    $class = strtolower($class) ; 
    $path = "includes/{$class}.php" ;



    if(file_exists($path)){
require_once($path) ; 

    }
    else {

        die("this file name {$class} was not found ") ; 
    }








    }
    spl_autoload_register('classAutoLoader' );































?>