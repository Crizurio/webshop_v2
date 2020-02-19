<?php

namespace webshop_v2\Models;

use webshop_v2\Interfaces\iModels as iModels;

class UserModel implements iModels\iUserModel
{
    private $crud;

    public function __construct($crud)
    {
        $this->crud = $crud;
    }

    public function getUserByEmail(string $email)
    {
        //TODO user_names.full_name AS user_name,
        $query = 'SELECT users.id AS user_id, user_names.full_name AS user_name,
                  users.email, users.password FROM users LEFT JOIN user_names
                  ON users.id = user_names.id WHERE users.email = :email';

        $params = 
            [
                ':email' => [
                    'type' => \PDO::PARAM_STR,
                    'value' => $email
                ]
            ];
        
        if ($result =  $this->crud->selectOne($query, $params))
        {
            return $result;
        }
        else 
        {
            return false;
        }
    }

    public function setUser(
        string $fname,
        string $lname,
        string $email,
        string $password
    ): int
    
    {
        $query = 'INSERT INTO users(Fname, Lname, email, Password)
            VALUES(:fname, :lname, :email, :password)';

        $params = 
            [
                ':fname' => [
                    'type' => \PDO::PARAM_STR,
                    'value' => $fname
                ],

                ':lname' => [
                    'type' => \PDO::PARAM_STR,
                    'value' => $lname
                ],

                ':email' => [
                    'type' => \PDO::PARAM_STR,
                    'value' => $email
                ],

                ':password' => [
                    'type' => \PDO::PARAM_STR,
                    'value' => password_hash($password, PASSWORD_DEFAULT,
                    ['cost' => 12])
                ]
            ];
        
        $result = $this->crud->doInsert($query, $params);
        return $result;
    }

    public function setMessage(
        string $name,
        string $email,
        string $message
    ): bool

    {
        $query = 'INSERT INTO messages (name, email, message) VALUES ( :name,
        :email, :message)';

        $params = 
            [
                ':name' => [
                    'type' => \PDO::PARAM_STR,
                    'value' => $name
                ],

                ':email' => [
                    'type' => \PDO::PARAM_STR,
                    'value' => $email
                ],

                ':message' => [
                    'type' => \PDO::PARAM_STR,
                    'value' => $message
                ]
            ];

        $this->crud->doInsert($query, $params);
        return true;
    }
}