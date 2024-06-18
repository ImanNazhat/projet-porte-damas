<?php

class Avis
{
    private ? int $id = null;

   
    public function __construct(private string $userName, private string $email, private string $comment)
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
    
    
    public function getUserName(): string
    {
        return $this->userName;
    }
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }
    
    
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    
    
    public function getComment(): string
    {
        return $this->comment;
    }
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }
}