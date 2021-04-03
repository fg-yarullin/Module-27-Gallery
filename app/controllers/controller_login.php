<?php

class Controller_Login extends Controller {
    private $authentication;

    // public function __construct() {
    //     // $authentication = new Authentication;
    //     // $this->model = new stdClass();
    //     $usersTable = new DatabaseTable(get_connection(), 'user', 'id');
    //     $this->authentication = new Authentication($usersTable, 'email', 'password');
    // }

    function loginForm() {
        $title = 'Log In';
        $this->view->generate('/../auth/login_view.php', 'template_view.php', $title);
    }

    public function processLogin() {
        $usersTable = new DatabaseTable(get_connection(), 'user', 'id');
        $this->authentication = new Authentication($usersTable, 'email', 'password');
        // var_dump($this->authentication); exit();
        if ($this->authentication->login($_POST['email'], $_POST['password'])) {
            header('location: /login/success');
        } else {
            // $title = 'Log In';
            $data = [
                'title' => 'Log In',
                // 'isLoggedIn' => !!$this->authentication->isLoggedIn() ? $this->authentication->isLoggedIn() : false,
                'error' => 'Invalid username or password.'
            ];
            $this->view->generate('/../auth/login_view.php', 'template_view.php', $data);
        }
    }

    public function success() {
        // $title = 'Login Successful';
        // $this->view->generate('/../auth/loginsuccess_view.php', 'template_view.php', $title);
        header('location: /gallery');
    }

    public function error() {
        return [
            'template' => 'loginerror.html.php',
            'title' => 'You are not logged in'
        ];
    }

    public function logout() {
        session_start();
        $_SESSION = [];
        session_destroy ();
        $title = 'Yo have been logged out';
        $this->view->generate('/../auth/logout_view.php', 'template_view.php', $title);
    }
}