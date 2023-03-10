<?php

namespace App\Controllers\Auth;
use App\Core\Support\QueryBuilder;
use App\Core\Support\ReCaptcha;
class RegisterController
{
     private string $name;
     private string $username;
     private string $email;
     private string $password;
     private string $password_confirmation;
     
     public function index()
     {
          ifAuth();
          return view('auth.register');
     }

     public function store()
     {
          if($_SERVER['REQUEST_METHOD'] === 'POST'){
               if(isset($_POST['name'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['password_confirmation'], $_POST['re_captcha'])){
                    $this->checkReCaptchaV3();
                    // assign preperties
                    $this->name = htmlspecialchars(strip_tags($_POST['name']));
                    $this->username = htmlspecialchars(strip_tags($_POST['username']));
                    $this->email = htmlspecialchars(strip_tags($_POST['email']));
                    $this->password = $_POST['password'];
                    $this->password_confirm = $_POST['password_confirmation'];

                    // check the validations
                    $this->validation();

                    // create new account
                    $this->craeteNewAccount();
                    
               }
          }

     }

     private function checkReCaptchaV3()
     {
          if(!ReCaptcha::checkReCaptchaV3($_POST['re_captcha'])){
               session()->setFlash('fail', "ReCaptcha Error.!");
               return back();
          }
     }

     private function validation()
     {
          $name_errors = $this->nameValidation();
          if(!empty($name_errors)){
               session()->setFlash('name_errors', $name_errors);
          }

          $username_errors = $this->usernameValidation();
          if(!empty($username_errors)){
               session()->setFlash('username_errors', $username_errors);
          }


          $email_errors = $this->emailValidation();
          if(!empty($email_errors)){
               session()->setFlash('email_errors', $email_errors);
          }

          $password_errors = $this->passwordValidation();
          if(!empty($password_errors)){
               session()->setFlash('password_errors', $password_errors);
          }

          if(!empty($name_errors) || !empty($username_errors) || !empty($email_errors) || !empty($password_errors)){
               session()->setFlash('name', $this->name);
               session()->setFlash('username', $this->username);
               session()->setFlash('email', $this->email);
               return back();
          }

     }

     private function nameValidation()
     {
          $name_errors = [];

          // name validation
          if(empty($this->name)){
               $name_errors[] = 'The name field is required.';
          }

          // name validation
          if(strlen($this->name) < 3){
               $name_errors[] = 'The length of name field shloud be grater than or equal to 3 characters.';
          }

          // name validation
          if(strlen($this->name) > 32){
               $name_errors[] = 'The length of name field shloud be less than or equal to 32 characters.';
          }

          return $name_errors;
     }

     private function usernameValidation()
     {
          $username_errors = [];
          // username validation - check the username is empty
          if(empty($this->username)){
               $username_errors[] = "The username field is required.";
          }

          // username validation
          if(strlen($this->username) < 3){
               $username_errors[] = "The length of username field shloud be grater than or equal to 3 characters.";
          }

          // username validation
          if(strlen($this->username) > 32){
               $username_errors[] = 'The length of username field shloud be less than or equal to 32 characters.';
          }

          // username validation - check the username if exist
          if(QueryBuilder::get('users', 'username', '=', $this->username)){
               $username_errors[] = "Username is alerady taken, please pick up another one.";
          }
          
          return $username_errors;
     }

     private function emailValidation()
     {
          $email_errors = [];
          // email validation - check the email is empty
          if(empty($this->email)){
               $email_errors[] = "The email field is required.";
          }

          // email validation - check the email is invalid
          if(!filter_var($this->email, FILTER_VALIDATE_EMAIL) || strlen($this->email) < 6 || strlen($this->email) > 40){
               $email_errors[] = "Invalid email.";
          }

          // email validation - check the email if exist
          if(QueryBuilder::get('users', 'email', '=', $this->email)){
               $email_errors[] = "Email is alerady taken, please pick up another one.";
          }
          
          return $email_errors;
     }

     private function passwordValidation()
     {
          $password_errors = [];
          // password validation
          if(empty($this->password)){
               $password_errors[] = "The password field is required.";
          }

          // password validation
          if(strlen($this->password) < 8){
               $password_errors[] = "The password field should be grater than or equal to 8 characters.";
          }

          // password validation
          if(strlen($this->password) > 32){
               $password_errors[] = "The password field should be less than or equal to 32 characters.";
          }

          // password validation
          if($this->password_confirm !== $this->password){
               $password_errors[] = "Password confirmation doesn't match.";
          }

          return $password_errors;
         
     }

     private function craeteNewAccount()
     {
          $data = [
               'name' => $this->name,
               'username' => $this->username,
               'email' => $this->email,
               'password' => password_hash($this->password, PASSWORD_DEFAULT),
          ];

          try{
               QueryBuilder::insert('users', $data);
               session()->setFlash('success', 'Registered sucessfully, Sign in');
               return to('login');
          } catch (Exception $e) {
               session()->setFlash('fail', $e->getMessage());
               return back();
          }

     }

}