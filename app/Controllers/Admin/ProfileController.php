<?php
namespace App\Controllers\Admin;
use App\Core\Support\QueryBuilder;
use Carbon\Carbon;

class ProfileController
{

    public function __construct()
    {
        if_not_authenticated();    
    }

    public function show()
    {
        return view('admin.profile.show');
    }

    public function edit()
    {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['name'], $_POST['username'])){
                
                $this->validation();
                $this->editProfile();

            }
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

        
        if(!empty($name_errors) || !empty($username_errors)){
            return back();
        }

    }

    private function nameValidation()
    {
        $name_errors = [];

        // name validation
        if(empty($_POST['name'])){
            $name_errors[] = 'The name field is required.';
        }

        // name validation
        if(strlen($_POST['name']) < 3){
            $name_errors[] = 'The length of name field shloud be grater than or equal to 3 characters.';
        }

        // name validation
        if(strlen($_POST['name']) > 32){
            $name_errors[] = 'The length of name field shloud be less than or equal to 32 characters.';
        }

        return $name_errors;
    }

    private function usernameValidation()
    {
        $username_errors = [];
        // username validation - check the username is empty
        if(empty($_POST['username'])){
            $username_errors[] = "The username field is required.";
        }

        if(str_contains($_POST['username'], " ")){
            $username_errors[] = "The username field cannot contain white space";
        }


        // username validation
        if(strlen($_POST['username']) < 3){
            $username_errors[] = "The length of username field shloud be grater than or equal to 3 characters.";
        }

        // username validation
        if(strlen($_POST['username']) > 32){
            $username_errors[] = 'The length of username field shloud be less than or equal to 32 characters.';
        }

        // username validation - check the username if exist
        
        $search_user = QueryBuilder::get('users', 'username', '=', $_POST['username']);
        if($search_user && $search_user->id != auth()->id){
            $username_errors[] = "Username is alerady taken, please pick up another one.";
        }
        
        return $username_errors;
    }

    private function editProfile()
    {
        $data = [
            'name' => $_POST['name'],
            'username' => $_POST['username'],
            'updated_at' => Carbon::now()
        ];
        QueryBuilder::update('users', $data, 'id', '=', auth()->id);
        session()->setFlash('success', "Profile was updated successfully.");
        return back();
        
    }
    
}