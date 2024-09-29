<?php
// DB接続します
include 'util/db_connect.php';

// SQL
$sql = "SELECT * FROM place_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if($status==false) {
  $error = $stmt->errorInfo();
  exit("SQL_SELECT_ERROR: " . htmlspecialchars($error[2], ENT_QUOTES));
}

$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); 

foreach($values as $value){
  $location_name = htmlspecialchars($value["loc-name"], ENT_QUOTES, 'UTF-8');
  $place_id = htmlspecialchars($value["id"], ENT_QUOTES, 'UTF-8');
  
  $h = '';
  $h .= '<div>';
  $h .= '<li class="topic-item cursor-pointer" place_id="' . $place_id . '" currTopic="' . $location_name . '">';
  $h .= $location_name;
  $h .= '</li>';
  $h .= '</div>';
  echo $h;
}

?>



