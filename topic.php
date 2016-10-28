<?php require('core/init.php'); ?>

<?php
//Topic Controller

//Initiate Topic Object
$topic = new Topic();

//Get IF from URL
$topic_id = $_GET['id'];

//Get Template and Assign Vars
$template = new Template('templates/topic.php');

//Assign variables
$template->topic   = $topic->getTopic($topic_id);//going to topic class and run getTopic() method
$template->replies = $topic->getReplies($topic_id);
$template->title   = $topic->getTopic($topic_id)->title;

//Dsiplay template
 echo $template;
