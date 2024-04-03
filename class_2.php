<?php
declare(strict_types=1);

// bitwise 
function SUM(int|float $a, int|float $b): int|float
{

 $result = $a + $b;

 return $result;

}

function SUM_array(array $a): int|float  
{
 $sum = 0;
 foreach ($a as $value) {
  $sum += $value;
 }

 return $sum;


}

$q=[12,321,4532,543,654,765,876];




$html = "<h1>" . SUM_array($q). "</h1>";

echo $html;

?>