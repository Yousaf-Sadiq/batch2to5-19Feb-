<?php

/*
4 pillar of oops
1. encapsulation
2. inheritance 
3. abstraction
4. polymorphism
 */


class abc{
 // access modifier 
 // public  $qwer=0;
 // protected  $qwer=0;
 // private $qwer;

 private $name;
 private $age;
 private $address;
 // parent::$name;

 // setter or getter 
// ==================================
 function setName($a)
 {
  $this->name = $a;
 }

 function setAge($age)
 {
  $this->age = $age;
 }
// ==========================================

function getName(){
 return $this->name;
}


function getAge(){
 return $this->age;
}


}






$obj= new abc;


$obj->setName("abc");
echo $obj->getName();


// $a= new abc;
// $b= new abc;

// $a->qwer= 213;

// echo $a->qwer;
// echo "<br>";
// echo $b->qwer;

?>