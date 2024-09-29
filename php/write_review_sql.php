<?php
session_start();

//1. POSTデータ取得
$place_id = $_POST["hiddenPlaceValue"];

$user_icon = $_POST["user-icon"]; 
$username = $_SESSION["loginID"];
$email = $_SESSION["email"];
$rating = $_POST["rating"]; 
$review = $_POST["review"];

//2. DB接続します
include 'util/db_connect.php';

//３．SQL
$sql = "INSERT INTO review_table(`place_id`, `user-photo`, `username`, `email`, `rating`, `review`, `timestamp`)VALUES(:place_id, :user_icon, :username, :email, :rating, :review, sysdate());";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':place_id', $place_id, PDO::PARAM_INT);  
$stmt->bindValue(':user_icon', $user_icon, PDO::PARAM_STR);  
$stmt->bindValue(':username', $username, PDO::PARAM_STR);  
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  
$stmt->bindValue(':rating', $rating, PDO::PARAM_INT);  
$stmt->bindValue(':review', $review, PDO::PARAM_STR); 

$status = $stmt->execute(); 

//４．データ登録処理後
if($status==false){
  $error = $stmt->errorInfo();
  exit("SQL_INSERT_ERROR: " . htmlspecialchars($error[2], ENT_QUOTES));
}else{
  $safe_place_id = htmlspecialchars($place_id, ENT_QUOTES);
  header("Location: ../index.php?loadReview={$safe_place_id}");
  exit();
}
?>

