<?php

class UserDAO
{
  private $db;
  function __construct()
  {
    $this->db = new PDO("sqlite:data/data.db");
  }

  public function get(string $pseudo):User{

    $query = ($this->db)->query("select * from user where id=$id");
    if ($query){
      $user = $query->fetchAll(PDO::FETCH_CLASS,"User");
    }
    return $user[0];

  }

  public function create(string $pseudo, string $password, string $mail, string $tel, string $address){
    ($this->db)->query("insert into user values($pseudo,$password,$mail,$tel,$address)");
  }

}

?>
