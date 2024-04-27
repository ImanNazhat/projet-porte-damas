<?php

class AvisManager extends AbstractManager
{
    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM opinions');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $opinions = [];

        foreach($result as $item)
        {
            $opinion = new Avis($item["user_name"], $item["email"], $item["comment"]);
            $opinion->setId($item["id"]);
            $opinions[] = $opinion;
        }
        return $opinions;
    }

     public function findOne(int $id) : ? Avis
    {
        $query = $this->db->prepare('SELECT * FROM opinions WHERE id=:id');

         $parameters = [
            "id" => $id
        ]; 

        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $opinion = new Avis($item["user_name"], $item["email"], $item["comment"]);
            $opinion->setId($result["id"]);
            return $opinion;


        }
        return null;
    }
    public function createAvis(Avis $avis) : Avis 
    {
        $query = $this->db->prepare('INSERT INTO opinions (id, user_name, email, comment) VALUES (NULL, :user_name,:email, :comment)');
        $parameters = [
            "user_name" => $avis->getUserName(),
            "email" => $avis->getEmail(),
            "comment" => $avis->getComment()
        ];

        $query->execute($parameters);

        $avis->setId($this->db->lastInsertId());

        return $avis;
    }
    
    public function delete(int $id) : void 
    {
        $query = $this->db->prepare('DELETE FROM opinions WHERE id=:id');
        
        $query->execute(array('id' => $id));
    }
    
    
}