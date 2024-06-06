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
    
    public function createUser(User $user) : User  
    {
        $query = $this->db->prepare('INSERT INTO users (id, username, email,password) VALUES (NULL, :username,:email, :password)');
        $parameters = [
            "username" => $user->getUserName(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword()
        ];

        $query->execute($parameters);

        $user->setId($this->db->lastInsertId());

        return $user;
    }
    public function delete(int $id) : void 
    {
        $query = $this->db->prepare('DELETE FROM users WHERE id=:id');
        
        $query->execute(array('id' => $id));
    }
    
    public function editUser(User $user) : User
    {
        
        $query = $this->db->prepare('UPDATE users SET username=:username,email=:email, password=:password WHERE id=:id');
        $parameters = [
            "username" => $user->getUserName(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "id" => $user->getId()
        ];
         
        $query->execute($parameters);
       
        return $user;
    }
}
                 