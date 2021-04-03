<?php

class Controller_Register extends Controller {

    private $usersTable;

    // public function __construct($stdClass) {
    // // public function __construct() {
    //     $this->pdo = get_connection();
    //     $this->usersTable = new DatabaseTable($this->pdo, 'user', 'id');
    // } 

    public function registrationForm() {
        $this->view->generate('/../auth/register_view.php', 'template_view.php');
    }

    public function registerUser() {
        $this->usersTable = new DatabaseTable(get_connection(), 'user', 'id');

        $user = $_POST['user'];

        $valid = true;
        $errors = [];

        if (empty($user['name'])) {
            $valid = false;
            // array_push($this->errors, ['name' => 'Name cannot be blank']);
            $errors['name'] = 'Name cannot be blank';
        }

        if (empty($user['email'])) {
            $valid = false;
            // array_push($this->errors, ['email' => 'Email cannot be blank']);
            $errors['email'] = 'Email cannot be blank';
        } else if (filter_var($user['email'], FILTER_VALIDATE_EMAIL) == false) {
            $valid = false;
            $errors['email'] = 'Invalid email address';
        } else {
            $user['email'] = strtolower($user['email']);
            // if (count($this->usersTable->find('email', $user['email'])) > 0) {
            //     $valid = false;
            //     $errors['email'] = 'That email address is already registered';
            // }
        }

        if (empty($user['password'])) {
            $valid = false;
            // array_push($this->errors, ['password' => 'Password cannot be blank']);
            $errors['password'] = 'Password cannot be blank';
        }

        if ($valid == true) {
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
            $this->usersTable->save($user);
            header('location: /user/success');
        } else {
            return $this->registrationForm();
            // return [
            //     'template' => 'register.html.php',
            //     'title' => 'Register an account',
            //     'variables' => [
            //         'errors' => $errors,
            //         'user' => $user
            //     ]
            // ];
        }
    }

    public function success() {
        $title = 'Registration Successful';
        $this->view->generate('/../auth/registersuccess_view.php', 'template_view.php', $title);
        // return [
        //     'template' =>'registersuccess.html.php',
        //     'title' => 'Registration Successful'
        // ];
    }
    
}

