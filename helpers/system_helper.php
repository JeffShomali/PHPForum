<?php
/**
 * [redirect description]
 * @param  boolean $page         [Page that we want to redirect to]
 * @param  [type]  $message      [Message that we want to send, create session message]
 * @param  [type]  $message_type [Message type shoul be error or success message]
 * @return [type]                [redirect]
 */
function redirect($page = FALSE, $message = NULL, $message_type = NULL) {
	if (is_string ($page)) { // if the page is string
		$location = $page; // location would be page
	} else {
          // if its not current page assign, if we do not pass $page arg
		$location = $_SERVER ['SCRIPT_NAME'];
	}

	//Check For Message
	if($message != NULL){
		//Set Message
		$_SESSION['message'] = $message;
	}
	//Check For Type
	if($message_type != NULL){
		//Set Message Type
		$_SESSION['message_type'] = $message_type;
	}

	//Redirect
	header ('Location: '.$location);
	exit;
}

/*
 * Display Session Message
 */
function displayMessage(){
	if(!empty($_SESSION['message'])) {

		//Assign Message Var
		$message = $_SESSION['message'];

		if(!empty($_SESSION['message_type'])) {
			//Assign Type Var
			$message_type = $_SESSION['message_type'];
			//Create Output
			if ($message_type == 'error') {
				echo '<div class="alert alert-danger">' . $message . '</div>';
			} else {
				echo '<div class="alert alert-success">' . $message . '</div>';
			}
		}
		//Unset Message
		unset($_SESSION['message'] );
		unset($_SESSION['message_type'] );
	} else {
		echo '';
	}
}

/**
 * [Check If User Is Logged In]
 * @return boolean [if session is set and is_logged_in = true]
 */
function isLoggedIn(){
     if(isset($_SESSION['is_logged_in'])) {
          return true;
     } else {
          return false;
     }
}

/**
 * [getUser description]
 * @return [type] [description]
 */
function getUser(){
	$userArray = array(); //create empty array for holding session variables
	$userArray['user_id']  = $_SESSION['user_id'];
	$userArray['username'] = $_SESSION['username'];
	$userArray['name']     = $_SESSION['name'];
	return $userArray;
}
