<?php

class old_Model_User extends Model {

    protected $surname;
    protected $name;
    protected $patronymic;
    protected $email;
    protected $password;
    public $pdo;

    public function __construct()
    {
        $this->pdo = get_connection();
    }

    function create(array $data)
    { 
        $query = 'INSERT INTO odb_users (name, email, password, created_at) VALUES (?, ?, ?, ?)';
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($data);
    }

    public function getUsersList()
    {
        $query = 'SELECT * FROM odb_users ORDER BY id DESC';
        return $this->pdo->query($query, PDO::FETCH_ASSOC);
    }

    public function update()
    {
    }

    function destroy($id)
    { 
        $query = 'DELETE FROM odb_users WHERE id = ?';
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$id]);
    }

    public function getUserByEmail(string $email)
    {
        $query = 'SELECT * FROM odb_users WHERE email = ?';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        }
        return false;
    }

}