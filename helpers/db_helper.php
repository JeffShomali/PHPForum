<?php
/**
 * [Get number of replies per topic]
 * @param  [string] $topic_id [description]
 * @return [integer]          [return number of reply]
 */
function replyCount($topic_id){
     $db = new Database;
     $db->query('SELECT * FROM replies WHERE topic_id = :topic_id');
     $db->bind(':topic_id', $topic_id);
     //Assign Rows
     $rows = $db->resultset();
     //Get Count
     return $db->rowCount();
}

/**
 * [Get Categories]
 * @return [type] [description]
 */
 function getCategories(){
 	$db = new Database;
 	$db->query('SELECT * FROM categories');

 	//Assign Result Set
 	$results = $db->resultset();

 	return $results;
 }

/**
 * Count User Posts
 * @param  [integer] $user_id [description]
 * @return [integer]          [description]
 */
 function userPostCount($user_id){
 	$db = new Database;
 	$db->query('SELECT * FROM topics
 				WHERE user_id = :user_id
 				');
 	$db->bind(':user_id', $user_id);
 	//Assign Rows
 	$rows = $db->resultset();
 	//Get Count
 	$topic_count = $db->rowCount();

 	$db->query('SELECT * FROM replies
 				WHERE user_id = :user_id
 				');
 	$db->bind(':user_id', $user_id);
 	//Assign Rows
 	$rows = $db->resultset();
 	//Get Count
 	$reply_count = $db->rowCount();
 	return $topic_count + $reply_count;
 }
