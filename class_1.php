<?php 
function pre($array){
 echo "<pre>";
 print_r($array);
 echo "</pre>";
}

// variable 

// let abc= 78;

$qwer=89;

const host="djdksa";

define("abc",1234);

// starting , ending/condition , increament/decreament

$a=[123,43,543,654,765,8];
$q=[123,43,543,654,765,8];
$t=[123,43,543,654,765,8];


array_push($a,"123",432432,321321321,76765);


pre($a);


$key=array_values($a);

pre($key);

// array_search();


array_splice($t,2,1,"hello world");

pre($t);

echo count($a);

// snake case 

// arrayColumn

// do {
//  echo "<h1>{$a} </h1>";

// } while ($a < 1);


// while ($a<=10) {
 
//  echo "<h1>{$a} </h1>";

//  $a++;
// }



// print $qwer;


?>

<script>
let main=document.querySelector("#demo");

let div=document.createElement("div");
div.innerHTML="loremipsum";

main.appendChild(div);

let div2=document.createElement("div");
div2.innerHTML="loremipsum";

div.appendChild(div2)


</script>