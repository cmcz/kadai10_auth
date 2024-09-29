<?php

//1. POSTデータ取得
$email      = filter_input( INPUT_POST, "email" );
$loginID   = filter_input( INPUT_POST, "loginID" );
$loginPW   = filter_input( INPUT_POST, "loginPW" );
$loginPW   = password_hash($loginPW, PASSWORD_DEFAULT);   //パスワードハッシュ化

//2. DB接続します
include 'util/db_connect.php';

//３．データ登録SQL作成
$sql = "INSERT INTO user_table(email,loginID,loginPW,adminFlag,activeFlag)VALUES(:email,:loginID,:loginPW,0,1)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':loginID', $loginID, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':loginPW', $loginPW, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    $error = $stmt->errorInfo();
    exit("SQL_INSERT_ERROR: " . htmlspecialchars($error[2], ENT_QUOTES));
} else {
    header("Location: ../index.php");
    exit();
}
