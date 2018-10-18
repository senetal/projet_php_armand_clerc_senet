<?php

class UserDAO
{
  private $db;
  function __construct()
  {
    $this->db = new PDO("sqlite:data/data.db");
  }

  public function get(int $id):User{

    $query = ($this->db)->query("select * from user where id=$id");
    if ($query){
      $user = $query->fetchAll(PDO::FETCH_CLASS,"User");
    }
    return $user[0];

  }

}

?>
