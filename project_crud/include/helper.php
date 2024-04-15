<?php
declare(strict_types=1);
function filter_data(string $data)
{
 global $conn;

 $data = trim($data); // extra white spaces remove left and rigth side

 $data = $conn->real_escape_string($data); // to secure from sql injection 

 $data = htmlspecialchars($data);// prevent to activate html tags

 $data = stripslashes($data); // remove extra slashed in any string 

 return $data;
}



function ERROR_MSG(string $msg)
{
 echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
<svg class='bi flex-shrink-0 me-2' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
<div>
  {$msg}
</div>
</div>";

}

function Success_MSG(string $msg)
{
 echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
 <svg class='bi flex-shrink-0 me-2' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
<div>
  {$msg}
</div>
</div>";
}

function refresh_url(int $second=2, string $url){

header("Refresh:{$second},url={$url}");

}


function redirect_url(string $url){
  header("Location:{$url}");
}
function pre(array $a){
echo "<pre>";
print_r($a);
echo "</pre>";
}
?>