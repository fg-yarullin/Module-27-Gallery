<?php

class Controller_User extends Controller {

    function action_index() {
        $this->view->generate('/../user_view.php', 'template_view.php', $this->model->getUsersList());
    }
}