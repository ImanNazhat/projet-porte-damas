<?php

class IngredientManager extends AbstractManager
{
    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM ingredients');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $ingredients = [];

        foreach($result as $item)
        {
            $ingredient = new Ingredient($item["name"]);
            $ingredient->setId($item["id"]);
            $ingredients[] = $ingredient;
        }
        return $ingredients;
    }

     public function findOne(int $id) : ?Ingredient // il faut mettre la nom de ma classe models
    {
        $query = $this->db->prepare('SELECT * FROM ingredients WHERE id=:id');

         $parameters = [
            "id" => $id
        ];

        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $ingredient = new Ingredient($result["name"]);
            $ingredient->setId($result["id"]);
            return $ingredient;


        }
        return null;
    }
    
    public function create(Ingredient $ingredient) : Ingredient
    {
        $query = $this->db->prepare('INSERT INTO ingredients (id, name) VALUES (NULL, :name)');
        $parameters = [
            "name" => $ingredient->getName(),
        ];

        $query->execute($parameters);

        $ingredient->setId($this->db->lastInsertId());

        return $ingredient;
    }
    
    public function delete(int $id) : void 
    {
        $query = $this->db->prepare('DELETE FROM ingredients WHERE id=:id');
        
        $query->execute(array('id' => $id));
    }
    
    public function edit(Ingredient $ingredient) : Ingredient
    {
        
        $query = $this->db->prepare('UPDATE ingredients SET name=:name WHERE id=:id');
        $parameters = [
            "name" => $ingredient->getName(),
            "id" => $ingredient->getId()
        ];
         
        $query->execute($parameters);
       
        return $ingredient;
    }
    
    public function findIngredientByMenuId(int $menuId) : array{
        
            $query = $this->db->prepare('
                SELECT ingredients.* 
                FROM ingredients
                JOIN dishes_ingredients ON dishes_ingredients.ingredients_id = ingredients.id
                WHERE dishes_ingredients.dishes_id = :menuId
            ');
            
            $query->execute(['menuId' => $menuId]);
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            
            $ingredients = [];
            foreach($results as $item)
            {
                $ingredient = new Ingredient($item['name']);
                $ingredient->setId($item['id']);
                $ingredients[] = $ingredient;
            }
        
            return $ingredients;
     }
     
     public function findIngredientByCategory(int $categoryId) : array
            {
                $query = $this->db->prepare('
                    SELECT 
                        dishes.id AS dish_id, 
                        dishes.name AS dish_name, 
                        dishes.picture AS dish_picture, 
                        ingredients.id AS ingredient_id, 
                        ingredients.name AS ingredient_name
                    FROM ingredients
                    JOIN dishes_ingredients ON dishes_ingredients.ingredients_id = ingredients.id
                    JOIN dishes ON dishes.id = dishes_ingredients.dishes_id
                    JOIN categories ON categories.id = dishes.categories_id
                    WHERE dishes.categories_id = :categories_id
                ');
            
                $query->execute(['categories_id' => $categoryId]);
                $results = $query->fetchAll(PDO::FETCH_ASSOC);
            
                 $dishes = [];

                    foreach ($results as $item) {
                        $dishId = $item['dish_id'];
                        if (!isset($dishes[$dishId])) {
                            $dishes[$dishId] = [
                                'id' => $item['dish_id'],
                                'name' => $item['dish_name'],
                                'picture' => $item['dish_picture'],
                                'ingredients' => []
                            ];
                        }
                
                        $dishes[$dishId]['ingredients'][] = [
                            'id' => $item['ingredient_id'],
                            'name' => $item['ingredient_name']
                        ];
                    }
                
                    return array_values($dishes);
}
}