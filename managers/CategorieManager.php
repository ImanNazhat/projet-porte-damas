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
    
    public function findMeat() : array
    {
        $query = $this->db->prepare('SELECT * FROM dishes WHERE categories_id=:1');
        $query->execute(array('1' => "1"));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $meats = [];
        
        foreach($result as $item)
        {
            $dish = new Menu($item["name"], $item["description"], $item["picture"],$item["categories_id"]);
            $dish->setId($item["id"]);
            $meats[] = $item;
        }
        return $meats;
       
    }
    
    public function findVegetarian() : array
    {
        $query = $this->db->prepare('SELECT * FROM dishes WHERE categories_id=:2');
        $query->execute(array('2' => "2"));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $vegetarian = [];
        
        foreach($result as $item)
        {
            $dish = new Menu($item["name"], $item["description"], $item["picture"],$item["categories_id"]);
            $dish->setId($item["id"]);
            $vegetarian[] = $item;
        }
        return $vegetarian;
       
    }
    
    public function findDessert() : array
    {
        $query = $this->db->prepare('SELECT * FROM dishes WHERE categories_id=:3');
        $query->execute(array('3' => "3"));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $dessert = [];
        
        foreach($result as $item)
        {
            $dish = new Menu($item["name"], $item["description"], $item["picture"],$item["categories_id"]);
            $dish->setId($item["id"]);
            $dessert[] = $item;
        }
        return $dessert;
       
    }
}