<?php

class Menu
{
    private ? int $id = null;

   
    public function __construct(private string $name, private string $discription,private string $picture, private string $categoriesId)
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

   
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    
    public function getName(): string
    {
        return $this->name;
    }

   
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDiscription(): string
    {
        return $this->discription;
    }

   
    public function setDiscription(string $discription): void
    {
        $this->discription = $discription;
    }
    
    public function getPicture(): string
    {
        return $this->picture;
    }

   
    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }
    
    public function getCategoriesId(): string
    {
        return $this->categoriesId;
    }

   
    public function setCategoriesId(string $categoriesId): void
    {
        $this->categoriesId= $categoriesId;
    }
   
    
}
