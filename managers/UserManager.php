<?php

class UserManager
        {
            private array $users = [];
            private PDO $db;
        
            public function __construct()
            {
                $host = "db.3wa.io";
                $port = "3306";
                $dbname = "imannazhat_projet";
                $connexionString = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
        
                $user = "imannazhat";
                $password = "4335837fec396c1cc23733ab346baf6a";
        
                $this->db = new PDO(
                    $connexionString,
                    $user,
                    $password
                );
            }
        
            public function getUsers(): array
            {
                return $this->users;
            }
        
            public function setUsers(array $users): void
            {
                $this->users = $users;
            }
        
            public function loadUsers() : void
            {
                $query = $this->db->prepare('SELECT * FROM users');
                $query->execute();
                $users = $query->fetchAll(PDO::FETCH_ASSOC);
                $userList = [];
        
                foreach($users as $user)
                {
                    $item = new User($user["username"], $user["email"], $user["password"]);
                    $item->setId($user["id"]);
        
                    $userList[] = $item;
                }
        
             $this->users = $userList;
    }
}