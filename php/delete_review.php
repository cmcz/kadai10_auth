<?php
//1. POSTデータ取得
$review_id = $_GET["review_id"];
$place_id = $_GET["place_id"];

//2. DB接続します
include 'util/db_connect.php';

//３．SQL
$sql = "DELETE FROM review_table WHERE id=:review_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':review_id', $review_id, PDO::PARAM_INT); 
$status = $stmt->execute(); 

//４．データ登録処理後
if($status==false){
    $error = $stmt->errorInfo();
    exit("SQL_DELETE_ERROR: " . htmlspecialchars($error[2], ENT_QUOTES));
}else{
    $safe_place_id = htmlspecialchars($place_id, ENT_QUOTES);
    header("Location: ../index.php?loadReview={$safe_place_id}");
    exit();
}
?>
