<?php
class User{
public $name;
public $password;
public $mail;
public $tel;
public $address;

  function __construct(string $name,string $password,string $mail,string $tel, string $address){
    $this->name=$name;
    $this->password=$password;
    $this->mail=$mail;
    $this->tel=$tel;
    $this->address=$address;
  }
}

?>
