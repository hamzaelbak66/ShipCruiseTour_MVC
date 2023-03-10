<?php
class Reservation{   
    private $db;
    private $stmt;

    public function __construct()
    {
        $this->db = new DB;
    }

    public function insertReservation($ID_user,$price_reservation,$id_Room,$ID_cruise){
    
        $sql ="INSERT INTO reservation (ID_user, price_reservation , id_Room, ID_cruise) VALUES (:id_user,:price_reservation ,:id_Room,:ID_cruise)";
        
        $this->db->query($sql);
        $this->db->bind(':id_user',$ID_user);
        $this->db->bind(':price_reservation',$price_reservation);
        $this->db->bind(':id_Room',$id_Room);
        $this->db->bind(':ID_cruise',$ID_cruise);
        $this->db->execute();
        if ($this->db->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }

    public function getreservation()
    {
        $sql = "SELECT 
        reservation.* , port.name as ports
        FROM reservation inner join port where reservation.port = port.id AND `start_date` > NOW()" ;
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->fetch();
    }

    public function getreservations($id)
    {
        $sql = "SELECT * FROM reservation WHERE id_reservation = :id";
        $this->db->query($sql);
        $this->db->bind(':id',$id);
        $this->db->execute();
        return $this->db->fetch();
    }

    public function getreservationByUserID($id)
    {
        $sql = "SELECT u.Id,r.*,c.* FROM users u,reservation r,cruise c WHERE u.Id=r.ID_user AND r.ID_cruise=c.ID_cruise AND u.Id=:id";
        $this->db->query($sql);
        $this->db->bind(':id',$id);
        $this->db->execute();
        return $this->db->fetchAll();

    }


}


?>