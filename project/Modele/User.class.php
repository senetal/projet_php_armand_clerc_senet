<?php

class User{
public $id;
public $name;
public $password;
public $mail;
public $tel;
public $address;

  function __construct(int $id,string $name,string $password,string $mail,string $tel, string $address){}
    $this->id=$id;
    $this->name=$name;
    $this->password=$password;
    $this->mail=$mail;
    $this->tel=$tel;
    $this->address=$address;
  }


 ?>
