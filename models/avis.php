<?php

class avis
{
    private ? int $id = null;

   
    public function __construct(private string $username, private string $email, private string $avis)
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
    
    
    public function getUsername(): string
    {
        return $this->username;
    }
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
    
    
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    
    
    public function getAvis(): string
    {
        return $this->avis;
    }
    public function setAvis(string $avis): void
    {
        $this->avis = $avis;
    }
}