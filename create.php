<?php require('core/init.php'); ?>
<?php
//Create Toppic Object
$topic = new Topic;

if(isset($_POST['do_create'])){
     //Form Validation
     $validate =  new Validator;

     //create Data Array
     $data = [];
     $data['title'] = $_POST['title'];
     $data['body'] = $_POST['body'];
     $data['category_id'] = $_POST['category'];
     $data['user_id'] = getUser()['user_id'];
     $data['last_activity'] = date('Y-m-d H:i:s');

     //Required Field
     $field_array = ['title', 'body', 'category'];

     if($validate->isRequired($field_array)){
          if($topic->create($data)){
               redirect('index.php', 'Topic posted', 'success');
          }else {
               redirect('topic.php?id='.$topic_id, 'something went wrong', 'error');
          }
     }else {
          redirect('create.php', 'Please fill in all required fields', 'error');
     }
}
//Get Template and Assign Vars
$template = new Template('templates/create.php');

//Assign variables


//Dsiplay template
 echo $template;
