<?php

class CategorieManager extends AbstractManager
{
    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM categories');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $categories = [];

        foreach($result as $item)
        {
            $categorie = new Categorie($item["name"]);
            $categorie->setId($item["id"]);
            $categories[] = $categorie;
        }
        return $categories;
    }

     public function findOne(int $id) : ? Categorie
    {
        $query = $this->db->prepare('SELECT * FROM categories WHERE id=:id');

         $parameters = [
            "id" => $id
        ]; 

        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $categorie = new Categorie($item["name"]);
            $categorie->setId($result["id"]);
            return $categorie;


        }
        return null;
    }
    
   
}