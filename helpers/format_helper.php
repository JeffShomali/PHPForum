<?php

/**
 * Formatting URL
 */
function urlFormat($str){
     //Stripping out all whitespaces
     $str = preg_replace('/\s*/', '', $str);
     //Converting to lowercase
     $str = strtolower($str);
     //Encodeing URL
     $str = urlencode($str);
     //Returning the Formatted URL
     return $str;
}

/**
 * Simple Date Formatter Function
 */
function formatDate($date){
     $date = date("F j, Y, g:i a", strtotime($date));
     return $date;
}
