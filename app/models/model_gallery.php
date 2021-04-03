<?php

class Model_Gallery extends Model {

    private $usersTable;
    private $imagesTable;
    private $commentsTable;
    private $authentication;

    public function __construct()
    {
        $this->usersTable = new DatabaseTable(get_connection(), 'user', 'id');
        $this->imagesTable = new DatabaseTable(get_connection(), 'image', 'id');
        $this->commentsTable = new DatabaseTable(get_connection(), 'comment', 'id');
        $this->authentication = new Authentication($this->usersTable, 'email', 'password');
    }
    
    public function getImagesData() {
        // var_dump($_POST); exit();

        $isGuest = (boolean)!$this->authentication->isLoggedIn() && !!$this->authentication->getUser();
        $users = $this->usersTable->findAll();
        $comments = $this->commentsTable->findAll();
        $images = $this->imagesTable->findAllSorted(2); // 1 - ASC, Othe value digit - DESC
        // var_dump($comments);
        foreach($images as $key => $image) {
            $userKey = (int) array_search($image['user_id'], array_column($users, 'id'));
            $commentKey = (int) array_search($image['id'], array_column($comments, 'image_id'));
            if (isset($userKey) && ($images[$key]['user_id'] == $users[$userKey]['id'])) {
                $images[$key]['user_name'] = $users[$userKey]['name'];
                $image[$key]['user_email'] = $users[$userKey]['email'];
            }
            if (isset($commentKey) && ($images[$key]['id'] == $comments[$commentKey]['image_id'])) {
                $images[$key]['comment'] = $comments[$commentKey]['text'];
                $images[$key]['date'] = $comments[$commentKey]['date'];
            } else {
                $images[$key]['comment'] = '';
                $images[$key]['date'] = '';
            }
            $images[$key]['isGuest'] = $isGuest;
        }
        // return $this->imagesTable->findAllSorted(2); // 1 - ASC, Othe value digit - DESC
        return $images;
    }

    public function getAllImages() {
        $images = $this->imagesTable->findAllSorted(2); // 1 - ASC, Othe value digit - DESC    
        return $images;
    }

    public function getImage($id) {
        
        $isGuest = !$this->authentication->isLoggedIn();
        if (!$isGuest && !empty($_POST['comment'])) {
            $comment = [
                'id' => null,
                'date' =>  date('Y-m-d'),
                'image_id' => $_POST['image_id'],
                'text' => $_POST['comment'],
                'user_id' => $this->authentication->getUser()['id']
            ];
            // var_dump($comment);
            // var_dump($isGuest);exit();
            $this->commentsTable->save($comment);
            // header('location: /gallery');
        }

        $image = $this->imagesTable->findById($id);
        // var_dump($image);
        $comments = $this->commentsTable->findWhere('image_id', $id, 'id', 0);

        $isVerified = !$isGuest &&
            ($image['user_id'] == !!$this->authentication->getUser()['id']) &&
            ($this->authentication->getUser()['email'] == $_SESSION['username']);
        $image['isGuest'] = $isGuest;
        $image['isVerified'] = $isVerified;

        $authUserId = isset($this->authentication->getUser()['id']) ? 
        $this->authentication->getUser()['id'] : false;
        $data = [
            'authUserId' => $authUserId,
            'isGuset' => $isGuest,
            'image' => $image,
            'comments' => $comments
        ];
        return $data;
    }

    public function deleteImage($id, $file_path) {
        $this->imagesTable->delete($id);
        $error = null;
        if (file_exists($file_path)) {
            $deleted = unlink($file_path);
            if (!$deleted) {
                $error = 'Could not delete file!';
            }
        } else {
            $error =  "The original file that you want to delete doesn't exist";
        }
        return $error;
    }

    public function addComment(array $comment) {
        $this->commentsTable->save($comment);
    }

    public function deleteComment($id) {
        $this->commentsTable->delete($id);
    }

    public function uploadImage() {

        try {
           // Undefined | Multiple Files | $_FILES Corruption Attack
           // If this request falls under any of them, treat it invalid.
           if (
               !isset($_FILES['fileToUpload']['error']) ||
               is_array($_FILES['fileToUpload']['error'])
           ) {
               throw new RuntimeException('Invalid parameters.');
           }
        
           // Check $_FILES['fileToUpload']['error'] value.
           switch ($_FILES['fileToUpload']['error']) {
               case UPLOAD_ERR_OK:
                   break;
               case UPLOAD_ERR_NO_FILE:
                   throw new RuntimeException('No file sent.');
               case UPLOAD_ERR_INI_SIZE:
               case UPLOAD_ERR_FORM_SIZE:
                   throw new RuntimeException('Exceeded filesize limit.');
               default:
                   throw new RuntimeException('Unknown errors.');
           }
        
           // You should also check filesize here.
           if ($_FILES['fileToUpload']['size'] > UPLOAD_MAX_SIZE) {
               throw new RuntimeException('Exceeded filesize limit. (max filesize 2MB)');
           }
        
           // DO NOT TRUST $_FILES['fileToUpload']['mime'] VALUE !!
           // Check MIME Type by yourself.
           $finfo = new finfo(FILEINFO_MIME_TYPE);
           if (false === $ext = array_search(
               $finfo->file($_FILES['fileToUpload']['tmp_name']),
               ALLOWED_TYPES, true)) {
               throw new RuntimeException('Invalid file format.');
           }
        
        //    // You should name it uniquely.
        //    // DO NOT USE $_FILES['fileToUpload']['name'] WITHOUT ANY VALIDATION !!
        //     if (mb_strlen($file_name) > 200) {
        //         return 'File name is too long! (maxlength is 200 characters)';
        //     };
        
            if (!mb_strlen((preg_match("`^[-0-9a-zA-Z_\.]+$`i", 
                $_FILES["fileToUpload"]["name"])))
                ) {
                return 'File name have to be in in English characters';
            };

            $file_name = sha1_file($_FILES['fileToUpload']['tmp_name']);

             // Check if file already exists
            if (file_exists(sprintf(UPLOAD_DIR . '%s.%s', $file_name, $ext))) {
                return "Sorry, file already exists.";
            }
        
           // On this example, obtain safe unique name from its binary data.
           if (!move_uploaded_file(
               $_FILES['fileToUpload']['tmp_name'],
               sprintf(UPLOAD_DIR . '%s.%s', $file_name, $ext)
           )) {
               throw new RuntimeException('Failed to move uploaded file.');
           }
           $data = [
               'name' => 'no name',
               'path' => sprintf(UPLOAD_DIR . '%s.%s', $file_name, $ext),
               'user_id' => $this->authentication->getUser()['id']
           ];
           $this->imagesTable->save($data);
           header('location: /gallery');
           
           // return 'File is uploaded successfully.';

        } catch (RuntimeException $e) {
           return $e->getMessage();
        }
    }
}