<?php 

require_once dirname(__FILE__)."/sample.php";
require_once dirname(__FILE__)."/class2.php";

use src\http\controller\std as student;
use src\http\controller\doc\std as student2;

$obj= new student2;

$obj->display3()

?>