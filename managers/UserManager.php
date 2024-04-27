<?php

class UserManager extends AbstractManager{
       
     
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
            $user = new User($result["email"], $result["password"]);
            $user->setId($result["id"]);

            return $user;
        }
        else
        {
            return null;
        }
    }
}
                