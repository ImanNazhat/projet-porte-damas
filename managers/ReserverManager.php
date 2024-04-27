<?php

class ReservationManager extends AbstractManager
{
    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM reservations');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $reservations = [];

        foreach($result as $item)
        {
            $reservation = new Reservation($item["name"], $item["email"], $item["telephone"], $item["number"] , $item["date"] , $item["hour"] , $item["message"]);
            $reservation->setId($item["id"]);
            $reservations[] = $reservation;
        }
        return $reservations;
    }

     public function findOne(int $id) : ? Avis
    {
        $query = $this->db->prepare('SELECT * FROM reservations WHERE id=:id');

         $parameters = [
            "id" => $id
        ]; 

        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $reservation = new Reservation($item["name"], $item["email"], $item["telephone"], $item["number"] , $item["date"] , $item["hour"] , $item["message"]);
            $reservation->setId($item["id"]);
            return $reservation;


        }
        return null;
    }
    public function createReservation(Reservation $reservation) : Reservation 
    {
        $query = $this->db->prepare('INSERT INTO reservations (id, name, email, telephone, number, date, hour, message) VALUES (NULL, :name,:email, :telephone, :number, :date , :hour , :message)');
        $parameters = [
            "name" => $reservation->getName(),
            "email" => $reservation->getEmail(),
            "telephone" => $reservation->getTelephone(),
            "number" => $reservation->getNumber(),
            "date" => $reservation->getDate(),
            "hour" => $reservation->getTime(),
            "message" => $reservation->getMessage()
        ];

        $query->execute($parameters);

        $reservation->setId($this->db->lastInsertId());

        return $reservation;
    }
}