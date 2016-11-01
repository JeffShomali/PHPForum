<?php

class Validator {
     /**
      * [Require Field Validation
      * @param  [array]  [$field_array]
      * @return boolean  [description]
      */
     public function isRequired($field_array) {
          foreach ($field_array as $field) {
               if($_POST[''.$field.''] == '') {
                    return false;
               }
          }
          return true;
     }

     /**
      * [Email Validatio ]
      * @param  [Email]  $email [email that we need to evaluate]
      * @return boolean    [description]
      */
     public function isValidEmail($email){
          if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
               return true;
          }else {
               return false;
          }
     }


     public function isPasswordMatched($pass1, $pass2){
          if($pass1 == $pass2){
               return true;
          }else {
               return false;
          }
     }

}
