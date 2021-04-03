<?php

class Controller_Gallery extends Controller {

    public function action_index() {
        $data = $this->model->getAllImages();
        // var_dump($images);exit();
        $this->view->generate('/../gallery/gallery_view.php',
            'template_view.php', $data);
    }

    public function action_showimage() {
//        var_dump($_POST);exit();
         // $data = $this->model->getImage($_POST['image']['id']);
        $data = $this->model->getImage($_POST['image_id']);

        $this->view->generate(
            '/../gallery/showimage_view.php',
            'template_view.php',
            $data
        );
    }

    public function action_addImageForm() {
        $data = [
            'title' => 'Add New Image',
        ];
        $this->view->generate(
            '/../gallery/addimage_view.php',
            'template_view.php',
            $data
        );
    }


    public function action_save() {
//        $message = $this->model->uploadImage('./uploads/');
        $message = $this->model->uploadImage();
        if (isset($message)) {
            $this->view->generate(
                '/../gallery/addimage_view.php',
                'template_view.php',
                [
                    'message' => $message,
                    '$title' => 'Add New Image'
                ]
            );
        }
        // header('location: /gallery');
    }

    public function action_delete_image() {
        $this->model->deleteImage($_POST['id'], $_POST['path']);
        header('location: /gallery');
    }

    public function action_addcomment() {
//        extract($_POST);
      var_dump($_POST['comment']);
        // $this->view->generate(
        //     '/../gallery/addcomment_view.php',
        //     'template_view.php'
        // );
        $comment = [
            'id' => null,
            'date' =>  date('Y-m-d'),
            'image_id' => $_POST['comment']['image_id'],
            'text' => htmlspecialchars($_POST['comment']['commentText']),
            'user_id' => $_POST['comment']['author_id']
        ];
        $this->model->addcomment($comment);
    }

    public function action_deletecomment() {
        $this->model->deleteComment($_POST['id']);
        // $this->view->generate(
        //     '/../gallery/......._view.php',
        //     'template_view.php'
        // );
    }
}