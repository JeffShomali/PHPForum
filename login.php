<?php include 'core/init.php';?>
<?php
     if(isset($_POST['do_login'])) {
         //Get Vraiables
          $username = $_POST['username'];
         $password = md5($_POST['password']);

          //Create User Object
          $user = new User();

         if ($user->login($username, $password)) {
             redirect('index.php', 'Logged in', 'success');
        }else {
             redirect('index.php', 'Login not valid', 'error');
        }

     }else {
         //redirect without submit
          redirect('index.php');
     }
