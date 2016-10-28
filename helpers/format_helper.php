<?php

/**
 * [Formatting URL]
 * @param  [type] $str [description]
 * @return [type]      [description]
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

/**
 * [Changing Active Class if Category is Active]
 * @param  [type]  $catgory [description]
 * @return boolean          [description]
 */
 function is_active($category){
 		if(isset($_GET['category'])){
 			if($_GET['category'] == $category){
 				return 'active';
 			} else {
 				return '';
 			}
 		} else {
 			if($category == null){
 				return 'active';
 			}
 		}
 }
