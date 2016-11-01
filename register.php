<?php require('core/init.php'); ?>
<?php
//Create Topic Object
$topic = new Topic;

//Create User Object
$user = new User;

//Create Validator Object
$validate = new Validator;

//Check if the form was submmitted from register.php
if(isset($_POST['register'])) {
     //Create Data Array for Submitted Form
	$data = array();
	$data['name']      = $_POST['name'];
	$data['email']     = $_POST['email'];
	$data['username']  = $_POST['username'];
	$data['password']  = md5($_POST['password']);
	$data['password2'] = md5($_POST['password2']);
	$data['about']     = $_POST['about'];
	$data['last_activity'] = date("Y-m-d H:i:s");

     //Required Fields
     $field_array = array('name','email','username','password','password2');

	if($validate->isRequired($field_array)){
		if($validate->isValidEmail($data['email'])){
			if($validate->isPasswordMatched($data['password'],$data['password2'])){
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
                         redirect('index.php', 'Thanks to become our memeber, you can login now', 'success');
                    } else {
                         redirect('index.php', 'Something went wrong with registration', 'error');
                    }

			} else {
				redirect('register.php', 'Passwords not match', 'error');
			}
		} else {
			redirect('register.php', 'Email adress is not valid', 'error');
		}
	} else {
		redirect('register.php', 'Please fill in all required fields', 'error');
	}
}


//Get Template and Assign Vars
$template = new Template('templates/register.php');

//Assign variables

//Dsiplay template
 echo $template;
