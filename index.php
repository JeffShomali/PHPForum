<?php require('core/init.php'); ?>

<?php
//Create Topic Object
$topic =  new Topic;

//Get Template and Assign Vars
$template = new Template('templates/frontpage.php');

//Assign variables
 $template->topics = $topic->getAllTopics();


//Dsiplay template
 echo $template;
