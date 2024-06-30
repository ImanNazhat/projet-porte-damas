<?php

class MenuManager extends AbstractManager
            {
                public function findAll() : array
                {
                    $query = $this->db->prepare('SELECT * FROM dishes');
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    $dishes = [];
            
                    foreach($result as $item)
                    {
                        $dish = new Menu($item["name"], $item["picture"], $item["categories_id"]);
                        $dish->setId($item["id"]);
                        $dishes[] = $dish;
                    }
                    return $dishes;
                }
            
                 public function findOne(int $id) : ?Menu // il faut mettre la nom de ma classe models
                {
                    $query = $this->db->prepare('SELECT * FROM dishes WHERE id=:id');
            
                     $parameters = [
                        "id" => $id
                    ];
            
                    $query->execute($parameters);
                    $result = $query->fetch(PDO::FETCH_ASSOC);
            
                    if($result)
                    {
                        $dish = new Menu($result["name"], $result["picture"],$result["categories_id"]);
                        $dish->setId($result["id"]);
                        return $dish;
            
                    }
                    return null;
                }
                
                
                public function create(Menu $menu) : Menu 
                {
                    $query = $this->db->prepare('INSERT INTO dishes (id, name,picture,categories_id) VALUES (NULL, :name, :picture , :categories_id)');
                    $parameters = [
                        "name" => $menu->getName(),
                        "picture" => $menu->getPicture(),
                        "categories_id" => $menu->getCategoriesId()
                    ];
            
                    $query->execute($parameters);
            
                    $menu->setId($this->db->lastInsertId());
            
                    return $menu;
                }
                
                public function delete(int $id) : void 
                {
                    $query = $this->db->prepare('DELETE FROM dishes WHERE id=:id');
                    
                    $query->execute(array('id' => $id));
                }
                
                public function edit(Menu $menu) : Menu
                {
                    
                    $query = $this->db->prepare('UPDATE dishes SET name=:name, picture=:picture, categories_id=:categories_id WHERE id=:id');
                    $parameters = [
                        "name" => $menu->getName(),
                        "picture" => $menu->getPicture(),
                        "categories_id" => $menu->getCategoriesId(),
                        "id" => $menu->getId()
                    ];
                     
                    $query->execute($parameters);
                    
                    // Supprimer les anciens ingrédients associés au plat
                    $deleteOld = $this->db->prepare('DELETE FROM dishes_ingredients WHERE dishes_id=:dishes_id');
                    $deleteOld->execute(["dishes_id" => $menu->getId()]);
            
                    return $menu;
                }
                
                public function addIngredientToMenu($menuId, $ingredientId) {
                    
                    $query = $this->db->prepare('INSERT INTO dishes_ingredients (dishes_id, ingredients_id) VALUES (:dishes_id, :ingredients_id)');
                    
                    $parameters = [
                         "dishes_id" => $menuId,
                         "ingredients_id" => $ingredientId
                        ];
                        
                    $query->execute($parameters);
                }
                
                
            }
