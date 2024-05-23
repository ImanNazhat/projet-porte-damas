<?php

class UserManager extends AbstractManager{
       
     public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM users');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $users = [];

        foreach($result as $item)
        {
            $user = new User($item["username"], $item["email"], $item["password"]);
            $user->setId($item["id"]);
            $users[] = $user;
        }
        return $users;
    }

     public function findOne(int $id) : ?User // il faut mettre la nom de ma classe models
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE id=:id');

         $parameters = [
            "id" => $id
        ];

        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $user = new User($result["username"], $result["email"], $result["password"]);
            $user->setId($result["id"]);
            return $user;


        }
        return null;
    }
     public function findByEmail(string $email) : ? User
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE email=:email');
        $parameters = [
            "email" => $email
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $user = new User($result["username"], $result["email"], $result["password"]);
            $user->setId($result["id"]);

            return $user;
        }
        else
        {
            return null;
        }
    }
}
                 