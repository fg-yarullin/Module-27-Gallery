<?php

class Model_User extends Model {

    protected $usersTable;

    protected $surname;
    protected $name;
    protected $patronymic;
    protected $email;
    protected $password;

    public function __construct()
    {
        $this->pdo = get_connection();
        $this->usersTable = new DatabaseTable($this->pdo, 'user', 'id');
    }

    // function create(array $data)
    // { 
    //     $query = 'INSERT INTO odb_users (name, email, password, created_at) VALUES (?, ?, ?, ?)';
    //     $stmt = $this->pdo->prepare($query);
    //     return $stmt->execute($data);
    // }

    public function getUsersList()
    {
        return  $this->usersTable->findAll();
        // $query = 'SELECT * FROM odb_users ORDER BY id DESC';
        // return $this->pdo->query($query, PDO::FETCH_ASSOC);
    }

    public function save($record) //save or edit
    {
        return  $this->usersTable->save($record);
    }

    function delete($id)
    { 
        return  $this->usersTable->delete($id);
        // $query = 'DELETE FROM odb_users WHERE id = ?';
        // $stmt = $this->pdo->prepare($query);
        // return $stmt->execute([$id]);
    }

    public function findById($id)
    {
        return  $this->usersTable->findById($id);
    }

    public function find($column, $value)
    {
        return  $this->usersTable->find($column, $value);
    }

    public function total()
    {
        return  $this->usersTable->total();
    }


    // public function getUserByEmail(string $email)
    // {
    //     $query = 'SELECT * FROM odb_users WHERE email = ?';
    //     $stmt = $this->pdo->prepare($query);
    //     $stmt->execute([$email]);
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //     if ($result) {
    //         return $result;
    //     }
    //     return false;
    // }

}