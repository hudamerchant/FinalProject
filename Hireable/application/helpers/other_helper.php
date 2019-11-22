<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
    function dbDate($date){
        list($month, $day, $year) = explode("/",$date);
        return implode( "-" , [ $year,$month,$day ]);
    }
 