<?php require('core/init.php'); ?>


<?php
//Create Topic Object
$topic = new Topic;

//Instantiate  User  Object
$user = new User;

//Check if the form was submmitted from register.php

if(isset($_POST['register'])){
     //Create Data Array for Submitted Form
     	$data = array();
     	$data['name']      = $_POST['name'];
     	$data['email']     = $_POST['email'];
     	$data['username']  = $_POST['username'];
     	$data['password']  = md5($_POST['password']);
     	$data['password2'] = md5($_POST['password2']);
     	$data['about']     = $_POST['about'];
     	$data['last_activity'] = date("Y-m-d H:i:s");


          //Upload Avatar Image
		if($user->uploadAvatar()){ //if uploadAvatar message is true,
               //put the firle name into our data array
			$data['avatar'] = $_FILES["avatar"]["name"];
		}else{
               //if not include avatar we set it into default avatar image
			$data['avatar'] = 'noimage.png';
		}

		//Register User
		//passing $data array to User class and call register function
		if($user->register($data)){
			redirect('index.php', 'Thanks to become our memebr, you can login now', 'success');
		} else {
			redirect('index.php', 'Something went wrong with registration', 'error');
		}

}//end

//Get Template and Assign Vars
$template = new Template('templates/register.php');

//Assign variables

//Dsiplay template
 echo $template;
