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

function refresh_url(int $second = 2, string $url)
{

  header("Refresh:{$second},url={$url}");

}




function redirect_url(string $url)
{
  header("Location:{$url}");
}
function pre(array $a)
{
  echo "<pre>";
  print_r($a);
  echo "</pre>";
}


function FileUPload(string $input, array $extention, string $to)
{
  // $extention=["jpg","jpeg","png"];


  $file = $_FILES[$input];

  $file_name = $file["name"];

  $tmp_name = $file["tmp_name"];

  $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION)); //JPG PNG ,png jpg
// ============================================
  $ext = $extention;

  if (!in_array($file_ext, $ext)) {

    $string = implode(",", $ext);

    ERROR_MSG("{$string} EXTENSTION ONLY  ALLOWED");

    return false;
  }


  // ========================================
  $randFile = ceil(rand(1, 99)) . "_" . $file_name;

  $destination = domain2 . $to . $randFile;


  if (move_uploaded_file($tmp_name, $destination)) {

    $AbsoulteUrl = domain . $to . $randFile;

$output=[$destination,$AbsoulteUrl];
    return $output ;
  } else {
    return false;
  }


}

?>