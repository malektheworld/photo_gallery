<?php

class Paginate {

public $currant_page ; 
public $items_per_pages ; 
public $items_total_count ; 

public function __construct($page=1, $items_per_pages=4, $items_total_count=0) {
$this->currant_page = (int)$page;
$this->items_per_pages= (int)$items_per_pages;
$this->items_total_count= (int)$items_total_count;

}


public function next() {

    return $this->currant_page + 1 ; 
}

public function previous() {
return $this->currant_page - 1; 

}

public function page_total(){
    return ceil( $this->items_total_count / $this->items_per_pages);
} 

public function has_previous() {
    return $this->previous() >= 1 ? true : false    ;

}

public function has_next() {
    return $this->next() <=$this->page_total() ? true : false    ;
}


public function offset() {
    return ($this->currant_page-1) * $this->items_per_pages;
}









}








?>