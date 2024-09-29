<?php
//1. POSTデータ取得
$review_id = $_POST["review_id"];
$place_id = $_POST["place_id"];

$user_icon = $_POST["user-icon"]; 
// $username = $_POST["username"];
// $email = $_POST["email"];
$rating = $_POST["rating"]; 
$review = $_POST["review"];

//2. DB接続します
include 'util/db_connect.php';

//３．SQL
$sql = "UPDATE review_table 
        SET `user-photo` = :user_icon, 
            -- username = :username, 
            -- email = :email, 
            rating = :rating, 
            review = :review, 
            timestamp = sysdate() 
        WHERE id = :review_id";
        
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_icon', $user_icon, PDO::PARAM_STR);  
// $stmt->bindValue(':username', $username, PDO::PARAM_STR);  
// $stmt->bindValue(':email', $email, PDO::PARAM_STR);  
$stmt->bindValue(':rating', $rating, PDO::PARAM_INT);  
$stmt->bindValue(':review', $review, PDO::PARAM_STR); 
$stmt->bindValue(':review_id', $review_id, PDO::PARAM_INT); 
$status = $stmt->execute(); 

//４．データ登録処理後
if($status==false){
  $error = $stmt->errorInfo();
  exit("SQL_UPDATE_ERROR: " . htmlspecialchars($error[2], ENT_QUOTES));
}else{
  $safe_place_id = htmlspecialchars($place_id, ENT_QUOTES);
  header("Location: ../index.php?loadReview={$safe_place_id}");
  exit();
}

?>
