<?php

/*
==================
4 pillar of oops
==================
1. encapsulation
2. inheritance => association 
3. abstraction
4. polymorphism
 */
class A{
 // protected $obj = new B;
 private $obj = new B;
 // public $obj = new B;

}

class B 
{
 // access modifier 
 // public  $qwer=0;
 // protected  $qwer=0;
 // private $qwer;

 private $name;
 // association 



 private $address;
 // parent::$name;

 // setter or getter 
// ==================================
 public function setName($a)
 {
  $this->name = $a;
 }

 // public function setAge($age)
 // {
 //  $this->age = $age;
 // }
 // ==========================================

 function getName()
 {
  return $this->name;
 }


 // function getAge()
 // {
 //  return $this->age;
 // }


}



class C extends A
{

 public function getName(){
  // $abc = new A;
  // $this->obj->setName("abc");
 }

}




$obj = new A;


// $obj->setName("abc");
// echo $obj->getName();
/*
Association

aggregration

compostion 

*/

// $a= new abc;
// $b= new abc;

// $a->qwer= 213;

// echo $a->qwer;
// echo "<br>";
// echo $b->qwer;

?>