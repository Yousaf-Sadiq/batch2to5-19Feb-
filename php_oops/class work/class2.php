<?php
namespace src\http\controller;
// abstraction 
// interfaces
// trait



interface person2
{
 public function engine(); // method
 public function engine2(); // method
 // public function display();
}
interface A
{
 public function display();
}


abstract class person
{

 protected $abc;
 public function display()
 {
  echo "display";
 }
 abstract public function engine(); // method
 // abstract public function name(); // method
 // abstract public function payment(); // method
 // abstract public function address(); // method
}


trait allFunction
{
 public function engine()
 {
  echo " engine";

 }
 public function display()
 {

  echo " display allFunction";

 }
 public function engine2()
 {
  echo "engine2";

 }
}


trait abc
{
 public function display()
 {
  echo "display  abc";
 }
}

class std
{
 use allFunction, abc {
  abc::display insteadof allFunction;
  allFunction::display as display2;
 }

 private $name;

 public function __construct($a)
 {
  $this->name = $a;
  echo "contructor call   " . $this->name;
 }

 public function display4()
 {
  echo "std class from class2.php file";
 }

 public function __destruct()
 {
  echo "destructor";
 }
}

// $obj = new std("dsjakldalsk");
// $obj2 = new std;

// $obj->display();
// $obj->display2();

?>