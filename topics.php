<?php require('core/init.php'); ?>

<?php
//Create Topic Object
$topic =  new Topic;

//Get Category From URL
//This is check if site.com/topics.php?category=2 is set
$category = isset($_GET['category']) ? $_GET['category'] : null;

//Get User From URL
$user_id = isset($_GET['user']) ? $_GET['user'] : null;


//Get Template and Assign Vars
$template = new Template('templates/topics.php');

//Assign Template Variables
if(isset($category)){
	$template->topics = $topic->getByCategory($category);
	$template->title = 'Posts In "'.$topic->getCategory($category)->name.'"';
}

if(isset($user_id)){
	$template->topics = $topic->getByUser($user_id);
	//$template->title = 'Posts In "'.$user->getUser($category)->username.'"';
}


if(!isset($category) && !isset($user_id)) {
     //Assign variables
      $template->topics = $topic->getAllTopics();
}

$template->totalTopics = $topic->getTotalTopics();
$template->totalCategories = $topic->getTotalCategories();

//Dsiplay template
 echo $template;
