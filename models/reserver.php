<?php

class resever
{
    private ? int $id = null;

   
    public function __construct(private string $name, private string $email, private string $telephone, private string $number, private Date $date, private Time $time, private string $message)
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
    
    
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    
    
    public function getTelephone(): string
    {
        return $this->telephone;
    }
    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }
    
    
     public function getNumber(): string
    {
        return $this->number;
    }
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }
    
    
    public function getDate(): Date
    {
        return $this->date;
    }
    public function setDate(Date $date): void
    {
        $this->date = $date;
    }
    
    
    public function getHour(): Time
    {
        return $this->hour;
    }
    public function setHour(Time $hour): void
    {
        $this->hour = $hour;
    }
    
    
    public function getMessage(): string
    {
        return $this->message;
    }
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}